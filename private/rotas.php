<?php
include '../infra/conexao.php';
include '../infra/auth.php';
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotas - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css?v=2">
</head>
<body>
    <nav class="navegacao">
            <div class="container_menu">
                <div class="logo">Rail<span>Pulse</span></div>
                <div class="paginas"><a href="dashboard.php" >PAINEL</a></div>
                <div class="paginas"><a href="sensores.php">SENSORES</a></div>
                <div class="paginas"><a href="trens.php">TRENS</a></div>
                <div class="paginas"><a href="rotas.php" class="active">ROTAS</a></div>
                <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
                <div class="paginas"><a href="usuarios.php" >USUÁRIOS</a></div>
                <div class="barra_topo_info">
                    <span id="info_matricula" class="matricula_topo"></span>
                    <a href="../index.php" class="paginas">SAIR</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="conteudo_principal">

        <h2 class="titulo_pagina">Rotas</h2>

        <section id="section_cadastro_rota" class="painel_formulario oculto">
            <div class="titulo_secao light">CADASTRO / EDIÇÃO DE ROTA</div>

            <form id="form_rota" autocomplete="off">
                <input type="hidden" id="edit_original_id">
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="rota_nome">NOME</label>
                        <input type="text" id="rota_nome" required>
                    </div>
                    <div class="grupo_formulario">
                        <label for="rota_origem">ORIGEM</label>
                        <input type="text" id="rota_origem" required>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="rota_destino">DESTINO</label>
                        <input type="text" id="rota_destino" required>
                    </div>
                    <div class="grupo_formulario">
                        <label for="rota_distancia_km">DISTÂNCIA (KM)</label>
                        <input type="number" id="rota_distancia_km" min="0.01" step="0.01" required>
                    </div>
                </div>
                <div class="botoes_linha">
                    <button type="submit" id="btn_salvar_rota" class="botao botao_primario">SALVAR</button>
                    <button type="button" id="btn_cancelar_rota" class="botao botao_secundario">CANCELAR</button>
                </div>
            </form>
        </section>

        <div class="barra_ferramentas">
            <div class="campo_pesquisa">
                <input type="text" id="input_busca" placeholder="Buscar rota...">
            </div>
            <button id="btn_nova_rota" class="botao botao_primario admin_only">+ NOVA ROTA</button>
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
                <tbody id="tbody_rotas"></tbody>
            </table>
            <div id="msg_vazio" class="mensagem_vazia oculto">
                Nenhuma rota cadastrada ainda.
            </div>
        </div>
    </main>

    <script src="../js/rotas_private.js"></script>
</body>
</html>