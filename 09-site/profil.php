<?php
require_once 'inc/init.inc.php';

//-----------------------------TRAITEMENT---------------------------
// Redirection si visiteur non connecté :
if(!internauteEstConnecte()){
  header('location:connexion.php');
  exit();
}

// Prépare le profil a afficher :
debug($_SESSION);
$contenu .= '<h1>Bonjour ' . $_SESSION['membre']['pseudo'] . '! </h1>';
$contenu .= '<p>Votre email: ' . $_SESSION['membre']['email'] . '</p>';
$contenu .= '<p>Votre adresse: ' . $_SESSION['membre']['adresse'] . '</p>';
$contenu .= '<p>Votre Code Postal: '. $_SESSION['membre']['code_postal'] . '</p>';
$contenu .= '<p>Votre ville: '. $_SESSION['membre']['ville'] . '</p>';










//------------------------------AFFICHAGE---------------------------
require_once 'inc/haut.inc.php';
echo $contenu;
require_once 'inc/bas.inc.php';
 ?>
