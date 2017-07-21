<?php

$titrePage = 'Bio Villefranche - Validation';
include 'includes/header.php';

/*A faire
-Lire le panier
-créer la facture
-créer un fichier CSV pour la préparation de la commande
-créer les lignes de la facture
-effacer les lignes du panier
-modifier les stocks produits
-dire merci pour les sous
*/

$idClient = $_SESSION['id'];
//Montant total du panier
$totalFacture = $_SESSION['totalFacture'];

//LECTURE DU PANIER
//Requête
$rqPanier = "SELECT idPanier, idClient, idProduit, quantite FROM paniers WHERE idClient = :idClient";

//Préparation
$stmtPanier = $dbh->prepare($rqPanier);

//Paramètres
$params = array(':idClient' => $idClient);

//Exécution
$stmtPanier->execute($params);

//Récupération
$contenuPanier = $stmtPanier->fetchAll();

print_r($contenuPanier);

//CREATION DE LA FACTURE
//Requête
$rqFacture = "INSERT INTO factures(idClient, idReglement, montant, dateFacture) VALUES(:idClient, 0, :totalFacture, NOW())";
//Préparation
$stmtFacture = $dbh->prepare($rqFacture);

//Paramètres
$paramFact = array(':idClient' => $idClient,
                    ':totalFacture' => $totalFacture);
//Exécution
$stmtFacture->execute($paramFact); //Recyclage $params

//Récupération id
$idFacture = $dbh->lastInsertId();
echo 'Numéro facture : '.$idFacture;


//Création d'un fichier CSV pour la préparation
$fd = fopen('bonsCommande/panier_'.date('dmYHis').'_'.$idClient.'.csv','w');

//Boucle sur le panier
foreach($contenuPanier as $artPanier) {
    
    //Ecriture dans le fichier CSV (séparateur ';')
    fputcsv($fd, $artPanier, ';');
    
    //Ecrire dans la table facturedetails
    //Requête
    $rqFactDetail = "INSERT INTO detailfactures(idFacture, idProduit, quantite) VALUES (:idFacture, :idProduit, :quantite)";
    //Préparation
    $stmtFactDetail = $dbh->prepare($rqFactDetail);
    //Paramètres
    $params2 = array(':idFacture' => $idFacture,
                    ':idProduit' => $artPanier['idProduit'],
                    ':quantite' => $artPanier['quantite']);
    //Exécution
    if($stmtFactDetail->execute($params2)) {
        //Effacerla ligne du panier
        //Requête
        $rqDelPanier = "DELETE FROM paniers WHERE idPanier = :idPanier";
        //Préparation
        $stmtDelPanier = $dbh->prepare($rqDelPanier);
        //Paramètres
        $params3 = array(':idPanier' => $artPanier['idPanier']);
        //Exécution
        $stmtDelPanier->execute($params3);
        
        //Modifier les stocks produits
        $rqModStocks = "UPDATE produits SET stocks = stocks - :quantite WHERE idProduit = :idProduit";
        //Préparation
        $stmtModStocks = $dbh->prepare($rqModStocks);
        //Paramètres
        $params4 = array(':idProduit' => $artPanier['idProduit'],
                        ':quantite' => $artPanier['quantite']);
        //Execution
        $stmtModStocks->execute($params4);
    }
}
?>

<div class="text-center">
	<form action="https://www.paypal.com/cgi-bin/webscr"
			  method="post" target="_top">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="hosted_button_id" 
					 value="XBCCCCUKVNN6L">
		<input type="hidden" name="amount" value="<?=$totalFacture; ?>">
		<input type="hidden" name="item_name" value = "Facture N°<?=$idFacture; ?>" >
		<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_buynowCC_LG.gif" 
		border="0" name="submit" 
		alt="PayPal, le réflexe sécurité pour payer en ligne">
		<img alt="" border="0" 
				src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	</form>
</div>

<?php
include 'includes/footer.php';
?>