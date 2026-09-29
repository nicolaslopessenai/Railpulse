<?php
include '../infra/conexao.php';
include '../infra/auth.php';

$trens = mysqli_query($conexao, "SELECT id_trem, nome FROM trens ORDER BY nome");
$rotas = mysqli_query($conexao, "SELECT id_rota, nome FROM rotas ORDER BY nome");
$sensores = mysqli_query($conexao, "SELECT s.id_sensor, s.nome, s.tipo_dado, s.localizacao, s.status, s.descricao, s.id_trem, s.id_rota, t.nome AS trem_nome, r.nome AS rota_nome FROM sensores s JOIN trens t ON s.id_trem = t.id_trem JOIN rotas r ON s.id_rota = r.id_rota ORDER BY s.id_sensor");
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
                    <li class="nav-item"><a class="nav-link" href="usuarios.php">Usuários</a></li>
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
            <h1 class="h3 fw-bold mb-0">Sensores cadastrados</h1>
            <button id="btn_novo_sensor" class="btn btn-primary admin_only">+ Novo sensor</button>
        </div>

        <div id="modal_sensor" class="crud_modal oculto" role="dialog" aria-modal="true" aria-labelledby="titulo_modal_sensor">
            <div class="card card-soft border-0 w-100" style="max-width: 760px;">
                <div class="card-body p-4">
                    <h2 id="titulo_modal_sensor" class="h5 fw-bold text-uppercase text-secondary mb-3">Cadastro / edição de sensor</h2>
                    <form id="form_sensor" action="../infra/salvar_sensor.php" method="POST" autocomplete="off">
                        <input type="hidden" id="snr_id_sensor" name="snr_id_sensor">
                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <label for="snr_nome" class="form-label text-uppercase small fw-semibold text-secondary">Nome do sensor</label>
                                <input type="text" class="form-control" id="snr_nome" name="snr_nome" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="snr_tipo" class="form-label text-uppercase small fw-semibold text-secondary">Tipo</label>
                                <select class="form-select" id="snr_tipo" name="snr_tipo" required>
                                    <option value="">Selecione o tipo</option>
                                    <option value="velocidade">velocidade</option>
                                    <option value="temperatura">temperatura</option>
                                    <option value="falha">falha</option>
                                    <option value="vibracao">vibracao</option>
                                    <option value="pressao">pressao</option>
                                    <option value="umidade">umidade</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="snr_localizacao" class="form-label text-uppercase small fw-semibold text-secondary">Localização</label>
                                <input type="text" class="form-control" id="snr_localizacao" name="snr_localizacao" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="snr_id_trem" class="form-label text-uppercase small fw-semibold text-secondary">Trem</label>
                                <select class="form-select" id="snr_id_trem" name="snr_id_trem" required>
                                    <option value="">Selecione o trem</option>
                                    <?php while ($trem = mysqli_fetch_assoc($trens)) { ?>
                                        <option value="<?php echo $trem['id_trem']; ?>"><?php echo htmlspecialchars($trem['nome'], ENT_QUOTES, 'UTF-8'); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="snr_id_rota" class="form-label text-uppercase small fw-semibold text-secondary">Rota</label>
                                <select class="form-select" id="snr_id_rota" name="snr_id_rota" required>
                                    <option value="">Selecione a rota</option>
                                    <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                                        <option value="<?php echo $rota['id_rota']; ?>"><?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="snr_status" class="form-label text-uppercase small fw-semibold text-secondary">Status inicial</label>
                                <select class="form-select" id="snr_status" name="snr_status" required>
                                    <option value="ativo">Ativo</option>
                                    <option value="em_espera">Em Espera</option>
                                    <option value="falha">Falha</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="snr_descricao" class="form-label text-uppercase small fw-semibold text-secondary">Descrição</label>
                                <input type="text" class="form-control" id="snr_descricao" name="snr_descricao">
                            </div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="submit" class="btn btn-primary" id="btn_salvar_sensor">Salvar sensor</button>
                            <button type="button" class="btn btn-outline-secondary" id="btn_cancelar_sensor">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
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
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_sensores">
                            <?php if (mysqli_num_rows($sensores) === 0) { ?>
                                <tr><td colspan="8" class="text-secondary">Nenhum sensor cadastrado ainda.</td></tr>
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
                                    <td class="crud_actions">
                                        <button type="button" class="btn btn-outline-secondary btn-sm crud_edit_button"
                                            data-id="<?php echo (int) $sensor['id_sensor']; ?>"
                                            data-nome="<?php echo htmlspecialchars($sensor['nome'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-tipo="<?php echo htmlspecialchars($sensor['tipo_dado'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-localizacao="<?php echo htmlspecialchars($sensor['localizacao'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-status="<?php echo htmlspecialchars($sensor['status'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-descricao="<?php echo htmlspecialchars((string) $sensor['descricao'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-trem="<?php echo (int) $sensor['id_trem']; ?>"
                                            data-rota="<?php echo (int) $sensor['id_rota']; ?>">
                                            Editar
                                        </button>
                                        <form class="d-inline crud_delete_form" data-confirm="Excluir este sensor e todos os dados históricos dele?" action="../infra/excluir_sensor.php" method="POST">
                                            <input type="hidden" name="id_sensor" value="<?php echo (int) $sensor['id_sensor']; ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/sensores_private.js?v=2"></script>
</body>
</html>