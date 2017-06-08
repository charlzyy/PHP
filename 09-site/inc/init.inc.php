<?php
//Le fichier init.inc.php sera inclus dans tous les scripts (hors les fichiers .inc eux-memes) pour initialiser les éléments suivants :
/* -connexion a la BDD
   -Création ou ouverture de session
   -définir le chemin du site
   -et inclure le fichierfonction.inc.php
*/

$pdo = new PDO('mysql:host=localhost;dbname=site', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// session :
session_start(); // crée ou ouvre un session sur le serveur.

// definition du chemin du site :
define('RACINE_SITE', '/PHP/09-site/'); // indique le dossier dans lequel ce trouve les sources du site sans localhost.

// Variables d'affichage de contenus :
$contenu = '';
$contenu_gauche = '';
$contenu_droite = '';

//inclusion des fonctions :
require_once('fonction.inc.php');// on inclus ce fichier ici , ainsi il sera automatiquement inclus dans tous les scripts du site.
 ?>
