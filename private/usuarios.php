<?php
include '../infra/conexao.php';
include '../infra/auth.php';

$cargo_atual = strtolower($_SESSION['cargo'] ?? 'funcionario');
$cargo_label = $cargo_atual === 'admin' ? 'Admin' : 'Funcionário';

$usuarios = mysqli_query($conexao, "SELECT id_usuario, nome, email, matricula, cargo FROM usuarios ORDER BY id_usuario");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários - RailPulse</title>
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
                    <li class="nav-item"><a class="nav-link" href="relatorios.php">Relatórios</a></li>
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="usuarios.php">Usuários</a></li>
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
            <h1 class="h3 fw-bold mb-0">Usuários</h1>
            <button id="btn_novo_usuario" class="btn btn-primary admin_only">+ Novo usuário</button>
        </div>

        <div id="modal_usuario" class="crud_modal oculto" role="dialog" aria-modal="true" aria-labelledby="titulo_modal_usuario">
            <div class="card card-soft border-0 w-100" style="max-width: 760px;">
                <div class="card-body p-4">
                    <h2 id="titulo_modal_usuario" class="h5 fw-bold text-uppercase text-secondary mb-3">Cadastro / edição de usuário</h2>
                    <form id="form_usuario" action="../infra/salvar_usuario.php" method="POST" autocomplete="off">
                        <input type="hidden" id="usr_id" name="usr_id">
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="cad_nome" class="form-label text-uppercase small fw-semibold text-secondary">Nome completo</label>
                                <input type="text" class="form-control" id="cad_nome" name="usr_nome" required>
                            </div>
                            <div class="col-md-6">
                                <label for="cad_matricula" class="form-label text-uppercase small fw-semibold text-secondary">Matrícula</label>
                                <input type="text" class="form-control" id="cad_matricula" name="usr_matricula" maxlength="10" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="cad_cargo" class="form-label text-uppercase small fw-semibold text-secondary">Cargo</label>
                                <select class="form-select" id="cad_cargo" name="usr_cargo" required>
                                    <option value="">Selecione um cargo</option>
                                    <option value="admin">Administrador</option>
                                    <option value="funcionario">Funcionário</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="cad_email" class="form-label text-uppercase small fw-semibold text-secondary">E-mail</label>
                                <input type="email" class="form-control" id="cad_email" name="usr_email" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                <label for="cad_senha" class="form-label text-uppercase small fw-semibold text-secondary">Senha</label>
                                <input type="password" class="form-control" id="cad_senha" name="usr_senha" data-required-on-create>
                            </div>
                        </div>

                        <div data-cep-form class="border rounded-3 p-3 bg-light mb-4">
                            <h3 class="h6 fw-bold text-uppercase text-secondary mb-3">Endereço</h3>
                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label for="cad_cep" class="form-label text-uppercase small fw-semibold text-secondary">CEP</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="cad_cep" name="usr_cep" maxlength="9" placeholder="00000-000" data-cep-input>
                                        <button type="button" class="btn btn-outline-secondary" data-consultar-cep>Buscar</button>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <label for="cad_logradouro" class="form-label text-uppercase small fw-semibold text-secondary">Logradouro</label>
                                    <input type="text" class="form-control" id="cad_logradouro" name="usr_logradouro" data-endereco-field="logradouro" readonly>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-5">
                                    <label for="cad_bairro" class="form-label text-uppercase small fw-semibold text-secondary">Bairro</label>
                                    <input type="text" class="form-control" id="cad_bairro" name="usr_bairro" data-endereco-field="bairro" readonly>
                                </div>
                                <div class="col-md-5">
                                    <label for="cad_cidade" class="form-label text-uppercase small fw-semibold text-secondary">Cidade</label>
                                    <input type="text" class="form-control" id="cad_cidade" name="usr_cidade" data-endereco-field="cidade" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="cad_uf" class="form-label text-uppercase small fw-semibold text-secondary">UF</label>
                                    <input type="text" class="form-control" id="cad_uf" name="usr_uf" data-endereco-field="uf" readonly>
                                </div>
                            </div>

                            <div data-cep-status class="form-text"></div>
                        </div>

                        <div class="d-flex gap-2 flex-wrap">
                            <button type="submit" class="btn btn-primary">Salvar usuário</button>
                            <button type="button" class="btn btn-outline-secondary" id="btn_cancelar_usuario">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php if (isset($_GET['erro']) && $_GET['erro'] === 'em_uso') { ?>
            <div class="alert alert-warning mt-3">Este usuário está vinculado a trens e não pode ser excluído.</div>
        <?php } ?>

        <div class="card card-soft border-0">
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="input_busca" placeholder="Buscar usuário...">
                </div>
                <h2 class="h5 fw-bold text-uppercase text-secondary mb-3">Listagem de usuários</h2>
                <div class="table-responsive">
                    <table id="tabela_usuarios" class="table table-hover align-middle table-soft">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Matrícula</th>
                                <th>Cargo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbody_usuarios" class="tbody-busca-universal">
                            <?php if (mysqli_num_rows($usuarios) === 0) { ?>
                                <tr><td colspan="6" class="text-secondary">Nenhum usuário cadastrado ainda.</td></tr>
                            <?php } ?>
                            <?php while ($usuario = mysqli_fetch_assoc($usuarios)) { ?>
                                <tr>
                                    <td><?php echo (int) $usuario['id_usuario']; ?></td>
                                    <td><?php echo htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['matricula'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($usuario['cargo'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="crud_actions">
                                        <button type="button" class="btn btn-primary btn-sm crud_edit_button"
                                            data-id="<?php echo (int) $usuario['id_usuario']; ?>"
                                            data-nome="<?php echo htmlspecialchars($usuario['nome'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-email="<?php echo htmlspecialchars($usuario['email'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-matricula="<?php echo htmlspecialchars($usuario['matricula'], ENT_QUOTES, 'UTF-8'); ?>"
                                            data-cargo="<?php echo htmlspecialchars($usuario['cargo'], ENT_QUOTES, 'UTF-8'); ?>"
                                            aria-label="Editar usuário">
                                            <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path d="M11.5 2.5L13.5 4.5L5.75 12.25L2.75 13.25L3.75 10.25L11.5 2.5Z" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M9.75 4.25L11.75 6.25" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/>
                                            </svg>
                                        </button>
                                        <form class="d-inline crud_delete_form" data-confirm="Excluir este usuário?" action="../infra/excluir_usuario.php" method="POST">
                                            <input type="hidden" name="id_usuario" value="<?php echo (int) $usuario['id_usuario']; ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm crud_delete_button" aria-label="Excluir usuário">
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
    <script src="../js/usuarios_private.js?v=2"></script>
    <script src="../js/cep_lookup.js"></script>
    <script src="../js/pesquisa_tabelas.js"></script>

</body>
</html>