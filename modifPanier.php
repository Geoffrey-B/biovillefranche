<?php
session_start();

include 'includes/connexion.php';

//Mr Propre
$safe= array_map('strip_tags', $_POST);

//Si bouton supprimer cliqué
if(isset($safe['btnSupp'])) {
    //Requête
    $rqSupp = "DELETE FROM paniers WHERE idPanier = :idPanier";

    //Préparation
    $stmtSupp = $dbh->prepare($rqSupp);

    //Paramètres
    $params = array(':idPanier' => $safe['idPanier']);

    //Exécution
    $stmtSupp->execute($params);

}
//Si bouton modifier cliqué
if(isset($safe['btnModif'])) {
    //Requête
    $rqModif = "UPDATE paniers SET quantite = :quantite WHERE idPanier = :idPanier";

    //Préparation
    $stmtModif = $dbh->prepare($rqModif);

    //Paramètres
    $params = array(':quantite' => $safe['quantite'], ':idPanier' => $safe['idPanier']);

    //Exécution
    $stmtModif->execute($params);
}

header('location: panier.php');
