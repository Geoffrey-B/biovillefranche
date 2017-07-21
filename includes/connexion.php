<?php

$dbh = new PDO('mysql:host=localhost;dbname=biovillefranche;charset=utf8', 'root', '');

//Pour forcer le type de récupération (assiociatif)
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

//Mode Debug SQL
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

?>