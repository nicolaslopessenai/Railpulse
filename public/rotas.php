<?php
include '../infra/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotas - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>
<body>
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="paginas"><a href="dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
            <div class="paginas"><a href="rotas.php" class="active">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
            <div class="topbar_info">
                <span id="info_matricula" class="topbar_matricula"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="main_content">
        <h2 class="page_title">ROTAS</h2>
        <hr class="divider">

        <div class="list_toolbar">
            <div class="search_wrap">
                <input type="text" id="input_busca" placeholder="Buscar rota...">
            </div>
            <button id="btn_nova_rota" class="btn btn_primary admin_only" style="display:none;">+ NOVA ROTA</button>
        </div>

        <div class="section_title light">LISTAGEM DE ROTAS</div>

        <div class="table_wrapper">
            <table class="tabela" id="tabela_rotas">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>ORIGEM</th>
                        <th>DESTINO</th>
                        <th>STATUS</th>
                        <th id="col_acoes" style="display:none;">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tbody_rotas">
                </tbody>
            </table>
            <div id="msg_vazio" class="msg_vazio" style="display:none;">
                Nenhuma rota cadastrada ainda.
            </div>
        </div>
    </main>

    <script src="../script/rotas.js"></script>
</body>
</html>
