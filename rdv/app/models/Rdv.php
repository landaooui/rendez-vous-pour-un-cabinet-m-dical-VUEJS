<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class Rdv{
    private $db ;


    public function __construct()
    {
        $this->db =new Database ;
    }

        public function add($data){
      $this->db->query('INSERT INTO rdv (time_rdv,date_rdv,reference) VALUES(:time_rdv,:date,:reference)');
      // Bind values
      // $this->db->bind(':date_rdv',$data->date_rdv);
      $this->db->bind(':time_rdv',$data->time_rdv);
      $this->db->bind(':reference',$data->reference);
      $this->db->bind(':date',$data->date);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
    public function update($data){
      $this->db->query('UPDATE rdv  SET  date_rdv=:date_rdv,time_rdv=:time_rdv WHERE reference=:reference');
      // Bind values
      $this->db->bind(':date_rdv',$data->date_rdv);
      $this->db->bind(':time_rdv',$data->time_rdv);
      $this->db->bind(':reference',$data->reference);
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
     public function delete($data){
      $this->db->query('DELETE FROM rdv WHERE id=:id');
      $this->db->bind(':id' ,$data->id);

       // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }

    } 
     public function getMine($data){
      $this->db->query('SELECT * FROM rdv WHERE reference = :reference');
      $this->db->bind(':reference' ,$data );
      $RDVs = $this->db->resultSet();
       // Execute
      if($RDVs){
        return $RDVs;
      } else {
        return false;
      }
    } 

    public function getRdvBydate($data){
      $this->db->query('SELECT * FROM rdv WHERE date_rdv = :date_rdv');
      $this->db->bind(':date_rdv' ,$data->time_rdv );
        $RDVs = $this->db->resultSet();
       // Execute
      if($RDVs){
        return $RDVs;
      } else {
        return false;
      }
    }


    
        
}