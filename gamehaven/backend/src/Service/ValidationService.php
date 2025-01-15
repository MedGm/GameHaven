<?php

namespace App\Service;

class ValidationService
{
    private const ALLOWED_PLATFORMS = ['PS5', 'PS4', 'Xbox Series X', 'Xbox One', 'Nintendo Switch', 'PC'];
    private const ALLOWED_CONDITIONS = ['new', 'like new', 'good', 'acceptable'];

    public function validateGameListing(array $data): array
    {
        $errors = [];
        
        if (!in_array($data['platform'] ?? '', self::ALLOWED_PLATFORMS)) {
            $errors[] = 'Invalid platform';
        }
        
        if (!in_array($data['condition'] ?? '', self::ALLOWED_CONDITIONS)) {
            $errors[] = 'Invalid condition';
        }

        return $errors;
    }
}
