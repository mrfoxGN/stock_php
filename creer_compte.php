<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        form {
            width: 350px;
            margin: 0 auto;
            text-align: left;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }
        p, a {
            text-align: center;
            color: #555;
            font-size: 14px;
            margin-bottom: 25px;
        }
        label {
            display: block; 
            font-weight: 600;
            color: #444;
        }
        input[type="number"], input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px 12px;
            margin-top: 6px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
        input[type="submit"], input[type="reset"] {
            width: 48%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        .cree {
            background-color: #007BFF; /* Blue */
            color: white;
        }
        .cree:hover {
            background-color: #0056b3;
        }
        .eff {
            background-color: #ccc; /* Grey */
            color: #333;
        }
        .eff:hover {
            background-color: #999;
        }
    </style>
    <title>Compte</title>
</head>
<body>
    <h1>Stock de produit</h1>
    <?php if (isset($_GET["error"]) && $_GET["error"] == "email_exist"): ?>
    <p style="color:red; font-weight:bold;">
        ⚠ Cet email existe déjà !
    </p>
<?php endif; ?>
    <p><font size="4"> Veuillez remplir les champs suivant!</font></p>
    <form method="post" action="user.php">
        <input type="hidden" name="source" value="login_form">
        <label><b>Nom</b></label>
        <input type="text" name="nom" pattern="[a-zA-Z]+" required>
        
        <label><b>Prenom</b></label>
        <input type="text" name="prenom" pattern="[a-zA-Z]+" required>
        
        <label><b>Age</b></label>
        <input type="number" name="age" required>
        
        <label><b>Email</b></label>
        <input type="text" name="email" pattern="[a-zA-Z0-9_]+@[a-z]+\.[a-z]{2,4}" title="exemple@domain.com" required>
        
        <label><b>Nouveau Password</b></label>
        <input type="password" name="past" pattern="[a-zA-Z0-9_@$]{8,30}" title="entrer au moins 8 caractères" required>
        
        <div class="button-container">
            <input type="submit" value="Créer" class="cree">
            <input type="reset" value="Effacer" class="eff">
        </div>
        <center><a href="connect_user.php"><font size ="3"><u>J'ai déja un compte.</u></font></a></center>
    </form>
</body>
</html>