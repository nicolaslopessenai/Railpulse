# Pesquisa: APIs

## O que é uma API e qual é sua finalidade

API (*Application Programming Interface*) é um conjunto de regras que permite que um sistema converse com outro. Sua finalidade é integrar sistemas, reaproveitar funcionalidades prontas (pagamento, consulta de CEP, frete) e permitir que o mesmo back-end atenda site, aplicativo e parceiros.

## Como funciona a comunicação entre sistemas

Funciona no modelo cliente-servidor: o cliente envia uma **requisição**, o servidor processa o pedido e devolve uma **resposta**, geralmente em JSON, usando o protocolo HTTP/HTTPS.

## APIs REST

REST é um estilo de arquitetura em que tudo é um **recurso** (cliente, produto, pedido) com uma URL própria, manipulado pelos métodos HTTP. Cada requisição é independente (*stateless*) e os dados normalmente trafegam em JSON.

## Métodos HTTP

| Método | Ação |
|---|---|
| GET | Consultar dados |
| POST | Criar um registro |
| PUT | Substituir um registro inteiro |
| PATCH | Alterar parte de um registro |
| DELETE | Excluir um registro |

## Requisições e respostas HTTP

A **requisição** contém método, URL, cabeçalhos e, às vezes, corpo com dados. A **resposta** contém um código de status (200 sucesso, 201 criado, 400 requisição inválida, 401 não autenticado, 404 não encontrado, 500 erro no servidor), cabeçalhos e o corpo com os dados.

## Endpoints

Endpoint é o endereço de um recurso da API. Junto com o método HTTP, define a operação. Exemplo: `GET https://api.exemplo.com/v1/clientes/10` busca o cliente de id 10.

## JSON

JSON é um formato de texto leve, baseado em pares chave/valor, usado para trocar dados entre sistemas.

```json
{ "id": 10, "nome": "Maria Silva", "ativo": true }
```

Em PHP, `json_encode()` converte um array em JSON e `json_decode()` faz o contrário.

## API x sistema web tradicional

O sistema web tradicional devolve páginas HTML para uma pessoa ver no navegador. A API devolve apenas dados (JSON) para outro sistema usar, sem se preocupar com o visual.

## Como o PHP consome uma API

Usa-se cURL, `file_get_contents()` ou Guzzle para fazer a requisição, verificar o status da resposta e converter o JSON com `json_decode()`.

```php
<?php
$ch = curl_init('https://viacep.com.br/ws/89201000/json/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$resposta = curl_exec($ch);
curl_close($ch);

$endereco = json_decode($resposta, true);
echo $endereco['logradouro'];
```

## Como uma API disponibiliza informações

O sistema cria endpoints que recebem a requisição, buscam os dados e devolvem JSON. Em PHP, basta definir o cabeçalho e usar `json_encode()`.

```php
<?php
header('Content-Type: application/json');
echo json_encode([['id' => 1, 'nome' => 'Maria']]);
```

## Autenticação, autorização e segurança

- **Autenticação:** confirma quem está acessando (login, token, chave de API).
- **Autorização:** define o que cada usuário pode fazer.
- **Segurança:** usar HTTPS, validar os dados recebidos, proteger tokens e senhas (fora do código) e limitar o número de requisições.

## Exemplos em sistemas empresariais

- Loja virtual integrada a um serviço de pagamento.
- ERP emitindo nota fiscal eletrônica por API.
- Cálculo de frete e rastreamento com transportadoras.
- Preenchimento automático de endereço pelo CEP.
- Site e aplicativo usando o mesmo sistema da empresa.
