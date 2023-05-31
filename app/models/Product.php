<?php
require_once('conf/Database.php');

class Product {
     private $db;
     private $table_name = "products";
 
     public function __construct() {
         $this->db = new Database();
     }
 
     public function get_by_id($id) {
         $sql = "SELECT * FROM $this->table_name WHERE id = $id";
         $result = $this->db->query($sql);
         return $result->fetch_assoc();
     }

     public function get_by_user_id($user_id) {
          $sql = "SELECT * FROM $this->table_name WHERE user_id = $user_id";
          $result = $this->db->query($sql);
          $rows = [];
          while($row = mysqli_fetch_assoc($result))
             {
           $rows[] = $row;

          }
          return $rows;
      }

     public function get_by_name($name) {
        $sql = "SELECT * FROM $this->table_name WHERE name = '$name'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }

     public function all() {
          $sql = "SELECT * FROM $this->table_name";
          $result = $this->db->query($sql);
          return $result->fetch_assoc();
      }
 
     public function store($user_id,$name) {
        $sql = "INSERT INTO $this->table_name (user_id, name) VALUES ('$user_id','$name');";
        $result = $this->db->query($sql);
     }
     
     public function update_by_id($id,$name) {
        $sql = "UPDATE $this->table_name
        SET name = '$name'
        WHERE id = $id;";
        $result = $this->db->query($sql);
     }

     public function delete_by_id($id) {
          $sql = "DELETE FROM $this->table_name WHERE id = $id;";
          $result = $this->db->query($sql);
       }
 
     public function __destruct() {
         $this->db->close();
     }
 }