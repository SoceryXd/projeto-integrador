<?php
// Configuração de conexão com o banco de dados
class Database {
    private $host = 'localhost';
    private $db_name = 'overclock_zone';
    private $username = 'root';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro na conexão com o banco de dados: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
