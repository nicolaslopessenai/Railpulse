# Relatório de uso da IA

## Ferramenta de IA utilizada

- GitHub Copilot no ambiente do VS Code.
- Modelo associado ao assistente: MAI-Code-1.1-Flash.

## Objetivos da utilização

A IA foi utilizada para:

- analisar a estrutura atual do projeto e confirmar a arquitetura em PHP/MySQL;
- identificar páginas públicas e privadas, autenticação e padrões de código já existentes;
- propor e ajustar a implementação de integração de clima e consulta por CEP sem quebrar a landing page e o fluxo atual do sistema;
- revisar documentação, criar o relatório de uso da IA e atualizar a descrição do projeto.

## Principais instruções fornecidas

As instruções principais foram:

- preservar a arquitetura atual do sistema;
- não modificar a landing page nem a identidade visual já existente;
- respeitar a organização em `public/` e `private/`;
- não alterar o banco de dados sem necessidade;
- priorizar integrações reais com APIs públicas;
- manter o código simples, compatível com o projeto e fácil de manter.

## Arquivos e funcionalidades desenvolvidas com auxílio da IA

Os principais itens apoiados pela IA foram:

- análise estrutural de autenticação e navegação em `infra/auth.php`, `public/dashboard.php`, `private/dashboard.php` e `private/usuarios.php`;
- criação do módulo de clima em `js/weather_dashboard.js` para integrar a API Open-Meteo;
- criação do módulo de consulta de CEP em `js/cep_lookup.js` para integrar a API ViaCEP;
- inclusão dos campos de endereço e botão de consulta no formulário de cadastro/edição de usuários em `private/cadastro.php` e `private/usuarios.php`;
- atualização do `README.md` para refletir a estrutura e as integrações atuais;
- criação deste relatório em `docs/relatorio-uso-ia.md`.

## Alterações e revisões realizadas

A IA sugeriu a estrutura inicial das integrações e os trechos de marcação HTML/JavaScript. As alterações foram revisadas manualmente para:

- remover caminhos quebrados ou referências inexistentes;
- manter os nomes dos arquivos compatíveis com o projeto;
- evitar modificações de banco desnecessárias;
- garantir que a landing page resistisse intacta;
- ajustar a exibição de mensagens e estados de carregamento.

## Testes executados

Os testes e verificações executados foram:

- `php -l infra/conexao.php`
- `php -l infra/auth.php`
- `php -l public/dashboard.php`
- `php -l private/dashboard.php`
- `php -l private/cadastro.php`
- `php -l private/usuarios.php`
- `node --check js/weather_dashboard.js`
- `node --check js/cep_lookup.js`
- consultas reais às APIs públicas com `curl` para verificar disponibilidade e resposta.

## Problemas identificados e correções

Os principais problemas encontrados foram:

- páginas de dashboard não tinham integração climática;
- não existia fluxo de busca por CEP em nenhum formulário atual;
- o projeto tinha referências a arquivos JavaScript inexistentes em algumas páginas;
- a documentação anterior estava desatualizada em relação à estrutura real do repositório.

As correções implementadas foram:

- adicionar a consulta de clima na dashboard;
- inserir a busca de CEP no formulário existente de usuários;
- manter a relação de scripts compatível com a pasta `js/` do projeto;
- revisar a documentação de instalação e execução.

## Limitações encontradas

- a estrutura do projeto ainda é simples e não possui um backend completo em API REST;
- o sistema não persiste dados de endereço em banco, pois a tabela `usuarios` atual não contém esses campos;
- o uso da API de clima depende de disponibilidade externa da internet e da resposta da API;
- a verificação visual completa da interface exige execução em navegador local, o que não foi possível validar neste ambiente de terminal.

## Reflexão sobre a utilização da IA

A IA foi útil para acelerar a leitura, sugerir estruturas já compatíveis com o projeto e reduzir o retrabalho manual na escrita de scripts e documentação. Ainda assim, o papel da equipe foi essencial para:

- validar as sugestões contra a arquitetura real do projeto;
- remover soluções desnecessárias ou incompatíveis;
- confirmar se as integrações correspondiam ao que o professor exigia;
- verificar que os arquivos e caminhos realmente existiam no repositório.

A IA foi um apoio de produtividade e análise, mas não substituiu a revisão técnica e a decisão final da equipe.
