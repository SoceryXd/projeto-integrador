<?php

class User {
    private $id;
    private $name;
    private $email;
    private $password;
    private $created_at;

    // Construtor
    public function __construct($id, $name, $email, $password, $created_at) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->created_at = $created_at;
    }

    // Getters e Setters
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    // Método para criptografar a senha
    public function encryptPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Método para verificar a senha
    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    // Método para converter o usuário para um array (útil para JSON)
    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at
        ];
    }
}
?>