<?php

$envPath = __DIR__ . '/../.env';

if (!file_exists($envPath)) {
    die('.env file not found. Please create one from .env.example');
}

$env = parse_ini_file($envPath);

$host = $env['DB_HOST'];
$db   = $env['DB_NAME'];
$user = $env['DB_USER'];
$pass = $env['DB_PASS'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

