<?php

// require_once'./classes/database.php';
// require_once'./classes/categories.php';

class rating{
    private $rating_id;
    private $rating_value;


    

    public function __construct($rating_id=null,$rating_value=''){
        $this->rating_id=$rating_id;
        $this->rating_value=$rating_value;
        }
        // getters
        
        // public function gettagId(){
        //     return $this->rating_id;
        // }
        // public function gettagname(){
        //     return $this->rating_value;
        // }

        public static function insertRating($rating_value,$idReservation){
            $bd = database::getInstance()->getConnection();
            $sql = "INSERT INTO rating (rating_value,reservation_id) VALUES
                    (:rating_value,:reservation_id)";
        
            $stmt = $bd->prepare($sql);
            $stmt->execute([
                ':rating_value' => $rating_value,
                ':reservation_id' => $idReservation,
               
            ]);
        
            return $bd->lastInsertId();  
        }
        
public static function getRate($idReservation){
    $bd= database::getInstance()->getConnection();
    $sql = " SELECT * FROM rating WHERE reservation_id=:reservation_id"; 
    $stmt=$bd->prepare($sql);
    $stmt->execute(
        [
            ':reservation_id' => $idReservation,

        ]
    );
    
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
     
    return $result;
}
}