<?php
require_once('app/services/UserService.php');

class UserController{

     private $user_service;

     public function __construct(){
          $this->user_service = new UserService();
     }

     public function index(){
          http_response_code(200);
          return json_encode($this->user_service->get());
     }
}