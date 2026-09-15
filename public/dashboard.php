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
            <div class="topbar_info">
                <span id="info_matricula" class="topbar_matricula"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="main_content">
        <h2 class="page_title" id="boas_vindas">Bem-vindo</h2>
        <hr class="divider"><br>

        <div class="section_title light" style="margin-top: 0;">RASTREAMENTO DE LOCALIZAÇÃO</div>
    </main>

    <script src="../script/dashboard.js"></script>
</body>

</html>