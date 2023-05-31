<?php

class JwtService{
     private $encrypt_method = 'AES-256-CBC';          
     private $key = 'TaskPhp';
     private $iv = '!IV@_$2';

     public function encryptByIdAndEmail($id,$email) {
          $output = openssl_encrypt($id . $this->key . $email, $this->encrypt_method, $this->key, 0, $this->iv);
          return base64_encode($output);

     }
            
     public function decrypt($token) {

          $output = openssl_decrypt(base64_decode($token), $this->encrypt_method, $this->key, 0, $this->iv);

          if($output){
               $exp = explode($this->key, $output);
               return [
                    'id' => $exp[0],
                    'email' => $exp[1]
               ];

          }

          return 0;

     }
}

?>