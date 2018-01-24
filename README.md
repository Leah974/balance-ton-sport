# balance-ton-sport

Télécharger le fichier zip.

Clic-droit sur le dossier et ouvrir avec Git Bash.

Pour récupérer le dossier vendors indispensable :

Ecrire en ligne de commande

composer update

Pour lancer le server : 

php bin/console server:run

OU

php ../composer.phar update
(si votre fichier composer est placé dans le dossier htdocs)

Le dossier vendors est importé.

Pour créer la base de données associée :

Voir le fichier .env et changer la ligne commençant par DATABASE en 

DATABASE_URL=mysql://'root':''@127.0.0.1:3306/balance-ton-sport

1 - Créer la bdd en ligne de commande
php bin/console doctrine:database:create
-> le nom de la bdd sera balance-ton-sport

Vérifier dans phpmyadmin

2 - Commande pour comparer nos données et voir les éléments et tables à créer
php bin/console doctrine:migrations:diff

3 - Valider la migration des données
php bin/console doctrine:migrations:migrate

On vous demande de valider en entrant la lettre "y".

Et voilà la base de données a été créée et elle est prête à l'emploi.

Créez vous un compte utilisateur sur le site.
Vous aurez le rôle de SUPER ADMIN

Puis pensez à changer ce rôle dans le fichier src/Entity/User.php

Modifier à la ligne 76 ROLE_SUPER_ADMIN en ROLE_USER

