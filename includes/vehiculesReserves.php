<?php
require_once '../classes/database.php';
require_once '../classes/reservations.php';
require_once '../classes/user.php';
require_once '../classes/vehicules.php';
require_once '../classes/rating.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $rating=$_POST['rating'];
  $reservation=$_POST['reservation_id'];
  $resultat=rating::insertRating($rating,$reservation);
  $rate=rating::getRate($reservation);
}



$lesreservations =reservations::getreservationaccepte();


?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Liste des Véhicules</title>
  <link rel="stylesheet" href="../Styles/vehiculeReserve.css">
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
    <section class="cars-section">
      <h2>Vos Reservations</h2>
      <div class="cars-container">
        <!-- Exemple de carte de véhicule -->
        <?php foreach($lesreservations as $reservation):?>
        <div class="card">
          <img src="<?=htmlspecialchars($reservation['picture'])?>" alt="SUV 1">
          <p>Modèle : <?=htmlspecialchars($reservation['vehicule_model'])?></p>
          <p>Disponibilité : <?=htmlspecialchars($reservation['disponibilite'])?></p>
          <p>Prix : <?=htmlspecialchars($reservation['prix'])?> € / jour</p>

          <form class="rating-section" method="POST" action="" >
          <input type="hidden" id="evaluer" name="reservation_id" value="<?=htmlspecialchars($reservation['reservation_id'])?>">
            <input type="number" id="evaluer" name="rating" value="rating" class="rating-input" placeholder="Votre note (1-10)" min="1" max="10">
            <button type="submit" name="evaluer" class="rating-btn">Évaluer</button>
          </form>

          <p class="rating-result">Note actuelle : <?=htmlspecialchars($rate['rating_value'])?></p>
        </div>
        <?php endforeach; ?>
        <!-- Ajouter plus de cartes similaires ici -->
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>
</body>
</html>
