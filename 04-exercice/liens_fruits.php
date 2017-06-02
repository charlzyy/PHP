<?php
//-------------------------
/* exercice :
faire 4 liens html avec les fruits , quand on clique sur un lien on affiche le prix du fruit choisis pour 1000g. (lien_fruits.php) */

// exercice : afficher le prix de 2000g de bananes en éxecutant la fonction calcul() du fichier fonction.inc.php
include('fonction.inc.php');

if(isset($_GET['fruit'])){
 // si l'indice article existe, c'est qu'il est dans l'url :
if($_GET['fruit'] == 'cerise'){
  // si existe les indices 'articles', 'couleur' et 'prix' :
  echo calcul('cerise', 1000);
  echo '<p>couleur:jaune</p>';
}else if ($_GET['fruit'] == 'banane'){
  echo calcul('banane', 1000);
  echo '<p>couleur:vert</p>';
}else if ($_GET['fruit'] == 'pommes'){
  echo calcul('pommes', 1000);
  echo '<p>couleur:rouge</p>';
}
else{
  echo calcul('peches', 1000);
  echo '<p> couleur:rose </p>';
}
}

// if(isset($_GET['fruit'])) echo calcul($_GET['fruit'],1000); CORRECTION.

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Fruits Market</title>
  </head>
  <body>

    <h1>Nos Produits</h1>
    <a href="liens_fruits.php?fruit=cerise&couleur=rouge">cerise</a>
    <br>
    <a href="liens_fruits.php?fruit=banane&couleur=banane">banane</a>
    <br>
    <a href="liens_fruits.php?fruit=pommes&couleur=vert">pommes</a>
    <br>
    <a href="liens_fruits.php?fruit=peche&couleur=rose">peche</a>
  </body>
</html>
