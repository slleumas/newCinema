<?php

$host = "localhost";
$dbname = "cinemadb";
$user = "root";
$password = "";
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Definir o modo de erro do PDO para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo "Conexão falhou: " . $e->getMessage();
}
