
<?php
session_start();
require_once '../classes/database.php';
require_once '../classes/categories.php';
require_once '../classes/user.php';
require_once '../classes/reservations.php';
require_once '../classes/authentification.php';
require_once '../classes/user.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['date1']) && !empty($_POST['date2']) && !empty($_POST['lieu']) ) {
      $date1 = $_POST['date1'];
      $date2 = $_POST['date2'];
      $lieu = $_POST['lieu'];
      $vehicule_id = $_GET['vehicule_id'];
      $user_id = $_GET['id']; 

      $newReservation = reservations::AddNewReservation($date1, $date2, $lieu, $vehicule_id, $user_id);

      header("Location: ../includes/ConsultVehicules.php?categorie_id=" . $categorie_id);
      exit;
  } else {
      echo "Veuillez remplir tous les champs du formulaire.";
  }
}

// session_start();
// require_once '../classes/database.php';
// require_once '../classes/categories.php';
// require_once '../classes/user.php';
// require_once '../classes/reservations.php';



// Vérifier que les paramètres sont bien passés dans l'URL
// if (isset($_GET['vehicule_id']) && isset($_GET['user_id'])) {
//     $vehicule_id = $_GET['vehicule_id'];
//     $user_id = $_GET['user_id'];
// } else {
//     die("Les paramètres 'vehicule_id' et 'user_id' sont requis.");
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Vérification des champs
//     if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
//       die("L'utilisateur n'est pas connecté ou 'user_id' n'est pas défini.");
//     } else {
//         echo "Veuillez remplir tous les champs du formulaire.";
//     }
// }



?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Réservation - CarRent</title>
  <link rel="stylesheet" href="../Styles/styleformreser.css">
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
    <section class="form-section">
      <h2>Formulaire de Réservation</h2>
      <div class="form-container">



        <form action="#" method="POST">

        <label for="name">Nom Complet</label>
          <input type="text" id="name" name="name" placeholder="Votre nom complet" required>


          <label for="date">Date de Réservation</label>
<input type="date" id="date" name="date1" required>

<label for="days">Date de dernier jour de réservation</label>
<input type="date" id="days" name="date2" required>


          <label for="text">La ville de reservation</label>
          <input type="lieu" id="lieu" name="lieu" placeholder="La ville de reservation"   required>

          <label for="phone">Numéro de Téléphone</label>
          <input type="tel" id="phone" name="phone" placeholder="Votre numéro" required>

          <div>
            <a style="text-decoration: none;" type="reset" class="cancel-btn" href="user_page.php">Annuler</a>
            <button type="submit" name="submit">Réserver</button>
          </div>
        </form>



      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>
</body>
</html>
