<?php
include '../infra/conexao.php';
include '../infra/auth.php';

$rotas = mysqli_query($conexao, "SELECT id_rota, nome, origem, destino, distancia_km FROM rotas ORDER BY id_rota");
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotas - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css?v=4">
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

        <div id="modal_rota" class="crud_modal oculto" role="dialog" aria-modal="true" aria-labelledby="titulo_modal_rota">
        <section id="section_cadastro_rota" class="painel_formulario">
            <div id="titulo_modal_rota" class="titulo_secao light">CADASTRO / EDIÇÃO DE ROTA</div>

            <form id="form_rota" action="../infra/salvar_rota.php" method="POST" autocomplete="off">
            <input type="hidden" id="edit_original_id" name="rta_id_rota">
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="rota_nome">NOME</label>
                        <input type="text" id="rota_nome" name="rta_nome" required>
                    </div>
                    <div class="grupo_formulario">
                        <label for="rota_origem">ORIGEM</label>
                        <input type="text" id="rota_origem" name="rta_origem" required>
                    </div>
                </div>
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="rota_destino">DESTINO</label>
                        <input type="text" id="rota_destino" name="rta_destino" required>
                    </div>
                    <div class="grupo_formulario">
                        <label for="rota_distancia_km">DISTÂNCIA (KM)</label>
                        <input type="number" id="rota_distancia_km" name="rta_distancia_km" min="0.01" step="0.01" required>
                    </div>
                </div>
                <div class="botoes_linha">
                    <button type="submit" id="btn_salvar_rota" class="botao botao_primario">SALVAR</button>
                    <button type="button" id="btn_cancelar_rota" class="botao botao_secundario">CANCELAR</button>
                </div>
            </form>
        </section>
        </div>

        <?php if (isset($_GET['erro']) && $_GET['erro'] === 'em_uso') { ?>
            <div class="crud_error">Esta rota está vinculada a trens ou sensores e não pode ser excluída.</div>
        <?php } ?>

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
                        <th>DISTÂNCIA (KM)</th>
                        <th>AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tbody_rotas">
                    <?php if (mysqli_num_rows($rotas) === 0) { ?>
                        <tr><td colspan="6">Nenhuma rota cadastrada ainda.</td></tr>
                    <?php } ?>
                    <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                        <tr>
                            <td><?php echo (int) $rota['id_rota']; ?></td>
                            <td><?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($rota['origem'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($rota['destino'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $rota['distancia_km'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td class="crud_actions">
                                <button type="button" class="botao botao_secundario crud_edit_button"
                                    data-id="<?php echo (int) $rota['id_rota']; ?>"
                                    data-nome="<?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-origem="<?php echo htmlspecialchars($rota['origem'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-destino="<?php echo htmlspecialchars($rota['destino'], ENT_QUOTES, 'UTF-8'); ?>"
                                    data-distancia="<?php echo htmlspecialchars((string) $rota['distancia_km'], ENT_QUOTES, 'UTF-8'); ?>">
                                    EDITAR
                                </button>
                                <form class="crud_delete_form" data-confirm="Excluir esta rota? O banco não permite excluir rotas vinculadas a trens ou sensores." action="../infra/excluir_rota.php" method="POST">
                                    <input type="hidden" name="id_rota" value="<?php echo (int) $rota['id_rota']; ?>">
                                    <button type="submit" class="botao botao_secundario">EXCLUIR</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <script src="../js/rotas_private.js?v=2"></script>
</body>
</html>