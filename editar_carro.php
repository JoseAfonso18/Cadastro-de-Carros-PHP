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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 90%;
            max-width: 400px; /* Reduzindo um pouco a largura */
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center; /* Isso centraliza os inputs */
            gap: 12px;
        }

        input {
            width: 90%; /* Mantém um bom espaço nas laterais */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .button-container {
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
        }

        .button-container button,
        .button-container a {
            width: 45%;
            padding: 8px;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        .button-container button {
            background: #007bff;
            color: white;
        }

        .button-container button:hover {
            background: #0056b3;
        }

        .button-container a {
            background: #6c757d;
            color: white;
        }

        .button-container a:hover {
            background: #5a6268;
        }

        .button-container {
            display: flex;
            justify-content: space-between; /* Distribui os botões */
            gap: 15px; /* Adiciona espaçamento entre eles */
            margin-top: 15px;
        }

        .button-container button,
        .button-container a {
            width: 50%; /* Aumenta a largura dos botões */
            padding: 12px; /* Aumenta a altura */
            font-size: 16px; /* Aumenta o tamanho da fonte */
            border-radius: 8px; /* Deixa os botões mais arredondados */
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Editar Carro</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $carro['id'] ?>">
            <input type="text" name="modelo" value="<?= $carro['modelo'] ?>" placeholder="Modelo" required>
            <input type="text" name="marca" value="<?= $carro['marca'] ?>" placeholder="Marca" required>
            <input type="number" name="ano" value="<?= $carro['ano'] ?>" placeholder="Ano" required>
            <input type="text" name="preco" value="<?= $carro['preco'] ?>" placeholder="Preço" required>

            <div class="button-container">
                <button type="submit">Salvar</button>
                <a href="listar_carros.php">Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>

