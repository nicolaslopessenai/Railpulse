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

<body class="body-login">
        <main>
        <div class="logo">Rail<span>Pulse</span></div>
        <div class="e-form">
            <h2 id="titulo">Login</h2>
            <form id="form">
                <div id="e-email" class="conjunto">
                    <label for="email">Email:</label>
                    <input type="email" id="email" placeholder="Email" required>
                </div>
                <div id="e-senha" class="conjunto">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" placeholder="Senha" required>
                </div>
                <button type="submit" id="botao">Entrar</button>
            </form>
        </div>
    </main>
    <script src="../script/login.js"></script>
</body>

</html>