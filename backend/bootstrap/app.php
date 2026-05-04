<?php

// Manually load .env file if it exists
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $value = trim($parts[1], " \t\n\r\0\x0B\"'");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
            putenv("$key=$value");
        }
    }
} else {
    // If .env doesn't exist (like on Vercel), copy system env to $_ENV
    foreach (getenv() as $key => $value) {
        $_ENV[$key] = $value;
    }
}

// Error reporting
$debug = (isset($_ENV['APP_DEBUG']) && $_ENV['APP_DEBUG'] === 'true');
if ($debug) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

date_default_timezone_set('Asia/Karachi');

// Robust Autoloader
spl_autoload_register(function ($class) {
    $base_dir = __DIR__ . '/../';
    
    // Standard PSR-4 style
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
        return;
    }
    
    // Case-insensitive fallback for 'App' vs 'app'
    if (strpos($class, 'App\\') === 0) {
        $class = 'app' . substr($class, 3);
        $file = $base_dir . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    }
});
