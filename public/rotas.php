Aqui está este código também totalmente convertido para snake_case.
Todas as classes CSS e IDs de elementos que usavam hífens foram alterados para letras minúsculas com sublinhados (_), mantendo a estrutura e os links intactos.

<?php
include '../infra/conexao.php';

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rotas</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>
<body>
    <nav class="navegacao">
            <div class="container_menu">
                <div class="logo">Rail<span>Pulse</span></div>
                <div class="paginas"><a href="../public/dashboard.html" >PAINEL</a></div>
                <div class="paginas"><a href="../public/sensores.html">SENSORES</a></div>
                <div class="paginas"><a href="../public/trens.html">TRENS</a></div>
                <div class="paginas"><a href="../public/rotas.html" class="active">ROTAS</a></div>
                <div class="paginas"><a href="../public/relatorios.html">RELATÓRIOS</a></div>
                <div class="topbar_info">
                    <span id="info_matricula" class="topbar_matricula"></span>
                    <a href="../index.php" class="paginas">SAIR</a>
                </div>

            </div>
        </nav>
</body>
</html>


