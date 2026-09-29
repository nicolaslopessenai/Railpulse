<?php
include '../infra/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RailPulse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/style.css">
</head>
<body class="login-bg d-flex align-items-center">
    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5">
                <div class="text-center mb-3">
                    <a class="navbar-brand text-white fs-2 fw-bold" href="../index.php">Rail<span class="text-primary">Pulse</span></a>
                </div>
                <div class="card card-soft border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h3 fw-bold mb-4">Login</h2>
                        <form id="form" method="POST" action="../infra/processar_login.php">
                            <div class="mb-3" id="e_email">
                                <label for="email" class="form-label text-uppercase small fw-semibold text-secondary">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="nome@empresa.com" required>
                            </div>
                            <div class="mb-3" id="e_senha">
                                <label for="senha" class="form-label text-uppercase small fw-semibold text-secondary">Senha</label>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="••••••••" required>
                            </div>
                            <button type="submit" id="botao" class="btn btn-primary w-100 mt-2 rounded-3">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>