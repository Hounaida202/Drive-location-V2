<?php

// require_once'./classes/database.php';
// require_once'./classes/categories.php';

class vehicule{
    private $vehicule_id;
    private $vehicule_model;
    private $disponibilite;
    private $prix;
    private $categorie_id;
    private $picture;

    public function __construct($vehicule_id=null,$model='',$dispo='',$prix=0, $categorie_id = null,$picture=''){
        $this->vehicule_id=$vehicule_id;
        $this->vehicule_model=$model;
        $this->disponibilite=$dispo;
        $this->prix=$prix;
        $this->categorie_id=$categorie_id;
        $this->picture=$picture;


 
        }
        // getters
        
        public function getVehiculeId(){
            return $this->vehicule_id;
        }
        public function getVehiculeModele(){
            return $this->vehicule_model;
        }
        public function getVehiculeDispo(){
            return $this->disponibilite;
        }
        public function getVehiculePrix(){
            return $this->prix;
        }
        public function getCategorieId(){
            return $this->categorie_id;
        }
        public function getCategoriePicture(){
            return $this->picture;
        }
        

// methode pour get les vehicules

// public static function getAllVehicules(){
//     $bd= database::getInstance()->getConnection();
//     $sql = " SELECT * FROM vehicules INNER JOIN categories
//      ON categories.categorie_id=vehicules.categorie_id
//      "; 
//     $stmt=$bd->prepare($sql);
//     $stmt->execute();
//     $arrayVehicules=[];
//     while ($data=$stmt->fetch(PDO::FETCH_ASSOC)){
//         $arrayVehicules[]=new self (
//             isset( $data['vehicule_id'])? $data['vehicule_id'] : '',
//             isset( $data['vehicule_model'])? $data['vehicule_model'] : '',
//             isset( $data['disponibilite'])? $data['disponibilite'] : '',
//             isset( $data['prix'])? $data['prix'] : '',
//             isset( $data['categorie_id'])? $data['categorie_id'] : '',
//             isset( $data['picture'])? $data['picture'] : '',
//         );
//     }
//     return $arrayVehicules;
// }



// public static function createvehicule($nom, $modele, $dispo, $prix, $categorie_id, $picture) {
//     $db = Database::getInstance()->getConnection();
//         $sql = "INSERT INTO vehicules (vehicule_nom, vehicule_modele, disponibilite, prix, categorie_id, picture) 
//             VALUES (:nom, :modele, :dispo, :prix, :categorie_id, :picture)";
    
//     $stmt = $db->prepare($sql);
//         $stmt->execute([
//         ':nom' => $nom,
//         ':modele' => $modele,
//         ':dispo' => $dispo,
//         ':prix' => $prix,
//         ':categorie_id' => $categorie_id,
//         ':picture' => $picture
//     ]);
    
//     return new self($db->lastInsertId(), $nom, $modele, $dispo, $prix, $categorie_id, $picture);
// }

public static function createvehicule($nom, $modele, $dispo, $prix, $categorie_id, $picture) {
    $db = Database::getInstance()->getConnection();
    $sql = "INSERT INTO vehicules (vehicule_name, vehicule_model, disponibilite, prix, categorie_id, picture) 
        VALUES (:nom, :modele, :dispo, :prix, :categorie_id, :picture)";
    
    $stmt = $db->prepare($sql);
    $stmt->execute([
        ':nom' => $nom,
        ':modele' => $modele,
        ':dispo' => $dispo,
        ':prix' => $prix,
        ':categorie_id' => $categorie_id,
        ':picture' => $picture,
    ]);
    
    return new self($db->lastInsertId(), $nom, $modele, $dispo, $prix, $categorie_id, $picture);
}
public function deletevehicule() {
    $db = Database::getInstance()->getConnection();
    $sql = "DELETE FROM vehicules WHERE vehicule_id = :id";  
    $stmt = $db->prepare($sql);
    return $stmt->execute([':id' => $this->vehicule_id
]);
}


// public static function createcategorie($nom) {
//     $db = Database::getInstance()->getConnection();
//     $sql = "INSERT INTO categories (categorie_name) VALUES (:nom)";
//     $stmt = $db->prepare($sql);
//     $stmt->execute([':nom' => $nom]);
//     return new self($db->lastInsertId(), $nom);
// }



public static function getAllVehiculesByCategory($categorie_id){

    $bd= database::getInstance()->getConnection();
    $sql = " SELECT * FROM vehicules WHERE vehicules.categorie_id = :categorie_id"; 
//  WHERE categories.categorie_id= :categorie_id
    $stmt=$bd->prepare($sql);

    $stmt->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);

    $stmt->execute();
    $arrayVehicules=[];
    while ($data=$stmt->fetch(PDO::FETCH_ASSOC)){
        $arrayVehicules[]=new self (
            isset( $data['vehicule_id'])? $data['vehicule_id'] : '',
            isset( $data['vehicule_model'])? $data['vehicule_model'] : '',
            isset( $data['disponibilite'])? $data['disponibilite'] : '',
            isset( $data['prix'])? $data['prix'] : '',
            isset( $data['categorie_id'])? $data['categorie_id'] : '',
            isset( $data['picture'])? $data['picture'] : '',
        );
    }
    return $arrayVehicules;
}
}
