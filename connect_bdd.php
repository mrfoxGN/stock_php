<?php
// connexion avec server
$con = mysqli_connect("127.0.0.1", "root", "");
if (!$con) die("Echec de la connexion!");

// Importer le contenut du fichier SQL
$sql = file_get_contents("bdd.sql");

// Creation de bdd et les tables
if(!mysqli_multi_query($con, $sql)) die("Error d'importer le fichier SQL!");
else {
    header("Location: http://127.0.0.1/phpmyadmin/index.php?route=/server/databases");
    exit();
};
?>