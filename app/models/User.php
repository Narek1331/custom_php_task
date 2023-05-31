<?php
require_once('conf/Database.php');

class User {
     private $db;
     private $table_name = "users";
 
     public function __construct() {
         $this->db = new Database();
     }
 
     public function get_by_id($id) {
         $sql = "SELECT * FROM $this->table_name WHERE id = $id";
         $result = $this->db->query($sql);
         return $result->fetch_assoc();
     }

     public function get_by_email($email) {
        $sql = "SELECT * FROM $this->table_name WHERE email = '$email'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }

     public function all() {
          $sql = "SELECT * FROM $this->table_name";
          $result = $this->db->query($sql);
          return $result->fetch_assoc();
      }
 
     public function store($name,$email,$password) {
        $sql = "INSERT INTO $this->table_name (name, email, password) VALUES ('$name','$email','$password');";
        $result = $this->db->query($sql);
     }
 
     public function __destruct() {
         $this->db->close();
     }
 }