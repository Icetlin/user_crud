<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container90Za28w\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container90Za28w/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container90Za28w.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container90Za28w\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container90Za28w\App_KernelDevDebugContainer([
    'container.build_hash' => '90Za28w',
    'container.build_id' => 'e02f7ada',
    'container.build_time' => 1720022923,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'Container90Za28w');
