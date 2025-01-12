<?php
require_once '../classes/database.php';
require_once '../classes/themes.php';
require_once '../classes/articles.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : "";
$theme_id = isset($_GET['theme_id']) && is_numeric($_GET['theme_id']) ? (int) $_GET['theme_id'] : null;
$per_page = isset($_GET['per_page']) && in_array($_GET['per_page'], [5, 10, 15]) ? (int) $_GET['per_page'] : 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

if (!empty($search)) {
    $lesarticles = articles::getArticlesBySearch($search, $per_page, $offset);
    $total_articles = articles::countArticlesBySearch($search);
} elseif ($theme_id) {
    $lesarticles = articles::getArticlesByThemeWithPagination($theme_id, $per_page, $offset);
    $total_articles = articles::countArticlesByTheme($theme_id);
} else {
    $lesarticles = [];
    $total_articles = 0;
}

$total_pages = ceil($total_articles / $per_page);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Articles</title>
  <link rel="stylesheet" href="../styles/stylearticles.css">
  <style>
   
  </style>
</head>
<body>
  <header>
    <!-- <nav class="navbar">
      <div class="logo">CarEnt</div>
      <form method="GET" action="">
        <input type="text" name="search" placeholder="Rechercher un article..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
      </form>
      <ul class="nav-links">
      <li><a href="../includes/user_page.php">Categories</a></li>
      <li><a href="../includes/vehiculesReserves.php">Reservations</a></li>
        <li><a href="../includes/blog.php">blogs</a></li>
      </ul>
    </nav> -->
    <nav class="navbar">
      <div class="logo">
        <h1>CarRent</h1>
      </div>
      <form method="GET" action="">
        <input type="text" name="search" placeholder="Rechercher un article..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Rechercher</button>
      </form>
      <ul class="nav-links">
      <li><a href="../includes/user_page.php">Categories</a></li>
      <li><a href="../includes/vehiculesReserves.php">Reservations</a></li>
        <li><a href="../includes/blog.php">blogs</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="articles-section">
      <a href="AddArticleUser.php?theme_id=<?= $theme_id ?>" class="framed-link"><span class="plus-symbol">+</span> Ajouter un article</a>

      <h1>Nos Articles</h1>
      <div class="articles-container">
        <?php if (!empty($lesarticles)): ?>
            <?php foreach ($lesarticles as $larticle): ?>
                <a class="article-card" href="lireArticle.php?article_id=<?= htmlspecialchars($larticle->getarticleId()) ?>">
                    <img src="<?= htmlspecialchars($larticle->getpicture()) ?>" alt="Article">
                    <h3><?= htmlspecialchars($larticle->getarticleTitre()) ?></h3>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucun article trouvé.</p>
        <?php endif; ?>
      </div>

      <div class="pagination-options">
        <p>Afficher : 
          <a href="?theme_id=<?= $theme_id ?>&per_page=5">5 par page</a> | 
          <a href="?theme_id=<?= $theme_id ?>&per_page=10">10 par page</a> | 
          <a href="?theme_id=<?= $theme_id ?>&per_page=15">15 par page</a>
        </p>
      </div>

      <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?theme_id=<?= $theme_id ?>&per_page=<?= $per_page ?>&page=<?= $page - 1 ?>">Précédent</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?theme_id=<?= $theme_id ?>&per_page=<?= $per_page ?>&page=<?= $i ?>" 
               class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="?theme_id=<?= $theme_id ?>&per_page=<?= $per_page ?>&page=<?= $page + 1 ?>">Suivant</a>
        <?php endif; ?>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarEnt. Tous droits réservés.</p>
  </footer>
</body>
</html>