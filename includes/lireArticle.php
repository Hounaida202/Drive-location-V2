<?php
require_once '../classes/database.php';
require_once '../classes/themes.php';
require_once '../classes/articles.php';
require_once '../classes/article-tag.php';

if (isset($_GET['article_id']) && is_numeric($_GET['article_id'])) {
    $article_id = (int) $_GET['article_id']; 
    $larticles=articles::getAllArticlesByID($article_id);
} else {
    echo "<p>ID de catégorie invalide ou manquant.</p>";
    exit;
}
$lestags=article_tag::affichertagassocier($article_id);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article avec Navbar et Footer</title>
<link rel="stylesheet" href="../Styles/Lire.css">
</head>
<style>
    /* Global Container */
.main-container {
    display: flex;
    gap: 20px;
    max-width: 1200px;
    margin: 50px auto;
    padding: 0 20px;
}

/* Main Content Section */
.main-content {
    flex: 7; /* 70% */
}

/* Comments Section */
.comments-section {
    flex: 3; /* 30% */
    border-left: 2px solid #ddd;
    padding-left: 20px;
}

/* Comments Section Styles */
.comments-section h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
}

.comment {
    margin-bottom: 15px;
}

.comment p {
    font-size: 16px;
    color: #666;
    line-height: 1.5;
}

.comment strong {
    color: #007BFF;
}

</style>
<body>

    <!-- Navbar -->
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

    <!-- Main Content -->
    <div class="main-container">
    <!-- Main Content -->
    <div class="main-content">
        <?php foreach($larticles as $larticle): ?>
        <div class="article">
            <img src="<?= htmlspecialchars($larticle->getpicture()) ?>" alt="Image de l'article">
            <h1><?= htmlspecialchars($larticle->getarticleTitre()) ?></h1>
            <p><?= htmlspecialchars($larticle->getContenu()) ?></p>
            <div class="tags-container">
                <?php foreach($lestags as $letag): ?>
                <div class="tag">#<?= htmlspecialchars($letag['tag_name']) ?></div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Comments Section -->
    <div class="comments-section">
        <h2>Commentaires</h2>
        <div class="comment">
            <p><strong>Utilisateur 1:</strong> Excellent article, merci pour le partage !</p>
        </div>
        <div class="comment">
            <p><strong>Utilisateur 2:</strong> Très intéressant, j'ai appris beaucoup de choses.</p>
        </div>
    </div>
</div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; 2025 Mon Site. Tous droits réservés.</p>
    </div>

</body>
</html>