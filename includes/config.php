<?php

$database_host = 'localhost';
$database_username = 'root';
$database_password = '';
$database_name = 'photo_gallery';

try {
    $pdo = new PDO("mysql:host=$database_host;dbname=$database_name;charset=utf8mb4", $database_username, $database_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed.");
}
