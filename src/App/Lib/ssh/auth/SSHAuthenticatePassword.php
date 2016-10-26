<?php
namespace App\Lib\ssh\auth;

use App\Lib\ssh\interfaces\ISSHAuthentication;

final class SSHAuthenticatePassword implements ISSHAuthentication {
        /**
         * @var string
         */
        private $user;
 
        /**
         * @var string
         */
        private $pswd;
 
        /**
         * Constroi o objeto de autenticação
         * @param string $user
         * @param string $pswd
         */
        public function __construct( $user , $pswd ){
                $this->user =& $user;
                $this->pswd =& $pswd;
        }
 
        /**
         * Efetua a autenticação
         * @param resource $resource
         * @throws InvalidArgumentException se o recurso não for válido
         */
        public function authenticate( &$resource ){
                if ( is_resource( $resource ) ){
                        return \ssh2_auth_password( $resource , $this->user , $this->pswd );
                } else {
                        throw new \InvalidArgumentException( 'Recurso inválido.' );
                }
 
                return false;
        }
 
        /**
         * Recupera o nome do usuário
         * @return string
         */
        public function getUser(){
                return $this->user;
        }
}