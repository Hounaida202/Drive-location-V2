<?php
require_once '../classes/database.php';

require_once '../classes/reservations.php';
require_once '../classes/user.php';
require_once '../classes/vehicules.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accepte']) || isset($_POST['refuse'])) {
        $id = $_POST['reservation_id']; 
        $status = isset($_POST['accepte']) ? 'accepte' : 'refuse';
        reservations::updateStatus($id, $status);
    }
}

$lesreservations =reservations::getreservationattente();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cartes de Véhicules</title>
  <link rel="stylesheet" href="../Styles/gestionReservation.css">
</head>

<body>
<header>
    <nav class="navbar">
      <div class="logo">
        <h1>CarRent</h1>
      </div>
      <ul class="nav-links">
        <li><a href="dashbaord.php">Catégories</a></li>
        <li><a href="../includes/gestionReservation.php">Réservations</a></li>
        <li><a href="categories.html" class="active">Logout</a></li>
      </ul>
    </nav>
  </header>
  <div class="container">
    <h1>Demandes de Location de Véhicules</h1>

    <div class="cards">
        <!-- -------------------------------------- -->
         <?php foreach($lesreservations as $reservation):?>
      <div class="card">
        <img src="<?=htmlspecialchars($reservation['picture'])?>" alt="Véhicule" class="card-image">
        <div class="card-content">
            <p>Nom de l'utilisateur : <span><?=htmlspecialchars($reservation['user_name'])?></span></p>
          <p>Modèle : <span><?=htmlspecialchars($reservation['vehicule_model'])?></span></p>
          <p>Date de début : <span><?=htmlspecialchars($reservation['date1'])?></span></p>
          <p>Date de fin : <span><?=htmlspecialchars($reservation['date2'])?></span></p>
          <p>Lieu : <span><?=htmlspecialchars($reservation['lieu'])?></span></p>

          <!-- <form class="card-buttons">
            <button class="accept">Accepter</button>
            <button class="decline">Refuser</button>
         </form> -->
         <form class="card-buttons" action="" method="POST">
            <input type="hidden" name="reservation_id" value="<?=htmlspecialchars($reservation['reservation_id'])?>">
            <input class="accept" type="submit" name="accepte" value="accepte" placeholder="accepter">
            <input class="decline" type="submit" name="refuse" value="refuse" placeholder="refuser">
         </form>
        </div>
      </div>

      <?php endforeach; ?>

      <!-- --------------------------------- -->
    </div>
  </div>
  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>
</body>
</html>
