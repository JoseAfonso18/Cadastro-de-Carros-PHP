<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

// Se o nome do usuário não estiver definido, evita erro
$usuario_nome = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : "Usuário";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
            border-radius: 10px;
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
        a:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Olá, <?php echo htmlspecialchars($usuario_nome); ?>!</h2>
        <a href="index.php">Voltar ao Início</a>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>
