<?php


require_once '../classes/database.php';
require_once '../classes/articles.php';
require_once '../classes/article-tag.php';
require_once '../classes/AddArticleUser.php';

if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['image']) && !empty($_POST['tags']) && isset($_GET['theme_id'])) {
    $theme_id = $_GET['theme_id'];
    $idArticle = articles::AjouterArticle($_POST['title'], $_POST['content'], $theme_id, $_POST['image']);
    if ($idArticle) {
        $tags = tags::getAlltags();
        $tagIds = [];
        foreach ($tags as $tag) {
            if (in_array($tag['tag_id'], $_POST['tags'])) {
                $tagIds[] = $tag['tag_id'];
            }
        }
        foreach ($tagIds as $idtag) {
            if (!article_tag::associer($idtag, $idArticle)) {
                echo "Erreur lors de l'association d'un tag.";
            }
        }
        echo "Article et tags ajoutés avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'article.";
    }
} else {
    echo "Veuillez remplir tous les champs.";
}
?>