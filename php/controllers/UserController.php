<?php

require_once 'models/User.php';

class UserController {
    private $pdo;

    // Construtor - Recebe a conexão PDO
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Função para cadastrar um novo usuário
    public function cadastrarUsuario($data) {
        // Verifica se os dados necessários foram enviados
        if (isset($data['name'], $data['email'], $data['password'])) {
            $name = $data['name'];
            $email = $data['email'];
            $password = $data['password'];

            // Verifica se o e-mail já existe
            if ($this->emailExists($email)) {
                return ['success' => false, 'message' => 'E-mail já cadastrado.'];
            }

            // Criptografa a senha
            $user = new User(0, $name, $email, '', ''); // ID será 0 por enquanto
            $hashedPassword = $user->encryptPassword($password);

            // Tenta salvar no banco de dados
            try {
                $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$name, $email, $hashedPassword]);

                // Retorna a resposta de sucesso
                return ['success' => true, 'message' => 'Usuário cadastrado com sucesso.'];
            } catch (PDOException $e) {
                // Caso ocorra algum erro ao inserir no banco
                return ['success' => false, 'message' => 'Erro ao cadastrar o usuário: ' . $e->getMessage()];
            }
        } else {
            // Se algum dado obrigatório não for enviado
            return ['success' => false, 'message' => 'Dados incompletos.'];
        }
    }

    // Verifica se o e-mail já existe no banco de dados
    private function emailExists($email) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn() > 0;
    }
}
?>