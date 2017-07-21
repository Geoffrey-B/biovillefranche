<?php

$titrePage = 'BioVillefranche - Administration';
include 'includes/header.php';
?>

<div class="col-md-offset-3 col-md-6">
    <form method="post" action="admLogin2.php">
        <div class="form-group">
            <label>Login</label>
            <input type="text" name="login" class="form-control">    
        </div>
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" name="password" class="form-control">    
        </div>
        <div class="form-group text-center">
            <input type="submit" name="btnSub" value="Entrer" class="btn btn-lg btn-danger">    
        </div>
    </form>
</div>

<?php
include 'includes/footer.php';
?>