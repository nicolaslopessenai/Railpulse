<?php
include '../infra/conexao.php';
include '../infra/auth.php';

$rotas = mysqli_query($conexao, "SELECT id_rota, nome FROM rotas ORDER BY nome");
$trens = mysqli_query($conexao, "SELECT id_trem, nome, modelo, status_operacional, velocidade_atual, latitude, longitude, id_rota FROM trens ORDER BY id_trem");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trens - RailPulse</title>
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
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="trens.php">Trens</a></li>
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
            <h1 class="h3 fw-bold mb-0">Trens</h1>
            <button id="btn_novo_trem" class="btn btn-primary admin_only">+ Novo trem</button>
        </div>

        <div id="modal_trem" class="crud_modal oculto" role="dialog" aria-modal="true" aria-labelledby="titulo_modal_trem">
            <div class="card card-soft border-0 w-100" style="max-width: 760px;">
                <div class="card-body p-4">
                    <h2 id="titulo_modal_trem" class="h5 fw-bold text-uppercase text-secondary mb-3">Cadastro / edição de trem</h2>
                    <form id="form_editar" action="../infra/salvar_trem.php" method="POST" autocomplete="off">
                        <input type="hidden" id="edit_original_id" name="trn_id_trem">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="edit_nome" class="form-label text-uppercase small fw-semibold text-secondary">Nome</label>
                                <input type="text" class="form-control" id="edit_nome" name="trn_nome" required>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_modelo" class="form-label text-uppercase small fw-semibold text-secondary">Modelo</label>
                                <input type="text" class="form-control" id="edit_modelo" name="trn_modelo" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="edit_status_operacional" class="form-label text-uppercase small fw-semibold text-secondary">Status operacional</label>
                                <select class="form-select" id="edit_status_operacional" name="trn_status" required>
                                    <option value="normal">Normal</option>
                                    <option value="alerta">Alerta</option>
                                    <option value="falha">Falha</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="edit_id_rota" class="form-label text-uppercase small fw-semibold text-secondary">Rota</label>
                                <select class="form-select" id="edit_id_rota" name="trn_id_rota" required>
                                    <option value="">Selecione a rota</option>
                                    <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                                        <option value="<?php echo $rota['id_rota']; ?>"><?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="edit_velocidade_atual" class="form-label text-uppercase small fw-semibold text-secondary">Velocidade</label>
                                <input type="number" class="form-control" id="edit_velocidade_atual" name="trn_velocidade" min="0" step="0.01" required>
                            </div>
                            <div class="col-md-4">
                                <label for="edit_latitude" class="form-label text-uppercase small fw-semibold text-secondary">Latitude</label>
                                <input type="number" class="form-control" id="edit_latitude" name="trn_latitude" step="0.0000001" required>
                            </div>
                            <div class="col-md-4">
                                <label for="edit_longitude" class="form-label text-uppercase small fw-semibold text-secondary">Longitude</label>
                                <input type="number" class="form-control" id="edit_longitude" name="trn_longitude" step="0.0000001" required>
                            </div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="submit" id="btn_salvar_trem" class="btn btn-primary">Salvar</button>
                            <button type="button" id="btn_cancelar_trem" class="btn btn-outline-secondary">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card card-soft border-0">
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="input_busca" placeholder="Buscar trem...">
                </div>
                <h2 class="h5 fw-bold text-uppercase text-secondary mb-3">Listagem de trens</h2>
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-soft">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Modelo</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_trens">
                            <?php if (mysqli_num_rows($trens) === 0) { ?>
                                <tr><td colspan="5" class="text-secondary">Nenhum trem cadastrado ainda.</td></tr>
                            <?php } ?>
                            <?php while ($trem = mysqli_fetch_assoc($trens)) { ?>
                                <tr>
                                    <td><?php echo (int) $trem['id_trem']; ?></td>
                                    <td><?php echo htmlspecialchars($trem['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($trem['modelo'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($trem['status_operacional'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="crud_actions">
                                        <button type="button" class="btn btn-outline-secondary btn-sm crud_edit_button"
                                            data-id="<?php echo (int) $trem['id_trem']; ?>"
                                            data-nome="<?php echo htmlspecialchars($trem['nome'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-modelo="<?php echo htmlspecialchars($trem['modelo'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-status="<?php echo htmlspecialchars($trem['status_operacional'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-rota="<?php echo (int) $trem['id_rota']; ?>"
                                            data-velocidade="<?php echo htmlspecialchars((string) $trem['velocidade_atual'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-latitude="<?php echo htmlspecialchars((string) $trem['latitude'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-longitude="<?php echo htmlspecialchars((string) $trem['longitude'], ENT_QUOTES, 'UTF-8'); ?>">
                                            Editar
                                        </button>
                                        <form class="d-inline crud_delete_form" data-confirm="Excluir este trem, os sensores vinculados e os dados desses sensores?" action="../infra/excluir_trem.php" method="POST">
                                            <input type="hidden" name="id_trem" value="<?php echo (int) $trem['id_trem']; ?>">
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
    <script src="../js/trens_private.js?v=3"></script>
</body>
</html>