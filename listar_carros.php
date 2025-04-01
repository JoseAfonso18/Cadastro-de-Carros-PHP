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
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        
        .container {
            width: 90%;
            max-width: 800px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #007bff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background: #f2f2f2;
        }

        a {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
            display: inline-block;
        }

        .btn-editar {
            background: #ffc107;
            color: black;
        }

        .btn-editar:hover {
            background: #e0a800;
        }

        .btn-excluir {
            background: #dc3545;
            color: white;
        }

        .btn-excluir:hover {
            background: #c82333;
        }

        .btn-cadastrar {
            display: inline-block;
            margin-top: 20px;
            background: #007bff;
            color: white;
        }

        .btn-cadastrar:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Lista de Carros Cadastrados</h2>
        <table>
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
                        <a href="editar_carro.php?id=<?= $carro['id'] ?>" class="btn-editar">Editar</a>
                        <a href="excluir_carro.php?id=<?= $carro['id'] ?>" class="btn-excluir" onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="cadastrar_carro.php" class="btn-cadastrar">Cadastrar Novo Carro</a>
    </div>
</body>
</html>

