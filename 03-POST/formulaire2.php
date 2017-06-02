<?php
// exercice :
// créer un formulaire avec les champs ville , code postal et adresse.
// Puis afficher les données saisies par l'internaute juste au dessus du formulaire en precisant l'etiquette correspondante.

echo '<pre>'; var_dump($_POST); echo '</pre>';

if(!empty($_POST)){
//Pour afficher les données du formulaire :
echo 'ville : ' . $_POST['ville'] . '<br>';
echo 'code : ' . $_POST['code'] . '<br>';
echo 'adresse : ' . $_POST['adresse'] . '<br>';
}
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Mon formulaire</title>
   </head>
   <body>
     <h1>Formulaire 2</h1>
     <form method="post" action="" >
       <label for="ville">ville</label>
       <input type="text" name="ville" id="ville"><!-- les attributs name permettent de remplir les indices de $_post -->
       <br>
       <label for="code">code postal</label>
       <input type="text" name="code" id="code">
       <br>
       <label for="adresse">adresse</label>
       <input type="text" name="adresse" id="adresse">


       <br>

       <input type="submit" name="validation" value="envoyer">
     </form>
   </body>
 </html>
