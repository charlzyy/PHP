<?php
// création d'une fonction qui retourne le prix d'un certain poids de fruits.

function calcul($fruit, $poids){
  switch($fruit){
    case 'cerise' : $prix_kg = 5.76; break;
    case 'banane' : $prix_kg = 1.09; break;
    case 'pommes' : $prix_kg = 1.61; break;
    case 'peches' : $prix_kg = 3.23; break;
    default       : return 'fruit inexistant';
  }
  $resultat = $poids / 1000 * $prix_kg; // prix pour un poids en grammes
  return "les fruits $fruit coutent $resultat euros pour $poids grammes";
}


 ?>
