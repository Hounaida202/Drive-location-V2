
<?php

session_start();
require_once '../classes/database.php';
require_once '../classes/categories.php';
require_once '../classes/vehicules.php';


if (isset($_GET['categorie_id']) && is_numeric($_GET['categorie_id'])) {
    $categorie_id = (int) $_GET['categorie_id']; 
    $lesVehicules = Vehicule::getAllVehiculesByCategory($categorie_id);
} else {
    echo "<p>ID de catégorie invalide ou manquant.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && isset($_POST['vehicule_id'])) {
    $vehicule_id = $_POST['vehicule_id'];  
    $vehicule = new vehicule($vehicule_id);  
    if ($vehicule->deletevehicule()) {  
        header("Location: ../includes/ShowCategories.php?categorie_id=$categorie_id");
        exit();
    } else {
        echo "Erreur lors de la suppression de la catégorie.";
    }
  }




$lesVehicules= vehicule::getAllVehiculesByCategory($_GET['categorie_id']);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voitures - Catégorie</title>
  <link rel="stylesheet" href="../Styles/stylev.css">
</head>
<style>

</style>
<body>
  <header>
    <nav class="navbar">
      <div class="logo">
        <h1>CarRent</h1>
      </div>
      <ul class="nav-links">

        <li><a href="../includes/dashbaord.php">Categories</a></li>
        <!-- <li><a href="inscription.html">Inscription</a></li> -->
        <li><a href="connexion.html">Reservations</a></li>
        <li><a href="categories.html">Logout</a></li>

      </ul>
    </nav>
  </header>

  <main>
  <div class="add-category-btn-container">
  <a class="add-category-btn" href="../includes/newVehicule.php?categorie_id=<?= htmlspecialchars($categorie_id) ?>">Ajouter une nouvelle véhicule</a>

    </div>
    <section class="cars-section">

<?php
    foreach($lesVehicules as $lavehicule):
    ?>
  <div class="cards">
    <div class="card">
      <img src="<?=$lavehicule->getCategoriePicture()?> " alt="SUV Modèle 1">
      <h3> <?= $lavehicule->getVehiculeModele()  ?></h3>
      <p class="price">Prix : 100€ / jour</p>
      <!-- Ajout des boutons Modifier et Supprimer -->
       <div class="card-actions">

           <button class="btn-modifier">Modifier</button>
           <form method="POST">
               <input type="hidden" name="vehicule_id" value="<?= htmlspecialchars($lavehicule->getVehiculeId()) ?>">
               <button type="submit" class="btn-supprimer" name="delete">Supprimer</button>
           </form>


           
    </div>
      <!-- <div class="card-actions">
      </div> -->
    </div>
  </div>
  <br>

   <?php
    endforeach;
    ?>

</section>


  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>
</body>
</html>
