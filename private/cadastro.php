<?php
include '../infra/conexao.php';
include '../infra/auth.php';
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>

<body>

        <nav class="navegacao">
            <div class="container_menu">
                <div class="logo">Rail<span>Pulse</span></div>
                <div class="paginas"><a href="dashboard.php" >PAINEL</a></div>
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
            <h2 class="titulo_pagina">SISTEMA DE CADASTROS - USUÁRIOS</h2>

            <div id="mensagem_container"></div>

            <div class="titulo_secao light">DADOS USUÁRIOS</div>
            <form id="form_cadastro" action="../infra/salvar_usuario.php" method="POST">

                <div class="grupo_formulario">
                    <label>NOME COMPLETO</label>
                    <input type="text" id="cad_nome" name="usr_nome" placeholder="Ex: João da Silva" required>
                </div>

                <div class="linha_formulario">
                    <div class="grupo_formulario">
                        <label>MATRÍCULA</label>
                        <input type="text" id="cad_matricula" name="usr_matricula" placeholder="Ex: 4325" maxlength="10" required>
                    </div>

                    <div class="grupo_formulario">
                        <label class="form_label">CARGO</label>
                        <select id="cad_cargo" name="usr_cargo" required>
                            <option value="">Selecione um cargo</option>
                            <option value="admin">Administrador</option>
                            <option value="funcionario">Funcionário</option>
                        </select>
                    </div>
                </div>

                <div class="grupo_formulario">
                    <label>E-MAIL</label>
                    <input type="email" id="cad_email" name="usr_email" placeholder="exemplo@empresa.com.br" required>
                </div>

                <div class="grupo_formulario">
                    <label>SENHA</label>
                    <input type="password" id="cad_senha" name="usr_senha" placeholder="Senha do funcionário" required>
                </div>

                <div class="botoes_linha">
                    <button type="submit" class="botao botao_primario" id="btn_cadastrar">CADASTRAR NOVO</button>
                </div>

                <div class="paginas"><a href="usuarios.php">Cancelar</a></div>
            </form>
            
        </main>
    </div>

    <script src="../script/cadastro.js"></script>

</body>

</html>
