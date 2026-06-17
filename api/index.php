<?php

if (!getenv('APP_KEY')) {
    putenv('APP_KEY=base64:fHKF0x55LT2sEnin5nM5WI9DztXu36lySsCYpKa8mvs=');
    $_ENV['APP_KEY'] = 'base64:fHKF0x55LT2sEnin5nM5WI9DztXu36lySsCYpKa8mvs=';
}

$cacheKey = preg_replace('/[^A-Za-z0-9_]/', '_', getenv('VERCEL_GIT_COMMIT_SHA') ?: getenv('VERCEL_URL') ?: 'runtime');

putenv("APP_CONFIG_CACHE=/tmp/config_{$cacheKey}.php");
putenv("APP_EVENTS_CACHE=/tmp/events_{$cacheKey}.php");
putenv("APP_PACKAGES_CACHE=/tmp/packages_{$cacheKey}.php");
putenv("APP_ROUTES_CACHE=/tmp/routes_{$cacheKey}.php");
putenv("APP_SERVICES_CACHE=/tmp/services_{$cacheKey}.php");
putenv("VIEW_COMPILED_PATH=/tmp/views");

@mkdir('/tmp/views', 0777, true);

if (isset($_GET['__path'])) {
    $path = '/' . ltrim((string) $_GET['__path'], '/');
    unset($_GET['__path']);

    $query = http_build_query($_GET);
    $_SERVER['REQUEST_URI'] = $path . ($query ? '?' . $query : '');
    $_SERVER['PATH_INFO'] = $path;
}

require __DIR__ . '/../public/index.php';
