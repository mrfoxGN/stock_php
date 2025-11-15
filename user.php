<?php

$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$age = $_POST["age"];

$email = $_POST["email"];   // email au niveau de creation
$past = $_POST["past"];    // password au niveau de creation

$source = $_POST["source"];



// password au niveau de connexion

    // connexion au server et la bdd
    $con = mysqli_connect("127.0.0.1", "root", "", "gestion_stock");

    if (!$con) die("Echec de la connexion!");

    // Sauvegarder les infos de user
    $req = "SELECT Email FROM Users";
    $exist = false;
    $emls = mysqli_query($con, $req);

    while ($line = mysqli_fetch_array($emls)){
        if ($email == $line["Email"]) {
            $exist = true;
        }
    }
    if ($exist == true) {
    header("Location: creer_compte.php?error=email_exist");
    exit();
}

    // Ajouter user
    if (!$exist) {
        $req = "INSERT INTO Users (Nom, Prenom, Age, Email, Pass_word) VALUES ('$nom', '$prenom', $age, '$email', '$past')";
        $ajouter = mysqli_query($con, $req);
        if (!$ajouter) die("Requete invalide: $req");
    }



// Aller au page de categorie
if($source = "login_form")
{
header('Location: connect_user.php');
}
?>