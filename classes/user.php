<?php

class user{


    private $id;
    private $username;
    private $email;
    private $password;
    private $role_id;


    public function __construct($id = null, $username = '', $email = '', $password = '', $role_id = 0) {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role_id = $role_id;
    }

// getters

  public function getId() { return $this->id; }
    public function getUsername() { return $this->username; }
    public function getEmail() { return $this->email; }
    public function getIsAdmin() { return $this->role_id; }

    // Setters
    public function setUsername($username) { $this->username = $username; }
    public function setEmail($email) { $this->email = $email; }
    public function setPassword($password) { $this->password = $password; }
    public function setIsAdmin($is_admin) { $this->role_id = $is_admin; }
    

}

$user=new user();