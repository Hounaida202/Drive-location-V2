
<?php
session_start();

require_once '../classes/database.php';

require_once '../classes/categories.php';
require_once '../classes/user.php';


// if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
//     header('Location: ../includes/connexion.php');
//     exit();
// }
// $category = new categories();

if (!isset($_SESSION['user_id'])) {
  header('Location: http://localhost/Drive-Loc/includes/connexion.php');
  exit();
} 
elseif (isset($_SESSION['role_id']) && $_SESSION['role_id'] === 2) {
  header('Location: http://localhost/Drive-Loc/includes/user_page.php');
  exit(); 
}
elseif (isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1) {
  header('Location: http://localhost/Drive-Loc/includes/user_page.php');
  exit(); 
}



$lescategories= categories::getAllCategories();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['nom-par-user'])) {
      $newcategorie = categories::createcategorie($_POST['nom-par-user']);
      
      header("Location: " . $_SERVER['PHP_SELF']); 
      exit; 
  } else {
      echo "Le nom de la catégorie est vide.";
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && isset($_POST['categorie_id'])) {
  $id = $_POST['categorie_id'];  
  $category = new categories($id);  
  if ($category->deletecategorie()) {  
      header("Location: ../includes/dashbaord.php");
      exit();
  } else {
      echo "Erreur lors de la suppression de la catégorie.";
  }
}



    //   if ($newcategorie->createcategorie($db)) {
    //     $message = "Fruit ajouté avec succès !";
    // } else {
    //     $message = "Erreur lors de l'ajout du fruit.";
    // }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catégories - CarRent</title>
  <link rel="stylesheet" href="../Styles/styledashbaord.css">

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
        <li><a href="../includes/gestion_articles.php">Gestion</a></li>

        <li><a href="categories.html" class="active">Logout</a></li>
      </ul>
    </nav>
  </header>

  
  <?php if (isset($_SESSION['username'])): ?>
        <p>Hey, <?php echo htmlspecialchars($_SESSION['username']); ?> ! Bienvenue sur ton tableau de bord.</p>
      <?php endif; ?>



      <div class="add-category-btn-container">
      <button class="add-category-btn" onclick="showModal()">Ajouter une nouvelle catégorie</button>
    </div>

  <main>
  <section class="categories" style="position: relative;">
  <?php foreach($lescategories as $lacategorie): ?>
    <div class="category">
      <a href="../includes/ShowCategories.php?categorie_id=<?= htmlspecialchars($lacategorie->getCategorieID()) ?>" class="cards">
        <div class="card">
          <h3><?= $lacategorie->getCategorieName() ?></h3>
          <img src="suv1.jpg" alt="SUV 1">
        </div>
      </a>
      <div class="buttons-container">



        <form action="" method="POST" style="display: inline;">
          <input type="hidden" name="categorie_id" value="<?= htmlspecialchars($lacategorie->getCategorieID()) ?>">
          <a type="submit" class="btn-edit" name="edit" style="text-decoration: none;" href="../includes/FormModifyCategorie.php?categorie_id=<?= htmlspecialchars($lacategorie->getCategorieID()) ?>">Modifier</a>
        </form>

       



        <form action="" method="POST" style="display: inline;">
          <input type="hidden" name="categorie_id" value="<?= htmlspecialchars($lacategorie->getCategorieID()) ?>">
          <button type="submit" class="btn-delete" name="delete">Supprimer</button>
        </form>

      </div>
    </div>
  <?php endforeach; ?>
</section>
   

    <div class="modal-overlay" id="modalOverlay">
      <div class="modal">


        <h3>Ajouter une nouvelle catégorie</h3>
        <form action="" method="POST">
  <input type="text" name="nom-par-user" placeholder="Nom de la catégorie" required>
  <div class="modal-buttons">
    <input type="submit" name="ajouter" class="submit-btn" value="Ajouter">
    <button type="button" class="cancel-btn" onclick="hideModal()">Annuler</button>
  </div>
</form>


      </div>
    </div>

    <!-- <div class="modal-overlay" id="modalOverlay">
      <div class="modal">
        <h3>Modifier la catégorie</h3>
        <form action="" method="POST" id="editCategoryForm">
          <input type="hidden" name="categorie_id" id="editCategorieID">
          <input type="text" name="nom-par-user" id="editCategorieName" placeholder="Nom de la catégorie" required>
          <div class="modal-buttons">
            <input type="submit" name="ajouter" class="submit-btn" value="Modifier">
            <button type="button" class="cancel-btn" onclick="hideModal()">Annuler</button>
          </div>
        </form>
      </div>
    </div> -->
  </main>

  <footer>
    <p>&copy; 2025 CarRent. Tous droits réservés.</p>
  </footer>

  <script>
    function showModal() {
      document.getElementById('modalOverlay').style.display = 'block';
    }

    function hideModal() {
      document.getElementById('modalOverlay').style.display = 'none';
    }

    // function showEditModal(categorieID, categorieName) {
    //   document.getElementById('editCategorieID').value = categorieID;
    //   document.getElementById('editCategorieName').value = categorieName;
    //   document.getElementById('modalOverlay').style.display = 'block';
    // }
  </script>
</body>
</html>



