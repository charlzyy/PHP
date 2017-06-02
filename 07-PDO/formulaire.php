<?php
//---------
//exercice :
/*
créer un formulaire qui permet d'enregistrer un nouvel employé dans la base de données "entreprise", en ecrivant le code suivant :

1-creation du formulaire HTML
2-connexion a la BDD
3-Lorsque le formulaire est posté , insertion des données du formulaire dans la base avec une requete preparée
4-afficher un message "l'employé a bien été ajouté".
*/
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
print_r($_POST); // permet de voir si le formulaire recois les informations

$message = ''; // variable pour afficher les messages.

if(!empty($_POST)){

//------------- condition en + pour le formulaire
if(strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 20) $message .='le prénom doit comporter entre 3 et 20 caracteres <br>';

if(strlen($_POST['nom']) < 3 || strlen($_POST['nom']) > 20) $message .='le nom doit comporter entre 3 et 20 caracteres <br>';

if(strlen($_POST['service']) < 3 || strlen($_POST['service']) > 20) $message .='le service doit comporter entre 3 et 20 caracteres <br>';

if(($_POST['sexe']) != 'm' && $_POST['sexe'] != 'f') $message .= 'le sexe n\'a pas été coché <br>';

if(!is_numeric($_POST['salaire']) || $_POST['salaire'] <= 0) $message .= 'le salaire doit etre un nombre superieur a 0 <br>'; //isnumeric verifie si c'est un nombre decimal ou pas.

// Controle de la date :
function validateDate($date, $format = 'Y-m-d'){
  $d = DateTime::createFromFormat($format, $date);// ici on crée un objet date au format indiqué dans $format, ou bien retourner false si la date fournie ne respecte pas le format fourni.

    if($d && $d->format($format) == $date){ // la date est correct si $d vaut true (sinon c'est que $date ne respecte pas le format fourni) Et que l'objet $d formaté est identique a la date fournie (sinon c'est que on a donné par exemple 1975-02-30 au lieu de 1975-03-02)
      return true;
    }else {
      return false;
    }

}

if(!validateDate($_POST['date_embauche'])) $message .= 'Date Incorrect';


//---------------------------------------------------
echo 'nom : ' . $_POST['nom'] . '<br>';
echo 'prenom : ' . $_POST['prenom'] . '<br>';
  echo '<br>  <strong style = "color:green"> L\'employé ' .  $_POST['nom'] .  $_POST['prenom'] . ' a bien été ajouté !</strong>';
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $sexe = $_POST['sexe'];
  $service = $_POST['service'];
  $date_embauche = $_POST['date_embauche'];
  $salaire = $_POST['salaire'];


if(empty($message)){ // si message est vite c'est qu'il n'y a pas d'erreur.
  $resultat = $pdo->prepare("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES(:prenom,:nom, :sexe, :service, :date_embauche, :salaire)"); // Les marqueurs s'ecrivent avec : collés au nom du marqueur et sans les quotes

  $resultat->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
  $resultat->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
  $resultat->bindValue(':sexe', $_POST['sexe'], PDO::PARAM_STR);
  $resultat->bindValue(':service', $_POST['service'], PDO::PARAM_STR);
  $resultat->bindValue(':date_embauche', $_POST['date_embauche'], PDO::PARAM_STR);
  $resultat->bindValue(':service', $_POST['service'], PDO::PARAM_STR);
  $resultat->bindValue(':salaire', $_POST['salaire'],PDO::PARAM_STR);

    $resultat->execute();



  if (empty($_POST['prenom'] )){
    echo '<br>  <strong style = "color:red">veuillez renseigner tout les champs !!!</strong>';
    }
}

}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mon formulaire</title>
  </head>
  <body>
    <h1>Formulaire exo</h1>
    <?php echo $message ?>
    <form method="post" action="" >
      <label for="nom">nom</label>
      <input type="text" name="nom" id="nom">
      <br>
      <label for="prenom">prenom</label>
      <input type="text" name="prenom" id="prenom">
      <br>

        <label for="choix">sexe : </label>
        <INPUT type="radio" name="sexe" value="m" checked> homme
          <INPUT type="radio" name="sexe" value="f"> femme

      <br>
      <label for="date_embauche">date_embauche(AAAA-MM-JJ)</label>
      <input type="text" name="date_embauche" id="date_embauche">
      <br>

      <br>
      <label for="service">service</label>
      <input type="text" name="service" id="service">
      <br>
      <label for="salaire">salaire</label>
      <input type="text" name="salaire" id="salaire">
      <br>
      <input type="submit" name="validation" value="envoyer">
    </form>
  </body>
</html>
