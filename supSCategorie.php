<?php
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe= array_map('strip_tags', $_POST);

$rqExist = "SELECT idSCategorie from produits WHERE idSCategorie = :idSCategorie";
$stmtExist = $dbh->prepare($rqExist);
$params = array(':idSCategorie' => $_GET['id']);
$stmtExist->execute($params);
$listeExist = $stmtExist->fetchAll();

if(count($listeExist) == 0){



    //Requête
    $rqSupp = "DELETE FROM scategories WHERE idsCategories = :idsCategories";

    //Préparation
    $stmtSupp = $dbh->prepare($rqSupp);

    //Paramètres
    $params = array(':idsCategories' => $_GET['id']);

    //Exécution
    if($stmtSupp->execute($params)) {
        header('location:admin.php');
    } 
} else echo '<div class="alert alert-danger">Certains produits sont classés dans cette sous-catégorie. Vous ne pouvez pas la supprimer.<br><a href="#" onclick="window.history.go(-1); return false;">Retour</a></div>';





include 'includes/footer.php';