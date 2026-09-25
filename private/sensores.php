<?php
include '../infra/conexao.php';
include '../infra/auth.php';

$trens = mysqli_query($conexao, "SELECT id_trem, nome FROM trens ORDER BY nome");
$rotas = mysqli_query($conexao, "SELECT id_rota, nome FROM rotas ORDER BY nome");
$sensores = mysqli_query($conexao, "SELECT s.id_sensor, s.nome, s.tipo_dado, s.localizacao, s.status, s.descricao, s.id_trem, s.id_rota, t.nome AS trem_nome, r.nome AS rota_nome FROM sensores s JOIN trens t ON s.id_trem = t.id_trem JOIN rotas r ON s.id_rota = r.id_rota ORDER BY s.id_sensor");
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensores - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css?v=4">
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

        <h1 class="titulo_pagina">Sensores Cadastrados</h1>

        <div id="modal_sensor" class="crud_modal oculto" role="dialog" aria-modal="true" aria-labelledby="titulo_modal_sensor">
        <section id="section_cadastro" class="painel_formulario">
            <div id="titulo_modal_sensor" class="titulo_secao light">CADASTRO / EDIÇÃO DE SENSOR</div>

            <form id="form_sensor" action="../infra/salvar_sensor.php" method="POST" autocomplete="off">
                <input type="hidden" id="snr_id_sensor" name="snr_id_sensor">
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="snr_nome">NOME DO SENSOR</label>
                        <input type="text" id="snr_nome" name="snr_nome" required>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="snr_tipo">TIPO</label>
                        <select id="snr_tipo" name="snr_tipo" required>
                            <option value="">Selecione o tipo</option>
                            <option value="velocidade">velocidade</option>
                            <option value="temperatura">temperatura</option>
                            <option value="falha">falha</option>
                            <option value="vibracao">vibracao</option>
                            <option value="pressao">pressao</option>
                            <option value="umidade">umidade</option>
                        </select>
                    </div>
                    <div class="grupo_formulario">
                        <label for="snr_localizacao">LOCALIZAÇÃO</label>
                        <input type="text" id="snr_localizacao" name="snr_localizacao" required>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="snr_id_trem">TREM</label>
                        <select id="snr_id_trem" name="snr_id_trem" required>
                            <option value="">Selecione o trem</option>
                            <?php while ($trem = mysqli_fetch_assoc($trens)) { ?>
                                <option value="<?php echo $trem['id_trem']; ?>"><?php echo htmlspecialchars($trem['nome'], ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="grupo_formulario">
                        <label for="snr_id_rota">ROTA</label>
                        <select id="snr_id_rota" name="snr_id_rota" required>
                            <option value="">Selecione a rota</option>
                            <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                                <option value="<?php echo $rota['id_rota']; ?>"><?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="snr_status">STATUS INICIAL</label>
                        <select id="snr_status" name="snr_status" required>
                            <option value="ativo">Ativo</option>
                            <option value="em_espera">Em Espera</option>
                            <option value="falha">Falha</option>
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
        </section>
        </div>

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
                        <th>TREM</th>
                        <th>ROTA</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tbody_sensores">
                    <?php if (mysqli_num_rows($sensores) === 0) { ?>
                        <tr><td colspan="8">Nenhum sensor cadastrado ainda.</td></tr>
                    <?php } ?>
                    <?php while ($sensor = mysqli_fetch_assoc($sensores)) { ?>
                        <tr>
                            <td><?php echo (int) $sensor['id_sensor']; ?></td>
                            <td><?php echo htmlspecialchars($sensor['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($sensor['tipo_dado'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($sensor['localizacao'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($sensor['status'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($sensor['trem_nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($sensor['rota_nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="crud_actions">
                                <button type="button" class="botao botao_secundario crud_edit_button"
                                    data-id="<?php echo (int) $sensor['id_sensor']; ?>"
                                    data-nome="<?php echo htmlspecialchars($sensor['nome'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-tipo="<?php echo htmlspecialchars($sensor['tipo_dado'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-localizacao="<?php echo htmlspecialchars($sensor['localizacao'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-status="<?php echo htmlspecialchars($sensor['status'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-descricao="<?php echo htmlspecialchars((string) $sensor['descricao'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-trem="<?php echo (int) $sensor['id_trem']; ?>"
                                    data-rota="<?php echo (int) $sensor['id_rota']; ?>">
                                    EDITAR
                                </button>
                                <form class="crud_delete_form" data-confirm="Excluir este sensor e todos os dados históricos dele?" action="../infra/excluir_sensor.php" method="POST">
                                    <input type="hidden" name="id_sensor" value="<?php echo (int) $sensor['id_sensor']; ?>">
                                    <button type="submit" class="botao botao_secundario">EXCLUIR</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </main>

    <script src="../js/sensores_private.js?v=2"></script>
</body>

</html>