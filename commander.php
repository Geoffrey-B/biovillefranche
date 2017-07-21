<?php

session_start();

include 'includes/connexion.php';

//echo'<pre>';
//print_r($_POST);
//echo'</pre>';

//Mr Propre
$safe = array_map('strip_tags', $_POST);
$idClient = $_SESSION['id']; //Le numéro du client

//Déjà dans le panier ?
$rqVerif = "SELECT COUNT(*) FROM paniers WHERE idProduit = :idProduit AND idClient = :idClient";
//Préparation
$stmtVerif = $dbh->prepare($rqVerif);
//Paramètres
$params = array(':idProduit' => $safe['idproduit'], ':idClient' => $idClient);
//Exécution
$stmtVerif->execute($params);
$exists = $stmtVerif->fetchColumn();
//echo $exists;

//Ajout
if($exists == 0) {
    //Requête
    $rqPanier = "INSERT INTO paniers(datePanier, idClient, idproduit, quantite) VALUES(NOW(), :idClient, :idProduit, :quantite)";

} else {
    $rqPanier = "UPDATE paniers SET quantite = quantite + :quantite WHERE idClient = :idClient AND idProduit = :idProduit";
}
//Préparation
$stmtPanier = $dbh->prepare($rqPanier);

//Paramètres
$paramPanier = array(':idClient' => $idClient, ':idProduit' => $safe['idproduit'], ':quantite' => $safe['quantite']);

//Exécution
if($stmtPanier->execute($paramPanier)) {
    header('location: produits.php?id='.$safe['cat']);
//    $rqAchat = "UPDATE produits SET stocks = stocks - :quantite WHERE idProduit = :idProduit";
//    $stmtAchat = $dbh->prepare($rqAchat);
//    $paramAchat = array(':idProduit' => $safe['idproduit'], ':quantite' => $safe['quantite']);
//    $stmtAchat->execute($paramAchat);
} else echo '<p>OUPSSSSS</p>';

