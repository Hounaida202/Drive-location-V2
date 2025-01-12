<?php

// require_once'./classes/database.php';
// require_once'./classes/categories.php';
require_once 'article-tag.php';


class article_tag{
    private $article_tag_id;
    private $tag_id;
    private $article_id;


    

    public function __construct($article_tag_id,$tag_id=null,$article_id=''){
        $this->article_tag_id=$article_tag_id;
        $this->tag_id=$tag_id;
        $this->article_id=$article_id;
        }
        // getters
        public function getarticletagId(){
            return $this->article_tag_id;
        }
        public function gettagId(){
            return $this->tag_id;
        }
        public function getarticleid(){
            return $this->article_id;
        }


public static function getAlltags(){
    $bd= database::getInstance()->getConnection();
    $sql = " SELECT * FROM tags"; 
    $stmt=$bd->prepare($sql);
    $stmt->execute();
    $arraytags=[];
    while ($data=$stmt->fetch(PDO::FETCH_ASSOC)){
        $arraytags[]= $data;
    }
    return $arraytags;
  }


  public static function associer($tag_id, $article_id) {
    $bd= database::getInstance()->getConnection();

    $sql = "INSERT INTO article_tag (tag_id, article_id) VALUES (:tag_id, :article_id)";
    $stmt=$bd->prepare($sql);
    $stmt->bindParam(":tag_id", $tag_id);
    $stmt->bindParam(":article_id", $article_id);
    return $stmt->execute();
}


// public static function afficher()
// {
//     $bd = database::getInstance()->getConnection();
//     $query = "
//         SELECT 
           
//             article_titre,article_contenu,picture,tag_name
//         FROM articles
//         LEFT JOIN article_tag ON articles.article_id = article_tag.article_id
//         LEFT JOIN tags ON article_tag.tag_id = tags.tag_id
//         GROUP BY articles.article_id
//         ORDER BY articles.article_titre;
//     ";
//     $stmt = $bd->prepare($query);
//     $stmt->execute();
//     $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     return $resultats;
//     }

// public static function affichertagassocier(){
//     $bd = database::getInstance()->getConnection();
// $sql="SELECT * FROM tags
// left JOIN article_tag
// ON article_tag.tag_id=tags.tag_id
// left join articles on articles.article_id=article_tag.article_id
// ";
//  $stmt = $bd->prepare($sql);
//  $stmt->execute();
//  $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
//  return $resultats;
// }
public static function affichertagassocier($article_id){
    $bd = database::getInstance()->getConnection();
    $sql = "SELECT tags.tag_name 
            FROM tags
            LEFT JOIN article_tag ON article_tag.tag_id = tags.tag_id
            WHERE article_tag.article_id = :article_id";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
    $stmt->execute();
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultats;
}


}