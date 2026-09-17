<?php
include '../infra/conexao.php';
include '../infra/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body>
    <!-- CSS usado: .navegacao, .container_menu, .logo, .paginas, .topbar_info, .topbar_matricula (linha 330-347 e 553-592) -->
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
            <div class="paginas"><a href="rotas.php">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
            <div class="paginas"><a href="usuarios.php" class="active">USUÁRIOS</a></div>
            <div class="topbar_info">
                <span id="info_matricula" class="topbar_matricula"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <!-- CSS usado: .main_content, .usuarios_header, .page_title, .btn_link, .btn, .btn_primary, .usuarios_table, #tabela_usuarios (linha 354-396 e 580-632) -->
    <main class="main_content">
        <div class="usuarios_header">

            <h1 class="page_title">Usuários Cadastrados</h1>
            <a href="cadastro.php" class="btn_link">

                <button class="btn btn_primary" type="button">NOVO USUÁRIO</button>

            </a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>EMAIL</th>
                    <th>MATRÍCULA</th>
                </tr>
            </thead>
            <tbody id="tabela_usuarios"></tbody>
        </table>
    </main>
</body>

</html>