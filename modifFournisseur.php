<?php 
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);

$rqModifFour = "UPDATE fournisseurs SET RS = :RS WHERE idFournisseur = :idFournisseur";
$stmtModifFour = $dbh->prepare($rqModifFour);
$params = array(':RS' => $safe['RS'], ':idFournisseur' => $safe['idFournisseur']);
if($stmtModifFour->execute($params)) {
    header('location:admin.php');
} else echo '<div class="alert alert-danger">Oups !<br><a href="#" onclick="window.history.go(-1); return false;">Recommencer</a></div>';


include 'includes/footer.php';