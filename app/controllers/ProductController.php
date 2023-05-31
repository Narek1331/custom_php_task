<?php
require_once('app/services/ProductService.php');
require_once('app/middlewares/Auth.php');

class ProductController{

     private $product_service;
     private $auth_middleware;

     public function __construct(){
          $this->product_service = new ProductService();
          $this->auth_middleware = new AuthMiddleware();
     }

     public function index(){
          $user = $this->auth_middleware->auth();
          $products = $this->product_service->getByUserId($user['id']);
          
          http_response_code(200);
          return json_encode([
               'datas' => $products,
               'status' => true
          ]);
     }

     public function store(){

          $user = $this->auth_middleware->auth();
          
          $body = file_get_contents('php://input');
          $body_dec = json_decode($body);

          if(!isset($body_dec->name)){
               http_response_code(422);
               return json_encode([
                    'message' => 'invalid data',
                    'status' => false
               ]);
          }

          $this->product_service->store($user['id'],$body_dec->name);

          http_response_code(201);
          return json_encode([
               'message' => 'product successfuly created',
               'status' => true
          ]);
     }

     public function destroy(){
          $user = $this->auth_middleware->auth();
          
          $body = file_get_contents('php://input');
          $body_dec = json_decode($body);

          if(!isset($body_dec->id)){
               http_response_code(422);
               return json_encode([
                    'message' => 'invalid data',
                    'status' => false
               ]);
          }

          $this->product_service->delete($body_dec->id);

          http_response_code(200);
          return json_encode([
               'message' => 'product deleted created',
               'status' => true
          ]);
     }

     public function update(){

          $user = $this->auth_middleware->auth();
          
          $body = file_get_contents('php://input');
          $body_dec = json_decode($body);

          if(!isset($body_dec->name) || !isset($body_dec->id)){
               http_response_code(422);
               return json_encode([
                    'message' => 'invalid data',
                    'status' => false
               ]);
          }

          $this->product_service->update($body_dec->id,$body_dec->name);

          http_response_code(200);
          return json_encode([
               'message' => 'product updated created',
               'status' => true
          ]);
     }
}