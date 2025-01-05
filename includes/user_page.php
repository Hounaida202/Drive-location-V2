<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/user.php';
require_once '../classes/categories.php';


$lescategories= categories::getAllCategories();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Africa Map with Flags</title>
    <link rel="stylesheet" href="../Styles/stylec.css">
</head>
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
        <li><a href="categories.html">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main>
  <section class="welcome-message">
            <h2>Bienvenue sur votre page, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        </section>

    <section class="categories-section">
      <h2>Nos Catégories</h2>
      <div class="categories">
        <?php
        foreach($lescategories as $lacategorie):
        ?>
        <div class="category-card">
          <img src="utilitaire.jpg" alt="Utilitaire">
          <h3><?= $lacategorie->getCategorieName()?></h3>
          <p>Transportez tout ce dont vous avez besoin avec nos véhicules de <?= $lacategorie->getCategorieName()?>.</p>
          <a href="../includes/ConsultVehicules.php?categorie_id=<?= htmlspecialchars($lacategorie->getCategorieID()) ?>?user_id=<?=($_SESSION['username'])?>">Voir plus</a>
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
</html>