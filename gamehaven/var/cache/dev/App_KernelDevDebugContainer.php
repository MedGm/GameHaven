<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerIPrHQu8\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerIPrHQu8/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerIPrHQu8.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerIPrHQu8\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerIPrHQu8\App_KernelDevDebugContainer([
    'container.build_hash' => 'IPrHQu8',
    'container.build_id' => 'a3f5e9de',
    'container.build_time' => 1735759984,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerIPrHQu8');