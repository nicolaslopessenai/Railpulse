<?php
include '../infra/conexao.php';
include '../infra/auth.php';

$cargo_atual = strtolower($_SESSION['cargo'] ?? 'funcionario');
$cargo_label = $cargo_atual === 'admin' ? 'Admin' : 'Funcionário';

$rotas = mysqli_query($conexao, "SELECT id_rota, nome, origem, destino, distancia_km FROM rotas ORDER BY id_rota");
$rotas_trens = mysqli_query($conexao, "SELECT rt.id_rota, t.id_trem, t.nome AS trem_nome FROM rota_trem rt JOIN trens t ON t.id_trem = rt.id_trem GROUP BY rt.id_rota, t.id_trem, t.nome ORDER BY rt.id_rota, t.nome");
$vinculos_rota_trem = [];
while ($vinculo = mysqli_fetch_assoc($rotas_trens)) {
    $id_rota_vinculo = (int) $vinculo['id_rota'];
    $id_trem_vinculado = (int) $vinculo['id_trem'];

    if (!isset($vinculos_rota_trem[$id_rota_vinculo][$id_trem_vinculado])) {
        $vinculos_rota_trem[$id_rota_vinculo][$id_trem_vinculado] = [
            'id_trem' => $id_trem_vinculado,
            'nome' => $vinculo['trem_nome'],
        ];
    }
}
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
            <div class="navbar-brand fw-bold fs-4 mb-0">Rail<span class="text-primary">Pulse</span></div>
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

                        <div class="mb-3">
                            <label for="rota_trem_select" class="form-label text-uppercase small fw-semibold text-secondary">Adicionar trem à rota</label>
                            <select class="form-select" id="rota_trem_select" name="rta_id_trem">
                                <option value="">Nenhum trem no momento</option>
                                <?php
                                    $todos_trens = mysqli_query($conexao, "SELECT id_trem, nome FROM trens ORDER BY nome");
                                    while ($trem = mysqli_fetch_assoc($todos_trens)) {
                                        echo '<option value="' . (int) $trem['id_trem'] . '">' . htmlspecialchars($trem['nome'], ENT_QUOTES, 'UTF-8') . '</option>';
                                    }
                                ?>
                            </select>
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
                                <th>Trens vinculados</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_rotas" class="tbody-busca-universal">
                            <?php if (mysqli_num_rows($rotas) === 0) { ?>
                                <tr><td colspan="7" class="text-secondary">Nenhuma rota cadastrada ainda.</td></tr>
                            <?php } ?>
                            <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                                <?php
                                    $id_rota_atual = (int) $rota['id_rota'];
                                    $trens_vinculados = $vinculos_rota_trem[$id_rota_atual] ?? [];
                                ?>
                                <tr>
                                    <td><?php echo (int) $rota['id_rota']; ?></td>
                                    <td><?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($rota['origem'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($rota['destino'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars((string) $rota['distancia_km'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td>
                                        <?php if (empty($trens_vinculados)) { ?>
                                            <span class="text-secondary small">Nenhum trem vinculado</span>
                                        <?php } else { ?>
                                            <?php foreach ($trens_vinculados as $trem_vinculado) { ?>
                                                <div><?php echo htmlspecialchars($trem_vinculado['nome'], ENT_QUOTES, 'UTF-8'); ?></div>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <td class="crud_actions">
                                        <button type="button" class="btn btn-primary btn-sm crud_edit_button"
                                            data-id="<?php echo (int) $rota['id_rota']; ?>"
                                            data-nome="<?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-origem="<?php echo htmlspecialchars($rota['origem'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-destino="<?php echo htmlspecialchars($rota['destino'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-distancia="<?php echo htmlspecialchars((string) $rota['distancia_km'], ENT_QUOTES, 'UTF-8'); ?>"
                                            aria-label="Editar rota">
                                            <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path d="M11.5 2.5L13.5 4.5L5.75 12.25L2.75 13.25L3.75 10.25L11.5 2.5Z" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.75 4.25L11.75 6.25" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                            </svg>
                                        </button>
                                        <form class="d-inline crud_delete_form" data-confirm="Excluir esta rota? O banco não permite excluir rotas vinculadas a trens ou sensores." action="../infra/excluir_rota.php" method="POST">
                                            <input type="hidden" name="id_rota" value="<?php echo (int) $rota['id_rota']; ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm crud_delete_button" aria-label="Excluir rota">
                                                <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                    <path d="M3 4.25H13" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                                    <path d="M6 4.25V2.75C6 2.33579 6.33579 2 6.75 2H9.25C9.66421 2 10 2.33579 10 2.75V4.25" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M4.5 4.25L5.25 12.75C5.3 13.3 5.76 13.75 6.31 13.75H9.69C10.24 13.75 10.7 13.3 10.75 12.75L11.5 4.25" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M7 6.75V11.25" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                                    <path d="M9 6.75V11.25" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                                </svg>
                                            </button>
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