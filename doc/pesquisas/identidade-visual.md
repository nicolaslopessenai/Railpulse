# Registro de Desenvolvimento da Identidade Visual

Este documento documenta as decisões técnicas de design, conceitos de interface (UI) e usabilidade (UX) aplicados no desenvolvimento do front-end do sistema.

## 1. Referências e Aprendizados
* **Estudo de Caso:** Analisamos painéis operacionais e sistemas de bilhetagem de transporte público moderno.
* **Diretriz de Design:** Interfaces densas em dados (como tabelas de rotas e horários) exigem um gerenciamento rigoroso do espaço em branco (*whitespace*) e tipografia sem serifa de alta legibilidade para mitigar a carga cognitiva do usuário.

## 2. Paleta de Cores e Semântica Visual
A escolha cromática foi estruturada por meio de variáveis CSS (`:root`), garantindo consistência visual e facilidade de manutenção.

* `---rail-blue` (`#2d97d4`): **Cor Primária.** Utilizada estritamente para elementos de ação principal (*Call to Action*), links e estados de foco.
* `--rail-text` (`#1f2937`): **Texto Principal.** Um cinza de alta densidade que substitui o preto puro (#000), reduzindo a fadiga visual em períodos prolongados de uso.
* `--rail-muted` (`#5f6f82`): **Texto Secundário.** Aplicado em metadados, labels de formulários e informações de suporte.
* `--rail-bg` (`#f4f7fb`): **Fundo do Sistema.** Tom frio e neutro que destaca os componentes da interface.
* `--rail-surface` (`#ffffff`): **Superfície.** Reservado para os contêineres de conteúdo (`.card-soft`), criando separação e profundidade em relação ao fundo.
* `--rail-line` (`#e5e7eb`): **Divisores.** Utilizado para bordas sutis e separadores de tabelas, organizando os dados sem poluir o layout.

## 3. Tipografia e Elementos Gráficos
* **Tipografia:** Família de fontes *sans-serif* (`"Segoe UI", Tahoma, Geneva, sans-serif`). A escolha garante excelente renderização de caracteres numéricos e legibilidade em telas de diferentes resoluções.
* **Estilização de Componentes:** Adotamos cantos arredondados (`0.9rem` a `1rem`) e sombras suaves (`--rail-shadow`) para suavizar a interface corporativa, alinhando o sistema às tendências modernas de design de software (Soft Design).
* **Microinterações:** Botões e elementos interativos possuem transições suaves (`transition: all 0.2s ease-in-out`) com elevação no estado de *hover*, fornecendo *feedback* visual imediato ao usuário.

## 4. Arquitetura de Layout e Hierarquia
* **Componentização:** O uso da classe `.card-soft` agrupa informações correlacionadas, respeitando o princípio de proximidade da Gestalt.
* **Hierarquia em Dados:** As tabelas (`.table-soft th`) utilizam caixas-altas (letras maiúsculas), tamanho reduzido (`0.72rem`) e espaçamento entre letras (`letter-spacing: 0.08em`), diferenciando claramente os cabeçalhos dos dados brutos.

## 5. Resolução de Problemas de Usabilidade (Refatoração)
* **Contraste na Tela de Login:** A imagem de fundo (`Trem.png`) competia visualmente com os campos de entrada, prejudicando o acesso. Aplicamos um *overlay* de gradiente escuro (`rgba(15, 23, 42, 0.72)`) para garantir o contraste do formulário.
* **Componentes Modais:** Janelas de cadastro quebravam ou extrapolavam os limites de telas menores. Refatoramos o contêiner utilizando propriedades flexíveis (`width: min(760px, 100%)`) e limitador de altura com rolagem interna (`overflow: auto`).

## 6. Testes de Interface
* **Acessibilidade:** Validamos a relação de contraste entre o texto principal (`--rail-text`) e as superfícies de fundo, atendendo aos critérios de conformidade da WCAG.
* **Responsividade:** O layout foi testado em resoluções *desktop* e *mobile*. Em dispositivos móveis (abaixo de 768px), o comportamento do fundo da tela de login foi ajustado para `scroll` para otimizar a performance de renderização do navegador.

## 7. Ferramentas Utilizadas
* **Figma:** Prototipagem e especificação das telas.
* **Coolors:** Modelagem e validação da paleta de cores neutras.
* **VS Code:** Desenvolvimento, codificação do CSS e inspeção técnica de elementos.

