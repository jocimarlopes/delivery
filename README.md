# Sistema Delivery
## _Automação de Pedidos via WhatsApp_

Sistema desenvolvido com Ionic + Laravel (Painel Admin) + PHP (APIs)
Ele consiste em automatizar toda a parte de Pedidos, as automações seriam:

- O usuário clica no Link que recebeu via Whatsapp do Cardápio
- Realiza todo o pedido de forma rápida e automatizada
- Recebe informações de valores, como valor da Tele-entrega, valor total do pedido
- O usuário pode avisar se precisa de troco
- Depois de fazer todo o pedido o usuário envia o formulário via WhatsApp para a Empresa Delivery

## o Sistema

- Aplicativo PWA.
- Painel administrativo.
- Banco de Dados MySQL
- APIs

## Requerimentos

- [Node.js](https://nodejs.org/) v10+ para instalar Ionic.
- [Ionic Framework](https://ionicframework.com/docs/) para poder compilar o PWA.
- [Composer](https://getcomposer.org/) para poder configurar o Painel Administrativo.


## Configurando o Aplicativo PWA

Após instalar os requerimentos vamos a configuração:
Depois de clonar esse repositório, você entra dentro da pasta dele e dentro da pasta  'app'.

```sh
~$ cd delivery
~/delivery$ cd app
~/delivery/app$
```

Dentro da pasta 'app' digite esse comando:

```sh
npm i && ionic build --prod
```
Após isso aperte ENTER, a instalação pode demorar um pouco.
Irá criar uma pasta chamada 'public', dentro dela irão ter os arquivos para Deploy.

## Configurando Banco de Dados

Nesta etapa iremos configurar o Banco de Dados do Sistema Delivery

##### Primeira etapa:
Acesse a pasta 'database', dentro dela contém um arquivo atualizado database.sql, ele é o banco de dados inicial.

##### Segunda etapa:
Com o database.sql em mãos, vá até o servidor e crie um banco de dados e importe o modelo para esse banco de dados criado.

##### Terceira etapa:
Pegue os dados necessários para realizar a conexão com o banco de dados, por exemplo:

```sh
host: localhost
user: root
password:
database: sistema_delivery
```

## Configurando a API

Dentro da pasta "apis/api/" temos os arquivos da API:

```sh
$ cd apis/api
apis/api$
```

Dentro da pasta vamos abrir o arquivo config.php e dentro dele vamos por as configurações que pegamos do banco de dados criado no servidor.


## em manutenção...
- #### Readme sendo configurado