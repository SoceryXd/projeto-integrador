<?php

require_once 'models/User.php';

class UserDAO {
    private $pdo;

    // Construtor - Recebe a conexão PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Criar um novo usuário
    public function createUser($name, $email, $password) {
        $hashedPassword = (new User(0, '', '', '', ''))->encryptPassword($password);

        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword]);

        return $this->pdo->lastInsertId();
    }

    // Obter usuário por ID
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($userData) {
            return new User($userData['id'], $userData['name'], $userData['email'], $userData['password'], $userData['created_at']);
        }
        return null;
    }

    // Obter todos os usuários
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        $users = [];
        
        while ($userData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User($userData['id'], $userData['name'], $userData['email'], $userData['password'], $userData['created_at']);
        }
        
        return $users;
    }

    // Atualizar um usuário
    public function updateUser($id, $name, $email, $password = null) {
        if ($password) {
            $hashedPassword = (new User(0, '', '', '', ''))->encryptPassword($password);
            $stmt = $this->pdo->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
            $stmt->execute([$name, $email, $hashedPassword, $id]);
        } else {
            $stmt = $this->pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
            $stmt->execute([$name, $email, $id]);
        }
    }

    // Excluir um usuário
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Verificar se o e-mail já está registrado
    public function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
}
?>