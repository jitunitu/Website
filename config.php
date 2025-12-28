<?php
$host = 'localhost';
$dbname = 'earning_app';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("sqlite:../database/earning_app.db");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>