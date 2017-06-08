<?php
function debug($var){
  echo '<div style="background:orange; padding: 5px;">';
    echo '<pre>'; print_r($var); echo'<pre>';
  echo '</div>';
}

//---------------Fonctions membre--------------------
function internauteEstConnecte(){
  if(isset($_SESSION['membre'])){
    //Si existe membre dans $_SESSION , c'est que le membre est passé par le formulaire de connexion avec les bon pseudo , mdp.
    return true;
  }else{
    return false;
  }

  // return(isset($_SESSION['membre'])); on peut mettre seulement ca dans la function pour ameliorer le code.
}

function internauteEstConnecteEtEstAdmin(){
  if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1){
  // Si l'internaute est connecté et que son statut vaut 1, alors il est admin :
    return true;
  }else{
    return false;
  }
  // return (internauteEstConnecte() && $_SESSION['membre']['statut'] == 1);
}

//-------------------------------
function executeRequete($req, $param = array()){
  if(!empty($param)){
    //si j'ai recu des valeurs associées aux marqueurs, je fais un htmlspecialchars dessus pour les échapper :
    foreach($param as $indice => $valeur){
      $param[$indice] = htmlspecialchars($valeur, ENT_QUOTES); // evite les injections XSS et CSS en neutralisant les caracteres > < " " ' ' et & .

    }

  }

  global $pdo; // permet d'avoir acces a la variable definie dans l'espace global dans (init.inc.php)
$r = $pdo->prepare($req); // on prepare la requete recue en argument

$succes = $r->execute($param); // on execute la requete en lui passant les parametres contenus dans $param.

if(!$succes){
  //Si la requete n'a pas fonctionné, execute renvoie false:
  die('erreur sur la requete SQL'); // arrete le script et affiche le message
}
    return $r;  // on retourne un objet issus de la classe PDOStatement.
}
