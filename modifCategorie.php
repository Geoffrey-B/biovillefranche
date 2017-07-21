<?php 
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);

$rqModifCat = "UPDATE categories SET libCategorie = :libCategorie WHERE idCategorie = :idCategorie";
$stmtModifCat = $dbh->prepare($rqModifCat);
$params = array(':libCategorie' => $safe['libCategorie'], ':idCategorie' => $safe['idCategorie']);
if($stmtModifCat->execute($params)) {
    header('location:admin.php');
} else echo '<div class="alert alert-danger">Oups !<br><a href="#" onclick="window.history.go(-1); return false;">Recommencer</a></div>';


include 'includes/footer.php';