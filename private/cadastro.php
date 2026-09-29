<?php
include '../infra/conexao.php';
include '../infra/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários - RailPulse</title>
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
                    <li class="nav-item"><a class="nav-link" href="relatorios.php">Relatórios</a></li>
                    <li class="nav-item"><a class="nav-link active fw-semibold" href="usuarios.php">Usuários</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <span id="info_matricula" class="badge badge-soft rounded-pill px-3 py-2"></span>
                    <a href="../index.php" class="btn btn-outline-secondary btn-sm">Sair</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <h1 class="h3 fw-bold mb-4">Sistema de cadastros - Usuários</h1>

        <div id="mensagem_container"></div>

        <div class="card card-soft border-0">
            <div class="card-body p-4">
                <h2 class="h5 fw-bold text-uppercase text-secondary mb-3">Dados do usuário</h2>
                <form id="form_cadastro" action="../infra/salvar_usuario.php" method="POST">
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <label class="form-label text-uppercase small fw-semibold text-secondary">Nome completo</label>
                            <input type="text" class="form-control" id="cad_nome" name="usr_nome" placeholder="Ex: João da Silva" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-uppercase small fw-semibold text-secondary">Matrícula</label>
                            <input type="text" class="form-control" id="cad_matricula" name="usr_matricula" placeholder="Ex: 4325" maxlength="10" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-uppercase small fw-semibold text-secondary">Cargo</label>
                            <select class="form-select" id="cad_cargo" name="usr_cargo" required>
                                <option value="">Selecione um cargo</option>
                                <option value="admin">Administrador</option>
                                <option value="funcionario">Funcionário</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <label class="form-label text-uppercase small fw-semibold text-secondary">E-mail</label>
                            <input type="email" class="form-control" id="cad_email" name="usr_email" placeholder="exemplo@empresa.com.br" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-12">
                            <label class="form-label text-uppercase small fw-semibold text-secondary">Senha</label>
                            <input type="password" class="form-control" id="cad_senha" name="usr_senha" placeholder="Senha do funcionário" required>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <button type="submit" class="btn btn-primary" id="btn_cadastrar">Cadastrar novo</button>
                        <a href="usuarios.php" class="btn btn-outline-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../script/cadastro.js"></script>
</body>
</html>
