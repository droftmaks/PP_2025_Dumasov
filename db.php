<?php
$host = "localhost";
$dbname = "a0951673_medgrag"; 
$username = "a0951673_medgrag";  
$password = "567tghjkP";      
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}
?>