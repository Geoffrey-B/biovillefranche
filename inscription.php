<?php

$titrePage = "BioVillefranche - Inscription";
include 'includes/header.php';

?>

<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <form method="post" action="ajoutClient.php">
            <div class="form-group">
                <label>Nom</label>
                <input type="text" name="nomClient" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenomClient" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Adresse</label>
                <input type="text" name="adresseClient" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Code postal</label>
                <input type="text" name="cpClient" maxlength="5" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Ville</label>
                <input type="text" name="villeClient" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Adresse mail</label>
                <input type="email" name="mailClient" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Téléphone</label>
                <input type="text" name="telClient" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="passClient" class="form-control" required />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-success" name="btnSub" value="Ajouter">
            </div>

        </form>
    </div>
</div>

<?php
include 'includes/footer.php';
?>