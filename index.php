<?php
include 'infra/conexao.php';
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RailPulse</title>
    <link rel="stylesheet" href="assets/style/style.css">
</head>
<body class="corpo_inicial">
    
    <nav class="navegacao">
        <div class="container_menu">
            <div class="logo">Rail<span>Pulse</span></div>
            <div class="botoes_topo">
                <a href="login.php" class="link_entrar">ENTRAR</a>
            </div>
        </div>
    </nav>

    <header class="banner">
        <div class="container">
            <div class="conteudo_banner">
                <span class="etiqueta">SISTEMA INTELIGENTE</span>
                <h1 class="titulo_principal">Monitoramento de Precisão para Ferrovias</h1>
                <p class="texto_apoio">Transformamos dados brutos de sensores IoT em decisões inteligentes para aumentar a segurança e eficiência da sua operação.</p>
                <div class="acoes">
                    <a href="#solucoes" class="botao_azul">CONHECER SOLUÇÃO</a>
                </div>
            </div>
        </div>
    </header>

    <section id="solucoes" class="recursos">
        <div class="container">
            <div class="section_title light">O QUE OFERECEMOS</div>
            <div class="grade_recursos">
                <div class="cartao">
                    <div class="numero">01</div>
                    <h3>Rastreamento</h3>
                    <p>Captura de velocidade, localização e consumo em tempo real por meio de sensores nos trilhos e locomotivas.</p>
                </div>
                <div class="cartao">
                    <div class="numero">02</div>
                    <h3>Segurança</h3>
                    <p>Detecção antecipada de falhas e manutenção preditiva baseada em padrões de dados operacionais.</p>
                </div>
                <div class="cartao">
                    <div class="numero">03</div>
                    <h3>Gestão</h3>
                    <p>Controle de acesso seguro, geração de relatórios detalhados e gráficos interativos para gestores.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="rodape">
        <div class="container">
            <div class="conteudo_rodape">
                <div class="info_projeto">
                    <p><strong>Projeto RailPulse</strong></p>
                    <p>Desenvolvimento de Sistemas - SENAI Santa Catarina</p>
                </div>
                <div class="equipe">
                    <span>Arthur Vieira • Gabriel Ostrovski • Gustavo Miquelute • Nicolas Lopes  </span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
