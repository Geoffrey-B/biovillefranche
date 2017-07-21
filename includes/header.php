<?php
session_start();//toujours en haut
//Connexion BDD
include "includes/connexion.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE-Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= $titrePage; ?></title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css" type="text/css">
    </head>
    <body>
        <div class="container">
            <header>
                <div class="row">
                    <div class="col-md-4">
                        <img src="images/logo.png" alt="BioVillefranche" class="logo">
                    </div>
                    <div class="col-md-8">
                        <hgroup>
                            <h1>Bio Villefranche</h1>
                            <h2>Votre épicerie Bio à Villefranche</h2>
                        </hgroup>
                    </div>
                </div>
            </header>
            <?php
            //menu de navigation
            include "includes/menu.php"
            ?>