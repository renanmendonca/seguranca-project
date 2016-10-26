<?php

namespace App\Controllers\Api;

use Core\Mvc\Api;
use Core\Mvc\Model;
use App\Lib\ssh\SSHConnection;
use App\Lib\ssh\auth\SSHAuthenticatePassword;

class Sshapi extends Api
{
    
    private $Com;
    
    
    public function __construct($request, $origin) {
        parent::__construct($request);

        $this->Com = new SSHConnection();
    	$server = $this->request['server'];
    	$user = $this->request['user'];
    	$password = $this->request['password'];
        $this->Com->open( $server ); //186.250.138.131
        $this->Com->authenticate( new SSHAuthenticatePassword( $user , $password ) );

    }    
    
	public function command_post()
    {    	
        $command = $this->request['command'];
        $this->_response(array('ret'=>$this->Com->execute( $command ))); //ls -l /var/www/
    }
}