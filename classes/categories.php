<?php
class categories {
  private $categorie_id;
  private $categorie_name;

public function __construct($id=null,$name=''){
$this->categorie_id=$id;
$this->categorie_name=$name;

}

public function getCategorieId(){
    return $this->categorie_id;
}
public function getCategorieName(){
    return $this->categorie_name;
}

public static function createcategorie($nom) {
    $db = Database::getInstance()->getConnection();
    $sql = "INSERT INTO categories (categorie_name) VALUES (:nom)";
    $stmt = $db->prepare($sql);
    $stmt->execute([':nom' => $nom]);
    return new self($db->lastInsertId(), $nom);
}

public function deletecategorie() {
    $db = Database::getInstance()->getConnection();
    $sql = "DELETE FROM categories WHERE categorie_id = :id";  
    $stmt = $db->prepare($sql);
    return $stmt->execute([':id' => $this->categorie_id]);
}


public function updatecategorie() {
    $db = database::getInstance()->getConnection();
    $sql = "UPDATE categories SET categorie_name = :nom WHERE categorie_id = :id";  
    $stmt = $db->prepare($sql);

    return $stmt->execute([
        ':id' => $this->categorie_id,
        ':nom' => $this->categorie_name
    ]);
}




public static function getAllCategories(){
$bd= database::getInstance()->getConnection();
$sql = " SELECT * FROM categories "; 
$stmt=$bd->prepare($sql);
$stmt->execute();
$arrayCategories=[];
while ($data=$stmt->fetch(PDO::FETCH_ASSOC)){
    $arrayCategories[]=new self (
        isset( $data['categorie_id'])? $data['categorie_id'] : '',
        isset( $data['categorie_name'])? $data['categorie_name'] : '',

    );
}
return $arrayCategories;
}

}

