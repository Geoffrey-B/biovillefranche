<?php

$titrePage = "BioVillefranche - Modification du mot de passe";
include 'includes/header.php';

//Mr Propre
$token = strip_tags($_GET['token']);

//Récupérer l'ID du client
$rqClient = "SELECT idClient FROM clients WHERE token = :token";
$stmtClient = $dbh->prepare($rqClient);
$params = array(':token' => $token);
$stmtClient->execute($params);
$idClient = $stmtClient->fetchColumn();

if($idClient !==false){
?>

<div class="row">
    <form method="post" action="perdu4.php" class="col-md-offset-4 col-md-4">
        <div class="form-group">
            <label>Nouveau mot de passe</label>
            <input type="password" name="passClient" class="form-control" required />
        </div>
        <div class="form-group">
            <label>Confirmez votre nouveau mot de passe</label>
            <input type="password" name="passClient2" class="form-control" required />
        </div>
        <input type="hidden" name="idClient" value="<?=$idClient;?>">
        <div class="form-group text-center">
            <input type="submit" name="btnSub" value="Modifier" class="btn btn-success" required />
        </div>
    </form>
</div>



<?php
} else echo '<div class="alert alert-danger">Erreur de token...</div>';
include 'includes/footer.php';
?>