<?php
namespace App\Lib\ssh\interfaces;


interface ISSHConnection {
        /**
         * Autentica um usuário
         * @param ISSHAuthentication $auth
         * @return boolean
         */
        public function authenticate( ISSHAuthentication $auth );
 
        /**
         * Executa um comando no servidor remoto
         * @param string $command
         * @return boolean
         */
        public function execute( $command );
 
        /**
         * Recupera a fingerprint do servidor
         * @return string
         */
        public function getFingerprint();
 
        /**
         * Abre uma nova conexão
         * @param stirng $host
         * @param integer $port
         * @return boolean
         */
        public function open( $host , $port );
 
        /**
         * Modifica o estado da conexão
         * @param ISSHState $state
         */
        public function changeState( ISSHState $state );

}