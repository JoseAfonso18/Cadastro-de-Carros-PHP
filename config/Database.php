<?php
class Database {
    private $host = "127.0.0.1"; // IP local
    private $port = "3307"; // Porta do MySQL
    private $dbname = "concessionaria"; // Nome do banco
    private $usuario = "root"; // Usuário padrão
    private $senha = ""; // Senha vazia por padrão

    public $conn;

    public function __construct() {
        try {
            $dsn = "mysql:host=$this->host;port=$this->port;dbname=$this->dbname;charset=utf8";
            $this->conn = new PDO($dsn, $this->usuario, $this->senha, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die("Erro de conexão com o banco de dados: " . $e->getMessage());
        }
    }
}
?>
