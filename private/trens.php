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
    <link rel="stylesheet" href="../assets/style/style.css?v=2">
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

        <section id="section_cadastro_trem" class="painel_formulario oculto">
            <div class="titulo_secao light">CADASTRO / EDIÇÃO DE TREM</div>

            <form id="form_editar" autocomplete="off">
                <input type="hidden" id="edit_original_id">
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_nome">NOME</label>
                        <input type="text" id="edit_nome" required>
                    </div>
                    <div class="grupo_formulario">
                        <label for="edit_modelo">MODELO</label>
                        <input type="text" id="edit_modelo" required>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_status_operacional">STATUS OPERACIONAL</label>
                        <select id="edit_status_operacional" required>
                            <option value="normal">Normal</option>
                            <option value="alerta">Alerta</option>
                            <option value="falha">Falha</option>
                        </select>
                    </div>
                    <div class="grupo_formulario">
                        <label for="edit_id_rota">ROTA</label>
                        <select id="edit_id_rota" required>
                            <option value="">Selecione a rota</option>
                        </select>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_velocidade_atual">VELOCIDADE ATUAL</label>
                        <input type="number" id="edit_velocidade_atual" min="0" step="0.01">
                    </div>
                    <div class="grupo_formulario">
                        <label for="edit_latitude">LATITUDE</label>
                        <input type="number" id="edit_latitude" step="0.0000001">
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_longitude">LONGITUDE</label>
                        <input type="number" id="edit_longitude" step="0.0000001">
                    </div>
                </div>
                <div class="botoes_linha">
                    <button type="submit" id="btn_salvar_trem" class="botao botao_primario">SALVAR</button>
                    <button type="button" id="btn_cancelar_trem" class="botao botao_secundario">CANCELAR</button>
                </div>
            </form>
        </section>

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

    <script src="../js/trens_private.js"></script>
</body>
</html>