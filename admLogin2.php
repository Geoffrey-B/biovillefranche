<?php
session_start();

//Mr Propre
$safe = array_map('strip_tags', $_POST);

//Vérification login & password
if($safe['login'] = 'Geoffrey' && $safe['password'] == 'moi') {
    $_SESSION['nom']='Admin'; //Pour la boutique
    $_SESSION['prenom']='Admin'; //Pour la boutique
    $_SESSION['id']='0'; //Pour la boutique
    $_SESSION['auth']='ok'; //Pour la boutique
    $_SESSION['admin'] ='ok'; //Pour l'admin
    header('location:admin.php');
    
}
//Redirection
else header('location: admLogin.php');