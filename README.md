# RailPulse

## Visão geral

O RailPulse é um sistema web para gestão operacional de ferrovias, com foco em monitoramento de trens, sensores, rotas e relatórios. A solução foi organizada em áreas públicas e privadas para separar autenticação, navegação interna e operações administrativas.

A estrutura atual usa PHP puro, MySQL e HTML/CSS/JavaScript, mantendo a lógica simples e didática para estudantes de Desenvolvimento de Sistemas.

## Objetivo do projeto

O sistema permite:

- acompanhar dados operacionais de trens e sensores;
- controlar acesso por perfil de usuário;
- gerenciar rotas, trens e relatórios;
- consultar clima em tempo real para a cidade de Joinville;
- consultar dados de endereço por CEP através da API ViaCEP.

## Landing page e sistema interno

A landing page institucional do projeto permanece em `index.php` e não foi alterada. O sistema interno continua acessível pelas páginas em `public/` e `private/` após login.

## Tecnologias utilizadas

- PHP 8.x (backend e autenticação via sessão)
- MySQL/MariaDB
- HTML5
- CSS3
- JavaScript ES6+
- Bootstrap 5
- APIs externas: Open-Meteo e ViaCEP

## Estrutura do repositório

```text
Railpulse/
├── assets/
│   ├── img/
│   └── style/
├── database/
│   └── railpulse.sql
├── doc/
│   └── pesquisas/
├── docs/
│   └── relatorio-uso-ia.md
├── infra/
│   ├── auth.php
│   ├── conexao.php
│   ├── processar_login.php
│   ├── logout.php
│   ├── salvar_usuario.php
│   ├── salvar_trem.php
│   ├── salvar_rota.php
│   ├── salvar_sensor.php
│   ├── excluir_usuario.php
│   ├── excluir_trem.php
│   ├── excluir_rota.php
│   └── excluir_sensor.php
├── js/
│   ├── cep_lookup.js
│   ├── weather_dashboard.js
│   ├── pesquisa_tabelas.js
│   ├── usuarios_private.js
│   └── ...
├── private/
│   ├── cadastro.php
│   ├── dashboard.php
│   ├── relatorios.php
│   ├── rotas.php
│   ├── sensores.php
│   ├── trens.php
│   └── usuarios.php
├── public/
│   ├── dashboard.php
│   ├── login.php
│   ├── relatorios.php
│   ├── rotas.php
│   ├── sensores.php
│   └── trens.php
├── index.php
├── LICENSE
├── README.md
└── ...
```

## Autenticação e acesso

A autenticação do projeto é baseada em sessão do PHP.

- `infra/auth.php` valida a presença de sessão e o cargo do usuário.
- `infra/processar_login.php` verifica e-mail e senha contra o banco.
- páginas em `private/` exigem acesso administrativo ou do perfil correspondente.
- `infra/logout.php` encerra a sessão e redireciona para a tela de login.

## Banco de dados

O banco principal está em `database/railpulse.sql`.

A conexão é feita em `infra/conexao.php` e usa as credenciais locais padrão do ambiente XAMPP:

- host: `localhost`
- usuário: `root`
- senha: vazia
- banco: `railpulse`

## APIs integradas

### Open-Meteo

- documentação: https://open-meteo.com/en/docs
- objetivo: consultar clima atual da cidade de Joinville.
- não exige chave de API.
- consulta usada na dashboard após login.

### ViaCEP

- documentação: https://viacep.com.br/
- objetivo: localizar endereço por CEP, preenchendo automaticamente os campos de logradouro, bairro, cidade e UF.
- valida o CEP antes da busca e trata erros e CEP inexistente.

## Instalação e execução

### Pré-requisitos

- XAMPP ou outro ambiente com PHP + MySQL em execução.
- acesso ao diretório `htdocs` do servidor local.

### Passos

1. Clone o projeto para o diretório do servidor local.
2. Importe o script `database/railpulse.sql` no phpMyAdmin ou via linha de comando do MySQL.
3. Confirme que o banco `railpulse` foi criado corretamente.
4. Acesse a aplicação em:
   - `http://localhost/Railpulse/` para a landing page.
   - `http://localhost/Railpulse/public/login.php` para o login do sistema.

## Como a integração funciona

### Clima

A dashboard consulta a API Open-Meteo em JavaScript. O fluxo é:

1. buscar geolocalização da cidade de Joinville;
2. consultar temperatura e condição climática atual;
3. mostrar o local, data/hora da atualização e mensagem de erro quando necessário.

### CEP

Os formulários de cadastro/edição de usuário foram adaptados para incluir busca por CEP. O comportamento é:

1. validação de 8 dígitos numéricos;
2. remoção de máscara e espaços;
3. consulta real à API ViaCEP;
4. preenchimento automático dos campos disponíveis;
5. mensagem de erro para CEP inválido, inexistente ou indisponível.

## Observações importantes

- A landing page institucional não foi alterada.
- O banco foi mantido sem alterações estruturais desnecessárias.
- As integrações foram feitas com APIs reais e sem dados estáticos.
- As consultas são executadas somente quando a página é carregada ou quando o usuário solicita o CEP.

## Desenvolvedores

- Arthur Vieira
- Gabriel Ostrovski
- Gustavo Miquelute
- Nicolas Lopes

## Licença

O projeto está sob a licença do repositório em `LICENSE`.
