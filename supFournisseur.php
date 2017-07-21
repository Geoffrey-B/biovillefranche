<?php
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe= array_map('strip_tags', $_POST);

$rqExist = "SELECT idFournisseur, nom from produits WHERE idFournisseur = :idFournisseur";
$stmtExist = $dbh->prepare($rqExist);
$params = array(':idFournisseur' => $_GET['id']);
$stmtExist->execute($params);
$listeExist = $stmtExist->fetchAll();

if(count($listeExist) == 0){


    //Requête
    $rqSuppF = "DELETE FROM fournisseurs WHERE idFournisseur = :idFournisseur";

    //Préparation
    $stmtSuppF = $dbh->prepare($rqSuppF);

    //Paramètres
    $params = array(':idFournisseur' => $_GET['id']);

    //Exécution
    if($stmtSuppF->execute($params)) {
        header('location:admin.php');
    } 

} else echo '<div class="alert alert-danger">Ce fournisseur continue à vous fournir des produits. Vous ne pouvez pas le supprimer.<br><a href="#" onclick="window.history.go(-1); return false;">Retour</a></div>';





include 'includes/footer.php';