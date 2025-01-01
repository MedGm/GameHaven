<?php

/*
 * This file is part of the Symfony WebpackEncoreBundle package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\WebpackEncoreBundle\Asset;

use Psr\Cache\CacheItemPoolInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\WebpackEncoreBundle\Exception\EntrypointNotFoundException;

/**
 * Returns the CSS or JavaScript files needed for a Webpack entry.
 *
 * This reads a JSON file with the format of Webpack Encore's entrypoints.json file.
 *
 * @final
 */
class EntrypointLookup implements EntrypointLookupInterface, IntegrityDataProviderInterface
{
    private $entrypointJsonPath;

    private $entriesData;

    private $returnedFiles = [];

    private $cache;

    private $cacheKey;

    private $strictMode;

    private $httpClient;

    public function __construct(string $entrypointJsonPath, ?CacheItemPoolInterface $cache = null, ?string $cacheKey = null, bool $strictMode = true, ?HttpClientInterface $httpClient = null)
    {
        $this->entrypointJsonPath = $entrypointJsonPath;
        $this->cache = $cache;
        $this->cacheKey = $cacheKey;
        $this->strictMode = $strictMode;
        $this->httpClient = $httpClient;
    }

    public function getJavaScriptFiles(string $entryName): array
    {
        return $this->getEntryFiles($entryName, 'js');
    }

    public function getCssFiles(string $entryName): array
    {
        return $this->getEntryFiles($entryName, 'css');
    }

    public function getIntegrityData(): array
    {
        $entriesData = $this->getEntriesData();

        if (!\array_key_exists('integrity', $entriesData)) {
            return [];
        }

        return $entriesData['integrity'];
    }

    /**
     * Resets the state of this service.
     */
    public function reset(): void
    {
        $this->returnedFiles = [];
    }

    private function getEntryFiles(string $entryName, string $key): array
    {
        $this->validateEntryName($entryName);
        $entriesData = $this->getEntriesData();
        $entryData = $entriesData['entrypoints'][$entryName] ?? [];

        if (!isset($entryData[$key])) {
            // If we don't find the file type then just send back nothing.
            return [];
        }

        // make sure to not return the same file multiple times
        $entryFiles = $entryData[$key];
        $newFiles = array_values(array_diff($entryFiles, $this->returnedFiles));
        $this->returnedFiles = array_merge($this->returnedFiles, $newFiles);

        return $newFiles;
    }

    private function validateEntryName(string $entryName): void
    {
        $entriesData = $this->getEntriesData();
        if (!isset($entriesData['entrypoints'][$entryName]) && $this->strictMode) {
            $withoutExtension = substr($entryName, 0, strrpos($entryName, '.'));

            if (isset($entriesData['entrypoints'][$withoutExtension])) {
                throw new EntrypointNotFoundException(\sprintf('Could not find the entry "%s". Try "%s" instead (without the extension).', $entryName, $withoutExtension));
            }

            throw new EntrypointNotFoundException(\sprintf('Could not find the entry "%s" in "%s". Found: %s.', $entryName, $this->entrypointJsonPath, implode(', ', array_keys($entriesData['entrypoints']))));
        }
    }

    private function getEntriesData(): array
    {
        if (null !== $this->entriesData) {
            return $this->entriesData;
        }

        if ($this->cache) {
            $cached = $this->cache->getItem($this->cacheKey);

            if ($cached->isHit()) {
                return $this->entriesData = $cached->get();
            }
        }

        if (str_starts_with($this->entrypointJsonPath, 'http')) {
            if (null === $this->httpClient && !class_exists(HttpClient::class)) {
                throw new \LogicException(\sprintf('You cannot fetch the entrypoints file from URL "%s" as the HttpClient component is not installed. Try running "composer require symfony/http-client".', $this->entrypointJsonPath));
            }
            $httpClient = $this->httpClient ?? HttpClient::create();

            $response = $httpClient->request('GET', $this->entrypointJsonPath);

            if (200 !== $response->getStatusCode()) {
                if (!$this->strictMode) {
                    return [];
                }
                throw new \InvalidArgumentException(\sprintf('Could not find the entrypoints file from URL "%s": the HTTP request failed with status code %d.', $this->entrypointJsonPath, $response->getStatusCode()));
            }

            $this->entriesData = $response->toArray();
        } elseif (!file_exists($this->entrypointJsonPath)) {
            if (!$this->strictMode) {
                return [];
            }
            throw new \InvalidArgumentException(\sprintf('Could not find the entrypoints file from Webpack: the file "%s" does not exist.', $this->entrypointJsonPath));
        } else {
            $this->entriesData = json_decode(file_get_contents($this->entrypointJsonPath), true);
        }

        if (null === $this->entriesData) {
            throw new \InvalidArgumentException(\sprintf('There was a problem JSON decoding the "%s" file', $this->entrypointJsonPath));
        }

        if (!isset($this->entriesData['entrypoints'])) {
            throw new \InvalidArgumentException(\sprintf('Could not find an "entrypoints" key in the "%s" file', $this->entrypointJsonPath));
        }

        if (isset($cached)) {
            $this->cache->save($cached->set($this->entriesData));
        }

        return $this->entriesData;
    }

    public function entryExists(string $entryName): bool
    {
        $entriesData = $this->getEntriesData();

        return isset($entriesData['entrypoints'][$entryName]);
    }
}
