<?php

$host = 'gateway01.ap-southeast-1.prod.alicloud.tidbcloud.com';
$port = 4000;
$user = '5AW8x6zHdthMx9n.root';
$pass = 'RootPassword123!';
$db_name = 'test';

$mysqli = mysqli_init();
$mysqli->real_connect($host, $user, $pass, $db_name, $port, NULL, MYSQLI_CLIENT_SSL);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

echo "Connected successfully to Cloud DB.\n";

$sql_file = 'c:\\Users\\HP\\Downloads\\QSaVsQ.sql';
$sql = file_get_contents($sql_file);

if ($mysqli->multi_query($sql)) {
    do {
        if ($result = $mysqli->store_result()) {
            $result->free();
        }
    } while ($mysqli->next_result());
    echo "SQL Import Completed Successfully!\n";
} else {
    echo "Error importing SQL: " . $mysqli->error . "\n";
}

$mysqli->close();
