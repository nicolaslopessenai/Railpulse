<?php
include '../infra/conexao.php';
include '../infra/auth.php';
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trens - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>
<body>
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php" class="active">TRENS</a></div>
            <div class="paginas"><a href="rotas.php">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
            <div class="paginas"><a href="usuarios.php">USUÁRIOS</a></div>
            <div class="barra_topo_info">
                <span id="info_matricula" class="matricula_topo"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="conteudo_principal">
        <h2 class="titulo_pagina">Trens</h2>
        <hr class="divider">

        <div class="barra_ferramentas">
            <div class="campo_pesquisa">
                <input type="text" id="input_busca" placeholder="Buscar trem...">
            </div>
            <button id="btn_novo_trem" class="botao botao_primario admin_only">+ NOVO TREM</button>
        </div>

        <div class="titulo_secao light">LISTAGEM DE TRENS</div>

        <div class="container_tabela">
            <table class="tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>MODELO</th>
                        <th>STATUS</th>
                        <th id="col_acoes" class="oculto">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tbody_trens">
                </tbody>
            </table>
            <div id="msg_vazio" class="mensagem_vazia oculto">
                Nenhum trem cadastrado ainda.
            </div>
        </div>
    </main>
</body>
</html>