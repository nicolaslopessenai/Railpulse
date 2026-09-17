<?php
include '../infra/conexao.php';
include '../infra/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensores - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body>
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php" class="active">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
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
        <section id="section_cadastro" class="oculto">
            <div class="titulo_secao light">CADASTRO NOVO SENSOR</div>

            <form id="form_sensor" autocomplete="off">
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="snr_nome">NOME DO SENSOR</label>
                        <input type="text" id="snr_nome">
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="snr_tipo">TIPO</label>
                        <select id="snr_tipo" name="snr_tipo" required>
                            <option value="">Selecione o tipo</option>
                            <option value="THERMAL_ARRAY">Thermal Array</option>
                            <option value="PRESSURE_FLUID">Pressure Fluid</option>
                            <option value="OPTICAL_LIDAR">Optical Lidar</option>
                            <option value="HUMIDITY_RES">Humidity Resistive</option>
                            <option value="GPS">GPS / Localização</option>
                            <option value="OUTROS">Outros</option>
                        </select>
                    </div>
                    <div class="grupo_formulario">
                        <label for="snr_localizacao">LOCALIZAÇÃO</label>
                        <input type="text" id="snr_localizacao" name="snr_localizacao" required>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="snr_status">STATUS INICIAL</label>
                        <select id="snr_status" name="snr_status" required>
                            <option value="Ativo">Ativo</option>
                            <option value="Em Espera">Em Espera</option>
                            <option value="Falha">Falha</option>
                        </select>
                    </div>
                    <div class="grupo_formulario grupo_formulario_largo">
                        <label for="snr_descricao">DESCRIÇÃO (opcional)</label>
                        <input type="text" id="snr_descricao" name="snr_descricao">
                    </div>
                </div>
                <div class="botoes_linha">
                    <button type="submit" class="botao botao_primario" id="btn_salvar_sensor">CADASTRAR SENSOR</button>
                    <button type="button" class="botao botao_secundario" id="btn_cancelar_sensor">CANCELAR</button>
                </div>
            </form>

            <div id="msg_sensor"></div>
        </section>

        <div class="barra_ferramentas">
            <div class="campo_pesquisa">
                <input type="text" id="input_busca" placeholder="Buscar sensor...">
            </div>
            <button id="btn_novo_sensor" class="botao botao_primario admin_only">+ NOVO SENSOR</button>
        </div>

        <div class="titulo_secao light">LISTAGEM DE SENSORES</div>

        <div class="container_tabela">
            <table class="tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>TIPO</th>
                        <th>LOCALIZAÇÃO</th>
                        <th>STATUS</th>
                        <th id="col_acoes" class="oculto">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tbody_sensores">
                </tbody>
            </table>

            <div id="msg_vazio" class="mensagem_vazia oculto">
                Nenhum sensor cadastrado ainda.
            </div>
        </div>

        <div id="aviso_historico" class="aviso_info oculto">
            NÃO É POSSIVEL EXCLUIR SENSORES COM DADOS HISTÓRICOS
        </div>
    </main>

    <div id="modal_editar" class="sobreposicao_modal oculto">
        <div class="caixa_modal">
            <h3 class="titulo_modal">EDITAR SENSOR</h3>
            <form id="form_editar">
                <input type="hidden" id="edit_original_id">
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_nome">NOME</label>
                        <input type="text" id="edit_nome" required>
                    </div>
                    <div class="grupo_formulario">
                        <label for="edit_id">IDENTIFICAÇÃO</label>
                        <input type="text" id="edit_id" required>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_tipo">TIPO</label>
                        <select id="edit_tipo" required>
                            <option value="">Selecione o tipo</option>
                            <option value="THERMAL_ARRAY">Thermal Array</option>
                            <option value="PRESSURE_FLUID">Pressure Fluid</option>
                            <option value="OPTICAL_LIDAR">Optical Lidar</option>
                            <option value="HUMIDITY_RES">Humidity Resistive</option>
                            <option value="GPS">GPS / Localização</option>
                            <option value="OUTROS">Outros</option>
                        </select>
                    </div>
                    <div class="grupo_formulario">
                        <label for="edit_localizacao">LOCALIZAÇÃO</label>
                        <input type="text" id="edit_localizacao" required>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_status">STATUS</label>
                        <select id="edit_status">
                            <option value="Ativo">Ativo</option>
                            <option value="Em Espera">Em Espera</option>
                            <option value="Falha">Falha</option>
                        </select>
                    </div>
                    <div class="grupo_formulario grupo_formulario_largo">
                        <label for="edit_descricao">DESCRIÇÃO</label>
                        <input type="text" id="edit_descricao">
                    </div>
                </div>
                <div class="buttons_row">
                    <button type="submit" class="botao botao_primario">SALVAR</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/sensores_private.js"></script>
</body>

</html>