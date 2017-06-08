<?php
require_once '../inc/init.inc.php';

//----------------------------TRAITEMENT-------------------------------
// 1-Verification que l'internaute est admin :
if(!internauteEstConnecteEtEstAdmin()){
  header('location:../connexion.php');
  exit();
}

//7- Suppression du produit :
if(isset($_GET['action']) && $_GET['action'] == 'supression' && isset($_GET['id_produit'])){
  //Si on a passé l'action suppression dans l'url :

  //On selectionne la photo en base pour pouvoir supprimer le fichier physique :
  $resultat = executeRequete("SELECT photo FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

  $produit_a_supprimer = $resultat->fetch(PDO::FETCH_ASSOC); // array associatif dont le nom de l'indice correspond au champ présent dans le SELECT de la requete ci-dessus.

  $chemin_photo_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $produit_a_supprimer['photo']; // chemin complet de la photo a supprimer dnas le dossier photo

  if(!empty($produit_a_supprimer['photo']) && file_exists($chemin_photo_a_supprimer)){
    // Si le produit existe bien , on le supprime :
    unlink($chemin_photo_a_supprimer); // Supprime le fichier a supprimer.
  }

executeRequete("DELETE FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

$contenu .= '<div class="bg-success">Le Produit a bien été supprimé ! </div>';

$_GET['action'] = 'affichage'; // pour réafficher le tableau HTML sans le produit supprimé.
}

// 4-Enregistrement du produit en BDD :
if(!empty($_POST)){
  // debug($_POST);
  // Ici il faudrait normalement mettre tous les controles sur le formulaire.

  $photo_bdd = ''; // represente le chemin de la photo du produit.

  // 9 suite- Modification de la photo
  if(isset($_GET['action']) && $_GET['action'] == 'modification'){
    //Si nous sommes en modification d'un produit, nous mettons en BDD la valeur du champ 'photo_actuelle' du formulaire :
    $photo_bdd = $_POST['photo_actuelle'];
  }


  //5- photo:
  debug($_FILES);
  if(!empty($_FILES['photo']['name'])){
    //Si on a uploader une photo :
    $nom_photo = $_POST['reference'] . '_' . $_FILES['photo']['name']; // on crée un nom unique pour nommer le fichier photo uploadé.

    $photo_bdd = RACINE_SITE . 'photo/' . $nom_photo;  //represente le chemin de la photo afficher sur le site et enregistrer en bdd.

    $photo_physique = $_SERVER['DOCUMENT_ROOT'] . $photo_bdd; // represente le chemin complet depuis le localhost ou est enregistré le fichier photo physique sur le serveur . ici $_SERVER['DOCUMENT_ROOT'] = localhost.

    copy($_FILES['photo']['tmp_name'], $photo_physique); // enregistre le fichier photo qui est temporairement dans $_FILES['photo']['tmp_name'], dans le repertoire dont le chemin est $photo_physique
  }

  //4- suite :
  executeRequete("REPLACE INTO produit (id_produit, reference, categorie, titre, description, couleur, taille, public, photo, prix, stock) VALUES (:id_produit, :reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock )",
  array(
  ':id_produit' => $_POST['id_produit'],
  ':reference' =>$_POST['reference'],
  ':categorie' =>$_POST['categorie'],
  ':titre' => $_POST['titre'],
  ':description' => $_POST['description'],
  ':couleur' => $_POST['couleur'],
  ':taille' => $_POST['taille'],
  ':public' => $_POST['public'],
  ':photo' => $photo_bdd,
  ':prix' => $_POST['prix'],
  ':stock' => $_POST['stock'] ));

$contenu .= '<div class="bg-success">Le produit a été enregistré</div>';
$_GET['action'] = 'affichage'; // pour declencher l'affiche de la table HTML avec tous les produits.
}

// 2-Liens affichage et ajout de produit :
$contenu .= '<ul class="nav nav-tabs">
            <li><a href="?action=affichage">Affichage des produits</a></li>
            <li><a href="?action=ajout">Ajout de produit</a></li>
            </ul>';

// 6- affichage des produits dans une table HTML
if(isset($_GET['action']) && $_GET['action'] == 'affichage'){
  // si l'affichage est demandée :
  $resultat = executeRequete("SELECT * FROM produit"); // on sélectionne tous les produits.

  $contenu .='<h3>Affichage Des Produits</h3>';
  $contenu .='Nombres de produits dans la boutique : ' . $resultat->rowCount();

  $contenu .= '<table class="table">';
  // entetes du tableau :
  $contenu .= '<tr>';
    $contenu .= '<th>id_produit</th>
                 <th>référence</th>
                 <th>catégorie</th>
                 <th>titre</th>
                 <th>description</th>
                 <th>couleur</th>
                 <th>taille</th>
                 <th>public</th>
                 <th>photo</th>
                 <th>prix</th>
                 <th>stock</th>
                 <th>action</th>
                 ';

  $contenu .= '</tr>';
  // les lignes du tableau :
  while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
    //debug($ligne);
    $contenu .= '<tr>';

      foreach($ligne as $indice => $valeur){
        if($indice == 'photo'){
          //Si nous sommes sur l'indice photo , on met une balise img.
          $contenu .= '<td><img  src=" '. $valeur .'" alt="" width="70" height="70" ></td>';
        }else {
          //Sinon pas de balise img
          $contenu .= '<td>'. $valeur .'</td>';
        }
      }
      $contenu .= '<td>
                    <a href="?action=modification&id_produit='.$ligne['id_produit'].'">modifier</a> /
                    <a href="?action=supression&id_produit='.$ligne['id_produit'].'" onclick="return(confirm(\'Etes vous sur de vouloir supprimer ce produit ?? ATTENTION , en supprimant ce produit vous allez quand meme payer 10€ !! \'))">supprimer</a>
                  </td>';
      $contenu .= '</tr>';
    }
    $contenu .= '</table>';


}
















//----------------------------AFFICHAGE--------------------------------
require_once '../inc/haut.inc.php';
echo $contenu;

// 3- Formulaire HTML :
if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')) :

  // 8- Modification d'un produit existant :
if(isset($_GET['id_produit'])){
  // Si on est en modification et qu'un id_produit existe , alors on le selectionne en BDD pour afficher ses infos dans le formulaire :
  $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

  $produit_actuel = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car il y a que un seul produit.
}


?>
<h3>Formulaire de produits</h3>
<form action="" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id_produit" value="<?php if(isset($produit_actuel)){echo $produit_actuel['id_produit'];} else{ echo 0;} ?>">

  <label for="reference">Référence</label>
  <input type="text" name="reference" id="reference" value="<?php if(isset($produit_actuel))echo $produit_actuel['reference']; ?>"><br><br>

  <label for="categorie">Catégorie</label>
  <input type="text" name="categorie" id="categorie" value="<?php if(isset($produit_actuel))echo $produit_actuel['categorie']; ?>"><br><br>

  <label for="titre">Titre</label>
  <input type="text" name="titre" id="titre" value="<?php if(isset($produit_actuel))echo $produit_actuel['titre']; ?>"><br><br>

  <label for="description">Description</label><br>
  <textarea name="description" id="description"><?php if(isset($produit_actuel))echo $produit_actuel['description']; ?></textarea><br><br>

  <label for="couleur">Couleur</label>
  <input type="text" name="couleur" id="couleur" value="<?php if(isset($produit_actuel))echo $produit_actuel['couleur']; ?>"><br><br>

  <label>Taille</label>
  <select name="taille" id="taille">
    <option value="S" <?php if(isset($produit_actuel) && $produit_actuel['taille'] == 'S') echo 'selected';?>>S</option>
    <option value="M" <?php if(isset($produit_actuel) && $produit_actuel['taille'] == 'M') echo 'selected';?>>M</option>
    <option value="L" <?php if(isset($produit_actuel) && $produit_actuel['taille'] == 'L') echo 'selected';?>>L</option>
    <option value="XL" <?php if(isset($produit_actuel) && $produit_actuel['taille'] == 'XL') echo 'selected';?>>XL</option>
  </select><br><br>

  <label for="public">Public</label>
  <input type="radio" name="public" value="m" id="homme" checked><label for="homme">Homme</label>
  <input type="radio" name="public" value="f" id="femme" <?php if(isset($produit_actuel)&& $produit_actuel['public'] == 'f') echo 'checked'; ?>><label for="femme">Femme</label>
  <input type="radio" name="public" value="mixte" id="mixte" ><label for="mixte">Mixte</label><br><br>

    <label for="photo">Photo</label><br>
    <input type="file" name="photo" id="photo" value=""><br><br><!-- va de pair avec l'attribut enctype de la balise <form> : permet d'uploader un fichier et de remplir la super globale $_FILES -->

      <!-- 9- Modification de la photo -->
      <?php
      // en cas de modification de produit, on affiche la photo actuelle :
      if(isset($produit_actuel)){
        echo'<i>Vous pouvez uploader une nouvelle photo</i><br>';
        echo'<img src"'.$produit_actuel['photo'].'" width="90" height="90"><br>';
        echo '<input type="hidden" name="photo_actuelle" value="' . $produit_actuel['photo'] .'"><br>'; // ce champs permet de renseigner l'indice 'photo_actuelle' dans $_POST quand on valide le formulaire de modification.

      }
      ?>




    <label for="prix">Prix</label>
    <input type="text" name="prix" id="prix" value="<?php if(isset($produit_actuel))echo $produit_actuel['prix']; ?>"><br><br>

    <label for="stock">Stock</label>
    <input type="text" name="stock" id="stock" value="<?php if(isset($produit_actuel))echo $produit_actuel['reference']; ?>"><br><br>

    <input type="submit" value="valider" class="btn">
</form>





<?php
endif;

require_once '../inc/bas.inc.php';


 ?>
