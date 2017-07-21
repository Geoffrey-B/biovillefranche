<?php

$titrePage = 'BioVillefranche - Contactez-nous';
include 'includes/header.php';

//Récupération de la bibliothèque PHPMailer
require 'includes/phpmailer/PHPMailerAutoload.php';

//Mr Propre
$safe = array_map('strip_tags', $_POST);
$mail = new PHPMailer; //nouvel objet de type mail
$mail->isSMTP(); //connexion directe au serveur SMTP
$mail->isHTML(true); //Utilisation du format HTML
$mail->Host = 'smtp.gmail.com'; //Le serveur de messagerie
$mail->Port = 465; //Port obligatoire de google
$mail->SMTPAuth = true; //On va fournir login/password
$mail->SMTPSecure = 'ssl'; //Certificat SSL
$mail->Username = 'wf3villefranche@gmail.com'; //Utilisateur SMTP
$mail->Password = 'Azerty1234'; //mdp utilisateur SMTP
$mail->setFrom('wf3villefranche@gmail.com', 'Bio Villefranche'); //Expéditeur du mail
$mail->addAddress('anaidbgraph@hotmail.fr'); //Destinataire du mail
$mail->Subject = 'Message de '.$safe['prenom'].' '.$safe['nom'];
$mail->Body = '<html>
                    <head>
                        <style>
                            h1{color:green; }
                        </style>
                    </head>
                    <body>
                        <h1>Message de '.$safe['email'].'</h1>
                        <p>'.$safe['message'].'</p>
                    </body>
                </html>'; //Le corps du mail

if(!$mail->send()) //si l'envoi échoue
{
    echo '<p class="alert alert-danger">Erreur envoi '.$mail->ErrorInfo.'</p>';
} else echo '<p class="alert alert-success">Votre message a bien été envoyé. Merci.</p>';


include 'includes/footer.php';
?>
