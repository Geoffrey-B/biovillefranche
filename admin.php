<?php

$titrePage = "Bio Villefranche - Administration";
include 'includes/header.php';

//Vérification si admin moggué
if(isset($_SESSION['admin'])){

    //Liste des catégories
    $rqCat = "SELECT * FROM categories";
    $listeCategories = $dbh->query($rqCat)->fetchAll();

    //Liste des sous-catégories
    $rqSCat = "SELECT s.*, c.libCategorie FROM scategories as s JOIN categories as c ON c.idCategorie = s.idcategorie ORDER BY s.idcategorie ASC";
    $listeSCategories = $dbh->query($rqSCat)->fetchAll();

    //Liste des produits
    $rqProd="SELECT * FROM produits";
    $listeProduits = $dbh->query($rqProd)->fetchAll();

    //$rqSCat="SELECT idsCategories, libSCategorie FROM scategories";
    //$listeSCat = $dbh->query($rqSCat)->fetchAll();

    $rqFour="SELECT RS, idFournisseur, nom, prenom, email, tel, rue, cp, ville FROM fournisseurs";
    $listeFour = $dbh->query($rqFour)->fetchAll();

    //Liste des catégories/sous-catégories
    $rqCatScat="SELECT s.idsCategories, s.libSCategorie, c.libCategorie FROM scategories as s JOIN categories as c ON c.idCategorie = s.idcategorie ORDER BY s.idcategorie ASC";
    $listeCatScat = $dbh->query($rqCatScat)->fetchAll();
?>

<div class="row">
    <div class="col-md-9">
        <table class="table table-striped">
            <thead>
                <tr class="gestion"><td colspan="4"><strong>Gestion des catégories</strong></td></tr>
                <tr>
                    <th>ID</th>
                    <th>Catégorie</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
    foreach($listeCategories as $cat):?>
                <tr>
                    <td><?= $cat['idCategorie']; ?></td>
                    <td>
                        <form action="modifCategorie.php" method="post" class="form-inline">
                            <input type="hidden" name="idCategorie" value="<?=$cat['idCategorie']; ?>">
                            <input type="text" name="libCategorie" value="<?=$cat['libCategorie']; ?>" class="form-control">
                            <button type="submit" name="btnSub" class="btn btn-warning glyphicon glyphicon-pencil"></button>
                        </form>
                    </td>
                    <td><a href="supCategorie.php?id=<?= $cat['idCategorie'];?>"><i class="glyphicon btn btn-danger glyphicon-trash"></i></a></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="3">
                        <form method="post" action="addCategorie.php" class="inline-form">
                            <label>Ajouter une catégorie :</label><br>
                            <label>Libellé :</label>
                            <input type="text" name="libCategorie" class="form-control">
                            <input type="submit" name="btnSub" value="Ajouter" class="btn btn-primary">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped">
            <thead>
                <tr class="gestion"><td colspan="4"><strong>Gestion des sous-catégories</strong></td></tr>
                <tr>
                    <th>ID</th>
                    <th>Catégorie</th>
                    <th>Sous-catégorie</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
    foreach($listeSCategories as $scat):?>
                <tr>
                    <td><?= $scat['idsCategories']; ?></td>
                    <td><?= $scat['libCategorie']; ?></td>
                    <td>
                        <form action="modifSCategorie.php" method="post" class="form-inline">
                            <input type="hidden" name="idsCategories" value="<?=$scat['idsCategories']; ?>">
                            <input type="text" name="libSCategorie" value="<?=$scat['libSCategorie']; ?>" class="form-control">
                            <button type="submit" name="btnSub" class="btn btn-warning glyphicon glyphicon-pencil"></button>
                        </form>
                    </td>
                    <td><a href="supSCategorie.php?id=<?= $scat['idsCategories'];?>"><i class="glyphicon btn btn-danger glyphicon-trash"></i></a></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="4">
                        <form method="post" action="addSCategorie.php" class="inline-form">
                            <label>Ajouter une sous-catégorie :</label><br>
                            <label>Libellé :</label>
                            <input type="text" name="libSCategorie" class="form-control">
                            <div class="form-group">
                                <label>Catégorie :</label>
                                <select name="idCategorie" class="form-control">
                                    <option value="" disabled selected>Sélectionnez une catégorie</option>
                                    <?php foreach($listeCategories as $Cat){
        echo '<option value="'.$Cat['idCategorie'].'">'.$Cat['libCategorie'].'</option>';
    }
                                    ?>
                                </select>
                            </div>
                            <input type="submit" name="btnSub" value="Ajouter" class="btn btn-primary">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped">
            <thead>
                <tr class="gestion"><td colspan="4"><strong>Gestion des fournisseurs</strong></td></tr>
                <tr>
                    <th>ID</th>
                    <th>Fournisseur</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
    foreach($listeFour as $four):?>
                <tr>
                    <td><?= $four['idFournisseur']; ?></td>
                    <td>
                        <form action="modifFournisseur.php" method="post" class="form-inline">
                            <input type="hidden" name="idFournisseur" value="<?=$four['idFournisseur']; ?>">
                            <input type="text" name="RS" value="<?=$four['RS']; ?>" class="form-control">
                            <button type="submit" name="btnSub" class="btn btn-warning glyphicon glyphicon-pencil"></button>
                        </form>
                    </td>
                    <td><a href="supFournisseur.php?id=<?= $four['idFournisseur'];?>"><i class="glyphicon btn btn-danger glyphicon-trash"></i></a></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="3">
                        <form method="post" action="addFournisseur.php" class="inline-form">
                            <label>Ajouter un fournisseur :</label>
                            <div class="form-group">
                                <label>Raison sociale :</label>
                                <input type="text" name="RS" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nom :</label>
                                <input type="text" name="nom" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Prénom :</label>
                                <input type="text" name="prenom" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Email :</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Téléphone :</label>
                                <input type="text" name="tel" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Rue :</label>
                                <input type="text" name="rue" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Code postal :</label>
                                <input type="number" name="cp" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ville :</label>
                                <input type="text" name="ville" class="form-control">
                            </div>
                            <input type="submit" name="btnSub" value="Ajouter" class="btn btn-primary">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--    Affichage de la liste des produits-->





    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr class="gestion"><td colspan="4"><strong>Gestion des produits</strong></td></tr>
                <tr>
                    <th>ID</th>
                    <th>Produit</th>
                    <th>Stock</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
    foreach($listeProduits as $produit):?>
                <tr>
                    <td><?= $produit['idproduit']; ?></td>
                    <td>
                        <form action="renameProduit.php" method="post" class="form-inline">
                            <input type="hidden" name="idproduit" value="<?=$produit['idproduit']; ?>">
                            <input type="text" name="nom" value="<?=$produit['nom']; ?>" class="form-control">
                            <button type="submit" name="btnSub" class="btn btn-warning glyphicon glyphicon-pencil"></button>
                        </form>
                    </td>
                    <td>
                        <form action="modifStock.php" method="post" class="form-inline">
                            <input type="hidden" name="idproduit" value="<?=$produit['idproduit']; ?>">
                            <input type="text" name="stock" value="<?=$produit['stocks']; ?>" class="form-control">
                            <button type="submit" name="btnSub" class="btn btn-warning glyphicon glyphicon-pencil"></button>
                        </form>
                    </td>
                    <td><a href="suppProduit.php?id=<?= $produit['idproduit'];?>"><i class="glyphicon btn btn-danger glyphicon-trash"></i></a></td>
                </tr>
                <?php endforeach;?>
                <tr>
                    <td colspan="4">
                        <form method="post" action="ajoutProduit.php" enctype="multipart/form-data">
                            <label>Ajouter un produit :</label>
                            <div class="form-group">
                                <label>Nom :</label>
                                <input type="text" name="nom" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Origine :</label>
                                <input type="text" name="origine" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Prix :</label>
                                <input type="text" name="prix" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Poids :</label>
                                <input type="text" name="poids" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Prix au kilo :</label>
                                <input type="text" name="pxkilo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Référence :</label>
                                <input type="text" name="reference" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Sous-catégorie :</label>
                                <select name="idSCategorie" class="form-control">
                                    <option value="" disabled selected>Sélectionnez une sous-catégorie</option>
                                    <?php foreach($listeCatScat as $sCat){
        echo '<option value="'.$sCat['idsCategories'].'">'.$sCat['libCategorie'].' '.$sCat['libSCategorie'].'</option>';
    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Description :</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Stocks :</label>
                                <input type="text" name="stocks" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Delais de livraison :</label>
                                <input type="text" name="delaislivraison" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Photo :</label>
                                <input type="file" name="photo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Fournisseur :</label>
                                <select name="idFournisseur" class="form-control">
                                    <option name="" disabled selected>Selectionnez un fournisseur</option>
                                    <?php foreach($listeFour as $four){
                                        echo '<option value="'.$four['idFournisseur'].'">'.$four['RS'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" name="btnSub" class="btn btn-primary" value="Ajouter">
                            </div>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>




<?php

} else header('location: index.php');

include 'includes/footer.php';
?>