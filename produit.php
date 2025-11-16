<?php
session_start();

// Sécurité : si l’utilisateur n’est pas connecté → vers login
if (!isset($_SESSION['user_id'])) {
    header('Location: connect_user.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Stock</title>

    <style>
        /* GLOBAL */
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f4f6fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: linear-gradient(180deg, #1b1b2f, #1f1f38);
            color: white;
            height: 100vh;
            position: fixed;
            padding: 25px;
            box-shadow: 3px 0 8px rgba(0,0,0,0.2);

            display: flex;            /* NEW */
            flex-direction: column;   /* NEW */
        }

        .sidebar h2 {
            font-size: 22px;
            margin-bottom: 25px;
        }

        .sidebar a {
            display: block;
            padding: 12px 10px;
            margin-bottom: 8px;
            color: #cfd0ff;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.2s;
            font-size: 15px;
        }

        .sidebar a:hover {
            background: #30304d;
            color: #fff;
            padding-left: 18px;
        }

        .logout-link {
            margin-top: 700px;         /* PUSHED TO BOTTOM */
            background: #3d3d5c;
        }

        .logout-link:hover {
            background: #2c2c46;
        }

        /* CONTENT AREA */
        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .user-info {
            text-align: right;
            color: #444;
            margin-bottom: 20px;
            font-size: 14px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #222;
        }

        h2 {
            margin-top: 30px;
            color: #333;
        }

        /* FORM CARD */
        .card {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: 600;
            margin-bottom: 5px;
            color: #555;
        }

        input, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            padding: 11px 20px;
            background: #395bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 12px;
            box-shadow: 0 3px 10px rgba(57,91,255,0.3);
            transition: 0.2s;
        }

        button:hover {
            background: #2642d8;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
            border-radius: 6px;
            overflow: hidden;
        }

        th {
            background: #e6e9ff;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #333;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ececec;
        }

        tr:hover {
            background: #f7f8ff;
        }

        .msg-ok { color: #0fa50f; font-weight: bold; }
        .msg-err { color: #e60000; font-weight: bold; }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>📦 Stock Manager</h2>

        <a href="produit.php">Produits</a>
        <a href="modify.php">Modifier</a>

        <!-- Logout always at bottom -->
        <a href="logout.php" class="logout-link">🚪 Déconnexion</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="user-info">
            Connecté : <strong><?php echo $_SESSION['user_name']; ?></strong>
        </div>

        <h1>Gestion de Stock</h1>

        <?php
        if (isset($_GET['page'])) {

            if ($_GET['page'] == "produit") {
                include "produit.php";
                exit();
            }

            if ($_GET['page'] == "modify") {
                include "modify.php";
                exit();
            }

            if ($_GET['page'] == "logout") {
                include "logout.php";
                exit();
            }
        }
        ?>

        <!-- MESSAGE -->
        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'ok'): ?>
            <p class="msg-ok">✔ Produit ajouté avec succès.</p>
        <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'err'): ?>
            <p class="msg-err">❌ Erreur lors de l’ajout.</p>
        <?php endif; ?>

        <!-- FORMULAIRE -->
        <h2>Ajouter un produit</h2>

        <div class="card">
            <form method="POST" action="ajout_produit.php">

                <div class="form-row">
                    <div class="form-group">
                        <label>Nom produit</label>
                        <input type="text" name="NomProd" required>
                    </div>

                    <div class="form-group">
                        <label>Catégorie</label>
                        <select name="Categorie" required>
                            <option value="">-- choisir --</option>
                            <option>Informatique & Électronique</option>
                            <option>Vêtements & Mode</option>
                            <option>Alimentaire & Boissons</option>
                            <option>Maison & Cuisine</option>
                            <option>Beauté & Hygiène</option>
                            <option>Sport & Loisirs</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Quantité</label>
                        <input type="number" name="Quantite" min="0" required>
                    </div>

                    <div class="form-group">
                        <label>Prix</label>
                        <input type="number" name="Prix" step="0.1" required>
                    </div>

                    <div class="form-group">
                        <label>Commentaire</label>
                        <input type="text" name="cmnt">
                    </div>
                </div>

                <button type="submit">Ajouter</button>

            </form>
        </div>

        <?php
        // Connexion BDD
        $con = mysqli_connect("127.0.0.1", "root", "", "gestion_stock");
        if (!$con) die("Erreur connexion BDD");

        // Récupérer les produits
        $req = "SELECT * FROM Produits WHERE IdU = " . $_SESSION['user_id'];
        $liste = mysqli_query($con, $req);
        ?>

        <!-- TABLEAU -->
        <h2>Stock actuel</h2>

        <table>
            <tr>
                <th>Nom</th>
                <th>Catégorie</th>
                <th>Quantité</th>
                <th>Prix</th>
                <th>Commentaire</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($liste)): ?>
                <tr>
                    <td><?= $row['Nom_Produit'] ?></td>
                    <td><?= $row['Categorie'] ?></td>
                    <td><?= $row['Quantite'] ?></td>
                    <td><?= $row['Prix'] ?></td>
                    <td><?= $row['Commentaire'] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <br><br>

        <h2>Supprimer un produit</h2>
        <form method="post" action="delete_produit.php">
            <?php
            $req = "SELECT Nom_Produit FROM Produits";
            $res = mysqli_query($con, $req);
            ?>
            <select name='prd'>
                <option value=''>--- delete ---</option>
                <?php while ($row = mysqli_fetch_assoc($res)): ?>
                    <option value="<?= $row['Nom_Produit'] ?>"><?= $row['Nom_Produit'] ?></option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Supprimer</button>

            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'ok_del'): ?>
                <p class="msg-ok">✔ Produit supprimé avec succès.</p>
            <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'err_del'): ?>
                <p class="msg-err">❌ Erreur lors de la suppression.</p>
            <?php endif; ?>
        </form>

    </div>

    // Modification
    
    <form method="post" action="modify.php">
            <?php
            $req = "SELECT Nom_Produit FROM Produits";
            $res = mysqli_query($con, $req);
            ?>
            <select name='prd'>
                <option value=''>--- delete ---</option>
                <?php while ($row = mysqli_fetch_assoc($res)): ?>
                    <option value="<?= $row['Nom_Produit'] ?>"><?= $row['Nom_Produit'] ?></option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Supprimer</button>
    </form>

</body>
</html>
