

<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  

class Users extends Controller {
    
 


    public function __construct(){
     
      $this->userModel = $this->model('User');

      
    }

    public function register(){

        
            
         $this->data->password=password_hash($this->data->password ,PASSWORD_DEFAULT);
        // die(var_dump($this->data));
             $user = $this->userModel->register($this->data);
            
             print_r(json_encode($user));
                    
    }
    

    public function login(){
      // Check for POST

      $user = $this->userModel->findUserByEmail($this->data->email);
      
    //  die(print_r($user));
        if ($user) { 

             if(password_verify($this->data->password,$user->password)){
               unset($user->password);
               unset($user->id);
                 echo json_encode(array("message"=>"todos buenes","user"=>$user));
             }else{
                echo json_encode(array("message"=>"nada buenes"));
             }
                
    }else{
       echo json_encode(array("message"=>"nada user"));
    }
    }


      

      
      

  
  }