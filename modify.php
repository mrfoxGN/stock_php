<?php
session_start();

// si tu fais déjà ce contrôle dans produit.php, garde-le aussi ici
if (!isset($_SESSION['user_id'])) {
    header('Location: connect_user.php');
    exit();
}

$con = mysqli_connect("127.0.0.1", "root", "", "gestion_stock");
if (!$con) {
    die("Erreur connexion BDD");
}

/* --- TRAITEMENT DU FORMULAIRE --- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $quantite = isset($_POST["qtt"]) ? (int)$_POST["qtt"] : 0;
    $prod     = isset($_POST["modfy"]) ? $_POST["modfy"] : '';

    if ($quantite > 0 && $prod !== '') {
        $prod_escaped = mysqli_real_escape_string($con, $prod);

        if ($_POST['action'] === 'add') {
            $req = "UPDATE Produits 
                    SET Quantite = Quantite + $quantite 
                    WHERE Nom_Produit = '$prod_escaped'";
            mysqli_query($con, $req);
        } elseif ($_POST['action'] === 'delete') {
            $req = "UPDATE Produits 
                    SET Quantite = GREATEST(Quantite - $quantite, 0) 
                    WHERE Nom_Produit = '$prod_escaped'";
            mysqli_query($con, $req);
        }

        header("Location: modify.php?msg=ok");
        exit();
    } else {
        header("Location: modify.php?msg=error");
        exit();
    }
}

/* --- RÉCUPÉRATION LISTE PRODUITS --- */
$req = "SELECT Nom_Produit FROM Produits ORDER BY Nom_Produit";
$res = mysqli_query($con, $req);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un produit - Stock Manager</title>

    <style>
        /* --------- LAYOUT GLOBAL (même style que produit.php) --------- */

        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f4f6fb;
        }

        .sidebar {
            width: 230px;
            background: #151a2c;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            padding: 24px 20px;
            box-sizing: border-box;
        }

        .sidebar h2 {
            margin: 0 0 30px;
            font-size: 20px;
        }

        .nav-link {
            display: block;
            padding: 10px 12px;
            margin-bottom: 8px;
            border-radius: 8px;
            color: #c7c9e0;
            text-decoration: none;
            font-size: 15px;
            transition: 0.2s;
        }

        .nav-link:hover {
            background: #1f2640;
            color: #ffffff;
        }

        .nav-link.active {
            background: #2c7dfe;
            color: #ffffff;
        }

        .main {
            margin-left: 230px;
            padding: 30px 40px;
        }

        .page-title {
            font-size: 26px;
            margin: 0 0 10px;
            color: #222;
        }

        .page-subtitle {
            color: #666;
            margin-bottom: 25px;
        }

        .alert {
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-success {
            background: #e5f8ea;
            color: #207844;
            border: 1px solid #b7e4c5;
        }

        .alert-error {
            background: #ffe9e9;
            color: #b02a2a;
            border: 1px solid #f5b4b4;
        }

        /* --------- CARTE DE MODIFICATION --------- */

        .modify-wrapper {
            display: flex;
            justify-content: flex-start;
        }

        .modify-card {
            width: 380px;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.10);
        }

        .modify-card h3 {
            margin-top: 0;
            font-size: 20px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .modify-card label {
            font-weight: 600;
            color: #555;
            display: block;
            margin-bottom: 6px;
        }

        .modify-card select,
        .modify-card input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        .btn-box {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .btn {
            flex: 1;
            padding: 10px;
            border: none;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            transition: 0.2s;
            font-size: 15px;
        }

        .btn-add {
            background: #2c7dfe;
            box-shadow: 0 3px 10px rgba(44,125,254,0.3);
        }

        .btn-add:hover {
            background: #1d5ed1;
        }

        .btn-delete {
            background: #e03a3a;
            box-shadow: 0 3px 10px rgba(224,58,58,0.3);
        }

        .btn-delete:hover {
            background: #b82e2e;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <h2>Stock Manager</h2>

        <a href="produit.php" class="nav-link">Produits</a>
        <a href="modify.php" class="nav-link active">Modifier</a>
    </aside>

    <!-- CONTENU PRINCIPAL -->
    <main class="main">
        <h1 class="page-title">Modifier un produit</h1>
        <p class="page-subtitle">Ajouter ou retirer de la quantité d'un produit existant.</p>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'ok'): ?>
            <div class="alert alert-success">
                ✔ Quantité mise à jour avec succès.
            </div>
        <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'error'): ?>
            <div class="alert alert-error">
                ⚠ Veuillez choisir un produit et saisir une quantité valide.
            </div>
        <?php endif; ?>

        <div class="modify-wrapper">
            <div class="modify-card">
                <h3>Modifier un produit</h3>

                <form method="post" action="modify.php">

                    <label>Choisir un produit</label>
                    <select name="modfy" required>
                        <option value="">--- Nom Produit ---</option>
                        <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                            <option value="<?= htmlspecialchars($row['Nom_Produit']) ?>">
                                <?= htmlspecialchars($row['Nom_Produit']) ?>
                            </option>
                        <?php } ?>
                    </select>

                    <label>Entrer la quantité</label>
                    <input type="number" name="qtt" min="1" required>

                    <div class="btn-box">
                        <button type="submit" name="action" value="add" class="btn btn-add">Add</button>
                        <button type="submit" name="action" value="delete" class="btn btn-delete">Delete</button>
                    </div>

                </form>
            </div>
        </div>
    </main>
</body>
</html>
