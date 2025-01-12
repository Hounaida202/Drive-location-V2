<?php
require_once '../classes/database.php';
require_once '../classes/articles.php';
require_once '../classes/article-tag.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['accepte']) || isset($_POST['refuse'])) {
        $id = $_POST['article_id']; 
        $status = isset($_POST['accepte']) ? 'accepte' : 'refuse';
        articles::updatestatus($id, $status);
    }
}


$allarticles = articles::afficherArticleComplete();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles</title>
    <link rel="stylesheet" href="../styles/gestionarticle.css">
</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <a href="#" class="logo">Mon Site</a>
        <div class="nav-links">
            <a href="../includes/blog.php">Blogs</a>
            <a href="#">Articles</a>
            <a href="#">Contact</a>
        </div>
    </div>
    <?php if (!empty($allarticles)): ?>
        <?php foreach ($allarticles as $onearticle): ?>
        <div class="main-content">
            <div class="article">
                <h1><?= htmlspecialchars($onearticle['article_titre']) ?></h1>
                <img src="<?= htmlspecialchars($onearticle['picture']) ?>" alt="Image de l'article">
                <p><?= htmlspecialchars($onearticle['article_contenu']) ?></p>
                <div class="tags-container">
                    <?php 
                    $tags = explode(', ', $onearticle['tags']);
                    foreach ($tags as $tag): 
                    ?>
                        <div class="tag">#<?= htmlspecialchars($tag) ?></div>
                    <?php endforeach; ?>
                </div>
                <div class="buttons-container">
                    <form action="" method="POST">
                        <input type="hidden" name="article_id" value="<?= $onearticle['article_id'] ?>"> 
                        <button type="submit" name="accepte" value="accepte" class="accept-button">Accepter</button>
                        <button type="submit" name="refuse" value="refuse" class="reject-button">Refuser</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
    <p>Aucun article à afficher.</p>
<?php endif; ?>
</body>
<div class="footer">
        <p>&copy; 2025 Mon Site. Tous droits réservés.</p>
    </div>
</html>
