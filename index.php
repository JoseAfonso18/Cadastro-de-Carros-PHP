<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Carros</title>
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
            margin: 100px auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }
        h1 {
            color: #007bff;
        }
        a {
            display: block;
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
        }
        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo ao Cadastro de Carros</h1>
        <a href="cadastrar_carro.php">Cadastrar Novo Carro</a>
        <a href="listar_carros.php">Listar Carros</a>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
