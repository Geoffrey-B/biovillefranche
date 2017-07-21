<?php

//Fonction de vérification de la complexité d'un mot de passe
function verifPassword($mdp) {
    $longueur = strlen($mdp);
    if ($longueur < 8) return false;

    $nbInt = $nbMaj = 0;
    for($i=0; $i<$longueur; $i++) {
        if(is_numeric($mdp[$i])) $nbInt++; //Est-ce un nombre ?
        else if(strtoupper($mdp[$i])==$mdp[$i]) $nbMaj++; // Est-ce une majuscule ?
    }
    if($nbInt < 1) return false;
    if($nbMaj < 1) return false;
    return true;
}


?>