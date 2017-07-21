<?php
$titrePage = 'BioVillefranche - Inscription';
include 'includes/header.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);
$errors = array();

//Contrôle email
if(!filter_var($safe['mailClient'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Adresse mail non valide';
}

//Contrôle mot de passe
$mdp = $safe['passClient'];
$longueur = strlen($mdp);
if ($longueur < 8) $errors[] = 'Mot de passe trop court';

$nbInt = $nbMaj = 0;
for($i=0; $i<$longueur; $i++) {
    if(is_numeric($mdp[$i])) $nbInt++;
    else if(strtoupper($mdp[$i])==$mdp[$i]) $nbMaj++;
}
if($nbInt < 1) {
    $errors[] = 'Le mot de passe doit contenir au moins un chiffre';
}
if($nbMaj < 1) {
    $errors[] = 'Le mot de passe doit contenir au moins une majuscule';
}

//L'adresse mail est-elle déjà dans la table clients ?
$rqVerif = "SELECT COUNT(*) FROM clients WHERE mailClient = :mailClient";
//Préparation
$stmtVerif = $dbh->prepare($rqVerif);
//Paramètres
$paramVerif = array(':mailClient' => $safe['mailClient']);
//Exécution
$stmtVerif->execute($paramVerif);
//Récupération
$exists = $stmtVerif->fetchColumn();
//Si > 0 erreur
if($exists>0){
    $errors[] = "L'adresse mail existe déjà";
}


if(count($errors)==0) {
    //Hashage mot de passe
    $hash = password_hash($mdp, PASSWORD_DEFAULT);

    //Ajout dans la base de données
    $req = "INSERT INTO clients(nomClient, prenomClient, adresseClient, cpClient, villeClient, mailClient, passClient, telClient, remiseClient, actif)
        VALUES(:nomClient, :prenomClient, :adresseClient, :cpClient, :villeClient, :mailClient, :passClient, :telClient, :remiseClient, :actif)";

    //Préparation
    $stmt = $dbh->prepare($req);

    //Paramètres
    $params = array(':nomClient' => $safe['nomClient'],
                    ':prenomClient' => $safe['prenomClient'],
                    ':adresseClient' => $safe['adresseClient'],
                    ':cpClient' => $safe['cpClient'],
                    ':villeClient' => $safe['villeClient'],
                    ':mailClient' => $safe['mailClient'],
                    ':passClient' => $hash,
                    ':telClient' => $safe['telClient'],
                    ':remiseClient' => 0,
                    ':actif' => 1);

    //Exécution
    if($stmt->execute($params)){
        //Message retour
        echo '<div class="alert alert-success">Merci pour votre inscription</div>';
    } else echo '<div class="alert alert-danger">Erreur de requête</div>';
} else {
    $liste = ''; //Chaîne vide
    foreach($errors as $erreur){
        $liste .= '<li>'.$erreur.'</li>';
    }
    echo '<div class="alert alert-danger">Des erreurs sont à corriger :<ul>'.$liste.'</ul></div>';
}



include 'includes/footer.php';
?>