<?php
session_start();
require 'config/Database.php';

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['pagina_origem'] = "cadastrar_carro.php";
    header("Location: login.php");
    exit();
}

$database = new Database();
$conn = $database->conn;

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("DELETE FROM carros WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: listar_carros.php");
exit();
?>
