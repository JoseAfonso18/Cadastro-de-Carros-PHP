<?php
require 'config/Database.php';

// Criar uma instância da classe Database e obter a conexão
$db = new Database();
$pdo = $db->conn; // Agora $pdo está definido corretamente

$erro = ""; // Inicializar a variável para evitar erro de variável indefinida

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    if ($stmt->execute([$nome, $email, $senha])) {
        header("Location: login.php");
        exit();
    } else {
        $erro = "Erro ao cadastrar!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
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
            width: calc(100% - 20px);
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
        <h2>Cadastro</h2>
        <?php if (!empty($erro)) echo "<p>$erro</p>"; ?>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="nome" placeholder="Nome" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="E-mail" required>
            </div>
            <div class="form-group">
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit">Cadastrar</button>
        </form>
        <a href="login.php" class="link">Já tem uma conta? Faça login</a>
    </div>
</body>
</html>
