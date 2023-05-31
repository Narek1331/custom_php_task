<?php
require_once('app/services/UserService.php');
require_once('app/services/JwtService.php');

class AuthController{

     private $user_service;
     private $jwt_service;

     public function __construct(){
          $this->user_service = new UserService();
          $this->jwt_service = new JwtService();
     }

     public function signup(){
          $body = file_get_contents('php://input');
          $body_dec = json_decode($body);

          if(!isset($body_dec->name) || !isset($body_dec->email) || !isset($body_dec->password)){
               http_response_code(422);
               return json_encode([
                    'message' => 'invalid data',
                    'status' => false
               ]);
          }

          if($this->user_service->getByEmail($body_dec->email)){
               http_response_code(422);
               return json_encode([
                    'message' => 'email already exists',
                    'status' => false
               ]);
          }

          $this->user_service->store($body_dec->name,$body_dec->email,$body_dec->password);
          http_response_code(201);
          return json_encode([
               'message' => 'user created successfully, please login',
               'status' => true
          ]);
     }

     public function login(){
          $body = file_get_contents('php://input');
          $body_dec = json_decode($body);
          
          if(!isset($body_dec->email) || !isset($body_dec->password)){
               http_response_code(422);
               return json_encode([
                    'message' => 'invalid data',
                    'status' => false
               ]);
          }

          $user = $this->user_service->getByEmail($body_dec->email);

          if(!$user){
               http_response_code(422);
               return json_encode([
                    'message' => 'email does not exist in our database',
                    'status' => false
               ]);
          }

          if(base64_decode($user['password']) != $body_dec->password){
               http_response_code(422);
               return json_encode([
                    'message' => 'invalid password',
                    'status' => false
               ]);
          }

          $token = $this->jwt_service->encryptByIdAndEmail($user['id'],$body_dec->email);

          http_response_code(200);
          return json_encode([
               'name' => $user['name'],
               'email' => $user['email'],
               'access_token' => $token,
               'status' => true
          ]);


     }
}