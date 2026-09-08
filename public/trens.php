<?php
include '../infra/conexao.php';

?>


<!DOCTYPE html>
<html lang="pt-BR">
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
                <div class="paginas"><a href="dashboard.html" >PAINEL</a></div>
                <div class="paginas"><a href="sensores.html">SENSORES</a></div>
                <div class="paginas"><a href="trens.html" class="active">TRENS</a></div>
                <div class="paginas"><a href="rotas.html">ROTAS</a></div>
                <div class="paginas"><a href="relatorios.html">RELATÓRIOS</a></div>
                <div class="topbar-info">
                    <span id="info-matricula" class="topbar-matricula"></span>
                    <a href="../index.php" class="paginas">SAIR</a>
                </div>

            </div>
        </nav>
</body>
</html>