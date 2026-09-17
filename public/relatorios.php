<?php
include '../infra/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios - RailPulse</title>
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
            <div class="paginas"><a href="relatorios.php" class="active">RELATÓRIOS</a></div>
            <div class="barra_topo_info">
                <span id="info_matricula" class="matricula_topo"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="conteudo_principal">
        <h2 class="titulo_pagina">RELATÓRIOS</h2>
        <hr class="divider">

        <div class="titulo_secao light">LISTAGEM DE RELATÓRIOS</div>

        <div class="container_tabela">
            <table class="tabela" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TÍTULO</th>
                        <th>DATA</th>
                        <th>TIPO</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody id="tbody_relatorios">
                </tbody>
            </table>
            <div id="msg_vazio" class="mensagem_vazia oculto">
                Nenhum relatório disponível ainda.
            </div>
        </div>
    </main>

    <script src="../script/relatorios.js"></script>
</body>
</html>
