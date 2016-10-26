<?php

namespace App\Controllers\Api;

use Core\Mvc\Api;
use App\Model\Crypt;

class Cryptapi extends Api
{
    
    private $crypt;
    
    
    public function __construct($request, $origin) {
        parent::__construct($request);

        $this->crypt = new Crypt();
        
    }    
    
	public function encrypt_post()
    {    	
        $string = $this->request['string'];
        $Key = $this->request['key'];
        $this->_response(array('ret'=>$this->crypt->encrypt( $string , $Key )));
    }

	public function decrypt_post()
    {    	
        $string = $this->request['string'];
        $Key = $this->request['key'];
        $this->_response(array('ret'=>$this->crypt->decrypt( $string , $Key )));
    }
    
}