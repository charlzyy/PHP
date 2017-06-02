<?php
//--------------------------------------
// Cas pratique : un espace de dialogue
//--------------------------------------

/*  objectif : créer un espace de dialogue de type avis ou livre d'or.

Base de données : dialogue
table           : commentaire
champs          : id_commentaire        INT(3) PK AI
                  pseudo                VARCHAR(20)
                  message               TEXT
                  date_enregistrement   DATETIME

                                                          */
$pdo = new PDO('mysql:host=localhost;dbname=dialogue', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

//Si le formulaire est posté :
if(!empty($_POST)){
  // 3- traitement contre les failles xss et les injections css : echapper les données.
  // exemple de faille css : <style>body{display:none}</style>
  // exemple de faire xss : <script>while(true){alert('vous etes bloqué');}</script>

// Pour s'en premunir :
$_POST['pseudo'] = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
$_POST['message'] = htmlspecialchars($_POST['message'],ENT_QUOTES); // convertit les caracteres speciaux (<,>,"",&,'')en entités html injectées dans le formulaire.on parle d'échappement des données.

// complements :
$_POST['message'] = strip_tags($_POST['message']); // Supprime toutes les balises HTML contenus dans $_POST['message']

// htmlentites() permet aussi de convertir en entité html les caracteres speciaux lorsqu'on fait un echo direct de données issues de l'internaute.


  // 1- Nous allons faire dans un premier temps une requete qui n'est pas protégée contre les injections et qui n'accepte pas les apostrophes :

  //$r = $pdo->query("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES('$_POST[pseudo]', NOW(), '$_POST[message]')");

  // 2-Nous avons fait l'injection SQL suivante dans le champ message :  ok'); DELETE FROM commentaire; (
  // elle a pour conséquence l'effacement de la table commentaire. On va pour se premunir de ce type d'injection, faire une requete préparée :

  $stmt = $pdo->prepare("INSERT INTO commentaire(pseudo, message, date_enregistrement) VALUES(:pseudo, :message, NOW())");

  $stmt->bindParam(':pseudo', $_POST['pseudo'], PDO::PARAM_STR);
  $stmt->bindParam(':message', $_POST['message'], PDO::PARAM_STR);

$stmt->execute();
//L'injection SQL ne fonctionne plus car on a mis des marqueur dans la requete plus des bindParam qui assainnissent les données en neutralisant les morceaux de code passer dans le champs message.



}



?>
<form method="post" action="">
  <h2>Formulaire</h2>

  <label for="pseudo">Pseudo</label>
  <input type="text" name="pseudo" id="pseudo"><br>

  <label for="message">Message</label>
  <textarea name="message" id="message"></textarea>

  <input type="submit" name="envoi" value="envoyer">


</form>

<?php
// affichage des messages postés :
$resultat = $pdo->query("SELECT pseudo, message, date_enregistrement FROM commentaire ORDER BY date_enregistrement DESC");

echo 'nombre de commentaires : ' . $resultat->rowCount();

while($commentaire = $resultat->fetch(PDO::FETCH_ASSOC)){
  echo '<div>';
    echo '<div> Pseudo :' . $commentaire['pseudo'] . ', le ' .$commentaire['date_enregistrement'] . '</div>';
    echo '<div>';
    echo '<div> Message :' . $commentaire['message'] . ', le ' . $commentaire['date_enregistrement'] . '</div>';
    echo '<div><hr>';
}
