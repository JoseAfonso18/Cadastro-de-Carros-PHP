<?php
session_start();
require 'config/Database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$conn = $database->conn;

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM carros WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $carro = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $preco = $_POST['preco'];

    $stmt = $conn->prepare("UPDATE carros SET modelo = ?, marca = ?, ano = ?, preco = ? WHERE id = ?");
    $stmt->execute([$modelo, $marca, $ano, $preco, $id]);

    header("Location: listar_carros.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carro</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        text-align: center;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background: white;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
    }
    h2 {
        color: #007bff;
    }
    form {
        display: flex;
        flex-direction: column;
    }
    input {
        margin: 5px 0;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    button {
        background: #007bff;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    button:hover {
        background: #0056b3;
    }
    a {
        text-decoration: none;
        color: white;
        background: #007bff;
        padding: 10px;
        border-radius: 5px;
        display: inline-block;
        margin-top: 10px;
    }
    a:hover {
        background: #0056b3;
    }
</style>

</head>
<body>
    <h2>Editar Carro</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $carro['id'] ?>">
        <input type="text" name="modelo" value="<?= $carro['modelo'] ?>" required>
        <input type="text" name="marca" value="<?= $carro['marca'] ?>" required>
        <input type="number" name="ano" value="<?= $carro['ano'] ?>" required>
        <input type="text" name="preco" value="<?= $carro['preco'] ?>" required>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
