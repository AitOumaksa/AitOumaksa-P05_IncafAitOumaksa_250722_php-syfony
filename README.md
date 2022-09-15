# P05_Blog_PHP
Projet 5 de la formation de développeur Php/Symfony chez OpenClassRooms Création d'un site de blog.


## Développement du Projet :
Backend : Php (orientée objet) ;

Base de données : MySQL ;

Frontend : Html, Css, bootstrap5 , twig , JavaScript ;

## Clonner le projet 

1- Dans le terminal lancer la command : git clone https://github.com/AitOumaksa/P05_IncafAitOumaksa_250722_php-syfony.git ;


2- Lancer dans le terminal la command : cd P05_IncafAitOumaksa_250722_php-syfony ;


3- Lancer dans le terminal: composer install ; 



## Remarque
1- Mettre à jour config/ConfigDB.php ;


Pour que vous puissiez vous connecter à votre base de données, veuillez modifier le fichier avec vos identifiants, hôte et nom de base de données Ces informations sont trouvables chez votre hébergeur.

host = '';  //Votre host


db_Name = '';  //Le nom de votre base de données 


db_User = '';  //Nom d'utilisateur de votre base de données 


db_Pass = '';  // Mot de passe de votre base de données ;


db_Port = ''; // numéro de port de votre base de données ; 



2- Mettre à jour Controller/SetupStmp/SmtpSend.php


Pour que vous puissiez pleinement profiter de l'envoi d'email, veuillez ajouter dans les '' vos identifiants, ports et protocole smtp Ces informations sont trouvables chez votre hébergeur.

mail->Host = '';  // Specifier SMTP servers 


mail->Username = '';    // SMTP Nom d'utilisateur 


mail->Password = ''; // SMTP Mot de passe 


mail->Port =     // TCP port pour se connecter 


mail->addAddress('');  // Ajouter un email de réception 



## Importer la base de données 
Importer  le fichier blog_php.sql situé dans le dossier DbImport dans la base de donnée.


