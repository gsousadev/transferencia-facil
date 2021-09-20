<div style="display:flex; align-content: center; color: #6495ED;">
<h1 style="text-align: center;display: inline-block; background: #fff;  padding: 20px;">
Transferência Fácil
</h1>
</div>

### **Clonando repositorio**

Rodar o comando GIT CLONE para copiar repositório do projeto do github

    git clone git@github.com:gsousadev/transferencia-facil.git

<br/>

### **Criação e inicialização das imagens e containers docker**

Depois do clone, inicie o docker na sua maquina, entre na pasta do projeto e execute os comandos do docker-compose para iniciar o projeto. 

OBS: O parametro "--build" deve ser usado apenas na primeira vez.

    cd transferencia-facil
    
    docker-compose up -d --build

<br/>

### **Inicialização do Projeto**

Primeiro passo é instalar as dependencias do projeto dentro do container

    docker exec app composer install
    
Logo depois é necessário criar um arquivo .ENV a partir do env.exemple contido no projeto

    docker exec app cp .env.example .env

Depois é necessário rodar as migrations do projeto para criar as tabelas do banco e tambem popular as mesmas

    docker exec app php artisan migrate

Por fim é necessário rodar a seeder principal do projeto para popular o banco com os primeiros usuários e logistas

    docker exec app php artisan db:seed

<div style="text-align: center"> 
Agora é só acessar a página inicial da aplicação na porta definida para o container


<h3><a href="http://localhost:5000"> http://localhost:5000 </a></h3>

</div>

---

### **Utilitários**

Para rodar os testes da aplicação rodar o comando abaixo

    docker exec app php artisan test

Para re-popular o banco rodar os comandos abaixo
    
    docker exec app php artisan migrate:fresh

    docker exec app php artisan db:seed



