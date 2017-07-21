<?php 
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);

$rqModifSCat = "UPDATE scategories SET libSCategorie = :libSCategorie WHERE idsCategories = :idsCategories";
$stmtModifSCat = $dbh->prepare($rqModifSCat);
$params = array(':libSCategorie' => $safe['libSCategorie'], ':idsCategories' => $safe['idsCategories']);
if($stmtModifSCat->execute($params)) {
    header('location:admin.php');
} else echo '<div class="alert alert-danger">Oups !<br><a href="#" onclick="window.history.go(-1); return false;">Recommencer</a></div>';


include 'includes/footer.php';