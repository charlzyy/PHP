<?php
//---------------
// exercice :
/* 1. realiser un formulaire permettant de sélectionner un fruit dans une liste deroulante et de saisir un poids dans un input.
2.Traiter les informations du formulaire pour afficher le  prix du fruits choisis et du poids saisis en passant par la fonction Calcul. */
include('fonction.inc.php');
echo '<pre>'; var_dump($_POST); echo '</pre>';

if(!empty($_POST)){
//Pour afficher les données du formulaire :
echo 'fruit : ' . $_POST['fruit'] . '<br>';
echo 'poids : ' . $_POST['poids'] . '<br>';
echo calcul($_POST['fruit'],$_POST['poids']);
}

 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Mon formulaire</title>
   </head>
   <body>
     <h1>Formulaire fruits</h1>
     <form method="post" action="" >
    <select class="fruitus" name="fruit">
      <option value="cerise">cerise</option>
      <option value="banane">bananes</option>
      <option value="pommes">pommes</option>
      <option value="peches">peches</option>
    </select>
       <br>
       <label for="poids">poids</label>
       <input type="text" name="poids" id="poids">


       <br>

       <input type="submit" name="validation" value="envoyer">
     </form>
   </body>
 </html>
