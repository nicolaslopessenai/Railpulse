<?php
include 'infra/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RailPulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white border-bottom shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="index.php">Rail<span class="text-primary">Pulse</span></a>
            <div class="ms-auto">
                <a class="btn btn-primary px-4" href="public/login.php">Entrar</a>
            </div>
        </div>
    </nav>

    <header class="bg-white border-bottom py-5">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-7">
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-2 text-uppercase">Sistema inteligente</span>
                    <h1 class="display-5 fw-bold mt-3 mb-3">Monitoramento de precisão para ferrovias</h1>
                    <p class="lead text-secondary mb-4">Dados de sensores em tempo real para melhorar segurança, operação e tomada de decisão.</p>
                    <a href="#solucoes" class="btn btn-primary btn-lg px-4">Conhecer solução</a>
                </div>
            </div>
        </div>
    </header>

    <section id="solucoes" class="py-5">
        <div class="container">
            <div class="text-uppercase small fw-bold text-secondary mb-4">O que oferecemos</div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 card-soft border-0">
                        <div class="card-body p-4">
                            <div class="fs-3 fw-bold text-primary mb-3">01</div>
                            <h3 class="h5 fw-bold mb-2">Rastreamento</h3>
                            <p class="text-secondary mb-0">Acompanhamento de velocidade, localização e operação em tempo real.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 card-soft border-0">
                        <div class="card-body p-4">
                            <div class="fs-3 fw-bold text-primary mb-3">02</div>
                            <h3 class="h5 fw-bold mb-2">Segurança</h3>
                            <p class="text-secondary mb-0">Monitoramento de falhas e alertas para agir antes que o problema se agrave.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 card-soft border-0">
                        <div class="card-body p-4">
                            <div class="fs-3 fw-bold text-primary mb-3">03</div>
                            <h3 class="h5 fw-bold mb-2">Gestão</h3>
                            <p class="text-secondary mb-0">Relatórios claros e organização de rotas, trens e sensores em um só painel.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-top py-4 mt-5">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                <div>
                    <strong>Projeto RailPulse</strong>
                    <div class="text-secondary small">Desenvolvimento de Sistemas - SENAI Santa Catarina</div>
                </div>
                <div class="text-secondary small text-md-end">
                    Arthur Vieira • Gabriel Ostrovski • Gustavo Miquelute • Nicolas Lopes
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
