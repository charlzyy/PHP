<?php
echo '<pre>'; var_dump($_POST); echo '</pre>'; // pour verifier que le formulaire fonctionne et envoie des infos.

if(!empty($_POST)){ //Si $_POST n'est pas vide c'est que le formulaire a été soumis.

//Pour afficher les données du formulaire :
echo 'prenom : ' . $_POST['prenom'] . '<br>'; // l'indice de $_POST correspond au name du formulaire.
echo 'description : ' . $_POST['description'] . '<br>';
}
 ?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mon formulaire</title>
  </head>
  <body>
    <h1>Formulaire 1</h1>
    <form method="post" action="" > <!-- method = comment vont circuler les données. action = url de destination des données. si laissé vide , les données circulent vers la page du formulaire -->
      <label for="prenom">prenom</label>
      <input type="text" name="prenom" id="prenom"><!-- les attributs name permettent de remplir les indices de $_post -->
      <br>

      <label for="description">description</label><!-- l'attribut for est la pour des raisons d'accessibilité : quand on clique sur le label , le curseur se positionne dans l'input d'id correspondant -->
      <textarea id="description" name="description"></textarea>
      <br>

      <input type="submit" name="validation" value="envoyer">
    </form>
  </body>
</html>
