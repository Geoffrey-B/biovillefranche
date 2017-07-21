<?php

$titrePage = "BioVillefranche - Modification du mot de passe";
include 'includes/header.php';
include 'includes/toolbox.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);

$hash = password_hash($safe['passClient'], PASSWORD_DEFAULT);

if(verifPassword($_POST['passClient']) == true) {

    if(($safe['passClient']) == ($safe['passClient2'])){

        //Mise à jour du mot de passe et suppression du token
        $rqMajMdp = "UPDATE clients SET passClient = :passClient, token = '' WHERE idClient = :idClient";
        $stmtMajMdp = $dbh->prepare($rqMajMdp);
        $params=array(':passClient' => $hash, ':idClient' => $safe['idClient']);
        if($stmtMajMdp->execute($params)){
            //Message de succès
            echo '<div class="alert alert-success">Votre mot de passe a été modifié avec succès</div>';
        } else echo '<div class="alert alert-danger">Oupssss</div>';

    } else echo '<div class="alert alert-danger">Les mots de passe doivent être indentiques.<a href="#" onclick="window.history.go(-1); return false;">Recommencer</a></div>';

} else echo '<div class="alert alert-danger">Votre mot de passe doit contenir au moins 8 caractères, une majuscule et un chiffre.<br><a href="#" onclick="window.history.go(-1); return false;">Recommencer</a></div>';


include 'includes/footer.php';
?>