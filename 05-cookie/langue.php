<?php
//------------------------
// COOKIE
//------------------------
/* definition : un cookie est un petit fichier (4ko max) déposé par le serveur du site dans le navigateur de l'internaute et qui peut contenir des informations.Les cookies sont automatiquement renvoyé au serveur web par le navigateur lorsque l'internaute navigue danas les pages concernés par les cookies.

PHP permet de récuperer tres facilement les données contenues dans un cookie ses informations sont récupérees dans la super globale $_COOKIE.

Precaution a prendre avec les cookies : etant sauvegardé que le poste de l'internaute, un cookie peut etre potentiellement détourné ou volé. on n'y stocke donc pas par precautions des données sensibles (mdp , referencement bancaire , panier achat). */

//Applications pratique : nous allons stocker la langue choisis par l'internaute dans un cookie afin de lui afficher le site dans cette langue a chaque visite :

//On determine une variable $langue :
if(isset($_GET['langue'])){
  //Si on a cliqué sur un des liens :
  $langue = $_GET['langue'];
}elseif(isset($_COOKIE['langue'])){
  //si on a recu un cookie appellé "langue":
  $langue = $_COOKIE['langue'];
}else{
  // par default la langue est le francais.
  $langue = 'fr';
}
//création du cookie :
$un_an = 365 * 24 * 3600; //variable qui represente un an exprimé en secondes.
setcookie('langue', $langue, time() + $un_an); // envoie un cookie dans le navigateur de l'internaute : setcookie('nom', 'valeur', 'date d'expiration  en timestamp')Pour rendre un cookie inactif on lui met une date passée ou a 0, car il n'existe pas de fonction pour supprimer un cookie :@

// Affichage de la langue :
echo 'langue : ';
switch ($langue){
  case 'fr': echo 'francais'; break;
  case 'es': echo 'Espagnol'; break;
  case 'en': echo 'Anglais'; break;
  case 'it': echo 'Italien'; break;
  default : echo 'francais';
}
//---------------------html --------------------
 ?>
 <h1>Votre langue : </h1>
 <ul>
   <li><a href="?langue=fr">Francais</a></li>
   <li><a href="?langue=es">Espagnol</a></li>
   <li><a href="?langue=en">Anglais</a></li>
   <li><a href="?langue=it">Italien</a></li>
 </ul>
