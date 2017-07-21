<?php 
$titrePage = 'Bio Villefranche - Erreur';
include 'includes/header.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);

//Vérification email valide
if(!filter_var($safe['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Veuillez renseigner une <strong>adresse mail correcte</strong> pour ce fournisseur';
}

//Vérification si champs renseignés
if(trim($safe['nom']) == ''){
    $errors[]='Veuillez renseigner le <strong>nom</strong> du fournisseur';
} 
if(trim($safe['prenom']) == ''){
    $errors[]='Veuillez renseigner le <strong>prénom</strong> du fournisseur';
}
if(trim($safe['RS']) == '') {
    $errors[]='Veuillez renseigner la <strong>raison sociale</strong> du fournisseur';
}

if(count($errors)==0) {
    // Verification si existe déjà
    $rqVerifF = "SELECT COUNT(*)
            FROM fournisseurs
            WHERE RS = :RS";
    $stmtVerifF = $dbh->prepare($rqVerifF); //preparation
    $params = array(':RS' => $safe['RS']);
    $stmtVerifF->execute($params); //execution
    $exists = $stmtVerifF->fetchColumn(); //contient 0 ou 1

    //Ajout
    if($exists == 0)
    {
        $reqAjoutF = "INSERT INTO fournisseurs(nom, prenom, RS, email, tel, rue, cp, ville) VALUE (?,?,?,?,?,?,?,?)";
        $stmtAjoutF = $dbh->prepare($reqAjoutF);
        $add = $stmtAjoutF->execute(array($safe['nom'], $safe['prenom'], $safe['RS'], $safe['email'], $safe['tel'], $safe['rue'], $safe['cp'], $safe['ville']));
        if($add !== false){
            header('location:admin.php');
        }
        else echo '<div class="alert alert-danger">Oups !</div>';
    }
    else{
        echo '<div class="alert alert-danger">Fournisseur déja existant !</div>';
    }
} else {
    $liste = ''; //Chaîne vide
    foreach($errors as $erreur){
        $liste .= '<li>'.$erreur.'</li>';
    }
    echo '<div class="alert alert-danger">Des erreurs sont à corriger :<ul>'.$liste.'</ul></div>';
}

include 'includes/footer.php';
?>