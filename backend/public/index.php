<?php

// Front controller
require_once __DIR__ . '/../bootstrap/app.php';

$db = null;
try {
    // Initialize database when it is available
    $database = new Config\Database();
    $db = $database->getConnection();
} catch (\Throwable $e) {
    error_log('Database connection unavailable: ' . $e->getMessage());
    $db = null;
}

// Load routes even when database is not available
require_once __DIR__ . '/../routes/api.php';
