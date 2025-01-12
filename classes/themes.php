<?php
require_once '../classes/database.php';
class themes{

private $theme_id;
private $theme_titre;


public function __construct($theme_id,$theme_titre)
{
    $this->theme_id=$theme_id;
    $this->theme_titre=$theme_titre;
}

// getters
public function getthemeId(){
    return $this->theme_id;
}
public function getthemeName(){
    return $this->theme_titre;
}


public static function getAllthemes(){
    $bd= database::getInstance()->getConnection();
    $sql = " SELECT * FROM themes "; 
    $stmt=$bd->prepare($sql);
    $stmt->execute();
    $arraythemes=[];
    while ($data=$stmt->fetch(PDO::FETCH_ASSOC)){
        $arraythemes[]=new self (
            isset( $data['theme_id'])? $data['theme_id'] : '',
            isset( $data['theme_name'])? $data['theme_name'] : '',
        );
    }
    return $arraythemes;
}
}