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
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
            <div class="paginas"><a href="rotas.php">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php" class="active">RELATÓRIOS</a></div>
            <div class="paginas"><a href="usuarios.php">USUÁRIOS</a></div>
            <div class="barra_topo_info">
                <span id="info_matricula" class="matricula_topo"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="conteudo_principal">
        <div class="usuarios_header">
            <h1 class="titulo_pagina">Relatórios</h1>
        </div>

        <section class="relatorios_grid">
            <article class="relatorio_card">
                <h2>Trens em operação</h2>
                <p>Resumo da frota e status geral.</p>
            </article>

            <article class="relatorio_card">
                <h2>Rotas ativas</h2>
                <p>Linhas com movimentação registrada hoje.</p>
            </article>

            <article class="relatorio_card">
                <h2>Alertas</h2>
                <p>Sensores e falhas pendentes de atenção.</p>
            </article>
        </section>
    </main>
</body>

</html>