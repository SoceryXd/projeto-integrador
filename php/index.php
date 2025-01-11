<?php

require_once 'db/configDatabase.php';
require_once 'controllers/UserController.php';

// Cria uma instância da controladora de usuários
$userController = new UserController($pdo);

// Chama o método de cadastrar usuário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->cadastrarUsuario($_POST);
} else {
    echo json_encode(['success' => false, 'message' => 'Método HTTP inválido.']);
}
?>