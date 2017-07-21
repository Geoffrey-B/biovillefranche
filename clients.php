<?php

$titrePage = "Bio Villefranche - Administration";
include 'includes/header.php';

//Vérification si admin moggué
if(isset($_SESSION['admin'])){

    //Liste des catégories
    $rqCli = "SELECT * FROM clients";
    $listeClients = $dbh->query($rqCli)->fetchAll();
?>

<div class="row">
    <!--    Affichage de la liste des produits-->
    <div class="col-md-12">
        <table class="table table-striped">
            <thead>
                <tr class="gestion"><td colspan="10"><strong>Gestion des clients</strong></td></tr>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>CP</th>
                    <th>Ville</th>
                    <th>Mail</th>
                    <th>Tel</th>
                    <th>Actif</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
    foreach($listeClients as $client):?>
                <tr>
                    <td><?= $client['idClient']; ?></td>
                    <td><?= $client['nomClient']; ?></td>
                    <td><?= $client['prenomClient']; ?></td>
                    <td><?= $client['adresseClient']; ?></td>
                    <td><?= $client['cpClient']; ?></td>
                    <td><?= $client['villeClient']; ?></td>
                    <td><?= $client['mailClient']; ?></td>
                    <td><?= $client['telClient']; ?></td>
                    <td><?= $client['actif']; ?></td>
                    <td><a href="suppClient.php?id=<?= $client['idClient'];?>" id="suppClient"><i class="glyphicon btn btn-danger glyphicon-trash"></i></a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

    </div>
</div>




<?php

} else header('location: index.php');

include 'includes/footer.php';
?>