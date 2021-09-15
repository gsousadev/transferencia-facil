# Transferência Fácil

### **Clonando repositorio**

Rodar o comando GIT CLONE para copiar repositório do projeto do github

    git clone git@github.com:gsousadev/transferencia-facil.git

<br/>
<br/>

### **Criação e inicialização das imagens e containers docker**

Depois do clone, inicie o docker na sua maquina, entre na pasta do projeto e execute os comandos do docker-compose para iniciar o projeto. 

OBS: O parametro "--build" deve ser usado apenas na primeira vez.

    cd transferencia-facil
    
    docker-compose up -d --build

*Se você estiver usando Windows o link simbolico pode não funcionar corretamente. Então antes de rodar o comando acima pode ser necessário apagar a pasta oculta no windows html que é um link simbolico do container com o comando "rm html"*


### **Inicialização do Projeto**

Primeiro passo é instalar as dependencias do projeto dentro do container

    docker exec app composer install
    
Agora precisamos dar acesso livre para a pasta storage do laravel

    docker exec app chmod -R 777 ./storage/*

Apos a criação do container é necessária a criação de um link da pasta html para a pasta publica do projeto, ou teremos um erro 500 na aplicação, pois o nginx usa a pasta html como padrão

    docker exec app ln -s public html
    
Logo depois é necessário criar um arquivo .ENV a partir do env.exemple contido no projeto

    docker exec app cp env.exemple .env

E por fim é necessário rodar as migrations do projeto para criar as tabelas do banco e tambem popular as mesmas

    docker exec app php artisan migrate



