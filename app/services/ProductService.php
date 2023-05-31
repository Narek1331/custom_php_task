<?php
require_once('app/models/Product.php');

class ProductService{

     private $product_model;
     public function __construct(){
          $this->product_model = new Product();
     }

     public function getByUserId($user_id){
          return $this->product_model->get_by_user_id($user_id);
     }

     public function store($user_id,$product_name){
          return $this->product_model->store($user_id,$product_name);
     }

     public function update($id,$product_name){
          return $this->product_model->update_by_id($id,$product_name);
     }

     public function delete($id){
          return $this->product_model->delete_by_id($id);
     }
     
}