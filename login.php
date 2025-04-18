<?php
session_start();
require 'config/Database.php';

$db = new Database();
$pdo = $db->conn;
$erro = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $stmt = $pdo->prepare("SELECT id, nome, senha FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user["senha"])) {
        $_SESSION["usuario_id"] = $user["id"];
        $_SESSION["usuario"] = $user["nome"]; // Agora o nome do usuário é armazenado corretamente
        header("Location: dashboard.php");
        exit();
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            text-align: center; 
            background-color: #f8f9fa;
        }
        .container { 
            max-width: 350px; 
            margin: 100px auto; 
            padding: 20px; 
            background: white; 
            box-shadow: 0px 4px 8px rgba(0,0,0,0.2); 
            border-radius: 10px; 
        }
        h2 {
            color: #333;
        }
        .form-group {
            text-align: left;
            margin-bottom: 10px;
        }
        input {
            width: calc(100% - 20px); /* Mantém alinhado com o botão */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: block;
            margin: 0 auto;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .link {
            display: block;
            margin-top: 10px;
            color: #6c757d;
            text-decoration: none;
        }
        .link:hover {
            text-decoration: underline;
        }
        p {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (!empty($erro)) echo "<p>$erro</p>"; ?>
        <form method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
        <a href="cadastro.php" class="link">Criar Conta</a>
    </div>
</body>
</html>

