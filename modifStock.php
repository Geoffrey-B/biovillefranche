<?php 
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);

$rqModifSto = "UPDATE produits SET stocks = :stocks WHERE idproduit = :idproduit";
$stmtModifSto = $dbh->prepare($rqModifSto);
$params = array(':stocks' => $safe['stock'], ':idproduit' => $safe['idproduit']);
if($stmtModifSto->execute($params)) {
    header('location:admin.php');
} else echo '<div class="alert alert-danger">Oups !<br><a href="#" onclick="window.history.go(-1); return false;">Recommencer</a></div>';


include 'includes/footer.php';