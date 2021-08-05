<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  



class Rdvini extends Controller{

  public $data;

    public function __construct()
    {
       $this->RdvModel =$this->model('Rdv');
    }
  
     public function add()
    {
      $RDV = $this->RdvModel->add($this->data);
        print_r(json_encode(array(
          "error"=>NULL,
          "message" => "RDV Created with success",
         "data" => $this->data
       )));
     }  
     public function getMine(){
      //  print_r($this->data);
       $RDVs = $this->RdvModel->getMine($this->data);
       print_r(json_encode(array(
        "message" => "OK",
         "rdvs" => $RDVs
       )));
     }
     
        public function getRdvBydate(){
      //  print_r($this->data);
       $RDVs = $this->RdvModel->getRdvBydate($this->data);
       print_r(json_encode(array(
        "message" => "OK ",
         "rdvs" => $RDVs
       )));
     }

       public function delete()
    {
      $RDV = $this->RdvModel->delete($this->data);
      if($RDV){
        echo 'dddd';
      }
      else{
       echo 'rdvv';
      }
        print_r(json_encode(array(
        
        "message" => "RDV deleted with success",
         "data" => $this->data
       )));
     }  
  
      
    

    

}
