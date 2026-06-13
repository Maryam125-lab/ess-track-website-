<?php

$host = '127.0.0.1';
$port = 3306;
$user = 'root';
$pass = '';
$db_name = 'ess-track-backend-db';

echo "Connecting to local MySQL server at $host:$port...\n";

$mysqli = mysqli_init();
$success = @$mysqli->real_connect($host, $user, $pass, null, $port);

if (!$success) {
    die("Connect Error (" . $mysqli->connect_errno . "): " . $mysqli->connect_error . "\n" .
        "Please make sure XAMPP MySQL is running and that your root password is empty. " .
        "If you have a password set, edit this file (import_local_db.php) and change the password.\n");
}

echo "Connected successfully to local MySQL server!\n";

// Create database if not exists
echo "Checking if database '$db_name' exists...\n";
if ($mysqli->query("CREATE DATABASE IF NOT EXISTS `$db_name`")) {
    echo "Database '$db_name' verified/created.\n";
} else {
    die("Error creating database: " . $mysqli->error . "\n");
}

// Select database
$mysqli->select_db($db_name);

// Import SQL file
$sql_file = __DIR__ . '/database_sql/QSaVsQ.sql';
echo "Reading SQL file from '$sql_file'...\n";

if (!file_exists($sql_file)) {
    die("Error: SQL file not found at '$sql_file'\n");
}

$sql = file_get_contents($sql_file);

echo "Importing SQL database schema and data...\n";
if ($mysqli->multi_query($sql)) {
    do {
        if ($result = $mysqli->store_result()) {
            $result->free();
        }
    } while ($mysqli->next_result());
    echo "SQL Import Completed Successfully! Local database '$db_name' is ready.\n";
} else {
    echo "Error importing SQL: " . $mysqli->error . "\n";
}

$mysqli->close();
