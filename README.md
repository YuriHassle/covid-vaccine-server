# Covid-vaccine-server

Projeto para back-end do sistema para gerenciamento de registros de imunizaçao contra a COVID-19. Link para o sistema http://imunizamanaus-hom.manaus.am.gov.br.

## Sobre o Sistema

O sistema nomeado covid-vaccine-server tem como objetivo auxiliar o cadastro de [...]. É disponibilizado um formulário onde [...].

O sistema contempla [...].

## Implementação

Para a implementação foi utilizado o framework Laravel (https://laravel.com/).
As demais dependências encontram-se no arquivo de configuração package.json.

## Pré-Requisitos para deployment

 1. Crie um arquivo chamado .env, para colocar suas variáveis de ambiente. Há um arquivo de exemplo, nomeado .env.example, o qual você pode se guiar;

 2. A instância dos containers que dão suporte ao serviço requer a criação de uma rede, para que possa se comunicar com containers de outros serviços. 
    
    2.1 Para criar a rede, execute:

        docker network create docker-semsa

     Caso a rede já esteja criada, isso não afetará seus containers.

3. Talvez seja necessário dar permissão para a pasta de logs, localizada no diretório /storage:

        sudo chmod 777 -R storage

## Deployment

### Utilização sem o docker

1. Após efetuar o clone deste repositório, no diretório raiz execute:

        composer install


### Utilização com o docker

1. Após efetuar o clone deste repositório, no diretório raiz execute:
        
        composer install

2.  Ainda no diretório raiz, execute:

        docker-compose up -d

3. Para utilizar o composer (gerenciador de dependências do php) - 'docker-compose exec php composer [comando]'. Ex:
    
        docker-compose exec covid_vaccine_server_php composer install




## Deploy automatizado

Exemplo

```shell
echo "<?php
return [
    'APP_NAME' => 'Bearer'
    'APP_ENV'   => '',
    'APP_KEY'   => '',
    'APP_DEBUG' => '',
    'APP_URL'   => '',
    'LOG_CHANNEL'   => '',
    'LOG_LEVEL'   => '',
    'DB_CONNECTION'   => '',
    'DB_HOST'   => '',
    'DB_DATABASE'   => '',
    'DB_USERNAME'   => '',
    'DB_PASSWORD'   => '',
];" > .env
composer install
export PROJECT_NAME="inscricaonfsa"
mkdir -p /var/www/html/$PROJECT_NAME/
rm -Rf /var/www/html/$PROJECT_NAME/*
cp * -Rf /var/www/html/$PROJECT_NAME/
cp .env /var/www/html/$PROJECT_NAME/
```