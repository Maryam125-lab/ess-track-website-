<?php

// Force set APP_KEY if not present
if (!getenv('APP_KEY')) {
    putenv('APP_KEY=base64:fHKF0x55LT2sEnin5nM5WI9DztXu36lySsCYpKa8mvs=');
    $_ENV['APP_KEY'] = 'base64:fHKF0x55LT2sEnin5nM5WI9DztXu36lySsCYpKa8mvs=';
}

// Set caching paths to /tmp since Vercel is read-only
$tmpDir = '/tmp';
putenv("APP_CONFIG_CACHE=$tmpDir/config.php");
putenv("APP_EVENTS_CACHE=$tmpDir/events.php");
putenv("APP_PACKAGES_CACHE=$tmpDir/packages.php");
putenv("APP_ROUTES_CACHE=$tmpDir/routes.php");
putenv("APP_SERVICES_CACHE=$tmpDir/services.php");
putenv("VIEW_COMPILED_PATH=$tmpDir");

// Forward Vercel requests to Laravel index.php
require __DIR__ . '/../public/index.php';

