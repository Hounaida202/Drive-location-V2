<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/categories.php';
require_once '../classes/vehicules.php';
require_once '../classes/authentification.php';
require_once '../classes/user.php';
require_once '../classes/pagination.php';

$vehicule = new Vehicules();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  
$lesVehicules = $vehicule->GetVehicules($page);

$totalVehicules = $vehicule->NbrVehicules();
$totalPages = ceil($totalVehicules / $vehicule->getLinesParPage());

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Véhicules</title>
  <link rel="stylesheet" href="./../Styles/styleConsultV.css">
</head>
<body>
  <header>
    <nav class="navbar">
      <div class="logo">
        <h1>CarRent</h1>
      </div>
      <ul class="nav-links">
      <li><a href="../includes/user_page.php">Categories</a></li>
      <li><a href="../includes/vehiculesReserves.php">Reservations</a></li>
        <li><a href="../includes/blog.php">blogs</a></li>
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
          <img src="<?=$lavehicule['picture']?>" alt="SUV">
          <p style="font-size: 30px;"><?= $lavehicule['vehicule_name'] ?></p>
          <p style="font-size: 20px;">Modèle: <?= $lavehicule['vehicule_model'] ?> </p>
          <p>Prix par Jour: <?= $lavehicule['prix'] ?> DH</p>
          <p class="availability available">Disponibilité : <?= $lavehicule['disponibilite'] ?></p>

          <a class="reserve-btn" href="ReservationVehicule.php?vehicule_id=<?=$lavehicule['vehicule_id']?>&id=<?=($_SESSION['user_id'])?>" style="text-decoration: none;">Réserver maintenant</a>
        </div>
        <?php
          endforeach;
        ?>
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <?php if ($page > 1): ?>
          <a href="?page=<?= $page - 1 ?>">Précédent</a>
        <?php endif; ?>

        <span>Page <?= $page ?> sur <?= $totalPages ?></span>

        <?php if ($page < $totalPages): ?>
          <a href="?page=<?= $page + 1 ?>">Suivant</a>
        <?php endif; ?>
      </div>

    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>
</body>
</html>
