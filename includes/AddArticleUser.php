<?php

require_once '../classes/themes.php';
require_once '../classes/articles.php';
require_once '../classes/tags.php';
require_once '../classes/traitement.php';
require_once '../classes/article-tag.php';
require_once '../classes/database.php';





// if($_SERVER['REQUEST_METHOD']=='POST'){
//     if(!empty($_POST['Titre']) && !empty($_POST['contenu']) && !empty($_POST['image'])    ){
//         $errors = 0;

//     $article_titre=$_POST['Titre'];
//     $article_contenu=$_POST['contenu'];
//     $picture=$_POST['picture'];
//     $tag_name=$_POST['tags[]'];
//     $theme_id=$_GET['theme_id'];

//     $articles=articles::AjouterArticle($article_titre,$article_contenu,$picture,$theme_id);
// $tags=articles::AjouterTags($tag_name,$article_id);


//     }

// }

// require_once 'database.php';
// require_once 'themes.php';
// require_once 'articles.php';

// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['image']) && !empty($_POST['tags'])){
//         $errors = 0;

//         $article_titre = $_POST['title'];
//         $article_contenu = $_POST['content'];
//         $picture = $_POST['image'];
//         $tags = $_POST['tags']; // récupère les tags sous forme de tableau
//         $theme_id = $_GET['theme_id'];

//         // Liste des tags autorisés (les mêmes que dans l'ENUM de la base)
//         $valid_tags = [
//             'Voiture', 'Moto', 'Camion', 'SUV', 'Véhicule électrique', 'Véhicule hybride',
//             '4x4', 'Véhicule de luxe', 'Auto sport', 'Véhicule d occasion'
//         ];

//         // Ajout de l'article
//         $article_id = articles::AjouterArticle($article_titre, $article_contenu, $picture, $theme_id);

//         // Ajout des tags associés à cet article (validation des tags)
//         foreach ($tags as $tag_name) {
//             // Si le tag fait partie des tags valides, on l'ajoute
//             if (in_array($tag_name, $valid_tags)) {
//                 articles::AjouterTags($tag_name, $article_id);
//             }
//         }

//     }
// }



// if($_SERVER['REQUEST_METHOD'] == 'POST'){
//     if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['image']) && !empty($_POST['tags'])){
//         $errors = 0;

//         $article_titre = $_POST['title'];
//         $article_contenu = $_POST['content'];
//         $picture = $_POST['image'];
//         $tags = $_POST['tags']; // récupère les tags sous forme de tableau
//         $theme_id = $_GET['theme_id'];

//         // Ajout de l'article
//         $article_id = articles::AjouterArticle($article_titre, $article_contenu, $picture, $theme_id);

//         // Ajout des tags associés à cet article
//         foreach ($tags as $tag_name) {
//             articles::AjouterTags($tag_name, $article_id);
//         }

//     }
// }

$tags=tags::getAlltags();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Éditeur d'article</title>
  <link rel="stylesheet" href="../styles/styleFormuleArticle.css">

</head>

<body>
<header>
    <nav class="navbar" >
      <div class="logo">CarEnt</div>
      <ul class="nav-links">
      <li><a href="../includes/user_page.php">Categories</a></li>
      <li><a href="../includes/vehiculesReserves.php">Reservations</a></li>
        <li><a href="../includes/blog.php">blogs</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="editor-container">
      <h2>Éditeur d'article</h2>
      <form action="#" method="POST" class="editor-form">
  <div class="form-group">
    <label for="title">Titre :</label>
    <input type="text" id="title" name="title" placeholder="Entrez le titre de l'article" required>
  </div>

  <div class="form-group">
    <label for="image">Image (URL) :</label>
    <input type="url" id="image" name="image" placeholder="Exemple : https://exemple.com/image.jpg">
  </div>

  <div class="form-group">
    <label for="content">Contenu :</label>
    <textarea id="content" name="content" rows="10" placeholder="Écrivez ici le contenu de l'article" required></textarea>
  </div>
  
  <details class="form-group">
    <summary>Choisissez vos options</summary>
    <?php foreach ($tags as $tag): ?>
        <label>
            <input type="checkbox" name="tags[]" value="<?= $tag['tag_id'] ?>">
            <?= htmlspecialchars($tag['tag_name']) ?>
        </label><br>
    <?php endforeach; ?>
</details>

  <!-- <div id="selected-options" class="selected-options"></div> -->
  <div class="form-buttons">
    <button type="submit" class="save-btn">Enregistrer</button>
    <button type="reset" class="cancel-btn">Annuler</button>
  </div>
</form>

    </section>
  </main>

  <footer>
    <p>&copy; 2025 CarEnt - Tous droits réservés.</p>
  </footer>

</body>
</html>

