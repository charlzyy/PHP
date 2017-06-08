<?php
//-----------------------TRAITEMENT----------------------------------
require_once('inc/init.inc.php');
$inscription = false; // Pour ne pas afficher le formulaire une fois le membre inscrit.

debug($_POST);

// Traitement du formulaire :
if(!empty($_POST)){
  //Controles:
  if(strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20){
    $contenu .= '<div class="bg-danger">Le Pseudo doit contenir entre 4 et 20 caracteres.</div>';
  }
  if(strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20){
    $contenu .= '<div class="bg-danger">Le mot de passe doit contenir entre 4 et 20 caracteres.</div>';
  }
  if(strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20){
    $contenu .= '<div class="bg-danger">Le nom doit contenir entre 2 et 20 caracteres.</div>';
  }
  if(strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20){
    $contenu .= '<div class="bg-danger">Le nom doit contenir entre 2 et 20 caracteres.</div>';
  }
  if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    $contenu .= '<div class="bg-danger">L\'email n\'est pas valide.</div>';
  }// filter_var permet de valider un format d'email avec l'option FILTER_VALIDATE_EMAIL. On peut aussi valider les URL avec FILTER_VALIDATE_URL.
  if(!isset($_POST['civilite']) || ($_POST['civilite'] !='m' && ($_POST['civilite'] !='f'))){
  $contenu .= '<div class="bg-danger">Erreur dans le champ civilité</div>';
  }
  if(strlen($_POST['ville']) < 1 || strlen($_POST['ville']) > 20){
    $contenu .= '<div class="bg-danger">La ville doit contenir entre 1 et 20 caracteres.</div>';
  }
  if(!preg_match('#^[0-9]{5}$#',
 $_POST['code_postal'])){
   $contenu .= '<div class="bg-danger">Le code postal  n\'est pas valide</div>';
 }


/* La fonction preg_match verifie que la chaine de caracteres contenu dans le code postal correspond a l'expression reguliere.En cas de succes, elle renvoie 1, sinon elle renvoie 0.

L'expression reguliere utilisée :
-elle est encadrée par des #(délimiteurs)
-le ^ signifie "commence par ce qui suit"
- le $ signifie "se termine par ce qui precede"
-entre crochets on definit l'interval de lettres ou de chiffres autorisés
-entre accolades on quantifie le nombres de chiffres souhaités , ici 5 obligatoirement(quantificateur)
*/

if(strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 50){
  $contenu .= '<div class="bg-danger">L\'adresse doit contenir entre 4 et 50 caracteres </div!>';
}
// Si il n'y a pas d'erreurs sur le formulaire, on verifie que le pseudo est unique :
if(empty($contenu)){
  //Si $contenu est vide, il n'y a pas d'erreurs
  $membre = executeRequete('SELECT * FROM membre WHERE pseudo = :pseudo', array(':pseudo' => $_POST['pseudo']));

   if ($membre->rowCount() > 0){
     //Si la requete renvoie des lignes c'est que le pseudo existe !
     $contenu .= '<div class="bg-danger">Pseudo indisponible, veuillez en choisir un autre !</div>';
   }else {
     // Si la requete ne contient pas de ligne , le pseudo est disponible : on l'insere en BDD :

     $_POST['mdp'] = md5($_POST['mdp']); // on encrypte le mot de passe avec la fonction prédéfinie md5.

     executeRequete('INSERT INTO membre(pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, 0)',
      array(':pseudo' => $_POST['pseudo'],
            ':mdp' => $_POST['mdp'],
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':email' => $_POST['email'],
            ':civilite' => $_POST['civilite'],
            ':ville' => $_POST['ville'],
            ':code_postal' => $_POST['code_postal'],
            ':adresse' => $_POST['adresse']));

            $contenu .= '<div class="bg-success">Vous etes inscrit sur notre site.<a href="connexion.php">Cliquez ici pour vous connecter</a></div>';
            $inscription = true; // Pour ne plus afficher le formulaire.


   }

}

}






//----------------------AFFICHAGE-------------------------------------
require_once('inc/haut.inc.php');
echo $contenu; // Pour afficher les messages
if(!$inscription) :
  // Si membre non inscrit , on affiche le formulaire :
  ?>
<form method="post" action="">

  <label for="pseudo">Pseudo</label><br>
  <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($_POST['pseudo'])) echo $_POST['pseudo'];  ?>"><br><br>

  <label for="mdp">Mot De Passe</label><br>
  <input type="password" name="mdp" id="mdp" value="<?php if(isset($_POST['mdp'])) echo $_POST['mdp'];  ?>"><br><br>

  <label for="nom">Nom</label><br>
  <input type="text" name="nom" id="nom" value="<?php if(isset($_POST['nom'])) echo $_POST['nom'];  ?>"><br><br>

  <label for="prenom">Prenom</label><br>
  <input type="text" name="prenom" id="prenom" value="<?php if(isset($_POST['prenom'])) echo $_POST['prenom'];  ?>"><br><br>

  <label for="email">Email</label><br>
  <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];  ?>"><br><br>

  <label>Civilité</label><br>
  <input type="radio" name="civilite" id="homme" value="m" checked><label for="homme">Homme</label>

  <input type="radio" name="civilite" id="femme" value="f" <?php if(isset($_POST['civilite']) && $_POST['civilite'] == 'f') echo 'checked'; ?> ><label for="femme">Femme</label> <br><br>

  <label for="ville">Ville</label><br>
  <input type="text" name="ville" id="ville" value="<?php if(isset($_POST['ville'])) echo $_POST['ville'];  ?>" ><br><br>

  <label for="code_postal">Code postal</label><br>
  <input type="text" name="code_postal" id="code_postal" value="<?php if(isset($_POST['code_postal'])) echo $_POST['code_postal'];  ?>"><br><br>

  <label for="adresse">Adresse</label><br>
  <input type="text" name="adresse" id="adresse" value="<?php if(isset($_POST['adresse'])) echo $_POST['adresse'];  ?>"><br><br>

  <input type="submit" name="inscription" value="S'inscrire" class="btn" ><br><br>
</form>
<?php
endif;
require_once('inc/bas.inc.php');
 ?>
