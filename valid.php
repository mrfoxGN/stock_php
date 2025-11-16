<?php
session_start();

$email = $_POST['mail'];  // ton input du form
$pasc  = $_POST['pasc'];  // mot de passe

$con = mysqli_connect("127.0.0.1", "root", "", "gestion_stock");
if (!$con) die("Echec de la connexion !");

// 🔥 On demande directement l'utilisateur qui correspond
$req = "SELECT IdU, Nom, Email, Pass_word 
        FROM Users 
        WHERE Email = '$email' AND Pass_word = '$pasc'
        LIMIT 1";

$res = mysqli_query($con, $req);

if ($line = mysqli_fetch_assoc($res)) {
    // ✅ Login OK

    // 1) On garde son id dans la session
    $_SESSION['user_id']   = $line['IdU'];
    $_SESSION['user_name'] = $line['Nom'];
    $_SESSION['user_mail'] = $line['Email'];

    // 2) On l’envoie sur l’interface produit
    header("Location: produit.php");
    exit();
} else {
    // ❌ Login KO
    header("Location: connect_user.php?error=invalid_credentials");
    exit();
}
?>
