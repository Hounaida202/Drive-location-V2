<?php
require_once '../classes/database.php';
require_once '../classes/themes.php';
$lesthemes=themes::getAllthemes();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarEnt</title>
    <link rel="stylesheet" href="../Styles/blogstyle.css">

</head>
<body>
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

    <main class="main-content">
        <div class="categories-list">
<?php      
       foreach($lesthemes as $letheme):
 ?>
           <a href="consultarticles.php?theme_id=<?= htmlspecialchars($letheme->getthemeId()) ?>" class="category-item">
                <h3>-> <?= $letheme->getthemeName()?></h3>
            </a>
       <?php   endforeach;
       ?>
        </div>
    </main>

    <footer class="footer">
        <p>&copy; 2025 CarEnt. Tous droits réservés.</p>
    </footer>
</body>
</html>
