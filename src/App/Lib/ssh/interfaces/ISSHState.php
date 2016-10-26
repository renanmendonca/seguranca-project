<?php
namespace App\Lib\ssh\interfaces;

interface ISSHState {
        /**
         * Autentica o usuário
         * @param ISSHAuthentication $auth
         * @param ISSHConnection $context
         */
        public function authenticate( ISSHAuthentication $auth , ISSHConnection $context );
 
        /**
         * Executa um comando no servidor remoto
         * @param string $command
         * @param ISSHConnection $context
         */
        public function execute( $command , ISSHConnection $context );
 
        /**
         * Recupera a fingerprint do servidor
         * @param ISSHConnection $context
         * @return string
         */
        public function getFingerprint( ISSHConnection $context );
 
        /**
         * Abre uma nova conexão
         * @param string $host
         * @param integer $port
         * @param ISSHConnection $context
         */
        public function open( $host , $port = 22 , ISSHConnection $context );
 
        /**
         * Define o recurso da conexão
         * @param resource $resource
         */
        public function setResource( &$resource );
}