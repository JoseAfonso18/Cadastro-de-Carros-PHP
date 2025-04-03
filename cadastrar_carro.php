<?php
session_start();
require 'config/Database.php';

if (!isset($_SESSION['usuario_id'])) {
    $_SESSION['pagina_origem'] = "cadastrar_carro.php";
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $ano = $_POST['ano'];
    $preco = $_POST['preco'];
    
    $database = new Database();
    $conn = $database->conn;

    $stmt = $conn->prepare("INSERT INTO carros (modelo, marca, ano, preco) VALUES (?, ?, ?, ?)");
    $stmt->execute([$modelo, $marca, $ano, $preco]);
    
    header("Location: listar_carros.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Carro</title>
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
        .botoes {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }
        .btn {
            text-decoration: none;
            color: white;
            background: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastrar Novo Carro</h2>
        <form method="POST">
            <input type="text" name="modelo" placeholder="Modelo" required>
            <input type="text" name="marca" placeholder="Marca" required>
            <input type="number" name="ano" placeholder="Ano" required>
            <input type="text" name="preco" placeholder="Preço" required>
            <div class="botoes">
                <button type="submit" class="btn">Cadastrar</button>
                <a href="listar_carros.php" class="btn">Ver lista de carros</a>
            </div>
        </form>
    </div>
</body>
</html>
