<?php

// require_once'./classes/database.php';

class articles{
    private $article_id;
    private $article_titre;
    private $article_contenu;
    private $theme_id;
    private $picture;

    

    public function __construct($article_id=null,$article_titre='',$article_contenu='',$theme_id = null,$picture=''){
        $this->article_id=$article_id;
        $this->article_titre=$article_titre;
        $this->article_contenu=$article_contenu;
        $this->theme_id=$theme_id;
        $this->picture=$picture;
        }
// ----------------getters-------------------
        
        public function getarticleId(){
            return $this->article_id;
        }
        public function getarticleTitre(){
            return $this->article_titre;
        }
        public function getContenu(){
            return $this->article_contenu;
        }

        public function getthemeId(){
            return $this->theme_id;
        }
        public function getpicture(){
            return $this->picture;
        }

public static function getAllArticlesByID($article_id){
    $bd= database::getInstance()->getConnection();
    $sql = " SELECT * FROM articles WHERE articles.article_id = :article_id"; 
    $stmt=$bd->prepare($sql);
    $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $stmt->execute();
    $arrayArtices=[];
    while ($data=$stmt->fetch(PDO::FETCH_ASSOC)){
        $arrayArtices[]=new self (
            isset( $data['article_id'])? $data['article_id'] : '',
            isset( $data['article_titre'])? $data['article_titre'] : '',
            isset( $data['article_contenu'])? $data['article_contenu'] : '',
            isset( $data['theme_id'])? $data['theme_id'] : '',
            isset( $data['picture'])? $data['picture'] : '',

        );
    }
    return $arrayArtices;
  }


public static function getArticlesByThemeWithPagination($theme_id, $limit, $offset) {
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT * FROM articles WHERE articles.theme_id = :theme_id and articles.status='accepte'
     LIMIT :limit OFFSET :offset";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':theme_id', $theme_id, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $arrayArticles = [];
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $arrayArticles[] = new self(
            $data['article_id'] ?? '',
            $data['article_titre'] ?? '',
            $data['article_contenu'] ?? '',
            $data['theme_id'] ?? '',
            $data['picture'] ?? ''
        );
    }
    return $arrayArticles;
}

public static function countArticlesByTheme($theme_id) {
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT COUNT(*) AS total FROM articles WHERE articles.theme_id = :theme_id";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':theme_id', $theme_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
}



// --------------------AJOuter une article par user-----------------------
public static function AjouterArticle($article_titre, $article_contenu, $theme_id, $picture){
    $bd = database::getInstance()->getConnection();
    $sql = "INSERT INTO articles (article_titre, article_contenu, theme_id, picture) VALUES
            (:article_titre, :article_contenu, :theme_id, :picture)";

    $stmt = $bd->prepare($sql);
    $stmt->execute([
        ':article_titre' => $article_titre,
        ':article_contenu' => $article_contenu,
        ':theme_id' => $theme_id,
        ':picture' => $picture,
    ]);

    return $bd->lastInsertId();  
}



public static function AjouterTags($tag_name, $article_id){
    $bd = database::getInstance()->getConnection();
    $sql = "INSERT INTO tags (tag_name, article_id) VALUES
            (:tag_name, :article_id)";

    $stmt = $bd->prepare($sql);
    $stmt->execute([
        ':tag_name' => $tag_name,
        ':article_id' => $article_id
    ]);
}
public static function getAllTagsByID($article_id) {
    $bd = database::getInstance()->getConnection();

    $sql = "
        SELECT t.nom 
        FROM tags t
        INNER JOIN article_tags at ON t.id = at.tag_id
        WHERE at.article_id = :article_id
    ";

    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}


public static function afficherArticleComplete() {
    $bd = database::getInstance()->getConnection();
    $sql = " 
    SELECT a.article_id, a.article_titre, a.article_contenu, a.picture, 
           GROUP_CONCAT(t.tag_name SEPARATOR ', ') AS tags
    FROM articles a
    LEFT JOIN article_tag at ON a.article_id = at.article_id
    LEFT JOIN tags t ON at.tag_id = t.tag_id
    WHERE a.status = 'en attente'
    GROUP BY a.article_id 
";
    $stmt = $bd->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public static function updatestatus($idArticleClique,$statusnew){
    $bd = database::getInstance()->getConnection();
    $sql = " UPDATE articles SET status =:statusnew 
    WHERE article_id=:idArticleClique
    ";
    $stmt=$bd->prepare($sql);
    $stmt->bindParam(':statusnew', $statusnew);
    $stmt->bindParam(':idArticleClique', $idArticleClique);
    $stmt->execute();
}

// ---------------------------------------------------
public static function getArticlesBySearch($search, $limit, $offset) {
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT * FROM articles WHERE article_titre LIKE :search LIMIT :limit OFFSET :offset";
    $stmt = $bd->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $arrayArticles = [];
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $arrayArticles[] = new self(
            $data['article_id'] ?? '',
            $data['article_titre'] ?? '',
            $data['article_contenu'] ?? '',
            $data['theme_id'] ?? '',
            $data['picture'] ?? ''
        );
    }
    return $arrayArticles;
}

public static function countArticlesBySearch($search) {
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT COUNT(*) AS total FROM articles WHERE article_titre LIKE :search";
    $stmt = $bd->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
}


// --------------------------------------------------------
}
