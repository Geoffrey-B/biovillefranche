<?php

session_start();

//Nettoyage des variables de session
session_unset();

//Destruction de la session
session_destroy();

//Retour à l'accueil
header('location: index.php');
?>