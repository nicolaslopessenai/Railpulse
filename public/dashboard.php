<?php
include '../infra/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body>
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php" class="active">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
            <div class="paginas"><a href="rotas.php">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
            <div class="barra_topo_info">
                <span id="info_matricula" class="matricula_topo"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="conteudo_principal">
        <h2 class="titulo_pagina" id="boas_vindas">Bem-vindo</h2>
        <hr class="divider"><br>

        <div class="titulo_secao light">RASTREAMENTO DE LOCALIZAÇÃO</div>
    </main>
</body>

</html>