<?php

// ouverture de la session en cours:
session_start(); // lorsque jeffectue un session_start, la session n'est pas récréée car elle existe deja ( elle a ete cree dans le fichier session1.php)

echo ' la session est accessible dans tous les scripts du site, comme ici : ';
echo '<pre>'; print_r($_SESSION);echo '</pre>';

//conclusion : ce fichier n'a pas de lieb avec session1.php , il n-y a pas d'inclusion, il pourrait etre dans nimporte quel dossier du site , s'appeller nimporte comment , et pourtant les informations du fichier de session reste accessible grace a session_start().
