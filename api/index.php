<?php

if (!getenv('APP_KEY')) {
    putenv('APP_KEY=base64:fHKF0x55LT2sEnin5nM5WI9DztXu36lySsCYpKa8mvs=');
    $_ENV['APP_KEY'] = 'base64:fHKF0x55LT2sEnin5nM5WI9DztXu36lySsCYpKa8mvs=';
}

$tmpDir = '/tmp';
putenv("APP_CONFIG_CACHE=$tmpDir/config.php");
putenv("APP_EVENTS_CACHE=$tmpDir/events.php");
putenv("APP_PACKAGES_CACHE=$tmpDir/packages.php");
putenv("APP_ROUTES_CACHE=$tmpDir/routes.php");
putenv("APP_SERVICES_CACHE=$tmpDir/services.php");
putenv("VIEW_COMPILED_PATH=$tmpDir");
putenv("APP_BOOTSTRAP_CACHE=$tmpDir");

// Fix bootstrap/cache
$bootstrapCache = __DIR__ . '/../bootstrap/cache';
if (!is_dir($bootstrapCache)) {
    mkdir($bootstrapCache, 0775, true);
}

// Fix storage directories
$storageDirs = [
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache',
    '/tmp/storage/logs',
];
foreach ($storageDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
}

putenv("APP_STORAGE_PATH=/tmp/storage");

require __DIR__ . '/../public/index.php';