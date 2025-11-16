<?php
$con = mysqli_connect("127.0.0.1", "root", "", "gestion_stock");
if (!$con) die("Erreur connexion BDD");

$supp = $_POST['prd'];
$req = "DELETE FROM Produits WHERE Nom_Produit = '$supp'";
if(!mysqli_query($con, $req)){
    header('Location: produit.php?msg=err_del');
    exit();
} else {
    header('Location: produit.php?msg=ok_del');
}
?>