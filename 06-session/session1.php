<?php
//-----------------------
// SESSION
//-----------------------

/* Principe : un fichier temporaire appelé session est créé sur le serveur, avec un identifiant unique. Cette session est liée à un internaute car, dans le meme temps, un cookie est déposé dans le navigateur de l'internaute avec l'identifiant.
Ce cookie devient inactif lorsqu'on quitte le navigateur : la session s'interrompt alors.
Le fichier de session peut contenir toute sorte d'informations, y compris sensibles, car il n'est pas accessible par l'internaute. On y stocke donc par exemple des logins de connexion, des paniers d'achat, etc...

Si l'internaute modifie le cookie relatif à une session, le lien avec celle-ci est rompue et l'internaute est déconnecté.

On récupère les données  de la session dans la superglobale $_SESSION.
*/

// Création ou ouverture d'une session :
session_start(); // permet de créer un fichier de session sur le serveur  OU de l'ouvrir s'il existe déjà

// Remplissage de la session :
$_SESSION['pseudo'] = 'tintin';
$_SESSION['mdp'] = 'milou'; // $_SESSION étant un array, il se remplie comme tous les tableaux en mettant un indice entre crochets et en lui affectant  une valeur

echo '1- La session après remplissage : ';
echo '<pre>'; print_r($_SESSION);echo '</pre>';// affiche les informations contenues dans la session. le fichier se trouve sur xampp/tmp

//vider une partie de la session :
unset($_SESSION['mdp']); // nous pouvons vider une partie de la session avec unset

echo '2- La session apres supression : ';
echo '<pre>'; print_r($_SESSION);echo '</pre>';

//Supprimer entierement la session :
//----------session_destroy(); // supprime toute la session.
echo '3- la session apres session_destroy : ';
echo '<pre>'; print_r($_SESSION);echo '</pre>'; // on voit encore la session a cet endroit car la session_destroy() a la particularité detre executé aa la fin du script , c-a-d apres le print_r.
