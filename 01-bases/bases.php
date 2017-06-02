<style>
  h2{
    margin: 0;
    font-size: 15px;
    color: red;
  }
</style>

<?php
//-------------------------------
echo '<h2>Les balises PHP</h2>';
//-------------------------------
?>
<?php
// pour ouvrir un passage en PHP, on utilise la balise précédente.
// et pour fermer un passage en PHP on utilise la balise suivant
?>

<strong>Bonjour</strong> <!-- en dehors des balises ouvertures et fermetures du PHP nous pouvons ecrire du HTML . Notez que vous ne pouvez pas mettre du PHP dans un fichier HTML.-->

<?php
// Vous n'etes pas obligé de fermer un passage PHP en fin de script.
// Notez que en PHP toutes les instructions se termine par un ";"

//-------------------------------------
echo '<h2> Ecriture et affichage</h2>';
//-------------------------------------

echo 'Bonjour'; // echo est une instruction qui permet d'effectuer un affichage dans le navigateur.

echo '<br>'; // on peut mettre du HTML entre les quotes qui suivent echo.

print 'Nous sommes mardi'; //print fait la meme chose que echo.

//il existe d'autres instructions d'affichage que nous verrons plus loin :
// print_r();
// var_dump();

// CECI est un commentaire sur une ligne
/*CECI pour faire un commentaire sur plusieurs lignes.*/

//-------------------------------------------------------------
echo '<h2>Variables : types / déclaration / affectation </h2>';
//-------------------------------------------------------------
//définition : une variable est un espace memoire nommé permettant de conserver une valeur.

// On déclare une variable avec le signe $ en PHP.

$a = 127; // je declare la variable appellé "a" et lui affecte la valeur 127.
echo gettype($a); // $a est de type integer(un entier).

echo '<br>';

$b = 1.5;
echo gettype($b); // $b est de type double(nombre décimal).

echo '<br>';

$a = 'une chaine';
echo gettype($a); // $a est de type string.

echo '<br>';

$b = '127';
echo gettype($b); // $b est de type string(parce qu'il est entre quotes).

echo '<br>';

$a = true; // $a est de type booleen.
echo gettype($a);

echo '<br>';

$b = false; // $b est de type booleen.(on peut ecrire true ou false en majuscules comme en minuscules.)
echo gettype($b);

//-------------------------------
echo '<h2> Concaténation </h2>';
//-------------------------------
$x = 'bonjour ';
$y = 'tout le monde';
echo $x . $y . '<br>'; // on concatene les valeurs de $x et de $y suivi d'une balise <br> .

//------
//Concatenation lors de l'affectation :
$prenom1 = 'bruno'; // affecte la valeur 'bruno' a la variable $prenom1
$prenom1 = 'claire';
echo $prenom1 . '<br>'; // affiche claire car elle a remplacer la valeur "bruno" dans la variable $prenom1 .

$prenom2 = 'bruno';
$prenom2 .= 'claire'; // on affecte la valeur "claire" a la suite de la valeur "bruno" : on obtient ainsi le string 'BrunoClaire'.
echo $prenom2 . '<br>';

//---------------------------------------
echo '<h2> Guillements et quotes </h2>';
//---------------------------------------
$message = "aujourd'hui"; // ou bien :
$message = 'aujourd\'hui'; // on echappe les apostrophes quand on est dans des quotes avec l'anti-slash .

$txt = 'Bonjour';
echo '$txt tout le monde <br>'; // ici on affiche $txt littéralement
echo "$txt tous le monde <br>"; // ici la variable est évaluée, c'est son contenu qui est affiché : 'bonjour tout le monde'

//--------------------------------
echo '<h2> Les constantes </h2>';
//--------------------------------
// definition : Une constante est un espace memoire nommé , qui contient une valeur , mais celle ci n'est pas modifiable : on ne peut donc pas la modifier lors de l'éxécution du script .

define('CAPITALE', 'Paris'); // déclare la constante CAPITALE et lui affecte la valeur "Paris" .Par convention on ecrit les constantes en MAJUSCULES .

echo CAPITALE . '<br>'; // Affiche Paris

//-------------------
// exercice : afficher bleu-blanc-rouge en mettant le texte de chaque couleur dans une variables.

$x = 'bleu';
$y = 'blanc';
$z = 'rouge';

echo $x . '_' . $y . '_' . $z . '<br>';
echo "$x-$y-$z <br>";

//---------------------------------------------
echo '<h2> Les Operateurs Arithmétiques </h2>';
//---------------------------------------------
$a = 10;
$b = 2;

echo $a + $b . '<br>'; // addition affiche 12
echo $a - $b . '<br>'; // soustraction affiche 8
echo $a * $b . '<br>'; // multiplication affiche 20
echo $a / $b . '<br>'; // division affiche 5
echo $a % $b . '<br>'; // modulo affiche 0 ( reste de la division entiere). Utile pour determiner si un nombre est pair ou impair grace au modulo 2.

//---------
$a = 10;
$b = 2;

$a += $b; // equivaut a $a = $a + $b ( donc ici $a = 12)
$a -= $b; // equivaut a $a = $a - $b ( donc ici $a = 10)
$a *= $b; // equivaut a $a = $a * $b ( donc ici $a = 20)
$a /= $b; // equivaut a $a = $a / $b ( donc ici $a = 10)
$a %= $b; // equivaut a $a = $a % $b ( donc ici $a = 0 --> 10%2)

// incrémenter et décrémenter :
$i = 0;
$i++; // ici incrementation --> ajoute + 1 a la valeur de i.
$i--; // ici décrémentation --> retire -1 a la valeur de i.

//---------------------------------------------
echo '<h2> Les Structures Conditionnelles </h2>';
//---------------------------------------------
$a = 10; $b = 5; $c = 2;

if ($a > $b) {
  // si la condition est true on exécute les accolades qui suivent
  print '$a est superieur a $b <br>';
} else {
  // so ma condition est false on exécute le else
  print 'non,c\'est b qui est superieur a $a <br>';
}

//--------
if ($a > $b && $b > $c){
  //la double esperluette pour AND : si les deux conditions sont vrai , on entre dans les accolades qui suivent.
  print ' ok pour au moins une des 2 conditions <br>';
} else {
  print 'nous somme dans le else <br>';
}

if ($a == 9 || $b > $c){
  // il faut que une des deux conditions soit vrai.
  print ' une des deux conditions est vrai';
} else {
  // si les deux conditions sont fausse on execute le else
  print 'nous somme dans le else <br>';
}

//-------------
$a = 10; $b = 5; $c = 2;

if ($a == 8){
  // si a = 8
  echo 'reponse 1 <br>';
} elseif ($a != 10) {
  //si a n'est pas egale a 10
  echo 'reponse 2 <br>';
}else {
  // sinon , si toutes les conditions sont fausses .
  echo 'reponse 3 <br>';
}

// attention un else n'est jamais suivi d'une condition , dans ce cas utiliser un elseif.

//-------------------------------
// Forme contractée dite ternaire : 2eme possibilité d'écrire le if/else :
echo ($a == 10) ? '$a égale a 10 <br>' : '$a est different de 10 <br>';

// le "?" remplace le if et le ":" remplace le else. si la condition avant le "?" est vrai alors on execute l'instruction avant le ":" sinon l'instruction apres le ":" .

//----------------------------------
// comparaison == OU ===
$vara = 1;
$varb = '1';

if ($vara == $varb) echo '$vara est egale a $varb en valeur <br>';

if ($vara === $varb) echo '$vara est egale a $varb en type et en valeur <br>';
// ici les deux variables sont de types different , donc le === renvoie false.

/* synthese :
  = est un signe d'affectation
  == est un signe de comparaison en valeur
  === est un signe de comparaison en valeur et en type
*/

//------------------------------
// isset et empty :

// empty() = teste si le contenu des parentheses est vide : ''; 0, NULL,FALSE, non defini.

// isset() = teste si c'est defini et a une valeur non NULL

$var1 = 0;
$var2 = ''; // string vide

if (empty($var1)) echo '0, vide, NULL, false ou non defini <br>';

if (isset($var2)) echo '$var2 existe et est non NULL <br>';

// difference entre isset et empty : si on commentaire les ligne 224 et 225 , empty renvoie TRUE car $var1 n'est pas définie , et isset renvoie FALSE  car $var2 n'est pas definie.

//---------------------------------------------
echo '<h2> Conditions Switch </h2>';
//---------------------------------------------
$couleur = 'jaune';

switch($couleur){
  case 'bleu' : echo 'vous aimez le bleu'; break;
  case 'rouge' : echo 'vous aimez le rouge'; break;
  case 'vert' : echo 'vous aimez le vert'; break;
  default: echo 'vous n\'aimez ni le  bleu , ni le rouge , ni le vert <br>';
}

// le switch compare la valeur de ce qui est entre parentheses au diffenrent cases. On execute les instructions du case dans lequel on tombe. Le break signifie sortir de la condition.

//Si aucun des cases ne correspond , on tombe alors dans le default. --> $couleur != bleu,rouge,vert

//--------------------
// exercice : réecrire ce switch avec des conditions if/else classiques.

if ($couleur == 'bleu'){
  echo 'vous aimez le bleu';
}elseif ($couleur == 'rouge') {
  echo 'vous aimez le rouge' ;
}elseif ($couleur == 'vert'){
  echo 'vous aimez le vert';
}else {
  echo 'vous aimez le jaune';
}

//---------------------------------------------
echo '<h2> Fonctions prédéfinies </h2>';
//---------------------------------------------
// Definition : une fonction prédéfinie permet de realiser un traitement spécifique prevu dans le language PHP.

//------
$email1 = 'prenom@site.fr';

echo strpos($email1,'@'); // Nous renvoie la position 6 du caractere '@' dans la chaine contenu dans $email1.

echo '<br>';

$email2 = 'bonjour';
echo strpos($email2, '@');

var_dump(strpos($email2, '@')); // Grace a var_dump , on appercois le false retourné par la fonction strpos quand elle ne trouve pas le signe "@" .

// Quand on utilise une fonction prédéfinie , il faut s'interroger sur les arguments a lui donner , et sur ce qu'elle retourne : strpos retourne un entier(qui montre la position du caractere demandé) ou booleen-->false si sa ne trouve pas.

echo '<br>';

//-------------
$phrase = 'mettez une phrase ici a cet endroit';
echo strlen($phrase); // "strlen" affiche la longueur de $phrase. ICI 35.

/* strlen() retourne :
        succes : integer
        échec  : booleen FALSE
*/

//---------
$texte = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';

echo substr($texte, 0, 40) .  '...<a href="">lire la suite</a>';  //ceci retourne une partie du texte , avec un lien pour lire la suite.

/* substr () retourne :
          succes : string
          echec  : un booleen false
*/

echo '<br>';
//---------
echo str_replace('site', 'gmail', $email1); // remplace le string 1 par le string 2 dans le string 3. Met gmail a la place de 'site'.

echo '<br>';
//---------
$message = '  Hello World  ';
echo strtolower($message) . '<br>'; // affiche tout en minuscules
echo strtoupper($message) . '<br>'; // affiche tout en MAJUSCULES

echo strlen($message) . '<br>'; // affiche 19 avec les espaces
echo strlen(trim($message)) . '<br>'; // affiche la longueur sans les espaces

echo '<br>';
//---------
$message = ' <h1> Hello World </h1><p> how are you? </p>';

echo strip_tags($message); // affiche le message sans les balises HTML.(utile dans un contexte de securité)
//---------------------------------------------
echo '<h2> Le manuel PHP </h2>';
//---------------------------------------------

// ressource en ligne : http://php.net/manual/fr/function.substr.php


//---------------------------------------------
echo '<h2> Les Fonctions Utilisateur </h2>';
//---------------------------------------------


//Les fonctions qui ne sont pas prédéfinies dans le language, sont déclarées puis exécutées par le developpeur.

// declaration d'une fonction :
function separation(){
  echo '<hr>';
} // fonction sans parametre , les parentheses sont donc vides (mais obligatoires)

// appel de la fonction :
separation(); // on exécute une fonction en l'appelant par son nom suivi de parentheses.

//----------------------------------------
// les fonctions avec parametres :
// les parametres d'une fonction sont destinés a recevoir une valeur qui permet de completer ou de modifier le comportement de la fonction.

function bonjour($qui){
  return 'bonjour ' . $qui . '<br>';
  echo 'ce code ne sera jamais exécuté...'; // car derriere le return
}

echo bonjour('pierre'); // si une fonction attend un argument , il faut le lui passer

$prenom = 'john';
echo bonjour($prenom); // l'argument peut etre une variable.

//---------------
function appliqueTva($nombre){
  return $nombre * 1.2;
}

// exercice : a partir de cette fonction , ecriver une fonction applique tva2 qui calcule un nombre multiplié par nimporte quel taux donné a la fonction .

function appliqueTva2($nombre, $taux = 1.1){
  return $nombre * $taux;
}

echo appliqueTva2(100, 3);
echo '<br>';
echo appliqueTva2(100); // on peut specifier une valeur par defaut a un parametre dans les parentheses lors de la declaration de la fonction.Dans ce cas si la valeur n'est pas passée lors de l'appel, le parametre prend cette valeur par defaut.
echo '<br>';
//-------------------
// exercice :

function meteo($saison, $temperature){
  echo "nous sommes en $saison et il fait $temperature degrés <br>";
}

meteo('hiver',2);
meteo('printemps',1);

// au sein d'une nouvelle fonction exometeo(), afficher l'article "au" pour le printemps ("au printemps"), et "en" pour les autres saison.
function exometeo($saison, $temperature){
 if ($saison==='hiver' || $saison==='été' || $saison==='automne'){
  $en= 'en';
 }else{
  $en= 'au';
 }
  echo "nous somme $en $saison et il fait $temperature degrés";
}

exometeo('été', 20);
exometeo('printemps', 20);

// correction version ternaire :
// $en = ($saison == 'printemps') ? 'au' : 'en';

//--------------------------------
// Variables locales et globales
function jourSemaine(){
  $jour = 'mercredi'; // variables locale
  return $jour; // retourne la valeur de $jour a l'exterieur de la fonction.
}

// echo $jour; // erreur, car on utilise une variable locale a la fonction jourSemaine dans l'espace global
echo jourSemaine() . '<br>'; // on recupere la valeur retourné par le return de la fonction.

//--------------------------------------
$pays = 'france'; // variable globales

function affichagePays(){
  global $pays; // le mot clé global permet d'utiliser une variable déclaré dans l'espace global au sein de la fonction.
  echo $pays; // on peut utiliser $pays grace au global ci-dessus.
}

 affichagePays();

 //-----------------------------------------------------
 echo '<h2> Les structures itératives : boucles </h2>';
 //-----------------------------------------------------
// boucle while
$i = 0; // valeur de départ
while($i < 3){ // tant que $i est inferieur a 3, j'entre dans la boucle
  echo "$i---";
  $i++; // ne pas oublier l'incrementation pour ne pas avoir une boucle infinie .
}

//---------------
// exercice : a l'aide d'une boucle while , afficher dans un selecteur les années de 1917 a 2017 .
$i = 1917;
echo '<select>';
while($i < 2017){
echo'<option>'.$i.'</option>';
$i++;
}
echo '</select>';

//-------------------
// boucle for :
echo '<br>';
for($j = 0; $j < 16; $j++){ // initialise la variable $j ; condition d'entrée dans la boucle; incrémentation ou décrémentation
  print $j . '<br>';
}

// exercice : affichez dans un selecteur les nombres de 1 a 30 avec une boucle for.
echo '<select>';
for($mois = 1; $mois <= 30; $mois++){
echo'<option>'.$mois.'</option>';
}
echo '</select>';

// exercice : affichez les chiffres de 0 a 9 sur la meme ligne dans une table html.

echo '<table border="1">';
echo'<tr>';
for($ligne = 0; $ligne <= 9; $ligne++){
echo'<td>'.$ligne.'</td>';
}
echo'</tr>';
echo '</table>';

echo '<br>';
//----------------
//Boucle do while
// la boucle do while a la particularité de s'exécuter au moins une fois , puis ensuite tant que la condition de fin est vraie.

$meteo = 'beau';

do{
  echo 'je m\'affiche au 1er tour de la boucle';
}while($meteo != 'beau'); // la condition est fausse et pourtant la boucle a fait un tour.

echo '<hr>';
//----------
$i = 0;
do{
  echo 'je suis au tour de boucle n' . $i .' <br>';
  $i++;
}while($i < 3);

//-----------------------------------------------------
echo '<h2> Les tableaux de données : les Arrays </h2>';
//-----------------------------------------------------

// declaration d'un array :
$liste = array('gregoire', 'nathalie', 'emilie', 'francois', 'georges');

// echo $liste; // erreur car on ne peut pas afficher directement un array

// pour afficher rapidement en phase de developpement le contenu d'un array :
echo '<pre>';var_dump($liste); echo '</pre>'; // var_dump affiche le contenu et le style de variable et <pre> nous presente la variable
echo '<pre>';print_r($liste); echo '</pre>'; // affiche le numero des elements dans le tableau.

// autre maniere d'affecter des valeurs a un array :
$tab[] = 'france'; // les crochets vides permettent d'ajouter la valeur 'france' au premier indice disponible , ici a l'indice 0.
$tab[] = 'italie';
$tab[] = 'suisse';
$tab[] = 'portugal';

echo '<pre>'; print_r($tab); echo '</pre>';

// pour acceder a l'element italie de l'array $tab
echo $tab[1] . '<br>'; // on precise l'indice de l'element entre crochet apres le nom du tableau.

//-------------------
// tableau associatif :
$couleur = array('j' => 'jaune', 'b' => 'bleu', 'v' => 'vert'); // on peut choisir le nom des indices , il s'agit alors d'un array associatif

// pour acceder a un element du tableau associatif :
echo 'la seconde couleur de notre tableau est le ' . $couleur['b']; // affiche bleu.
echo '<br>';
echo "la seconde couleur de notre tableau est le $couleur[b]"; // ceci affiche bleu aussi mais un array ecrit dans des guillemets perd les quotes autour de son indice.

//-----------------
echo '<br>';
// quelques fonctions prédéfinies sur les arrays :
echo 'taille du tableau : ' . count($couleur) . '<br>'; // compte le nombres d'éléments dans le tableau, ici 3.
echo 'taille du tableau : ' . sizeof($couleur) . '<br>'; // fait exactement la meme chose que Countable

$chaine = implode('-', $couleur); // fonction prédéfinies qui rassemble les éléments d'un array en une chaine, séparés par le separateur indiqué
echo $chaine . '<br>'; // $chaine est un string contenant les valeurs de l'array

$couleur2 = explode('-', $chaine); // fonction prédéfinies qui transforme une chaine contenant un séparateur comme le '-' en un tableau
var_dump($couleur2); // savoir l'indice d'un tableau

//-----------------------------------------------------
echo '<h2> Boucle foreach </h2>';
//-----------------------------------------------------
// La boucle foreach permet de parcourir un array ou un objet de maniere automatique.

echo '<pre>'; print_r($tab); echo '</pre>'; // affiche l'indice des objets du tableau.

foreach($tab as $valeur){ // parcourt l'array $tab par ses valeurs.$valeur prend successivement a chaque tour de boucle les valeurs contenues dnas $tab
  echo $valeur . '<br>';
}

//-----
// Pour parcourir les indices et les valeurs :
foreach($tab as $indice => $valeur){ // quand il y a 2 variables , la 1ere parcourt la colonne des indices et la seconde la colonne des valeurs.
  echo $indice . ' correspond a ' . $valeur . '<br>';
}

// exercice : ecrire un array avec les indices prenom, nom, email et telephone, et y associer des valeurs. puis vous affichez avec une boucle foreach les indices et les valeurs dans des <p>, sauf pour le prenom qui doit etre dans un <h1>

$prenom = array('prenom' => 'pierre', 'nom' => 'biclo', 'email' => 'pierre_biclo@bibi.fr', 'telephone' => '0652623256');

foreach($prenom as $indice => $valeur){
  if ($indice == 'prenom'){
    echo '<h1>' . $indice .':'. $valeur . '</h1>';
  }else{
    echo '<p>' . $indice . ':' . $valeur. '</p>';
  }
}

//-----------------------------------------------------
echo '<h2> Les Tableaux Multidimensionnels </h2>';
//-----------------------------------------------------
// Nous parlons de tableaux multidimensionnels quand un tableau est contenu dans un autre tableau.Chaque tableau représente une dimension.

// Création d'un tableau multidimensionnels :
$tab_multi = array(
            0 => array('prenom' => 'julien', 'nom' => 'dupon', 'tel' => '0665256525'),
            1 =>array('prenom' => 'nicolas', 'nom' => 'jambonneaux', 'tel' => '0648556525'),
            2 =>array('prenom' => 'pierre', 'nom' => 'duchemol'),
          );

echo '<pre>'; print_r($tab_multi); echo '</pre>';

// pour acceder a la valeur 'julien' :
echo $tab_multi[0]['prenom']. '<hr>'; // nous entrons dans $tab_multi a l'indice 0 pour aller ensuite a l'indice 'prenom'.

// parcourir le tableau multidimensionnel avec une boucle for :
for($i = 0; $i < count($tab_multi); $i++){
  echo $tab_multi[$i]['prenom']. '<br>';
}
echo '<hr>';
// exercice : afficher les prenoms de $tab_multi avec une boucle foreach.

foreach($tab_multi as $indice => $valeur){
  echo $tab_multi[$indice]['prenom']. '<br>' ;
}
echo '<hr>'; // deuxieme facon de le faire
foreach($tab_multi as $indice => $valeur){
  echo $valeur['prenom']. '<br>' ;
}

//-----------------------------------------------------
echo '<h2> Inclusion de fichiers </h2>';
//-----------------------------------------------------

echo 'premiere inclusion : ';
include('exemple.inc.php'); // apres include on precise le chemin du fichier a inclure.

echo '<br>Deuxieme inclusion : ';
include_once('exemple.inc.php'); // le once verifie si le fichier a deja été inclus et ne le ré-inclus pas si il y est deja .

echo '<br>Troisieme inclusion : ';
require('exemple.inc.php');

echo '<br>quatrieme inclusion : ';
require_once('exemple.inc.php'); // avec once on verifie dabord que le fichier n'est pas deja inclus .

/*
Difference entre include et require
Elle apparait uniquement si on ne parvient pas a inclure le fichier demandé :
-include : genere une erreur de type warning et continue l'execution du script
-require : genere une erreur de type fatal error et stop l'exécution du script

Notez que le .inc dans le nom du fichier est la a titre indicatif , precisant au developpeur qu'il sagit d'un fichier d'inclusion et non pas d'une page a part entiere.

*/

//-----------------------------------------------------
echo '<h2> Gestion des dates </h2>';
//-----------------------------------------------------
// la fonction prédéfinie date() renvoie la date du jour selon le format spécifié :
echo date('d/m/Y H:i:s') . '<br>'; // affiche la date au format jour,mois,années ainsi que heures,minutes,secondes.

echo date('Y-m-d'); // affiche la date au format années-mois-jour. Notez que l'on peut changer le separateur .

//------------------
/* definition du timestamp Unix :
Le timestamp est le nombre de secondes écoulées entre une date et le 1janvier 1970 a 00:00:00.
Cette date correspond a la création d'UNIX, premier systeme d'exploitation.

On utilise le timestamp dans de nombreux langages de programmation dont le PHP et le javascript.
*/

// la fonctions prédéfinie time() retourne l'heure courante en timestamp.

echo time();
echo '<br>';

// on va utiliser le timestamp pour passer une date d'un format vers un autre format :
$dateJour = strtotime('29-05-2017'); // transforme la date en timestamp
echo $dateJour . '<br>';

$dateFormat = strftime('%Y-%m-%d', $dateJour); // transforme un timestamp en date au format indiqué
echo $dateFormat . '<br>';

//---------------
// créer une date avec la classe DateTime (approche objet) :
$date = new DateTime('11-04-2017'); // on crée un objet $date de type DateTime en utilisant le mot clé new suivi du nom de la classe DateTime. On passe une date en argument de DateTime.

echo $date->Format('Y-m-d'); // on peut formater l'objet $date en appelant sa méthode format() et en lui indiquant les parametres du format souhaité, ici Y-m-d.

//-----------------------------------------------------
echo '<h2> Introduction aux objets </h2>';
//-----------------------------------------------------
// Un objet est un autre type de données.Il permet de regrouper des informations : on peut y déclarer des variables appelées attribut ou propriétés, ainsi que des fonctions appelées méthodes.

// exemple 1 :
// Nous creons une classe appelée etudiant qui nous permet de créer des objets de type etudiant. ils auront les attributs et les methodes de cette classe.
class Etudiant {
  public $prenom = 'julien';
  public $age    = 25; //$prenom et $age sont des attributs.Public permet de preciser qu'ils seront accessibles partout.

  public function pays(){
    return 'france'; // pays() est une methode
  }
}

$objet = new Etudiant(); //New est un mot clé permettant d'instancier(copier) la classe et d'en faire un objet.
echo '<pre>'; print_r($objet); echo '</pre>'; // on voit le type de $objet, la classe dont il est issu, et les propriétés qu'il contient.

echo $objet->prenom . '<br>'; // pour acceder a la propriété prenom qui est dans l'objet je met une fleche -> .

echo $objet->age . '<br>'; // pour acceder a la propriété age qui est dans l'objet je met une fleche -> .

echo $objet->pays() . '<br>'; // appel d'une methode toujours avec les parentheses.

// exemple 2 : un panier d'achat de site e-commerce :
class Panier {
  public function ajout_article($article){
    // ici le code pour ajouter l'article au panier
    return "l'article $article a bien été ajouté au panier";
  }
}

// création d'un objet panier :
$panier = new Panier();
echo $panier->ajout_article('pull'); // appelle la méthode ajout_article en lui passant l'argument "pull" pour l'ajouter au panier. Les méthodes s'appellent apres une fleche -> et des parentheses.

//****************************************
