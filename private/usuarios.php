<?php
include '../infra/conexao.php';
include '../infra/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body>
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
            <div class="paginas"><a href="rotas.php">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
            <div class="paginas"><a href="usuarios.php" class="active">USUÁRIOS</a></div>
            <div class="barra_topo_info">
                <span id="info_matricula" class="matricula_topo"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="conteudo_principal">

        <h1 class="titulo_pagina">Usuários</h1>

        <section id="section_cadastro_usuario" class="painel_formulario oculto">
            <div class="titulo_secao light">CADASTRO NOVO USUÁRIO</div>

            <form id="form_usuario" action="../infra/salvar_usuario.php" method="POST" autocomplete="off">
                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="cad_nome">NOME COMPLETO</label>
                        <input type="text" id="cad_nome" name="usr_nome" required>
                    </div>
                    <div class="grupo_formulario">
                        <label for="cad_matricula">MATRÍCULA</label>
                        <input type="text" id="cad_matricula" name="usr_matricula" maxlength="10" required>
                    </div>
                </div>

                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="cad_cargo">CARGO</label>
                        <select id="cad_cargo" name="usr_cargo" required>
                            <option value="">Selecione um cargo</option>
                            <option value="admin">Administrador</option>
                            <option value="funcionario">Funcionário</option>
                        </select>
                    </div>
                    <div class="grupo_formulario">
                        <label for="cad_email">E-MAIL</label>
                        <input type="email" id="cad_email" name="usr_email" required>
                    </div>
                </div>

                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label for="cad_senha">SENHA</label>
                        <input type="password" id="cad_senha" name="usr_senha" required>
                    </div>
                </div>

                <div class="botoes_linha">
                    <button type="submit" class="botao botao_primario">CADASTRAR USUÁRIO</button>
                    <button type="button" class="botao botao_secundario" id="btn_cancelar_usuario">CANCELAR</button>
                </div>
            </form>
        </section>

        <div class="barra_ferramentas">
            <div class="campo_pesquisa">
                <input type="text" id="input_busca" placeholder="Buscar usuário...">
            </div>
            <button id="btn_novo_usuario" class="botao botao_primario admin_only">+ NOVO USUÁRIO</button>
        </div>

        <div class="titulo_secao light">LISTAGEM DE USUÁRIOS</div>

        <div class="container_tabela">
            <table class="tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th>MATRÍCULA</th>
                        <th id="col_acoes" class="oculto">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tabela_usuarios"></tbody>
            </table>
        </div>
    </main>

    <script src="../js/usuarios_private.js"></script>
</body>

</html>