<?php
//-------------------------
// exercice :
// realiser un formulaire 'pseudo' et 'email' dans formulaire 3.php
//recuperer les données saisies dans le formulaire dans la page formulaire4.php et les afficher.
// de plus , si le champs pseudo est laisser vide, afficher un message dans formulaire 4 qui precise que le champs est obligatoire.

if(!empty($_POST)){
//Pour afficher les données du formulaire :
echo 'pseudo : ' . $_POST['pseudo'] . '<br>';
echo 'email : ' . $_POST['email'] . '<br>';
if (empty($_POST['pseudo'] )){
  echo '<br>  <strong style = "color:red">veuillez renseigner le champ pseudo !!!<strong>';
}
}
 ?>
