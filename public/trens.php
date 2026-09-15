<?php
include '../infra/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trens - RailPulse</title>
    <link rel="stylesheet" href="../assets/style/style.css">
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
            <div class="topbar_info">
                <span id="info_matricula" class="topbar_matricula"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="main_content">
        <h2 class="page_title">TRENS</h2>
        <hr class="divider">

        <div class="list_toolbar">
            <div class="search_wrap">
                <input type="text" id="input_busca" placeholder="Buscar trem...">
            </div>
            <button id="btn_novo_trem" class="btn btn_primary admin_only" style="display:none;">+ NOVO TREM</button>
        </div>

        <div class="section_title light">LISTAGEM DE TRENS</div>

        <div class="table_wrapper">
            <table class="tabela" id="tabela_trens">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>MODELO</th>
                        <th>STATUS</th>
                        <th id="col_acoes" style="display:none;">AÇÕES</th>
                    </tr>
                </thead>
                <tbody id="tbody_trens">
                </tbody>
            </table>
            <div id="msg_vazio" class="msg_vazio" style="display:none;">
                Nenhum trem cadastrado ainda.
            </div>
        </div>
    </main>

    <script src="../script/trens.js"></script>
</body>
</html>