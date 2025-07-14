<?php

// Start session with secure configuration
session_start([
    'cookie_lifetime' => 3600, // 1 hour
    'cookie_httponly' => true,
    'cookie_secure' => isset($_SERVER['HTTPS']), // Only over HTTPS if available
    'cookie_samesite' => 'Strict',
    'use_strict_mode' => true,
    'use_only_cookies' => true,
]);

// Database configuration - should be moved to environment variables in production
$servidor = $_ENV['DB_HOST'] ?? '127.0.0.1';
$usuario = $_ENV['DB_USER'] ?? 'root';
$senha = $_ENV['DB_PASS'] ?? 'root';
$db = $_ENV['DB_NAME'] ?? 'estoque_barba';

try{
    $conn = new PDO("mysql:host=$servidor;dbname=$db;charset=utf8mb4", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

}catch(PDOException $e) {
    // Log error securely without exposing sensitive information
    error_log("Database connection error: " . $e->getMessage());
    die('Erro de conexão com o banco de dados. Tente novamente mais tarde.');
}
