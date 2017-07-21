<?php 
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);

$rqModifPro = "UPDATE produits SET nom = :nom WHERE idproduit = :idproduit";
$stmtModifPro = $dbh->prepare($rqModifPro);
$params = array(':nom' => $safe['nom'], ':idproduit' => $safe['idproduit']);
if($stmtModifPro->execute($params)) {
    header('location:admin.php');
} else echo '<div class="alert alert-danger">Oups !<br><a href="#" onclick="window.history.go(-1); return false;">Recommencer</a></div>';


include 'includes/footer.php';