<?php
include '../infra/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - RailPulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body>
<<<<<<< HEAD
    <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold fs-4" href="../index.php">Rail<span class="text-primary">Pulse</span></a>
            <div class="collapse navbar-collapse show">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Painel</a></li>
                    <li class="nav-item"><a class="nav-link" href="sensores.php">Sensores</a></li>
                    <li class="nav-item"><a class="nav-link" href="trens.php">Trens</a></li>
                    <li class="nav-item"><a class="nav-link" href="rotas.php">Rotas</a></li>
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="relatorios.php">Relatórios</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <span id="info_matricula" class="badge badge-soft rounded-pill px-3 py-2"></span>
                    <a href="../index.php" class="btn btn-outline-secondary btn-sm">Sair</a>
                </div>
=======
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
            <div class="paginas"><a href="rotas.php">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php" class="active">RELATÓRIOS</a></div>
            <div class="barra_topo_info">
                <span id="info_matricula" class="matricula_topo"></span>
                <a href="../infra/logout.php" class="paginas">SAIR</a>
>>>>>>> d22df44cbd8e68993957f41f8a9dd03fd564962b
            </div>
        </div>
    </nav>

<<<<<<< HEAD
    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 fw-bold mb-0">Relatórios</h1>
        </div>

        <div class="card card-soft border-0">
            <div class="card-body">
                <h2 class="h5 fw-bold text-uppercase text-secondary mb-3">Listagem de relatórios</h2>
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-soft">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_relatorios"></tbody>
                    </table>
                </div>
                <div id="msg_vazio" class="text-secondary small oculto">Nenhum relatório disponível ainda.</div>
=======
    <main class="conteudo_principal">
        <div class="usuarios_header">
            <h1 class="titulo_pagina">Relatórios</h1>
        </div>

        <div class="barra_ferramentas">
            <div class="campo_pesquisa">
                <input type="search" id="input_busca" placeholder="Buscar relatório..." aria-label="Buscar relatório">
>>>>>>> d22df44cbd8e68993957f41f8a9dd03fd564962b
            </div>
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

<<<<<<< HEAD
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
=======
>>>>>>> d22df44cbd8e68993957f41f8a9dd03fd564962b
</body>

</html>
