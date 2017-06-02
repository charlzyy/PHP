<?php
//-----------------------------------------------------
// PDO
//-----------------------------------------------------
// L'extention PDO, pour PHP Data Objects, définit une interface pour acceder a une base de données depuis PHP.

//----------------------------------
echo '<h3>01.PDO : connexion </h3>';
//----------------------------------

$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// $pdo est un objet issu de la classe prédéfinie PDO : il represente la connexion a la base de données.

// les arguments : 1 driver mysql + serveur + BDD - 2 pseudo - 3 mdp - 4option 1 pour generer l'affichage des erreurs, option 2 definit le jeu de caracteres des échanges avec la bdd.

echo '<pre>'; print_r($pdo); echo'</pre>'; // on voit qu'il sagit d'un objet issus de la classe PDO.
echo'<pre>'; print_r(get_class_methods($pdo)); echo '</pre>';

//----------------------------------------------------------
echo '<h3>02.PDO : exec avec INSERT UPDATE ET DELETE </h3>';
//----------------------------------------------------------
//$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES('test','test', 'm', 'test', '2016-02-08', 500)");

//echo "nombre d'enregistrement affectés par L'INSERT : $resultat <br>";

/* exec() est utilisé pour la formulation de requetes ne retournant pas de jeu de resultats : insert, update et delete.

valeur de retour :
succes : un integer (=le nombre de lignes affectées)
echec : false
*/

//echo "dernier id généré lors de L'INSERT : " . $pdo->lastInsertId();

//-------------
// exemple avec UPDATE :
$resultat = $pdo->exec("UPDATE employes SET salaire = 6000 WHERE id_employes = 350");

echo "nombre d'enregistrement affectés par L'UPDATE :$resultat <br>";

//--------------------------------------------------------
echo '<h3>03.PDO : query avec SELECT + FETCH_ASSOC </h3>';
//--------------------------------------------------------

$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");

/* au contraire d'exec(), query() est utilisé avec les requetes retournant un ou plusieurs resultats : SELECT.

valeur de retour :
succes : on obtient un nouvel objet issus de la classe prédéfinie PDOStatement
echec : false

Notez que query peut etre utilisé avec INSERT, UPDATE ET DELETE .
*/
echo '<pre>'; print_r($result); echo '</pre>'; // affiche les propriétés de l'objet PDOStatement
echo '<pre>'; print_r(get_class_methods($result)); echo '</pre>'; // affiche les méthodes issues de la classe PDOStatement

// $result est le resultat de la requete sous une forme inexploitable directement.Il faut donc le transformer par la methode fetch.
$employe = $result->fetch(PDO::FETCH_ASSOC); // la methode fetch() avec le parametre PDO::FETCH_ASSOC permet de transformer l'objet $result en un array associatif($employe) indexé avec le nom des champs de la requete. (il y a une parenthese apres la methode)
echo '<pre>'; print_r($employe); echo '</pre>';
echo "je suis $employe[prenom] $employe[nom] du service $employe[service] <br>"; // on peut afficher le contenu de l'array avec des []. remarque : ici notre array est dans des guillemets , il perd donc c'est quotes autour des indices. On obtient un array associatif.

// On peut transformer $result selon l'une des autres methodes suivantes :
$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(PDO::FETCH_NUM);// on obtient un array indexé numeriquement.
echo '<pre>'; print_r($employe); echo '</pre>';
echo $employe[1] . '<br>'; // on affiche le prenom en passant par l'indice 1 correspondant.

//-------
$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(); // fetch() sans argument fait un melange de FETCH_ASSOC et FETCH_NUM.
echo '<pre>'; print_r($employe); echo '</pre>';
echo $employe['prenom'] . '<br>';
//ou
echo $employe[1] . '<br>';


//------
$result = $pdo->query("SELECT * FROM employes WHERE prenom = 'daniel'");
$employe = $result->fetch(PDO::FETCH_OBJ); // retourne un objet avec le nom des champs de la requete comme propriétés (=attributs) publiques
echo '<pre>'; print_r($employe); echo '</pre>';
echo $employe->prenom .'<br>'; // pour appeller un objet dans $employe par son indice on met une fleche -> .

// remarque : il faut choisir l'un des traitement fetch que vous voulez effectuer, car vous ne pouvez pas en faire plusieurs sur le meme resultat

echo '<hr>';

//-----------
//exercice : afficher le service de l'employé dont l'id_employes est 417.
$result = $pdo->query("SELECT service FROM employes WHERE id_employes = 417");
$employe = $result->fetch(PDO::FETCH_ASSOC);
echo "L'employe avec l'id 417 est dans la $employe[service] ";

//--------------------------------------------------------
echo '<h3>04.PDO : while + FETCH_ASSOC </h3>';
//--------------------------------------------------------

// Jusqu'ici il n'y avait qu'un seul resultat dans l'objet PDOStatement issu de la requete. Pour traiter plusieurs resultats il nous faut faire une boucle while.

$resultat = $pdo->query("SELECT * FROM employes");

echo 'nombre d\'employes dans la requete : ' . $resultat->rowCount() . '<br>'; // retourne le nombre de lignes dans la requete.

while($contenu = $resultat->fetch(PDO::FETCH_ASSOC)){ // Fetch retourne la ligne suivante du jeu de résultat contenu dans $resultat en un array associatif.La boucle while permet de parcourir tous les résultats en faisait avancer le curseur dans la table . La boucle s'arrete a la fin des resultats.
//  echo '<pre>'; print_r($contenu); echo '</pre>';
echo '<div>';
  echo $contenu['id_employes'] . '<br>';
  echo $contenu['prenom'] . '<br>';
  echo $contenu['service'] . '<br>';
echo '---------------------</div>';
}

// remarques : il n'y a pas un seul array avec tous les enregistrements, mais un array par employes.
// Quand vous avez potentiellement plusieurs resultats , vous faites une boucle while, sinon, vous faites un seul fetch.

//--------------------------------------------------------
echo '<h3>05.PDO fetchALL '; // array multidimensionnel
//--------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");

$donnees = $resultat->fetchALL(PDO::FETCH_ASSOC); //fetchALL retourne toutes les lignes du resultats dans un tableau multidimensionnel : on a 1 array associatif a chaque indice numerique représentant un employe.

echo '<pre>'; print_r($donnees); echo '</pre>';

// Pour afficher tout le contenu de cet array multidimensionnel nous faisons des boucles foreach imbriquées :
echo '<hr>';

foreach($donnees as $employe){ // $employe est un sous array associatif contenant les infos de l'employé.
  //echo '<pre>'; print_r($employe); echo '</pre>';
  foreach($employe as $indice => $valeur){ // cette boucle parcourt toutes les infos du sous array representant 1 employé
    echo $indice . ' : ' . $valeur . '<br>';
  }
  echo '-------------------------<br>';
}
echo '<hr>';
//--------------------------------------------------------
echo '<h3>06.PDO exercice </h3>';
//--------------------------------------------------------
// affichez la liste des differents services , en la mettant dans une liste <ul><li>.

$resultat = $pdo->query("SELECT DISTINCT service FROM employes");

$donnees = $resultat->fetchALL(PDO::FETCH_ASSOC);
echo '<ul>';
foreach($donnees as $employe){
// ou jaurais pu mettre juste echo $employe['service'];
echo '<li>';
foreach($employe as $indice => $valeur){
  echo $indice . ' : ' . $valeur . '<br>';
  echo '</li>';
  }
}
  echo '</ul>';

  //--------------------------------------------------
  echo '<h3>07.PDO Tables HTML </h3>';
  //--------------------------------------------------

  $resultat  = $pdo->query("SELECT * FROM employes");
  echo '<table border="1">';
    // affichage de la ligne des en-tetes .
    echo '<tr>';
    for($i=0; $i < $resultat->columnCount(); $i++){ // fait autant de boucles qu'il y a de colonnes dans le jeu de resultat.
      echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo'</pre>'; // on voit que getColumnMeta retourne un array qui contient l'indice name avec le nom du champs de la table sql.
      $colonne = $resultat->getColumnMeta($i); // colonne est donc un array avec dedans l'indice name.
      echo '<th>' . $colonne['name'] . '</th>'; // on affiche le nom de la colonne.

    }
    echo '</tr>';
    // affichage des lignes de la table :
    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
      echo '<tr>';
      foreach($ligne as $information){
        echo '<td>' . $information . '</td>' ;
      }
      echo '</tr>';
    }
  echo '</table>';

echo '<td>';
echo '</td>';

//---------------------------------------------------
echo '<h3>08.PDO prepare, bindParam, execute </h3>';
//---------------------------------------------------

$nom = 'sennard';

// préparation de la requete :
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); //Prepare la requete avec un marqueur nominatif qui attend une valeur.

//2- on lie le marqueur a une variable :
$resultat->bindParam(':nom', $nom, PDO::PARAM_STR);// bindParam recoit exclusivement une variable vers laquelle pointe le marqueur : ici on lie le marqueur nom a la variable $nom. ainsi, si le contenu de la variable change , la valeur du marqueur changera automatiquement lorsqu'on refera un execute. On a aussi les constantes PDO::PARAM_INT et PDO::PARAM_BOOL.

//3- On execute la requête :
$resultat->execute();

//4- fetch :
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo implode($donnees, '-'); // implode() transforme le contenu d'un array en string.

/*
Prepare() permet de préparer la requete mais ne l'execute pas.
execute() permet d'exécuter une requete preparee.

Valeur de retour :
  prepare() renvoie toujours un objet PDOStatement
  execute() :
        succes : True
        echec  : false

Les requetes préparées sont préconisées si vous éxecutez plusieurs fois la meme requete , et ainsi vouloir eviter de répéter le cycle complet : analyse/interpretation/execution.

Les requetes préparées sont aussi utilisées pour assainir les données (prepare + bindParam + execute).

*/

//---------------------------------------------------
echo '<h3>09.PDO prepare, bindValue, execute </h3>';
//---------------------------------------------------

// 1- préparation de la requete :
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");

// 2- lie le marqueur a une valeur :
$resultat->bindValue(':nom', 'thoyer', PDO::PARAM_STR);

// 3- on exécute la requete :
$resultat->execute();

// 4- fetch :
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo implode($donnees, '-');

//---------------------------------------------------
echo '<h3>10.PDO exercice </h3>';
//---------------------------------------------------
// affichez dans une liste <ul><li> le titre des livres empruntés par chloé en utilisant une requete préparée.

$pdo = new PDO('mysql:host=localhost;dbname=bibliotheque', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));



$resultat= $pdo->prepare("SELECT l.titre FROM livre l INNER JOIN emprunt e ON e.id_livre = l.id_livre INNER JOIN abonne a ON e.id_abonne = a.id_abonne WHERE a.prenom = :prenom ");

$resultat->bindValue(':prenom', 'chloe', PDO::PARAM_STR);

$resultat->execute();
echo '<ul>';
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<li>';
echo implode ($donnees, '-');
echo '</li></ul>';

// on aurais pu mettre une boucle while :
/* while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){
echo '<li>' . $donnees['titre'] . '</li>';
}
*/
//---------------------------------------------------
echo '<h3>11.PDO Point complementaire </h3>';
//---------------------------------------------------
$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root','', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

echo '<strong>Le marqueur "?"</strong>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = ? AND prenom = ?");//On prepare la requete sans les variables que l'on remplace par des marqueurs "?" .

$resultat->execute(array('durand', 'damien'));

$donnees = $resultat->fetch(PDO::FETCH_ASSOC); // pas de boucle while car je suis certain qu'il n'y a qu'un seul resultat dans la requete. $donnees est un array associatif.
echo '<br>';
echo $donnees['service'];
echo '<br>';
echo '<strong>Execute sans bindParam :</strong>';
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom");
$resultat->execute(array('nom' => 'durand', 'prenom' => 'damien')); // nous associons les marqueur nominatifs dans un array associatif passé en argument de execute

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<br>Service : ' . $donnees['service'] . '<br>';
