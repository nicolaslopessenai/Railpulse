<?php
include '../infra/conexao.php';
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body class="body_login">
        <main>
                    <div class="logo">Rail<span>Pulse</span></div>
        <div class="e_form">
            <h2 id="titulo">Login</h2>
            <form id="form" method="POST" action="../infra/processar_login.php">
                <div id="e_email" class="conjunto">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div id="e_senha" class="conjunto">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" placeholder="Senha" required>
                </div>
                <button type="submit" id="botao">Entrar</button>
            </form>
        </div>
    </main>
</body>
</html>