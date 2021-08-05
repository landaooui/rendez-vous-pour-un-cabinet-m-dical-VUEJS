<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class User{
    private $db ;


    public function __construct()
    {
        $this->db =new Database ;
    }


        public function uniqID($lenght = 8) {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }




public function register($data){
        // die(print_r($data)); 
    $this->db->query('INSERT INTO users (nom , prenom , date_naissance , email , password, reference ) VALUES (:nom, :prenom, :date_naissance, :email, :password, :reference)');
   
    // bind value
      $this->db->bind(':nom',$data->first_name);
      $this->db->bind(':prenom',$data->last_name);
      $this->db->bind(':date_naissance',$data->date_naissance);
      $this->db->bind(':password',$data->password);
      $this->db->bind(':email',$data->email);
      $this->db->bind(':reference',strtoupper($this->uniqID()));
        // execute

        if($this->db->execute()){
            return true ;
        } else {
            return false ;
        }
         
          
}

   // Login User
    public function login($datal){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      $this->db->bind(':email',$this->data->email);
      $row = $this->db->single();
      if(password_verify($this->data->password,$row->Password)){
          
        return $row;
        
      } else {
        return false;
     
      }
    } 

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM users WHERE email =:email');
        $this->db->bind(':email',$email);
        $row =$this->db->single();
        
        //chck row

        if ($this->db->rowCount()>0){
            return $row ;
        } else {
        return false ;
        }
    }
}