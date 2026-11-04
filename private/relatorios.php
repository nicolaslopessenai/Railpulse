<?php
include '../infra/conexao.php';
include '../infra/auth.php';

$cargo_atual = strtolower($_SESSION['cargo'] ?? 'funcionario');
$cargo_label = $cargo_atual === 'admin' ? 'Admin' : 'Funcionário';
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
            <div class="navbar-brand fw-bold fs-4 mb-0">Rail<span class="text-primary">Pulse</span></div>
            <div class="collapse navbar-collapse show">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Painel</a></li>
                    <li class="nav-item"><a class="nav-link" href="sensores.php">Sensores</a></li>
                    <li class="nav-item"><a class="nav-link" href="trens.php">Trens</a></li>
                    <li class="nav-item"><a class="nav-link" href="rotas.php">Rotas</a></li>
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="relatorios.php">Relatórios</a></li>
                    <li class="nav-item"><a class="nav-link" href="usuarios.php">Usuários</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge border rounded-pill px-2 py-1 text-secondary small">
                        <?php echo htmlspecialchars($cargo_label, ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                    <span id="info_matricula" class="badge badge-soft rounded-pill px-3 py-2"></span>
                    <a href="../infra/logout.php" class="btn btn-outline-secondary btn-sm">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-3">
            <h1 class="h3 fw-bold mb-0">Relatórios</h1>
            <button id="btn_gerar_pdf" class="btn btn-primary px-4" type="button">
                Gerar PDF
            </button>
        </div>

        <div id="report_loading" class="alert alert-info d-none" role="status" aria-live="polite">
            Gerando relatório consolidado...
        </div>
        <div id="report_error" class="alert alert-danger d-none" role="alert"></div>

        <div class="input-group mb-4">
            <input type="search" class="form-control" id="input_busca" placeholder="Buscar relatório baixado..." aria-label="Buscar relatório baixado">
        </div>

        <p id="msg_busca_vazia" class="text-secondary mt-3 oculto">Nenhum relatório encontrado no histórico.</p>

        <div class="card card-soft border-0 mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 gap-2">
                    <h2 class="h5 fw-bold mb-0">Relatórios gerados</h2>
                    <button id="btn_limpar_historico" class="btn btn-outline-secondary btn-sm" type="button">
                        Limpar histórico
                    </button>
                </div>
                <ul id="lista_relatorios" class="list-group list-group-flush"></ul>
                <div id="lista_relatorios_vazia" class="text-secondary small mb-0">
                    Nenhum relatório gerado ainda.
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <script src="../js/relatorios.js"></script>
</body>
</html>