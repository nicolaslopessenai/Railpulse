<?php
include '../infra/conexao.php';
include '../infra/processar_login.php';
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
        <div class="container-menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php" class="active">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
            <div class="paginas"><a href="rotas.php">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
            <div class="paginas"><a href="usuarios.php">USUÁRIOS</a></div>
            <div class="topbar-info">
                <span id="info-matricula" class="topbar-matricula"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>

        </div>
    </nav>


    <div class="app-container">
        <header class="topbar">
            
        </header>


        <main class="main-content">
            <h2 class="page-title" id="boas-vindas">Bem-vindo <?php echo $_SESSION['nome']; ?></h2>
            <hr class="divider"><br>

            <div class="section-title light" style="margin-top: 0;">RASTREAMENTO DE LOCALIZAÇÃO</div>
        </main>
    </div>

    <script src="../script/dashboard.js"></script>
</body>

</html>