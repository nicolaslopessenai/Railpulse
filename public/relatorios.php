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
                    <a href="../infra/logout.php" class="btn btn-outline-secondary btn-sm">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <h1 class="h3 fw-bold mb-3">Relatórios</h1>

        <div class="input-group mb-4">
            <input type="search" class="form-control" id="input_busca" placeholder="Buscar relatório..." aria-label="Buscar relatório">
        </div>

        <section class="row g-4" aria-label="Relatórios disponíveis">
            <div class="col-md-4 relatorio_card">
                <article class="card card-soft border-0 h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold mb-2">Trens em operação</h2>
                        <p class="text-secondary mb-0">Resumo da frota e status geral.</p>
                    </div>
                </article>
            </div>
            <div class="col-md-4 relatorio_card">
                <article class="card card-soft border-0 h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold mb-2">Rotas ativas</h2>
                        <p class="text-secondary mb-0">Linhas com movimentação registrada hoje.</p>
                    </div>
                </article>
            </div>
            <div class="col-md-4 relatorio_card">
                <article class="card card-soft border-0 h-100">
                    <div class="card-body p-4">
                        <h2 class="h5 fw-bold mb-2">Alertas</h2>
                        <p class="text-secondary mb-0">Sensores e falhas pendentes de atenção.</p>
                    </div>
                </article>
            </div>
        </section>
        <p id="msg_busca_vazia" class="text-secondary mt-3 oculto">Nenhum resultado encontrado.</p>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
