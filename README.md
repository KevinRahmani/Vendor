--------------------------------------------------------------------------------------------------------------------------------
--------------------------------------------------------FICHIER README----------------------------------------------------------
--------------------------------------------------------------------------------------------------------------------------------

L'ensemble du site est compris dans le dossier Vendor. Ce dernier contient tous les fichiers nécessaires à son utilisation, 
veuillez ne pas en modifier/supprimer. 

Le site Vendor a besoin d'une base de données Mysql pour fonctionner, 
vous devez donc vous rendre sur phpmyadmin et créer 3 nouvelles bases de données. 

Chacune d'entre elles devra porter le même nom que nos fichiers sql présents dans le dossier data du site (on aura donc colis, stock_vendor, user_vendor). 

De plus, les données devront être importées depuis les fichiers sql. Par exemple : une fois la base de données colis créée, cliquer dessus, se rendre dans Importer, Parcourir et sélectionner le fichier sql colis.sql (ce fichier est placé dans le dossier data).
Veuillez faire de même pour user_vendor et stock_vendor.sql.

--------IMPORTANT--------

Veuillez avoir une connexion internet stable.

Le nom d'utilisateur pour vous connecter à votre PhpMyAdmin doit etre root 
et le mot de passe doit etre laissé à vide c'est à dire qu'il n'y a pas de mot de passe 

Si vous n'avez pas la possibilité de changer vos coordonnées, veuillez vous rendre dans les fichiers connexion_colis.php connexion_stock.php et connexion_user.php 
A la place de root veuillez rentrer votre identifiant et à la place des guillemets vide, votre mot de passe.

Si cela ne fonctionne pas, envoyez un mail à rahmani.kevin9@gmail.com.
Une solution sous bref délai vous sera envoyée.


---------Info utile--------

Pour se connecter à un compte de livreur, un compte de vendeur ou un compte client déjà créé, rechercher dans la base de données user_vendor les identifiants nécessaires. Dans la page de connexion, on peut directement entrer les identifiants de la bdd pour se connecter. 

Par exemple, identifiants pour l'administrateur (ne pas mettre des espaces) :
log : Vendor
Mot de passe : 1234

Pour tous les autres login, consulter user_vendor.sql, vous aurez tous les mots de passe. 

Le site envoie de réels emails vers les destinataires, ne pas négligez la demande de mail lors du processus d'inscription.
Ne pas surcharger de mail les utilisateurs, une limite existe concernant l'envoi de mail par notre compte gmail. 

Ce site a été conçu en utilisant Mozilla Firefox comme navigateur. 

Ce site web a été créée sur Windows et sur la distribution WampServer 3.3.0 (PhpMyAdmin 5.2.0), mais a été testé sur d'autres distributions Wamp.

Pour une meilleure utilisation du site, n'hésitez pas à zoomer/dézoomer votre navigateur jusqu'à apercevoir trois produits par ligne dans la page de categorie comme repère, pour profiter d'une meilleure expérience. Si les écritures dépassent des encadrés, on peut faire de même.
