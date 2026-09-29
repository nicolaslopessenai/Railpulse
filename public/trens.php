<?php
include '../infra/conexao.php';

$trens = mysqli_query($conexao, "SELECT id_trem, nome, modelo, status_operacional FROM trens ORDER BY id_trem");
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
            <div class="barra_topo_info">
                <span id="info_matricula" class="matricula_topo"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="conteudo_principal">
        <h1 class="titulo_pagina">Trens</h1>

        <div class="barra_ferramentas">
            <div class="campo_pesquisa">
                <input type="search" id="input_busca" placeholder="Buscar trem..." aria-label="Buscar trem">
            </div>
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
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($trens) === 0) { ?>
                        <tr><td colspan="4">Nenhum trem cadastrado ainda.</td></tr>
                    <?php } ?>
                    <?php while ($trem = mysqli_fetch_assoc($trens)) { ?>
                        <tr>
                            <td><?php echo (int) $trem['id_trem']; ?></td>
                            <td><?php echo htmlspecialchars($trem['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($trem['modelo'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($trem['status_operacional'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="../js/trens.public.js?v=1"></script>
</body>

</html>
