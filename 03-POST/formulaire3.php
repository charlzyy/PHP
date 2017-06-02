<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Mon formulaire</title>
  </head>
  <body>
    <h1>Formulaire 2</h1>
    <form method="post" action="formulaire4.php" >
      <label for="pseudo" >pseudo</label>
      <input type="text"  name="pseudo" id="pseudo"><!-- les attributs name permettent de remplir les indices de $_post -->
      <br>
      <label for="email">email</label>
      <input type="text" name="email" id="email">
      <br>
      <input type="submit" name="validation" value="envoyer">
    </form>
  </body>
</html>
