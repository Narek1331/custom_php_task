<?php
require_once('app/services/JwtService.php');
class AuthMiddleware{

     private $jwt_service;

     public function __construct(){
          $this->jwt_service = new JwtService();
     }
     public function auth(){

          if(!isset($_SERVER['HTTP_AUTHORIZATION'])){
               http_response_code(401);
               echo json_encode([
                    'message' => 'Unauthorized user',
                    'status' => false
               ]);
               die;
          }

          $exp = explode(" ", $_SERVER['HTTP_AUTHORIZATION']);

          if(($exp[0] == 'Bearer') && isset($exp[1])){
               $user = $this->jwt_service->decrypt($exp[1]);

               if(!$user){
                    http_response_code(401);
                    echo json_encode([
                         'message' => 'Invalid access_token',
                         'status' => false
                    ]);
                    die;
               }
               
               return $user;

          }else{
               http_response_code(401);
               echo json_encode([
                    'message' => 'Unauthorized user',
                    'status' => false
               ]);
               die;
          }

     }
}

?>