<?php
class Database {
    private $host = "localhost";
    private $dbname = "concessionaria"; // Nome do banco que você criou no phpMyAdmin
    private $usuario = "root"; // Usuário padrão do XAMPP
    private $senha = ""; // Senha padrão é vazia no XAMPP
    public $conn;

    public function __construct() {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=seu_banco", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
}
?>
