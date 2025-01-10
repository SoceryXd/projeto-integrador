<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'overclock_zone';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>
