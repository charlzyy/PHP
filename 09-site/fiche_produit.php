<?php
require_once('inc/init.inc.php');


// ---------------------------TRAITEMENT------------------------------
$aside = '';

// 1- Controle de l'existence du produit demandé :
if(isset($_GET['id_produit'])){
        // Si l'indice id_produit existe bien , on verifie l'existence de l'id_produit en base:
        $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

        if($resultat->rowCount() == 0){
          //Si le produit n'existe pas en base, on redirige vers la boutique:
          header('location:boutique.php');
          exit();
        }

// 2- Mise en forme des informations sur le produit
$produit = $resultat->fetch(PDO::FETCH_ASSOC);

$contenu .= '<div class="row">
              <div class="col-lg-12">
                <h1 class="page-header">'. $produit['titre'] .'</h1>
              </div>
            </div>';

$contenu .= '<div class="col-md-8">
              <img src="'. $produit['photo'] .'" alt="" class="img-responsive">
            </div>';

$contenu .= '<div class="col-md-4">
              <h3>Description</h3>
              <p>'. $produit['description'] .'</p><br><br>
              <p class="lead">Prix : '. $produit['prix'] .' €</p><br>
              <h3>Details</h3>
              <ul>
                  <li>Categorie : '. $produit['categorie'] .'</li>
                  <li>Couleur : '. $produit['couleur'] .'</li>
                  <li>Taille : '. $produit['taille'] .'</li>
              </ul>
             </div>';

// 3- Affichage du formulaire d'ajout au panier si le stock est superieur a 0 .
$contenu .= '<div class="col-md-4">';

  if($produit['stock'] > 0){
    // On crée le formulaire :
    $contenu .= '<form method="post" action="panier.php">';
      $contenu .= '<input type="hidden" name="id_produit" value="'. $produit['id_produit'] .'">';

      $contenu .= '<select name="quantite" class="form-group-sm form-control-static" >';
      for($i = 1; $i <= $produit['stock'] && $i <= 5; $i++){
        $contenu .= "<option>$i</option>";

      }





      $contenu .= '</select>';
      $contenu .= '<input type="submit" name="ajout_panier" value="ajouter au panier" class="btn">';
      $contenu .= '</form>';

  }else{
    $contenu .= '<br><p class="bg-danger">Produit Indisponible !</p>';
  }

$contenu .= '<p><a href="boutique.php?categorie='. $produit['categorie'] .'">Retour vers votre selection</a></p>';



$contenu .= '</div>';

}else{
  //Si id_produit n'existe pas dans l'url, on redirige vers la boutique:
  header('location:boutique.php');
  exit();
}

// EXERCICE :
/*
- créer des suggestions de produits : afficher 2 produits (photo et titre) aléatoirement appartenant a la categorie du produit selectionné par linternaute.
-Ces 2 produits doivent etre differents du produit affiché dans fiche_produit.
- La photo est cliquable et renvoie a la fiche du produit

note : utilisez la variable $aside pour afficher le contenu.




*/

//-----------------------------AFFICHAGE----------------------------
require_once('inc/haut.inc.php');
echo $contenu_gauche;
?>

  <div class="row">
    <?php echo $contenu; ?>
  </div>

  <!-- Suggestions de produits -->

  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"> Suggestions de produits</h3>
    </div>
    <?php echo $aside; ?>
  </div>




<?php
require_once('inc/bas.inc.php');
