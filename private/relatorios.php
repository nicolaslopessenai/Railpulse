<?php
include '../infra/conexao.php';
include '../infra/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body>
    <!-- CSS usado: .navegacao, .container_menu, .logo, .paginas, .topbar_info, .topbar_matricula (linha 330-347 e 553-592) -->
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
            <div class="paginas"><a href="rotas.php">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php" class="active">RELATÓRIOS</a></div>
            <div class="paginas"><a href="usuarios.php">USUÁRIOS</a></div>
            <div class="topbar_info">
                <span id="info_matricula" class="topbar_matricula"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <!-- CSS usado: .main_content, .usuarios_header, .page_title, .relatorios_grid, .relatorio_card (linha 354-396 e 511-529) -->
    <main class="main_content">
        <div class="usuarios_header">
            <h1 class="page_title">Relatórios</h1>
        </div>

        <section class="relatorios_grid">
            <article class="relatorio_card">
                <h2>Trens em operação</h2>
                <p>Resumo da frota e status geral.</p>
                <strong>42</strong>
            </article>

            <article class="relatorio_card">
                <h2>Rotas ativas</h2>
                <p>Linhas com movimentação registrada hoje.</p>
                <strong>18</strong>
            </article>

            <article class="relatorio_card">
                <h2>Alertas</h2>
                <p>Sensores e falhas pendentes de atenção.</p>
                <strong>05</strong>
            </article>
        </section>
    </main>
</body>

</html>