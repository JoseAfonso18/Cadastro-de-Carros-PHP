<?php
session_start();
require 'config/Database.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$database = new Database();
$conn = $database->conn;
$carros = $conn->query("SELECT * FROM carros")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Carros</title>

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
    <h2>Lista de Carros Cadastrados</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Modelo</th>
            <th>Marca</th>
            <th>Ano</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($carros as $carro): ?>
            <tr>
                <td><?= $carro['id'] ?></td>
                <td><?= $carro['modelo'] ?></td>
                <td><?= $carro['marca'] ?></td>
                <td><?= $carro['ano'] ?></td>
                <td>R$ <?= number_format($carro['preco'], 2, ',', '.') ?></td>
                <td>
                    <a href="editar_carro.php?id=<?= $carro['id'] ?>">Editar</a> | 
                    <a href="excluir_carro.php?id=<?= $carro['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <br>
    <a href="cadastrar_carro.php">Cadastrar Novo Carro</a>
</body>
</html>
