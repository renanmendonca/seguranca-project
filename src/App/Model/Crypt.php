<?php

namespace App\Model;

use Core\Mvc\Model;

class Crypt extends Model{
     
    // Chave Privada do Sistema
    private static $salt = 'Lu70K$z3pu5xf7*I8nNud@x2oODwgDRr4&xjuyTh';
    
    public  function encrypt($plain,$key,$hmacSalt = null){ 
        if(!$plain){return false;}
        
        if ($hmacSalt === null) {
            $hmacSalt = self::$salt;
        }        
        
        
        $key = substr(hash('sha256', $key . $hmacSalt), 0, 32); 
        
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $plain, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext)); 
    }
    
    public function decrypt($cipher, $key,$hmacSalt = null){
        if(!$cipher){return false;}
        
        if ($hmacSalt === null) {
            $hmacSalt = self::$salt;
        }        
        
        
        $key = substr(hash('sha256', $key . $hmacSalt), 0, 32); 
        
        $crypttext = $this->safe_b64decode($cipher); 
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }   
    
    private  function safe_b64encode($string) {
        $data = base64_encode($string);
        $data = str_replace(array('+','/','='),array('-','_',''),$data);
        return $data;
    }
    
    private function safe_b64decode($string) {
        $data = str_replace(array('-','_'),array('+','/'),$string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }    
    
}