<?php
include '../infra/conexao.php';
include '../infra/auth.php';

$rotas = mysqli_query($conexao, "SELECT id_rota, nome, origem, destino, distancia_km FROM rotas ORDER BY id_rota");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotas - RailPulse</title>
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
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="rotas.php">Rotas</a></li>
                    <li class="nav-item"><a class="nav-link" href="relatorios.php">Relatórios</a></li>
                    <li class="nav-item"><a class="nav-link" href="usuarios.php">Usuários</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <span id="info_matricula" class="badge badge-soft rounded-pill px-3 py-2"></span>
                    <a href="../infra/logout.php" class="btn btn-outline-secondary btn-sm">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 fw-bold mb-0">Rotas</h1>
            <button id="btn_nova_rota" class="btn btn-primary admin_only">+ Nova rota</button>
        </div>

        <div id="modal_rota" class="crud_modal oculto" role="dialog" aria-modal="true" aria-labelledby="titulo_modal_rota">
            <div class="card card-soft border-0 w-100" style="max-width: 760px;">
                <div class="card-body p-4">
                    <h2 id="titulo_modal_rota" class="h5 fw-bold text-uppercase text-secondary mb-3">Cadastro / edição de rota</h2>
                    <form id="form_rota" action="../infra/salvar_rota.php" method="POST" autocomplete="off">
                        <input type="hidden" id="edit_original_id" name="rta_id_rota">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="rota_nome" class="form-label text-uppercase small fw-semibold text-secondary">Nome</label>
                                <input type="text" class="form-control" id="rota_nome" name="rta_nome" required>
                            </div>
                            <div class="col-md-6">
                                <label for="rota_origem" class="form-label text-uppercase small fw-semibold text-secondary">Origem</label>
                                <input type="text" class="form-control" id="rota_origem" name="rta_origem" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="rota_destino" class="form-label text-uppercase small fw-semibold text-secondary">Destino</label>
                                <input type="text" class="form-control" id="rota_destino" name="rta_destino" required>
                            </div>
                            <div class="col-md-6">
                                <label for="rota_distancia_km" class="form-label text-uppercase small fw-semibold text-secondary">Distância (km)</label>
                                <input type="number" class="form-control" id="rota_distancia_km" name="rta_distancia_km" min="0.01" step="0.01" required>
                            </div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            <button type="submit" id="btn_salvar_rota" class="btn btn-primary">Salvar</button>
                            <button type="button" id="btn_cancelar_rota" class="btn btn-outline-secondary">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php if (isset($_GET['erro']) && $_GET['erro'] === 'em_uso') { ?>
            <div class="alert alert-warning mt-3">Esta rota está vinculada a trens ou sensores e não pode ser excluída.</div>
        <?php } ?>

        <div class="card card-soft border-0">
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="input_busca" placeholder="Buscar rota...">
                </div>
                <h2 class="h5 fw-bold text-uppercase text-secondary mb-3">Listagem de rotas</h2>
                <div class="table-responsive">
                    <table class="table table-hover align-middle table-soft">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th>Distância (km)</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody class="tbody-busca-universal">
                            <?php if (mysqli_num_rows($rotas) === 0) { ?>
                                <tr><td colspan="6" class="text-secondary">Nenhuma rota cadastrada ainda.</td></tr>
                            <?php } ?>
                            <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                                <tr>
                                    <td><?php echo (int) $rota['id_rota']; ?></td>
                                    <td><?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($rota['origem'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($rota['destino'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars((string) $rota['distancia_km'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="crud_actions">
                                        <button type="button" class="btn btn-outline-secondary btn-sm crud_edit_button"
                                            data-id="<?php echo (int) $rota['id_rota']; ?>"
                                            data-nome="<?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-origem="<?php echo htmlspecialchars($rota['origem'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-destino="<?php echo htmlspecialchars($rota['destino'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-distancia="<?php echo htmlspecialchars((string) $rota['distancia_km'], ENT_QUOTES, 'UTF-8'); ?>">
                                            Editar
                                        </button>
                                        <form class="d-inline crud_delete_form" data-confirm="Excluir esta rota? O banco não permite excluir rotas vinculadas a trens ou sensores." action="../infra/excluir_rota.php" method="POST">
                                            <input type="hidden" name="id_rota" value="<?php echo (int) $rota['id_rota']; ?>">
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
    <script src="../js/rotas_private.js?v=2"></script>
        <script src="../js/pesquisa_tabelas.js"></script>

</body>
</html>