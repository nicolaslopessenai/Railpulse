<?php
include '../infra/conexao.php';
include '../infra/auth.php';

$rotas = mysqli_query($conexao, "SELECT id_rota, nome FROM rotas ORDER BY nome");
$trens = mysqli_query($conexao, "SELECT id_trem, nome, modelo, status_operacional, velocidade_atual, latitude, longitude, id_rota FROM trens ORDER BY id_trem");
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trens - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css?v=4">
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

        <div id="modal_trem" class="crud_modal oculto" role="dialog" aria-modal="true" aria-labelledby="titulo_modal_trem">
        <section id="section_cadastro_trem" class="painel_formulario">
            <div id="titulo_modal_trem" class="titulo_secao light">CADASTRO / EDIÇÃO DE TREM</div>

            <form id="form_editar" action="../infra/salvar_trem.php" method="POST" autocomplete="off">
            <input type="hidden" id="edit_original_id" name="trn_id_trem">
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_nome">NOME</label>
                        <input type="text" id="edit_nome" name="trn_nome" required>
                    </div>
                    <div class="grupo_formulario">
                        <label for="edit_modelo">MODELO</label>
                        <input type="text" id="edit_modelo" name="trn_modelo" required>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_status_operacional">STATUS OPERACIONAL</label>
                        <select id="edit_status_operacional" name="trn_status" required>
                            <option value="normal">Normal</option>
                            <option value="alerta">Alerta</option>
                            <option value="falha">Falha</option>
                        </select>
                    </div>
                    <div class="grupo_formulario">
                        <label for="edit_id_rota">ROTA</label>
                        <select id="edit_id_rota" name="trn_id_rota" required>
                            <option value="">Selecione a rota</option>
                            <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                                <option value="<?php echo $rota['id_rota']; ?>"><?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_velocidade_atual">VELOCIDADE ATUAL</label>
                        <input type="number" id="edit_velocidade_atual" name="trn_velocidade" min="0" step="0.01" required>
                    </div>
                    <div class="grupo_formulario">
                        <label for="edit_latitude">LATITUDE</label>
                        <input type="number" id="edit_latitude" name="trn_latitude" step="0.0000001" required>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="edit_longitude">LONGITUDE</label>
                        <input type="number" id="edit_longitude" name="trn_longitude" step="0.0000001" required>
                    </div>
                </div>
                <div class="botoes_linha">
                    <button type="submit" id="btn_salvar_trem" class="botao botao_primario">SALVAR</button>
                    <button type="button" id="btn_cancelar_trem" class="botao botao_secundario">CANCELAR</button>
                </div>
            </form>
        </section>
        </div>

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
                        <th id="col_acoes">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tbody_trens">
                    <?php if (mysqli_num_rows($trens) === 0) { ?>
                        <tr><td colspan="5">Nenhum trem cadastrado ainda.</td></tr>
                    <?php } ?>
                    <?php while ($trem = mysqli_fetch_assoc($trens)) { ?>
                        <tr>
                            <td><?php echo (int) $trem['id_trem']; ?></td>
                            <td><?php echo htmlspecialchars($trem['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($trem['modelo'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($trem['status_operacional'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="crud_actions">
                                <button type="button" class="botao botao_secundario crud_edit_button"
                                    data-id="<?php echo (int) $trem['id_trem']; ?>"
                                    data-nome="<?php echo htmlspecialchars($trem['nome'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-modelo="<?php echo htmlspecialchars($trem['modelo'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-status="<?php echo htmlspecialchars($trem['status_operacional'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-rota="<?php echo (int) $trem['id_rota']; ?>"
                                    data-velocidade="<?php echo htmlspecialchars((string) $trem['velocidade_atual'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-latitude="<?php echo htmlspecialchars((string) $trem['latitude'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-longitude="<?php echo htmlspecialchars((string) $trem['longitude'], ENT_QUOTES, 'UTF-8'); ?>">
                                    EDITAR
                                </button>
                                <form class="crud_delete_form" data-confirm="Excluir este trem, os sensores vinculados e os dados desses sensores?" action="../infra/excluir_trem.php" method="POST">
                                    <input type="hidden" name="id_trem" value="<?php echo (int) $trem['id_trem']; ?>">
                                    <button type="submit" class="botao botao_secundario">EXCLUIR</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="../js/trens_private.js?v=3"></script>
</body>
</html>