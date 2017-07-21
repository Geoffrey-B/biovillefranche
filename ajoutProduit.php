<?php 
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);

// Verification si existe déjà
$rqVerif = "SELECT COUNT(*)
            FROM produits
            WHERE nom = :nom";
$stmtVerif = $dbh->prepare($rqVerif); //preparation
$params = array(':nom' => $safe['nom']);
$stmtVerif->execute($params); //execution
$exists = $stmtVerif->fetchColumn(); //contient 0 ou 1

if($_FILES['photo']['error'] > 0){
    echo '<p> Une erreur s\'est produite.</p>';
}
//Le fichier est bien téléchargé
else {
    //Récupération de la taille des images
    $size = getimagesize($_FILES['photo']['tmp_name']);
//    print_r($size);
    if(!$size) echo '<p>Le fichier selectionné n\'est pas une image</p>';
    
    //Récupération du type MIME du fichier
    $info = new finfo(FILEINFO_MIME_TYPE);
    $mime = $info->file($_FILES['photo']['tmp_name']);
    var_dump($mime);
    
    //changer le nom du fichier téléchargé
    $extension = substr($_FILES['photo']['name'], strrpos($_FILES['photo']['name'], '.'));
    $nomFichier = md5(uniqid(rand(), true));
    
    $up = move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$nomFichier.$extension);
}

//Ajout
if($exists == 0)
{
    $reqAjout = "INSERT INTO produits(nom, origine, prix, poids, pxkilo, reference, idSCategorie, description, stocks, delaislivraison, photo, idFournisseur) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtAjout = $dbh->prepare($reqAjout);
    $add = $stmtAjout->execute(array($safe['nom'],$safe['origine'],$safe['prix'],$safe['poids'],$safe['pxkilo'],$safe['reference'],$safe['idSCategorie'],$safe['description'],$safe['stocks'],$safe['delaislivraison'],($nomFichier.$extension),$safe['idFournisseur']));
    if($add !== false){
        header('location:admin.php');
    }
    else echo '<div class="alert alert-danger">Oups !<br><a href="#" onclick="window.history.go(-1); return false;">Recommencer</a></div>';
}
else{
    echo '<div class="alert alert-danger">Produit déja existant !<br><a href="#" onclick="window.history.go(-1); return false;">Recommencer</a></div>';
}


include 'includes/footer.php';
?>