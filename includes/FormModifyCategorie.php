<?php
require_once '../classes/database.php';
require_once '../classes/categories.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categorie_id = (int) $_POST['categorie_id'];
    $categorie_name = $_POST['nom-par-user']; 

    $categorie = new Categories($categorie_id, $categorie_name);
    if ($categorie->updatecategorie()) {
        echo "La catégorie a été mise à jour avec succès.";
        header("Location: dashbaord.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de la catégorie.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Modifier la catégorie - CarRent</title>
  <link rel="stylesheet" href="../Styles/stylemodifiercategorie.css">
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="logo">
        <h1>CarRent</h1>
      </div>
      <ul class="nav-links">
        <li><a href="dashbaord.php">Catégories</a></li>
        <li><a href="connexion.html">Réservations</a></li>
        <li><a href="categories.html" class="active">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="edit-category-form">
      <h2>Modifier la catégorie</h2>
      <form action="" method="POST">
        <input type="hidden" name="categorie_id" value=""> 
        <label for="editCategorieName">Nom de la catégorie</label>
        <input type="text" name="nom-par-user" id="editCategorieName" placeholder="Nom de la catégorie" required value=""> 

        <div class="form-buttons">
          <input type="submit" name="modifier" class="submit-btn" value="Modifier">
          <a href="dashbaord.php" class="cancel-btn">Annuler</a>
        </div>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>
</body>
</html>
