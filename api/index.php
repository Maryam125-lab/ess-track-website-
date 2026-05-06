<?php

if (!getenv('APP_KEY')) {
    putenv('APP_KEY=base64:fHKF0x55LT2sEnin5nM5WI9DztXu36lySsCYpKa8mvs=');
    $_ENV['APP_KEY'] = 'base64:fHKF0x55LT2sEnin5nM5WI9DztXu36lySsCYpKa8mvs=';
}

// Create bootstrap/cache as actual directory in project
$bootstrapCache = __DIR__ . '/../bootstrap/cache';
if (!file_exists($bootstrapCache)) {
    mkdir($bootstrapCache, 0777, true);
}

putenv("APP_CONFIG_CACHE=/tmp/config.php");
putenv("APP_EVENTS_CACHE=/tmp/events.php");
putenv("APP_PACKAGES_CACHE=/tmp/packages.php");
putenv("APP_ROUTES_CACHE=/tmp/routes.php");
putenv("APP_SERVICES_CACHE=/tmp/services.php");
putenv("VIEW_COMPILED_PATH=/tmp/views");

@mkdir('/tmp/views', 0777, true);

require __DIR__ . '/../public/index.php';