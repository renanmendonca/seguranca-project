<?php

namespace App\Lib\ssh;


use App\Lib\ssh\interfaces\ISSHConnection;


use App\Lib\ssh\interfaces\ISSHAuthentication;

use App\Lib\ssh\interfaces\ISSHState;

use App\Lib\ssh\state\SSHStateClosed;


class SSHConnection implements ISSHConnection {
        /**
         * @var ISSHState
         */
        private $state;
 
        /**
         * Cria o objeto de conexão
         */
        public function __construct(){
                $this->state = new SSHStateClosed();
        }
 
        /**
         * Faz a autenticação no servidor
         * @param ISSHAuthentication $auth
         * @return boolean
         */
        public function authenticate( ISSHAuthentication $auth ){
                return $this->state->authenticate( $auth , $this );
        }
 
        /**
         * Executa um comando no servidor
         * @param string $command
         * @return boolean
         */
        public function execute( $command ){
                return $this->state->execute( $command , $this );
        }
 
        /**
         * Recupera a fingerprint do servidor
         * @return string
         */
        public function getFingerprint(){
                return $this->state->getFingerprint( $this );
        }
 
        /**
         * Abre uma conexão com um servidor remoto
         * @param string $host
         * @param integer $port
         * @return boolean
         */
        public function open( $host , $port = 22 ){
                return $this->state->open( $host , $port , $this );
        }
 
        /**
         * Modifica o estado da conexão
         * @param ISSHState $state
         */
        public function changeState( ISSHState $state ){
                $this->state =& $state;
        }
}