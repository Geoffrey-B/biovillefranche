<?php
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe= array_map('strip_tags', $_POST);


//Requête
$rqSupp = "DELETE FROM clients WHERE idClient = :idClient";

//Préparation
$stmtSupp = $dbh->prepare($rqSupp);

//Paramètres
$params = array(':idClient' => $_GET['id']);

//Exécution
if($stmtSupp->execute($params)) {
    header('location:clients.php');
} else echo '<div class="alert alert-danger">Oups !<br><a href="#" onclick="window.history.go(-1); return false;">Recommencer</a></div>';





include 'includes/footer.php';