<?php

$titrePage = 'Bio Villefranche - Mentions légales';
include 'includes/header.php';

//Lecture facile...
echo '<pre>';
echo file_get_contents('mentions.txt');
echo '</pre>';

////Lecture ligne par ligne
//$fd = fopen('mentions.txt', 'r');
//
////Boucle de parcours du ficher
//while(!feof($fd)) //feof=fin de fichier
//{
//    $ligne = fgets($fd, 4096);//Lecture de la ligne courante
//    echo '<p>'.$ligne.'</p>';//affichage dans un paragraphe
//}
//
//
//


include 'includes/footer.php';