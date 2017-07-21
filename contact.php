<?php

$titrePage = "Bio Villefranche - Contactez-nous";
include 'includes/header.php';
?>

<div class="row">
    <div class="col-md-offset-3 col-md-6">
        <form method="post" action="contact2.php">
            <div class="form-group">
                <label>Nom</label><span class="obligatoire"></span>
                <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Prénom</label><span class="obligatoire"></span>
                <input type="text" name="prenom" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label><span class="obligatoire"></span>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Message</label><span class="obligatoire"></span>
                <textarea name="message" rows="10" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="btnSub" value="Envoyer" class="btn btn-success">
            </div>
        </form>
        <p>
            <em>Champs obligatoires</em>
            <span class="obligatoire"></span>
        </p>
    </div>
</div>

<?php
include 'includes/footer.php';
?>