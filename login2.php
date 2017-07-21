<?php session_start();
//Connexion BDD
include 'includes/connexion.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);

//Adresse mail existe ?
$rqVerif = "SELECT COUNT(*)
            FROM clients
            WHERE mailClient = :mailClient";
$stmtVerif = $dbh->prepare($rqVerif);
$paramVerif = array(':mailClient' => $safe['mailClient']);
$stmtVerif->execute($paramVerif);
$exists = $stmtVerif->fetchColumn();

if($exists==1){
//Récupération du mot de passe
    $rqClient = "SELECT idClient, nomClient, prenomClient, passClient
                FROM clients
                WHERE mailClient = :mailClient";
    $stmtClient = $dbh->prepare($rqClient);
    $stmtClient->execute($paramVerif);
    
//Récupération des infos client
    $client = $stmtClient->fetch();

//Comparaison du mdp du formulaire et de la BDD
    if(password_verify($safe['passClient'], $client['passClient'])) {
        //Client trouvé enregistrement en session
        $_SESSION['auth'] = 'ok';
        $_SESSION['nom'] = $client['nomClient'];
        $_SESSION['id'] = $client['idClient'];
        $_SESSION['prenom'] = $client['prenomClient'];
        
        //Sécurité !
        session_regenerate_id();
        
        //Message de bienvenue et retour à l'accueil
        echo '<script>alert("Bienvenue '.$client['prenomClient'].' '.$client['nomClient'].'");window.location.href="index.php";</script>';
        
    } else echo '<script>alert("Votre mot de passe est incorrect");window.location.href="login.php";</script>';    
    
} else echo '<script>alert("Votre email est inconnu");window.location.href="login.php";</script>';
?>