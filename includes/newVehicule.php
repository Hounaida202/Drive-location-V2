

<?php

session_start();
require_once '../classes/database.php';
require_once '../classes/categories.php';
require_once '../classes/vehicules.php';



// if (isset($_GET['categorie_id']) && is_numeric($_GET['categorie_id'])) {
//     $categorie_id = (int) $_GET['categorie_id']; 
// } else {
//     echo "Catégorie invalide.";
//     exit;
// }





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nom']) && !empty($_POST['modele']) && !empty($_POST['disponibilite']) && !empty($_POST['prix']) && !empty($_POST['picture'])) {
        $nom = $_POST['nom'];
        $modele = $_POST['modele'];
        $dispo = $_POST['disponibilite'];
        $prix = $_POST['prix'];
        $categorie_id = $_GET['categorie_id']; 
        $picture = $_POST['picture'];  

        $newVehicule = Vehicule::createvehicule($nom, $modele, $dispo, $prix, $categorie_id, $picture);

        header("Location: ../includes/ShowCategories.php?categorie_id=" . $categorie_id);
        exit;
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire Véhicule - CarRent</title>
  <link rel="stylesheet" href="../Styles/formulaire_vehicule.css">
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
        <li><a href="categories.html" class="active">Déconnexion</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="form-section">
      <h2>Ajouter un Nouveau Véhicule</h2>
      <form action="" method="POST" class="vehicle-form">
        <div class="form-group">
          <label for="nom">Nom du Véhicule :</label>
          <input type="text" id="nom" name="nom" required>
        </div>

        <div class="form-group">
          <label for="modele">Modèle :</label>
          <input type="text" id="modele" name="modele" required>
        </div>

        <div class="form-group">
          <label for="disponibilite">Disponibilité :</label>
          <input type="text" id="disponibilite" name="disponibilite" required>
        </div>

        <div class="form-group">
          <label for="prix">Prix par Jour (€) :</label>
          <input type="number" id="prix" name="prix" required min="1">
        </div>

        <div class="form-group">
          <label for="picture">URL image :</label>
          <input type="text" id="picture" name="picture" required>
        </div>

        <button type="submit" class="btn-submit">Ajouter Véhicule</button>
        <button type="reset" class="btn-reset">Annuler</button>
      </form>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>
</body>
</html>
