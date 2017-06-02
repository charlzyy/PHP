<h1>Page detail des articles</h1>

<?php
//-------------------------------
// La superglobale $_GET
//-------------------------------
// $_GET represente l'URL : il s'agit d'une superglobale et comme toutes les superglobales , il s'agit d'un array.

// Superglobale signifie que cette variable est disponible dans tous les contextes du script, y compris dans les fonctions, et qu'il n'est pas necessaire de faire global $_GET.

//Les informations transitent dans l'URL de la maniere suivante :  ?indice=valeur&indice2=valeur2

// La Superglobale $_GET transforme ces informations passées dans l'URL en cet array : $_GET = array('indice' => 'valeur', 'indice2' => 'valeur2').

echo '<pre>'; var_dump($_GET); echo'</pre>';

// on met une condition qui verifie qu'on a bien les infos dans l'URL :
if(isset($_GET['article']) && isset($_GET['couleur']) && isset($_GET['prix'])){
  // si existe les indices 'articles', 'couleur' et 'prix' :
  echo '<p>article : ' . $_GET['article'] . '</p>';
  echo '<p>couleur: ' . $_GET['couleur'] . '</p>';
  echo '<p>prix : ' . $_GET['prix'] . '</p>';
}else {
  echo '<p> Ce produit n\existe pas </p>';
}
