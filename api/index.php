<?php

// Check if APP_KEY is set, if not, try to get it from environment
if (!getenv('APP_KEY') && isset($_ENV['APP_KEY'])) {
    putenv('APP_KEY=' . $_ENV['APP_KEY']);
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

