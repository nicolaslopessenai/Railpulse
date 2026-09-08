<?php
include '../infra/conexao.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trens</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>
<body>
    <nav class="navegacao">
            <div class="container-menu">
                <div class="logo">Rail<span>Pulse</span></div>
                <div class="paginas"><a href="dashboard.php" >PAINEL</a></div>
                <div class="paginas"><a href="sensores.php">SENSORES</a></div>
                <div class="paginas"><a href="trens.php" class="active">TRENS</a></div>
                <div class="paginas"><a href="rotas.php">ROTAS</a></div>
                <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
                <div class="paginas"><a href="usuarios.php" >USUÁRIOS</a></div>
                <div class="topbar-info">
                    <span id="info-matricula" class="topbar-matricula"></span>
                    <a href="../index.php" class="paginas">SAIR</a>
                </div>

            </div>
        </nav>
</body>
</html>