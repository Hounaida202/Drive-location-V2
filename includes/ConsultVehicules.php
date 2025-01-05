<?php

session_start();
require_once '../classes/database.php';
require_once '../classes/categories.php';
require_once '../classes/vehicules.php';
require_once '../classes/authentification.php';
require_once '../classes/user.php';





$lesVehicules= vehicule::getAllVehiculesByCategory($_GET['categorie_id']);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Véhicules</title>
  <link rel="stylesheet" href="../Styles/styleConsultV.css">
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
      <li><a href="user_page.php">Categories</a></li>
        <li><a href="vehiculesReserves.php">Reservations</a></li>
        <li><a href="">Véhicules</a></li>
        <li><a href="">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="vehicles-section">
      <h2>Nos Véhicules</h2>
     
      <div class="vehicles">
  <?php
    foreach($lesVehicules as $lavehicule):
  ?>
  <div class="vehicle-card">
    <img src="<?=$lavehicule->getCategoriePicture()?>" alt="SUV">
    <h3><?= $lavehicule->getVehiculeModele() ?></h3>
    <p>Catégorie : SUV</p>
    <p class="availability available">Disponible</p>
    <a class="reserve-btn" href="ReservationVehicule.php?vehicule_id=<?=$lavehicule->getVehiculeId()?>&id=<?=($_SESSION['user_id'])?>">

     style="text-decoration: none;">Réserver maintenant</a>
  </div>
  <?php
    endforeach;
  ?>
</div>

    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>
</body>
</html>
