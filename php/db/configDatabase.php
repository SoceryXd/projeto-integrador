<?php

$host = 'localhost';  // Endereço do servidor de banco de dados
$db = 'overclock_zone';     // Nome do banco de dados
$user = 'root';        // Usuário do banco de dados
$pass = '';            // Senha do banco de dados

try {
    // Conectando ao banco de dados
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // Habilita modo de erro
} catch (PDOException $e) {
    // Caso ocorra algum erro na conexão
    echo 'Erro ao conectar: ' . $e->getMessage();
    exit;
}
?>