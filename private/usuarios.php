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
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
            <div class="paginas"><a href="rotas.php">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
            <div class="paginas"><a href="usuarios.php" class="active">USUÁRIOS</a></div>
            <div class="barra_topo_info">
                <span id="info_matricula" class="matricula_topo"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="conteudo_principal">
        <div class="usuarios_header">

            <h1 class="titulo_pagina">Usuários Cadastrados</h1>
            <a href="cadastro.php" class="link_botao">
                <div class="campo_pesquisa">
                    <input type="text" id="input_busca" placeholder="Buscar trem...">
                </div>
                <button class="botao botao_primario" type="button">+NOVO USUÁRIO</button>

            </a>
        </div>

        <table class="tabela">
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