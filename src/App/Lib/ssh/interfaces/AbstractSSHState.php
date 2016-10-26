<?php
namespace App\Lib\ssh\interfaces;

abstract class AbstractSSHState implements ISSHState {
        /**
         * @var resource
         */
        protected $resource;
 
        /**
         * Autentica o usuário
         * @param ISSHAuthentication $auth
         * @param ISSHConnection $context
         * @return boolean
         * @throws BadMethodCallException se o estado não implementar o método authenticate
         */
        public function authenticate( ISSHAuthentication $auth , ISSHConnection $context ){
                throw new \BadMethodCallException( sprintf( '%s não implementa o método %s' , get_class( $this ) , __METHOD__ ) );
        }
 
        /**
         * Executa um comando no servidor remoto
         * @param string $command
         * @param ISSHConnection $context
         * @return boolean
         * @throws BadMethodCallException se o estado não implementar o método execute
         */
        public function execute( $command , ISSHConnection $context ){
                throw new \BadMethodCallException( sprintf( '%s não implementa o método %s' , get_class( $this ) , __METHOD__ ) );
        }
 
        /**
         * Recupera a fingerprint do servidor
         * @param ISSHConnection $context
         * @return string
         * @throws BadMethodCallException se o estado não implementar o método execute
         */
        public function getFingerprint( ISSHConnection $context ){
                throw new \BadMethodCallException( sprintf( '%s não implementa o método %s' , get_class( $this ) , __METHOD__ ) );
        }
 
        /**
         * Abre uma nova conexão
         * @param string $host
         * @param integer $port
         * @param ISSHConnection $context
         * @return boolean
         * @throws BadMethodCallException se o estado não implementar o método open
         */
        public function open( $host , $port = 22 , ISSHConnection $context ){
                throw new \BadMethodCallException( sprintf( '%s não implementa o método %s' , get_class( $this ) , __METHOD__ ) );
        }
 
        /**
         * Define o recurso da conexão
         * @param resource $resource
         * @throws InvalidArgumentException se o recurso não for válido
         */
        public function setResource( &$resource ){
                if ( !is_resource( $resource ) ){
                        throw new \InvalidArgumentException( 'Recurso inválido.' );
                } else {
                        $this->resource =& $resource;
                }
        }
}