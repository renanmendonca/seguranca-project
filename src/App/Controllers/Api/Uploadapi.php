<?php

namespace App\Controllers\Api;

use Core\Mvc\Api;
use App\Model\Upload;

class Uploadapi extends Api
{
    
    private $upload;
    
    public function __construct($request, $origin) {
        parent::__construct($request);

        $this->upload = new Upload();
        
    }    
    
	public function fileUpload_post()
    {    	
        $file = $_FILES;
        $this->_response(array('ret'=>$this->upload->save_file( $file )));
    }

    public function file_get()
    {    	
        $this->_response(array('ret'=>$this->upload->gitFiles()));
    }
    
}