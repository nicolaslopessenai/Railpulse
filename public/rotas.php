<?php
include '../infra/conexao.php';

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
            <div class="paginas"><a href="dashboard.php">PAINEL</a></div>
            <div class="paginas"><a href="sensores.php">SENSORES</a></div>
            <div class="paginas"><a href="trens.php">TRENS</a></div>
            <div class="paginas"><a href="rotas.php" class="active">ROTAS</a></div>
            <div class="paginas"><a href="relatorios.php">RELATÓRIOS</a></div>
            <div class="barra_topo_info">
                <span id="info_matricula" class="matricula_topo"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="conteudo_principal">
        <h1 class="titulo_pagina">Rotas</h1>

        <div class="barra_ferramentas">
            <div class="campo_pesquisa">
                <input type="search" id="input_busca" placeholder="Buscar rota..." aria-label="Buscar rota">
            </div>
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
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($rotas) === 0) { ?>
                        <tr><td colspan="5">Nenhuma rota cadastrada ainda.</td></tr>
                    <?php } ?>
                    <?php while ($rota = mysqli_fetch_assoc($rotas)) { ?>
                        <tr>
                            <td><?php echo (int) $rota['id_rota']; ?></td>
                            <td><?php echo htmlspecialchars($rota['nome'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($rota['origem'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($rota['destino'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars((string) $rota['distancia_km'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="../js/rotas.public.js?v=1"></script>
</body>

</html>
