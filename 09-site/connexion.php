<?php
require_once 'inc/init.inc.php';

//--------------------------TRAITEMENT------------------------------
//Deconnexion de l'internaute a sa demande:
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){
  session_destroy(); // Rappel : cette instruction est exécutée a la fin du script.
}

//l'internaute est deja connecté :
if(internauteEstConnecte()){
  //On le renvoie vers la page de profil :
  header('location:profil.php'); //On envoie une redirection vers la page profil
  exit(); // On quitte le script et supprime le fichier temporaire.
}

// Traitement du formulaire :
if($_POST){
  //Si le formulaire est posté(soumis) :
  // Controle du formulaire :
  if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20) $contenu .= '<div class"bg-danger">Le pseudo est requis</div>';
  if(strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20) $contenu .= '<div class"bg-danger">Le Mot De Passe est requis</div>';

  if(empty($_contenu)){
    // si $contenu est vide c'est qu'il n'y a pas d'erreur :
    $mdp = md5($_POST['mdp']); // On crypte le mdp pour le comparé a celui de la BDD.

    $resultat = executeRequete("SELECT * FROM membre WHERE mdp = :mdp AND pseudo = :pseudo", array(':mdp' => $mdp, ':pseudo' => $_POST['pseudo']));

    if($resultat->rowCount() != 0){
      //Si il y a une ligne dans le resultat de la requete, alors le membre est bien inscrit avec les bons login et mdp
      $membre = $resultat->fetch(PDO::FETCH_ASSOC); // Pas de while car il n'y a qu'un seul membre possédant les login/mdp correctes.

      //debug($membre);

      $_SESSION['membre'] = $membre; // Nous créons une session "membre" avec les éléments provennant de la BDD

      //debug($_SESSION);
      header('location:profil.php'); // le membre etant connecté, on l'envoie vers son profil
      exit();

    }else{
      $contenu .= '<div class="bg-danger">Erreur sur les identifiants</div>';
    }
  }
}




//--------------------------AFFICHAGE--------------------------------
require_once 'inc/haut.inc.php';
echo $contenu;
?>

    <h3>Veuillez renseigner vos identifiants pour vous connecter</h3>
    <form class="" action="" method="post">
      <label for="pseudo">Pseudo</label><br>
      <input type="text" name="pseudo" id="pseudo"><br><br>

      <label for="mdp">Mot De Passe</label><br>
      <input type="password" name="mdp" id="mdp"><br><br>

      <input type="submit" value="se connecter" class="btn">
    </form>

<?php
require_once 'inc/bas.inc.php';
