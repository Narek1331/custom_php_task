<?php
require_once('app/models/User.php');
class UserService{

     private $user_model;
     public function __construct(){
          $this->user_model = new User();
     }
     
     public function get(){
          return $this->user_model->all();
     }

     public function getByEmail($email){
          return $this->user_model->get_by_email($email);
     }

     public function store($name,$email,$password){
          $password = base64_encode($password);
          return $this->user_model->store($name,$email,$password);
     }


}