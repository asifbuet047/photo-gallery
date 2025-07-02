<?php

$database_host = 'localhost';
$database_username = 'root';
$database_password = '';
$database_name = 'photo_gallery';

try {
    // Note: no space between $db_host and ;dbname
    $pdo = new PDO("mysql:host=$database_host;dbname=$database_name;charset=utf8mb4", $database_username, $database_password);

    // Set PDO error mode to exception for better error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // In production, avoid showing detailed errors to users
    die("Database connection failed.");
    // Optionally log error: error_log($e->getMessage());
}
