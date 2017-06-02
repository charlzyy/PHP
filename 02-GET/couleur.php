<h1>fruits Market</h1>
<?php

//------------------------------
// exercice :
/*
Dans listefruits.php : créer 3 liens banane,kiwi et cerise

passer le fruit dans l'URL en GET a la page couleur.PHP

dans couleur.php : recuperer le fruit dans l'URL et afficher sa couleur avec une phrase du type " la couleur des bananes est jaune".

penser a se prémunir des tentatives d'acces direct a la page couleur.php par une condition.
*/
echo '<pre>'; var_dump($_GET); echo'</pre>';
if(isset($_GET['article'])){
 // si l'indice article existe, c'est qu'il est dans l'url :
if($_GET['article'] == 'banane'){
  // si existe les indices 'articles', 'couleur' et 'prix' :
  echo '<p>couleur:jaune</p>';
}else if ($_GET['article'] == 'kiwi'){
  echo '<p>couleur:vert</p>';
}else {
  echo '<p>couleur:rouge</p>';
}

}else {
  echo '<p> Ce produit n\existe pas </p>';
}
