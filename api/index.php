<?php

if (!getenv('APP_KEY')) {
    putenv('APP_KEY=base64:fHKF0x55LT2sEnin5nM5WI9DztXu36lySsCYpKa8mvs=');
    $_ENV['APP_KEY'] = 'base64:fHKF0x55LT2sEnin5nM5WI9DztXu36lySsCYpKa8mvs=';
}

$tmpDir = '/tmp';

// Create all required directories in /tmp
$dirs = [
    $tmpDir . '/bootstrap/cache',
    $tmpDir . '/storage/framework/sessions',
    $tmpDir . '/storage/framework/views',
    $tmpDir . '/storage/framework/cache/data',
    $tmpDir . '/storage/logs',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
}

putenv("APP_CONFIG_CACHE=$tmpDir/bootstrap/cache/config.php");
putenv("APP_EVENTS_CACHE=$tmpDir/bootstrap/cache/events.php");
putenv("APP_PACKAGES_CACHE=$tmpDir/bootstrap/cache/packages.php");
putenv("APP_ROUTES_CACHE=$tmpDir/bootstrap/cache/routes.php");
putenv("APP_SERVICES_CACHE=$tmpDir/bootstrap/cache/services.php");
putenv("VIEW_COMPILED_PATH=$tmpDir/storage/framework/views");
putenv("APP_STORAGE_PATH=$tmpDir/storage");

// Symlink bootstrap/cache to /tmp/bootstrap/cache
$bootstrapCache = __DIR__ . '/../bootstrap/cache';
if (!is_dir($bootstrapCache)) {
    symlink($tmpDir . '/bootstrap/cache', $bootstrapCache);
}

require __DIR__ . '/../public/index.php';