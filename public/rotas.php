<?php
include '../infra/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotas - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>
<body>
    <nav class="navegacao">
            <div class="container_menu">
                <div class="logo">Rail<span>Pulse</span></div>
                <div class="paginas"><a href="dashboard.html" >PAINEL</a></div>
                <div class="paginas"><a href="sensores.html">SENSORES</a></div>
                <div class="paginas"><a href="trens.html">TRENS</a></div>
                <div class="paginas"><a href="rotas.html" class="active">ROTAS</a></div>
                <div class="paginas"><a href="relatorios.html">RELATÓRIOS</a></div>
                <div class="barra_topo_info">
                    <span id="info_matricula" class="matricula_topo"></span>
                    <a href="../index.php" class="paginas">SAIR</a>
                </div>

            </div>
        </div>
    </nav>

    <main class="conteudo_principal">
        <h2 class="titulo_pagina">ROTAS</h2>
        <hr class="divider">

        <div class="barra_ferramentas">
            <div class="campo_pesquisa">
                <input type="text" id="input_busca" placeholder="Buscar rota...">
            </div>
            <button id="btn_nova_rota" class="botao botao_primario admin_only oculto">+ NOVA ROTA</button>
        </div>

        <div class="titulo_secao light">LISTAGEM DE ROTAS</div>

        <div class="container_tabela">
            <table class="tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>ORIGEM</th>
                        <th>DESTINO</th>
                        <th>STATUS</th>
                        <th id="col_acoes" class="oculto">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tbody_rotas">
                </tbody>
            </table>
            <div id="msg_vazio" class="mensagem_vazia oculto">
                Nenhuma rota cadastrada ainda.
            </div>
        </div>
    </main>
</body>
</html>
