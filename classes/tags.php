<?php

// require_once'./classes/database.php';
// require_once'./classes/categories.php';

class tags{
    private $tag_id;
    private $tag_name;


    

    public function __construct($tag_id=null,$tag_name=''){
        $this->tag_id=$tag_id;
        $this->tag_name=$tag_name;
        }
        // getters
        
        public function gettagId(){
            return $this->tag_id;
        }
        public function gettagname(){
            return $this->tag_name;
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
}