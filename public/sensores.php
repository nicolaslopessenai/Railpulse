<?php
include '../infra/conexao.php';

$sensores = mysqli_query($conexao, "SELECT s.id_sensor, s.nome, s.tipo_dado, s.localizacao, s.status, t.nome AS trem_nome, r.nome AS rota_nome FROM sensores s JOIN trens t ON s.id_trem = t.id_trem JOIN rotas r ON s.id_rota = r.id_rota ORDER BY s.id_sensor");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensores - RailPulse</title>
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
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="sensores.php">Sensores</a></li>
                    <li class="nav-item"><a class="nav-link" href="trens.php">Trens</a></li>
                    <li class="nav-item"><a class="nav-link" href="rotas.php">Rotas</a></li>
                    <li class="nav-item"><a class="nav-link" href="relatorios.php">Relatórios</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <span id="info_matricula" class="badge badge-soft rounded-pill px-3 py-2"></span>
                    <a href="../index.php" class="btn btn-outline-secondary btn-sm">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 fw-bold mb-0">Sensores</h1>
        </div>

        <div class="card card-soft border-0">
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="input_busca" placeholder="Buscar sensor...">
                </div>
                <h2 class="h5 fw-bold text-uppercase text-secondary mb-3">Listagem de sensores</h2>
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-soft">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Localização</th>
                                <th>Status</th>
                                <th>Trem</th>
                                <th>Rota</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_sensores">
                            <?php if (mysqli_num_rows($sensores) === 0) { ?>
                                <tr><td colspan="7" class="text-secondary">Nenhum sensor cadastrado ainda.</td></tr>
                            <?php } ?>
                            <?php while ($sensor = mysqli_fetch_assoc($sensores)) { ?>
                                <tr>
                                    <td><?php echo (int) $sensor['id_sensor']; ?></td>
                                    <td><?php echo htmlspecialchars($sensor['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($sensor['tipo_dado'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($sensor['localizacao'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($sensor['status'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($sensor['trem_nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($sensor['rota_nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div id="msg_vazio" class="text-secondary small oculto">Nenhum sensor cadastrado ainda.</div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/sensores.public.js?v=1"></script>
</body>

</html>
