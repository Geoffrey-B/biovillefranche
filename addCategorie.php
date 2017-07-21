<?php 
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);

// Verification si existe déjà
$rqVerif = "SELECT COUNT(*)
            FROM categories
            WHERE libCategorie = :libCategorie";
$stmtVerif = $dbh->prepare($rqVerif); //preparation
$params = array(':libCategorie' => $safe['libCategorie']);
$stmtVerif->execute($params); //execution
$exists = $stmtVerif->fetchColumn(); //contient 0 ou 1

//Ajout
if($exists == 0)
{
    $reqAjout = "INSERT INTO categories(libCategorie) VALUE (?)";
    $stmtAjout = $dbh->prepare($reqAjout);
    $add = $stmtAjout->execute(array($safe['libCategorie']));
    if($add !== false){
        header('location:admin.php');
    }
    else echo '<div class="alert alert-danger">Oups !</div>';
}
else{
    echo '<div class="alert alert-danger">Catégorie déja existante !</div>';
}


include 'includes/footer.php';
?>
