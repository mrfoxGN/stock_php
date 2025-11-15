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
        input[type="password"], input[type="text"] {
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
        .ajouter {
            background-color: #007BFF; /* Blue */
            color: white;
        }
        .ajouter:hover {
            background-color: #0056b3;
        }
        .annuler {
            background-color: #ccc; /* Grey */
            color: #333;
        }
        .annuler:hover {
            background-color: #999;
        }
    </style>
    <title>User</title>
</head>
<body>
    <h1>Stock de produit</h1>
    <p><font size="3">Connecter vous!</font></p>
    <form method="post" action="user.php">
        <input type="hidden" name="source" value="user_form">

        <label><b>Email</b></label>
        <input type="text" name="mail" pattern="[a-zA-Z0-9_]+@[a-z]+\.[a-z]{2,4}$" title="exemple@domain.com" required>

        <label><b>Password</b></label>
        <input type="password" name="pasc" pattern="[a-zA-Z0-9_@$]{8,30}" title="entrer au moins 8 caractères" required>

        
        <div class="button-container">
            <input type="submit" value="Connexion" class="ajouter">
            <input type="reset" value="Effacer" class="annuler">
        </div>
        <center><a href="creer_compte.php"><font size="3"><u>Créer un compte</u></font></a></center>
    </form>
</body>
</html>