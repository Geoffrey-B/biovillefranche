<?php

$titrePage = "BioVillefranche - Mot de passe perdu";
include 'includes/header.php';



//L'adresse mail est-elle dans la table client

$email = strip_tags($_POST['mailClient']);

$rqMail = "SELECT COUNT(*) FROM clients WHERE mailClient = :mailClient";
$stmtMail = $dbh->prepare($rqMail);
$params = array(':mailClient' => $email);
$stmtMail->execute($params);
$exists = $stmtMail->fetchColumn();

//Si le client existe
if($exists == 1) {
    //Génération d'un token
    $token = md5($email.date('YmdHis'));

    //Envoi du mail
    require 'includes/phpmailer/PHPMailerAutoload.php';
    $mail = new PHPMailer; //nouvel objet de type mail
    $mail->CharSet="UTF-8";
    $mail->isSMTP(); //connexion directe au serveur SMTP
    $mail->isHTML(true); //Utilisation du format HTML
    $mail->Host = 'smtp.gmail.com'; //Le serveur de messagerie
    $mail->Port = 465; //Port obligatoire de google
    $mail->SMTPAuth = true; //On va fournir login/password
    $mail->SMTPSecure = 'ssl'; //Certificat SSL
    $mail->Username = 'wf3villefranche@gmail.com'; //Utilisateur SMTP
    $mail->Password = 'Azerty1234'; //mdp utilisateur SMTP
    $mail->setFrom('wf3villefranche@gmail.com', 'Bio Villefranche'); //Expéditeur du mail
    $mail->addAddress($email); //Destinataire du mail
    $mail->Subject = 'Bio Villefranche - Récupération de votre mot de passe';
    $mail->Body = '<html>
                    <head>
                        <style>
                            h3{color:green; }
                        </style>
                    </head>
                    <body>
                        <h3>Vous avez signalé votre mot de passe perdu...</h3>
                        <p><a href="http://'.$_SERVER['SERVER_NAME'].'/biovillefranche/perdu3.php?token='.$token.'">Réinitialiser votre mot de passe</a></p>
                    </body>
                </html>'; //Le corps du mail

    if(!$mail->send()) //si l'envoi échoue
    {
        echo '<div class="alert alert-danger">Erreur de mail : '.$mail->ErrorInfo.'</div>';
    } else  //Si envoi ok
    {
        //MAJ BDD  
        $rqMaj = "UPDATE clients SET token = :token WHERE mailClient = :mailClient";
        $stmtMaj = $dbh->prepare($rqMaj);
        $param2 = array(':mailClient' => $email, ':token' => $token);
        $stmtMaj->execute($param2);        
        
        //Message de retour         
        echo '<div class="alert alert-success">Un mail vient de vous être envoyé pour renouveler votre mot de passe</div>';

}
}else echo '<div class="alert alert-danger">Votre adresse mail est inconnue</div>';


include 'includes/footer.php';
?>