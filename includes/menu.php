<?php
// Liste des catégories et sous-catégories pour les produits vendus
$rqSCatMenu = "SELECT s.idsCategories, s.libSCategorie, c.libCategorie FROM scategories as s JOIN categories as c ON c.idCategorie = s.idCategorie WHERE idsCategories IN(SELECT DISTINCT idSCategorie FROM produits) ORDER BY s.idCategorie ASC";

//Pas de paramètres donc query
$stmtSCatMenu = $dbh->query($rqSCatMenu);
//Récupération de la liste
$listeSCatMenu = $stmtSCatMenu->fetchAll();
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#monMenu" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="index.php" class="navbar-brand">Accueil</a>
        </div>
        <!--PARTIE DYNAMIQUE DU MENU-->
        <div class="collapse navbar-collapse" id="monMenu">
<!--        Liste des sous catégories-->
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Produits <span class="caret"></span></a>
                    <ul class="dropdown-menu">
<!--                        Liste des sous catégories depuis BDD-->
                        <!--                        <li><a href="produits.php?scat=1">libcategorie libSCategorie</a>-->
                        <?php
                        foreach($listeSCatMenu as $sCMenu){
                            $href='produits.php?id='.$sCMenu['idsCategories'];
                            //Le texte du lien categorie + scategorie
                            $libelle = $sCMenu['libCategorie'].' '.$sCMenu['libSCategorie'];
                            echo '<li><a href="'.$href.'">'.$libelle.'</a></li>';
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            
<!--            Formulaire de recherche-->
            <form class="navbar-form navbar-right" method="post" action="recherche.php">
                <div class="form-group">
                    <input type="text" class="form-control" name="recherche" placeholder="Recherche" id="recherche" />
                </div>
                <button type="submit" class="btn btn-default" id="rech">Rechercher</button>
            </form>
            
            <?php if(isset($_SESSION['admin'])): ?>
            <p class="navbar-text">
                Bonjour <?= $_SESSION['prenom']; ?>
            </p>
            
            
            <ul class="nav navbar-nav navbar-right">
                <li><a href="clients.php">Clients</a></li>
                <li><a href="admin.php">Produits</a></li>
                <li><a href="quitter.php">Déconnecter</a></li>
            </ul>
            <?php elseif(isset($_SESSION['auth'])): ?>
<!--            Menu si connecté-->
            <p class="navbar-text">
                Bonjour <?= $_SESSION['prenom']; ?>
            </p>
            
            
            <ul class="nav navbar-nav navbar-right">
                <li><a href="panier.php">Panier</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="quitter.php">Déconnecter</a></li>
            </ul>
            <?php else: ?>
<!--            Menu si non connecté-->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="login.php">Connexion</a></li>
            </ul>
            <?php endif; ?>
        </div> 
        <!--FIN PARTIE DYNAMIQUE DU MENU -->
    </div>
</nav>