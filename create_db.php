<?php
// create_db.php
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Создаем базу данных
    $sql = "CREATE DATABASE IF NOT EXISTS stone_feedback";
    $conn->exec($sql);
    echo "База данных создана успешно<br>";
    
    // Используем базу данных
    $sql = "USE stone_feedback";
    $conn->exec($sql);
    
    // Создаем таблицу
    $sql = "CREATE TABLE IF NOT EXISTS feedback (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(100) NOT NULL,
        email VARCHAR(50) NOT NULL,
        comment TEXT NOT NULL,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    echo "Таблица feedback создана успешно";
} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}

$conn = null;
?>