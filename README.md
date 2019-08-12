## Bem-vindo à loja virtual do melhor time de Rugby do mundo!

Esse projeto visa simular um sistema de CRUD de clientes em uma loja virtual da AllBlacks, sendo possível ao administrador do sistema gerar uma planilha Excel com todos os dados. É possível também fazer upload de planilhas Excel e arquivos XML que já possuem dados de clientes a fim de popular a base de dados.


## Como rodar o projeto

### Prepare o ambiente de desenvolvimento
* É necessário ter instalado na sua máquina uma ambiente de desenvolvimento PHP (APACHE + MYSQL + PHP). Existem inúmeras opções na web, como por exemplo o [XAMPP](https://www.apachefriends.org/pt_br/download.html), o [MAMP](https://www.mamp.info/en/downloads/)...

* Uma vez instalado, clone o projeto para o diretório raiz do servidor (htdocs, por exemplo):
   
   `$ git clone https://github.com/lucascouto/allblacks-ecommerce.git`
   
   `$ cd allblacks-ecommerce`

### Instale as dependências com o composer
   
   `$ composer install`

   [Clique aqui](https://getcomposer.org/download/) caso ainda não possua o composer instalado na sua máquina
 
### Importe o Banco de Dados
 * Sugiro baixar o [MySQL Workbench](https://dev.mysql.com/downloads/workbench/) para facilitar o processo de importação do banco
 * Uma vez baixado o MySQL Workbench, abra ele e acesse: 
  * server > data import
  * escolha a opção 'import from self-contained file'
  * selecione o arquivo localizado em '/allblacks-ecommerce/DB/dumps/dumpAllBlacks.sql'
  * 'start import'


### Configure username e password do banco de dados
  Configure corretamente o username e o password do seu banco de dados no arquivo `dbconfig` do projeto
 
 
### Acesse o sistema
 * Para acessar a pagina dos clientes: `http://localhost:8000/allblacks-ecommerce`
    * login: qualquer CPF da base de dados
    * senha: CEP correspondente ao CPF
 
 * Para acessar a pagina do administrador: `http://localhost:8000/allblacks-ecommerce/admin`
    * login: admin
    * senha: admin
  
  * Obs.: a porta de acesso `:8000` pode mudar de acordo com as configurações do seu servidor
