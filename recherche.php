<?php

$titrePage = 'BioVillefranche - Contactez-nous';
include 'includes/header.php';

//Mr Propre
$produit = strip_tags($_POST['recherche']);

//Requête
$rqProduit = "SELECT idProduit, origine, prix, poids, pxkilo, dluo, reference, description, stocks, photo, nom, delaislivraison, idSCategorie FROM produits WHERE nom LIKE ?";

//Préparation
$stmtProduit = $dbh->prepare($rqProduit);

//Paramètres
$params = array('%'.$produit.'%');

//Exécution
$stmtProduit->execute($params);

//Récupération
$listeProduits = $stmtProduit->fetchAll();

// Liste des catégories et sous-catégories pour les produits vendus
$rqSCatMenu = "SELECT s.idsCategories, s.libSCategorie, c.libCategorie FROM scategories as s JOIN categories as c ON c.idCategorie = s.idCategorie WHERE idsCategories IN(SELECT DISTINCT idSCategorie FROM produits) ORDER BY s.idCategorie ASC";

//Pas de paramètres donc query
$stmtSCatMenu = $dbh->query($rqSCatMenu);
//Récupération de la liste
$listeSCatMenu = $stmtSCatMenu->fetchAll();

//if($params !== array('%%')){

    echo'<section class="row">';
    foreach($listeProduits as $cpt => $produit) {
        //Une section pour 3 articles
        //Un article par produit
        echo'<article class="panel panel-default col-md-4">';
        echo'<h3 class="text-center">'.$produit['nom'].'</h3>';
        echo'<img src="images/'.$produit['photo'].'" alt="'.$produit['nom'].'" class="img-responsive img-circle">';
        echo'<p>Origine : '.$produit['origine'].'</p>';
        echo'<p>Référence : '.$produit['reference'].'</p>';
        echo'<p>Description : '.$produit['description'].'</p>';
        echo'<p>Poids : '.$produit['poids'].' kg</p>';
        echo'<p>Prix : '.$produit['prix'].' €</p>';
        echo'<p>Prix au kilo : '.$produit['pxkilo'].' €</p>';
        echo'<p>Délais de livraison : '.$produit['delaislivraison'].' jours</p>';
        echo'<p>Date limite d\'utilisation optimale : '.$produit['dluo'].'</p>';
        //Acheter si connecté et en stock
        if(isset($_SESSION['auth'])) {
            if($produit['stocks'] > 0) {
                //Formulaire de commande
                echo '<form method="post" action="commander.php">';
                echo '<input type="hidden" name="idproduit" value="'.$produit['idProduit'].'">';
                echo'<input type="hidden" name="cat" value="'.$produit['idSCategorie'].'">';
                echo'<div class="form-group">
                <label>Quantité</label>
                <input type="number" name="quantite" min="1" max="'.$produit['stocks'].'"class="form-control">
                </div>
                <div class="form-group text-center">
                <input type="submit" name="btnSub" value="Ajouter" class="btn btn-success">
                </div>';
                echo'</form>';


            } else echo '<p class="text-center rupture"><strong>Rupture de stock !</strong></p>';

        } else echo '<p class="text-center"><em>Vous devez vous authentifier pour commander.</em></p>';

        echo'</article>';

        //Pour limiter la ligne à 3 articles
        if($cpt>0 AND (($cpt+1) % 3) == 0) {   
            echo '</section><section class="row">';
        }

    } 
//}
//    else {
//    echo '<div class="alert alert-warning">Que recherchez-vous ?';
//    foreach($listeSCatMenu as $sCMenu){
//        $href='produits.php?id='.$sCMenu['idsCategories'];
//        //Le texte du lien categorie + scategorie
//        $libelle = $sCMenu['libCategorie'].' '.$sCMenu['libSCategorie'];
//        echo '<li><button><a href="'.$href.'">'.$libelle.'</a></button></li>';
//    }
//    echo '</div>';
//}
    echo'</section>';
    include 'includes/footer.php';
?>