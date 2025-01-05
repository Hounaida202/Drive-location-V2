
<?php



class reservations{


    private $reservation_id;
    private $date1;
    private $date2;
    private $lieu;
    private $vehicule_id;
    private $user_id;

    public function __construct($id=null,$date1=0,$date2=0,$lieu='', $vehicule_id = null,$user_id=null){
        $this->reservation_id=$id;
        $this->date1=$date1;
        $this->date2=$date2;
        $this->lieu=$lieu;
        $this->vehicule_id=$vehicule_id;
        $this->user_id=$user_id;


 
        }
        // getters
        
        public function getReservationId(){
            return $this->reservation_id;
        }
        public function getReservationDate1(){
            return $this->date1;
        }
        public function getReservationDate2(){
            return $this->date2;
        }
        public function getReservationlieu(){
            return $this->lieu;
        }
        public function getVehiculeId(){
            return $this->vehicule_id;
        }
        public function getUserId(){
            return $this->user_id;
        }
     
  
//         public static function AddNewReservation($date1,$date2,$lieu,$vehicule_id,$user_id){
//     $db = Database::getInstance()->getConnection();

// $sql="INSERT INTO reservations (date1,date2,lieu,vehicule_id,user_id)
// VALUES(:date1,:date2,:lieu,:vehicule_id,:user_id)";
//         $stmt = $db->prepare($sql);

//         $stmt->execute([
//             ':date1' => $date1,
//             ':date2' => $date2,
//             ':lieu' => $lieu,
//             ':vehicule_id' => $vehicule_id,
//             ':user_id' => $user_id
//         ]);
//         return new self($db->lastInsertId(), $date1, $date2, $lieu, $vehicule_id,$user_id);
//         }    
public static function AddNewReservation($date1, $date2, $lieu, $vehicule_id, $user_id) {
    $db = database::getInstance()->getConnection();

    $sql = "INSERT INTO reservations (date1, date2, lieu, vehicule_id, user_id)
            VALUES (:date1, :date2, :lieu, :vehicule_id, :user_id)";
    $stmt = $db->prepare($sql);

    $stmt->execute([
        ':date1' => $date1,
        ':date2' => $date2,
        ':lieu' => $lieu,
        ':vehicule_id' => $vehicule_id,
        ':user_id' => $user_id
    ]);

    return new self($db->lastInsertId(), $date1, $date2, $lieu, $vehicule_id, $user_id);
}




        public static function getAllReservationsByVehicule($categorie_id){

            $bd= database::getInstance()->getConnection();
            $sql="SELECT vehicules.*FROM vehicules 
            INNER JOIN reservations ON vehicules.vehicule_id = reservations.vehicule_id
            INNER JOIN users ON reservations.user_id = users.user_id
            WHERE vehicules.categorie_id = :categorie_id";

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