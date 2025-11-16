<?php
session_start();
$idu=$_SESSION['IdU'];
echo "------------$idu-----";
// Sécurité : user non connecté
/*if (!isset($_SESSION['user_id'])) {
    header('Location: connect_user.php');
    exit();
}

$idUser = $_SESSION['user_id'];

$nom   = $_POST['NomProd'];
$Cat = $_POST['Categorie'];
$qte   = $_POST['Quantite'];
$prix  = $_POST['Prix'];
$ref   = $_POST['cmnt'];


if ($nom === '') {
    header('Location: produit.php?msg=err');
    exit();
}

$con = mysqli_connect("127.0.0.1", "root", "", "gestion_stock");
if (!$con) {
    header('Location: produit.php?msg=err');
    exit();
}

$nom = mysqli_real_escape_string($con, $nom);
$ref = mysqli_real_escape_string($con, $ref);

// ⚠️ ici on utilise IdU (ton nom de colonne)
$sql = "INSERT INTO Produits (IdU, Nom_produit, Prix, Quantite,Categorie, commentaire)
        VALUES ('$idUser', '$nom', $prix, $qte, '$Cat', '$ref')";

if (mysqli_query($con, $sql)) {
    header('Location: produit.php?msg=ok');
} else {
    header('Location: produit.php?msg=err');
}
exit();*/
