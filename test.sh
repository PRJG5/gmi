#!/bin/bash

echo -e "\e[91mNETTOYAGE DU DOSSIER + INSTALLATION FICHIER MANQUANT\e[0m"
git remote rm heroku #Au cas ou un ancien projet heroku trainer sur le repertoire et que on reforce l'installation d'un new heroku project
composer install #au cas ou le vendor est manquant et il est necessaire pour la commande php artisan

FILE=.env
if [ -f "$FILE" ]; then
    echo -e "\e[92m$FILE exist\e[0m"
else 
    echo -e "\e[92m$FILE does not exist lets go creat\e[0m"
    cp .env.example .env
fi

echo -e "\e[92mCREATION DE L'APP HEROKU\e[0m"
heroku create # création de l'app sur heroku
echo -e "\e[94mPUSH DU CODE LOCAL VERS LE MASTER HEROKU\e[0m"
git push heroku master # push du code local
#heroku ps:scale web=1 # dimensionnement à un dyno
echo -e "\e[94mGENERATION DU PROCFILE\e[0m"
echo 'web: vendor/bin/heroku-php-apache2 public/' > Procfile # création du fichier Procfile et définition du dossier public pour le serveur web
echo -e "\e[94mAJOUT DE LA DB A HEROKU\e[0m"
heroku addons:create cleardb:ignite # ajout d'une bdd postgresql
#heroku config # on choppe l'url de la bdd
# et on définit les identifiants
echo -e "\e[94mCONFIGURATION DES VARIABLE D'ENVIRONNEMENT\e[0m"
heroku config:set APP_DEBUG=true 
#heroku config:set APP_KEY=`php artisan key:generate --show` # clé de chiffrement pour l'appli
php artisan key:generate
heroku config:set APP_KEY=`cat .env | grep APP_KEY | head -1  | cut -c 9-`
#heroku config:set DATABASE_URL=`heroku config | grep CLEARDB | cut -c 23-` #on recupere que la string necessaire qui contient l'url de la DB uniquement is on utilise une DB inclus dans HEROKU
echo -e "\e[94mDEMARRAGE DU DE LA MIGRATION\e[0m"
heroku run php artisan migrate # migration
#heroku run php artisan db:seed # seeding
echo -e "\e[94mOUVERTURE DE L'APPLICATION\e[0m"
heroku open # on ouvre l'appli pour vérifier que tout va bien
echo -e "\e[92mFIN DE LA MIGRATION VERS HEROKU\e[0m"

$SHELL