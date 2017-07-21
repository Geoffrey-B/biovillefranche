<?php

$titrePage= "Biovillefranche - Connexion";
include 'includes/header.php';
?>

<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <form method="post" action="login2.php">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="mailClient" class="form-control" required />
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="passClient" class="form-control" required />
            </div>
            <div class="form-group text-center">
                <input type="submit" name="btnSub" value="Entrer" class="btn btn-success" required />
            </div>
            <a href="perdu.php">Mot de passe perdu</a>
        </form>
    </div>
</div>



<?php
include 'includes/footer.php';
?>