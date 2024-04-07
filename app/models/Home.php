<?php

class Home {
    private $db;
    

    public function __construct() {
        $this->db = new Database;
    }

    public function getUserByUsername($data){
        $this->db->query('SELECT * FROM users WHERE  username=:username');
        $this->db->bind(':username',$data['username']);
        if($this->db->rowCount() > 0){
            $row = $this->db->single();
            $hashedpass = $row->password;
            if(password_verify($data['password'],$hashedpass)){
                return $row;
            }else{
                return false;
            }
        }

    }
}