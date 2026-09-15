<?php
include '../infra/conexao.php';
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
            <div class="paginas"><a href="../public/dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="../public/sensores.php" class="active">SENSORES</a></div>
            <div class="paginas"><a href="../public/trens.php">TRENS</a></div>
            <div class="paginas"><a href="../public/rotas.php">ROTAS</a></div>
            <div class="paginas"><a href="../public/relatorios.php">RELATÓRIOS</a></div>
            <div class="topbar_info">
                <span id="info_matricula" class="topbar_matricula"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="main_content">
        <section id="section_cadastro" style="display:none;">
            <div class="section_title light">CADASTRO NOVO SENSOR</div>

            <form id="form_sensor" autocomplete="off">
                <div class="form_row">
                    <div class="form_group">
                        <label for="snr_nome">NOME DO SENSOR</label>
                        <input type="text" id="snr_nome">
                    </div>
                    <div class="form_group">
                        <label for="snr_id">IDENTIFICAÇÃO (ID)</label>
                        <input type="text" id="snr_id">
                    </div>
                </div>
                <div class="form_row">
                    <div class="form_group">
                        <label for="snr_tipo">TIPO</label>
                        <select id="snr_tipo" required>
                            <option value="">Selecione o tipo</option>
                            <option value="THERMAL_ARRAY">Thermal Array</option>
                            <option value="PRESSURE_FLUID">Pressure Fluid</option>
                            <option value="OPTICAL_LIDAR">Optical Lidar</option>
                            <option value="HUMIDITY_RES">Humidity Resistive</option>
                            <option value="GPS">GPS / Localização</option>
                            <option value="OUTROS">Outros</option>
                        </select>
                    </div>
                    <div class="form_group">
                        <label for="snr_localizacao">LOCALIZAÇÃO</label>
                        <input type="text" id="snr_localizacao">
                    </div>
                </div>
                <div class="form_row">
                    <div class="form_group">
                        <label for="snr_status">STATUS INICIAL</label>
                        <select id="snr_status" required>
                            <option value="Ativo">Ativo</option>
                            <option value="Em Espera">Em Espera</option>
                            <option value="Falha">Falha</option>
                        </select>
                    </div>
                    <div class="form_group" style="flex:2;">
                        <label for="snr_descricao">DESCRIÇÃO (opcional)</label>
                        <input type="text" id="snr_descricao">
                    </div>
                </div>
                <div class="buttons_row">
                    <button type="submit" class="btn btn_primary" id="btn_salvar_sensor">CADASTRAR SENSOR</button>
                    <button type="button" class="btn btn_secondary" id="btn_cancelar_sensor">CANCELAR</button>
                </div>
            </form>
            <div id="msg_sensor"></div>
        </section>

        <div class="list_toolbar">
            <div class="search_wrap">
                <input type="text" id="input_busca" placeholder="Buscar sensor...">
            </div>
            <button id="btn_novo_sensor" class="btn btn_primary admin_only" style="display:none;">+ NOVO SENSOR</button>
        </div>

        <div class="section_title light">LISTAGEM DE SENSORES</div>

        <div class="table_wrapper">
            <table class="tabela" id="tabela_sensores">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>TIPO</th>
                        <th>LOCALIZAÇÃO</th>
                        <th>STATUS</th>
                        <th id="col_acoes" style="display:none;">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tbody_sensores">
                </tbody>
            </table>

            <div id="msg_vazio" class="msg_vazio" style="display: none;">
                Nenhum sensor cadastrado ainda.
            </div>
        </div>

        <div id="aviso_historico" class="aviso_info" style="display: none;">
            NÃO É POSSIVEL EXCLUIR SENSORES COM DADOS HISTÓRICOS
        </div>
    </main>

    <div id="modal_editar" class="modal_overlay" style="display: none;">
        <div class="modal_box">
            <h3 class="modal_title">EDITAR SENSOR</h3>
            <form id="form_editar">
                <input type="hidden" id="edit_original_id">
                <div class="form_row">
                    <div class="form_group">
                        <label for="edit_nome">NOME</label>
                        <input type="text" id="edit_nome" required>
                    </div>
                    <div class="form_group">
                        <label for="edit_id">IDENTIFICAÇÃO</label>
                        <input type="text" id="edit_id" required>
                    </div>
                </div>
                <div class="form_row">
                    <div class="form_group">
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
                    <div class="form_group">
                        <label for="edit_localizacao">LOCALIZAÇÃO</label>
                        <input type="text" id="edit_localizacao" required>
                    </div>
                </div>
                <div class="form_row">
                    <div class="form_group">
                        <label for="edit_status">STATUS</label>
                        <select id="edit_status">
                            <option value="Ativo">Ativo</option>
                            <option value="Em Espera">Em Espera</option>
                            <option value="Falha">Falha</option>
                        </select>
                    </div>
                    <div class="form_group" style="flex:2;">
                        <label for="edit_descricao">DESCRIÇÃO</label>
                        <input type="text" id="edit_descricao">
                    </div>
                </div>
                <div class="buttons_row">
                    <button type="submit" class="btn btn_primary">SALVAR</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../script/sensores.js"></script>
</body>
</html>