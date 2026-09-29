<?php
include '../infra/conexao.php';

$sensores = mysqli_query($conexao, "SELECT s.id_sensor, s.nome, s.tipo_dado, s.localizacao, s.status, t.nome AS trem_nome, r.nome AS rota_nome FROM sensores s JOIN trens t ON s.id_trem = t.id_trem JOIN rotas r ON s.id_rota = r.id_rota ORDER BY s.id_sensor");
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
            <div class="barra_topo_info">
                <span id="info_matricula" class="matricula_topo"></span>
                <a href="../index.php" class="paginas">SAIR</a>
            </div>
        </div>
    </nav>

    <main class="conteudo_principal">
        <h1 class="titulo_pagina">Sensores</h1>

        <div class="barra_ferramentas">
            <div class="campo_pesquisa">
                <input type="search" id="input_busca" placeholder="Buscar sensor..." aria-label="Buscar sensor">
            </div>
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
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($sensores) === 0) { ?>
                        <tr><td colspan="7">Nenhum sensor cadastrado ainda.</td></tr>
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
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
    <script src="../js/sensores.public.js?v=1"></script>
</body>

</html>
