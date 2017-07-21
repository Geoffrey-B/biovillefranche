<?php

$titrePage = 'Bio Villefranche - Panier';
include 'includes/header.php';


$rqPanierVide = "SELECT COUNT(*) FROM paniers WHERE idClient = :idClient";
$stmtPanierVide = $dbh->prepare($rqPanierVide);
$paramsPanierVide = array('idClient' => $_SESSION['id']);
$stmtPanierVide->execute($paramsPanierVide);
$exists = $stmtPanierVide->fetchColumn();

if($exists == 0) {
    echo '<p class="gros alert alert-warning text-center">Panier vide !</p>';
} else {

//qu'y-a-t-il dans mon panier ?
$rqPanier = "SELECT p.idPanier, a.photo, p.idProduit, p.quantite, a.nom, a.prix, a.stocks FROM paniers as p JOIN produits as a ON a.idProduit = p.idProduit WHERE p.idClient = :idClient";
$stmtPanier = $dbh->prepare($rqPanier);
$params = array(':idClient' => $_SESSION['id']);
$stmtPanier->execute($params);
$listePanier = $stmtPanier->fetchAll();
//Prix total à payer
$total = 0;

?>
<table class="table table-striped">
    <thead>
        <tr>
            <th id="paniert">Produit</th>
            <th id="paniert">Nom</th>
            <th id="paniert">Prix</th>
            <th id="paniert">Quantité</th>
            <th id="paniert">Actions</th>
            <th id="paniert">Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($listePanier as $achat) : ?>
        <tr>
            <td id="paniert"><img src="images/<?= $achat['photo']; ?>" height="80px"></td>
            <td id="paniert"><?= $achat['nom']; ?></td>
            <td id="paniert"><?= number_format($achat['prix'], 2, ',', ' '); ?> €</td>
            <td id="paniert"><?= $achat['quantite']; ?></td>
            <td id="paniert">
                <form method="post" action="modifPanier.php" class="form-inline">
                    <input type="hidden" name="idPanier" value="<?= $achat['idPanier']; ?>">
                    <input type="number" name="quantite" min="1" max="<?= $achat['stocks']; ?>" value="<?= $achat['quantite']; ?>"class="form-control">
                    <button type="submit" name="btnModif" value="Modifier" class="btn btn-xs btn-warning glyphicon glyphicon-pencil"></button>           
                    <button type="submit" name="btnSupp" value="Supprimer" class="btn btn-xs btn-danger glyphicon glyphicon-trash"></button>      
                </form>
            
            </td>
            <td id="paniert"><?= number_format(($achat['prix'] * $achat['quantite']), 2, ',', ' '); ?> €</td>        
        </tr>
        
        <?php $total += $achat['prix'] * $achat['quantite'];
        endforeach;
        ?>    
    </tbody>
    <tfoot>
        <tr class="success">
            <td colspan="5" id="paniertf">A payer :</td>
            <td id="paniert"><?= number_format($total, 2, ',', ' '); ?> €</td>
        </tr>
    
    </tfoot>
</table>
<div class="text-center">
    <a href="validePanier.php" class="btn btn-lg btn-success">Commander</a>
</div>


<?php
//Enregistrement du montant total en session
$_SESSION['totalFacture'] = $total;
}
include 'includes/footer.php';
        ?>