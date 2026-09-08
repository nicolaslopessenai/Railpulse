# RailPulse

## Sobre o Projeto

O **RailPulse** é uma solução tecnológica desenvolvida para otimizar e auxiliar a gestão de operações ferroviárias. O sistema captura e monitora dados críticos dos trens em tempo real — como velocidade, localização, consumo de combustível e diagnósticos de falhas — por meio de sensores IoT (Internet das Coisas) estrategicamente instalados nos trilhos e nas próprias locomotivas.

O foco principal do projeto é transformar dados brutos em decisões inteligentes, aumentando a segurança e a eficiência operacional. Com isso, falhas podem ser detectadas rapidamente e manutenções preditivas passam a ser realizadas com base em fatos, permitindo que os gestores acompanhem o desempenho da frota e identifiquem padrões operacionais a serem otimizados.

---

## Funcionalidades Principais

* **Controle de Acesso Seguro:** Sistema de login com autenticação para administradores e usuários.
* **Gestão de Sensores e Trens:** Telas dedicadas para o cadastro e vinculação de sensores IoT a locomotivas específicas.
* **Monitoramento em Tempo Real:** Painel de controle (Dashboard) para acompanhar o status da ferrovia.
* **Geolocalização:** Visualização e rastreamento dos trens ativos em um mapa interativo.
* **Alertas Automáticos:** Notificações instantâneas no sistema em caso de anormalidades ou falhas detectadas.
* **Relatórios e Gráficos:** Ferramentas para geração de relatórios detalhados e gráficos interativos para análise histórica de desempenho.

---

## Regras de Negócio (RN)

As regras abaixo definem as restrições operacionais e políticas do sistema RailPulse:

| ID | Regra de Negócio |
| :--- | :--- |
| **RN01** | A tela de apresentação inicial deve exibir uma página institucional sobre a empresa. |
| **RN02** | A autenticação na tela de login exige obrigatoriamente um e-mail válido e senha. |
| **RN03** | O sistema possui dois níveis de acesso distintos: versão Administrador (Admin) e versão Funcionário. |
| **RN04** | A versão Admin possui permissões totais de visualização, criação, edição e exclusão de cadastros. |
| **RN05** | A tela de Dashboard deve exibir o mapa com a plotagem e rastreamento dos trens em tempo real. |
| **RN06** | Operações de CRUD (Criar, Alterar e Excluir) em sensores são restritas à versão Admin. |
| **RN07** | Operações de CRUD (Criar, Alterar e Excluir) em trens/locomotivas são restritas à versão Admin. |
| **RN08** | O gerenciamento completo de usuários e contas de login é exclusivo da versão Admin. |
| **RN09** | A tela de sensores deve listar e permitir a visualização de todos os dispositivos para ambos os perfis. |
| **RN10** | A tela de trens deve listar e permitir a visualização de todas as locomotivas para ambos os perfis. |

---

## Requisitos Funcionais (RF)

Os requisitos abaixo descrevem as funcionalidades que o sistema deve executar para atender aos usuários:

| ID | Descrição do Requisito |
| :--- | :--- |
| **RF01** | Permitir que os usuários e administradores façam login utilizando e-mail e senha. |
| **RF02** | Redirecionar o usuário diretamente para a tela de Dashboard imediatamente após a autenticação bem-sucedida. |
| **RF03** | Disponibilizar um menu de navegação fluido no Dashboard para acessar as telas de sensores, relatórios e rotas. |
| **RF04** | Exibir de forma dinâmica no mapa a localização geográfica, velocidade e temperatura dos trens à medida que os dados chegam. |
| **RF05** | Listar os sensores cadastrados exibindo ID, Tipo, Status e Coordenadas, exibindo botões de ação apenas para o Admin. |
| **RF06** | Permitir que o Admin cadastre novos sensores vinculados a um trem específico ou a uma localização da via. |
| **RF07** | Permitir que o Admin altere e atualize as informações técnicas dos sensores cadastrados. |
| **RF08** | Exigir confirmação manual para exclusão de sensores pelo Admin e exibir erro caso possua histórico de telemetria no banco. |
| **RF09** | Exibir cartões de indicadores analíticos no topo da tela (total de ativos, trens operando, em manutenção e em reserva). |
| **RF10** | Listar as locomotivas exibindo ID/Nome, Modelo, Capacidade, Última Manutenção e Status, utilizando paginação de dados. |
| **RF11** | Restringir estritamente ao administrador as permissões para criar, alterar dados e deletar locomotivas da base. |
| **RF12** | Exibir um resumo consolidado do trajeto contendo o total de rotas cadastradas, extensão em quilômetros (km) e rotas ativas. |
| **RF13** | Listar as rotas cadastradas detalhando Nome, Origem, Destino e Distância, utilizando suporte a paginação. |
| **RF14** | Restringir estritamente ao administrador a permissão de registrar novas rotas, atualizar trajetos ou remover rotas. |
| **RF15** | Permitir somente ao perfil administrador cadastrar novos usuários, além de editar perfis existentes ou excluí-los. |
| **RF16** | Permitir a busca ou geração de relatórios de telemetria filtrando por ID, Nome do Sensor ou intervalo de período de tempo. |
| **RF17** | Disponibilizar filtros de data (inicial e final), status e tipo de falha para geração automática de gráficos de tendência. |
| **RF18** | Apresentar uma tabela de histórico contendo relatórios gerados previamente com um botão para visualização detalhada. |
| **RF19** | Manter um endpoint ou integração contínua ativa para receber e processar pacotes de dados do hardware externo de IoT. |

---

## Requisitos Não Funcionais (RNF)

Os critérios abaixo especificam as características de qualidade, segurança e restrições técnicas do sistema:

| ID | Descrição do Requisito Não Funcional |
| :--- | :--- |
| **RNF01** | **Segurança / Acesso:** O sistema deve bloquear o acesso de usuários comuns a URLs ou funções restritas do Admin. |
| **RNF02** | **Confiabilidade:** O banco de dados MySQL deve assegurar a integridade referencial rígida via chaves primárias e estrangeiras. |
| **RNF03** | **Desempenho:** O processamento e a atualização dos dados recebidos dos sensores IoT no Dashboard devem ocorrer em tempo real. |
| **RNF04** | **Usabilidade (UX/UI):** A interface deve seguir boas práticas de design, fornecendo gráficos interpretativos claros e limpos. |
| **RNF05** | **Segurança de Sessão:** A função de logout deve destruir a sessão, redirecionar para o login e impedir o reuso de rotas privadas. |
| **RNF06** | **Integridade de Dados:** O sistema deve impedir a deleção física de sensores com leituras salvas para evitar perda de histórico. |

---

## Tecnologias Utilizadas

* **Back-end:** PHP (Estruturado com separação de rotas e camadas pública/privada)
* **Front-end:** HTML5, CSS3, JavaScript (ES6+)
* **Banco de Dados:** MySQL / MariaDB (Arquivo `railpulse.sql`)
* **Metodologia & Documentação:** Scrum, Markdown (pesquisas e documentações internas)

---

## Estrutura do Projeto

Abaixo está a organização de pastas e arquivos do repositório:

```text
RAILPULSE/
│
├── assets/
│   ├── img/                  # Imagens e vetores do sistema
│   └── style/                # Arquivos de estilização CSS
│
├── doc/                      # Documentação do projeto e pesquisas
│   ├── logo_scrum.png
│   ├── logo_xampp.png
│   ├── pesquisa-crud.md
│   ├── pesquisa-scrum.md
│   └── pesquisa-xampp.md
│
├── infra/
│   └── db/
│       └── railpulse.sql     # Script de criação do banco de dados
│
├── private/                  # Regras de negócio e processamento interno (PHP)
│   ├── cadastro.php
│   ├── dashboard.php
│   ├── login.php
│   ├── relatorios.php
│   ├── rotas.php
│   ├── sensores.php
│   ├── trens.php
│   └── usuarios.php
│
├── public/                   # Telas e arquivos acessíveis ao usuário (PHP)
│   ├── cadastro.php
│   ├── dashboard.php
│   ├── login.php
│   ├── relatorios.php
│   ├── rotas.php
│   ├── sensores.php
│   └── trens.php
│
├── script/                   # Lógica e interatividade no Front-end (JavaScript)
│   ├── cadastro.js
│   ├── dashboard.js
│   ├── login.js
│   ├── relatorios.js
│   ├── rotas.js
│   ├── sensores.js
│   ├── trens.js
│   └── usuarios.js
│
├── index.html                # Página de entrada da aplicação
├── LICENSE                   # Arquivo de licença do projeto
└── README.md                 # Documentação principal
```

---

## Aprendizados e Objetivos

O principal objetivo deste projeto é aplicar conceitos práticos de desenvolvimento de sistemas comerciais, conectando hardware (sensores IoT simulados/integrados) a uma aplicação web completa. Durante o desenvolvimento, foram consolidados aprendizados em:

* Arquitetura e organização de projetos web divididos em escopo público e privado.
* Integração de banco de dados relacional com PHP.
* Manipulação dinâmica de elementos de tela, mapas e gráficos via JavaScript.
* Aplicação da metodologia ágil Scrum para organização de tarefas da equipe.

---

## Como Executar o Projeto

1. **Pré-requisitos:** Certifique-se de ter um ambiente de servidor local instalado, como o XAMPP (com instâncias de PHP e MySQL ativas).
2. **Clonar o Repositório:**
   ```bash
   git clone https://github.com
   ```
3. **Mover para o Servidor:** Cole a pasta do projeto dentro do diretório `htdocs` do seu XAMPP (ou equivalente do seu servidor local).
4. **Configurar o Banco de Dados:**
   * Abra o phpMyAdmin (`http://localhost/phpmyadmin`).
   * Crie um banco de dados chamado `railpulse`.
   * Importe o arquivo estrutural encontrado em `infra/db/railpulse.sql`.
5. **Acessar a Aplicação:** Abra o navegador de sua preferência e digite `http://localhost/railpulse/index.html`.

---

## Desenvolvedores

Este projeto foi orgulhosamente desenvolvido por:

* **Arthur Vieira**
* **Gabriel Ostrovski**
* **Gustavo Miquelute**
* **Nicolas Lopes**

Estudantes do Curso Técnico em Desenvolvimento de Sistemas no **SENAI Santa Catarina**.
