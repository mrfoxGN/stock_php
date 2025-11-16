<?php
session_start();

// Sécurité : si l’utilisateur n’est pas connecté → vers login
/*if (!isset($_SESSION['user_id'])) {
    header('Location: connect_user.php');
    exit();
}*/


?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Gestion de Stock</title>
        
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f2f2f2;
                margin: 0;
                padding: 0;
            }
            
            .sidebar {
                width: 220px;
                background: #1f1f2e;
                color: white;
                height: 100vh;
                position: fixed;
                padding: 20px;
            }
            
            .sidebar h2 {
                margin-top: 0;
            }
            
            .sidebar a {
                display: block;
                color: #dcdcdc;
                text-decoration: none;
                padding: 10px 0;
                margin-top: 5px;
            }
            
            .sidebar a:hover {
                color: white;
            }
            
            .content {
                margin-left: 240px;
                padding: 20px;
            }
            
            h1 {
                margin-top: 0;
            }
            
            .user-info {
                text-align: right;
                color: #444;
            }
            
            .form-row {
                display: flex;
                gap: 15px;
                margin-bottom: 10px;
            }
            
            .form-group {
                flex: 1;
                display: flex;
                flex-direction: column;
            }
            
            label {
                font-weight: bold;
                margin-bottom: 3px;
            }
            
            input, select {
                padding: 7px;
                border: 1px solid #bbb;
                border-radius: 4px;
            }
            
            button {
                padding: 9px 15px;
                background: #2b70ff;
                border: none;
                color: white;
                font-weight: bold;
                border-radius: 4px;
                cursor: pointer;
                margin-top: 10px;
            }
            
            button:hover {
                background: #1b53cc;
            }
            
            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 25px;
            }
            
            th, td {
                padding: 8px;
                border: 1px solid #ddd;
                text-align: left;
            }
            
            th {
                background: #eee;
            }
            
            .msg-ok { color: green; font-weight: bold; }
            .msg-err { color: red; font-weight: bold; }
        </style>
</head>
<body>
    
    <!-- MENU LATERAL -->
    <div class="sidebar">
        <h2>Stock Manager</h2>
        
        <a href="produit.php">📦 Produits</a>
        <a href="categorie.php">📁 Catégories</a>
        <a href="logout.php">🚪 Déconnexion</a>
    </div>
    
    <!-- CONTENU PRINCIPAL -->
    <div class="content">
        
        <div class="user-info">
            Connecté : <strong><?php echo $_SESSION['user_name']; ?></strong>
        </div>
        
        <h1>Gestion de Stock</h1>
        
        <!-- MESSAGE -->
        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'ok'): ?>
            <p class="msg-ok">✔ Produit ajouté avec succès.</p>
            <?php elseif (isset($_GET['msg']) && $_GET['msg'] === 'err'): ?>
                <p class="msg-err">❌ Erreur lors de l’ajout.</p>
                <?php endif; ?>
                
                <!-- FORMULAIRE D'AJOUT -->
                <h2>Ajouter un produit</h2>
                
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
                    <option value="Informatique & Électronique">Informatique & Électronique</option>
                    <option value="Vêtements & Mode">Vêtements & Mode</option>
                    <option value="Alimentaire & Boissons">Alimentaire & Boissons</option>
                    <option value="Maison & Cuisine">Maison & Cuisine</option>
                    <option value="Beauté & Hygiène">Beauté & Hygiène</option>
                    <option value="Sport & Loisirs">Sport & Loisirs</option>
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
                <input type="number" step="0.1" name="Prix" required>
            </div>
            
            <div class="form-group">
                <label>AJOUTER UN COMMENTAIRE</label>
                <input type="text" name="cmnt">
            </div>
        </div>
        
        <button type="submit">Ajouter</button>
    </form>

    <?php
    // Connexion BDD
    $con = mysqli_connect("127.0.0.1", "root", "", "gestion_stock");
    //if (!$con) die("Erreur connexion BDD");
    
    // Récupérer les produits existants
    $req = "SELECT * FROM Produits";
    $liste = mysqli_query($con, $req);
    ?>

    <tr>
    <!-- TABLEAU DES PRODUITS -->
    <h2>Stock actuel</h2>
    
    <table>
        <tr>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Référence</th>
        </tr>
        
        <?php while ($row = mysqli_fetch_assoc($liste)): ?>
            
                <td><?= $row['Nom_Produit'] ?></td>
                <td><?= $row['Categorie'] ?></td>
                <td><?= $row['Quantite'] ?></td>
                <td><?= $row['Prix'] ?></td>
                <td><?= $row['commentaire'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</div>

</body>
</html>
