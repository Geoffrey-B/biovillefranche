<?php

$titrePage = "BioVillefranche - Mot de passe perdu";
include 'includes/header.php';

?>

<div class="row">
    <form method="post" action="perdu2.php" class="col-md-offset-4 col-md-4">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="mailClient" class="form-control" required />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success" name="btnSub" value="Demander">
        </div>
    </form>
</div>








<?php
include 'includes/footer.php';
?>