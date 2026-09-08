<?php
include '../infra/conexao.php';

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensores</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>
<body>
    <nav class="navegacao">
            <div class="container-menu">
                <div class="logo">Rail<span>Pulse</span></div>
                <div class="paginas"><a href="dashboard.php" >PAINEL</a></div>
                <div class="paginas"><a href="sensores.php" class="active">SENSORES</a></div>
                <div class="paginas"><a href="trens.php">TRENS</a></div>
                <div class="paginas"><a href="rotas.php">ROTAS</a></div>
                <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
                <div class="topbar-info">
                    <span id="info-matricula" class="topbar-matricula"></span>
                    <a href="../index.php" class="paginas">SAIR</a>
                </div>

            </div>
        </nav>

        <main class="main-content">
        <section id="section-cadastro" style="display:none;">
            <div class="section-title light">CADASTRO NOVO SENSOR</div>

            <form id="form-sensor" autocomplete="off">
                <div class="form-row">
                    <div class="form-group">
                        <label for="snr-nome">NOME DO SENSOR</label>
                        <input type="text" id="snr-nome">
                    </div>
                    <div class="form-group">
                        <label for="snr-id"> IDENTIFICAÇÃO (ID)</label>
                        <input type="text" id="snr-id">
                    </div>
                </div>
                <div class="form-row">
                    <div class="from-group">
                        <label for="snr-tipo">TIPO</label>
                        <select id="snr-tipo" required>
                            <option value="">Selecione o tipo</option>
                            <option value="THERMAL_ARRAY">Thermal Array</option>
                            <option value="PRESSURE_FLUID">Pressure Fluid</option>
                            <option value="OPTICAL_LIDAR">Optical Lidar</option>
                            <option value="HUMIDITY_RES">Humidity Resistive</option>
                            <option value="GPS">GPS / Localização</option>
                            <option value="OUTROS">Outros</option>
                        </select>
                    </div>
                    <div class="from-group">
                        <label for="snr-localizacao">LOCALIZAÇÃO</label>
                        <input type="text" id="snr-localizacao">
                    </div>
                </div>
                <div class="from-row">
                    <div class="from-group">
                        <label for="snr-status">STATUS INICIAL</label>
                        <select id="snr-status" required>
                            <option value="Ativo">Ativo</option>
                            <option value="Em Espera">Em Espera</option>
                            <option value="Falha">Falha</option>
                        </select>
                    </div>
                    <div class="from-group" style="flex:2;">
                        <label for="snr-descricao">DESCRIÇÃO (opcional)</label>
                        <input type="text" id="snr-descricao">
                    </div>
                </div>
                <div class="buttons-row">
                    <button type="submit" class="btn btn primary" id="btn-salvar-sensor">CADASTRAR SENSOR</button>
                    <button type="button" class="btn btn-secondary" id="btn-cancelar-sensor">CANSELAR</button>
                </div>
            </form>
            <div id="msg-sensor"></div>
        </section>

        <div class="list-toolbar">
            <div class="search-wrap">
                <input type="text" id=" input-busca">
            </div>
            <button id="btn-novo-sensor" class="btn btn-primay admin-only" style="display:none;">+ NOVO SENSOR</button>
        </div>

        <div class="section-title light">LISTAGEM DE SENSORES</div>

        <div class="table-wrapper">
            <table id="tabela-sensores">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>TIPO</th>
                        <th>LOCALIZAÇÃO</th>
                        <th>STATUS</th>
                        <th id="col-acoes" style="display:none;">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tbody-sensores">
                </tbody>
            </table>

            <div id="msg-vazio" class="msg-vazio" style="display: none;">
                Nenhum sensor cadastrado ainda.
            </div>
        </div>

        <div id="aviso-historico" class="aviso-info" style="display: none;">
            NÃO É POSSIVEL EXCLUIR SENSORES COM DADOS HISTÓRICOS
        </div>
    </main>

    <div id="modal-editar" class="modal-overlay" style="display: none;">
        <div class="modal-box">
            <h3 class="modal-title">EDITAR SENSOR</h3>
            <form id="form-editar">
                <input type="hidden" id="edit-original-id">
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-nome">NOME</label>
                        <input type="text" id="edit-nome" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-id">IDENTIFICAÇÃO</label>
                        <input type="text" id="edit-id" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-tipo">TIPO</label>
                        <select id="edit-tipo" required>
                            <option value="">Selecione o tipo</option>
                            <option value="THERMAL_ARRAY">Thermal Array</option>
                            <option value="PRESSURE_FLUID">Pressure Fluid</option>
                            <option value="OPTICAL_LIDAR">Optical Lidar</option>
                            <option value="HUMIDITY_RES">Humidity Resistive</option>
                            <option value="GPS">GPS / Localização</option>
                            <option value="OUTROS">Outros</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-localizacao">LOCALIZAÇÃO</label>
                        <input type="text" id="edit-localizacao" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="edit-status">STATUS</label>
                        <select id="edit-status">
                            <option value="Ativo">Ativo</option>
                            <option value="Em Espera">Em Espera</option>
                            <option value="Falha">Falha</option>
                        </select>
                    </div>
                    <div class="form-group" style="flex:2;">
                        <label for="edit-descricao">DESCRIÇÃO</label>
                        <input type="text" id="edit-descricao">
                    </div>
                </div>
                <div class="buttons-row">
                    <button type="submit" class="btn btn-primary">SALVAR</button>
                </div>
            </form>
        </div>
    </div>

    <script src="../script/sensores.js"></script>
</body>
</html>