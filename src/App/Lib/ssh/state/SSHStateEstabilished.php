<?php

namespace App\Lib\ssh\state;


use App\Lib\ssh\interfaces\AbstractSSHState;


use App\Lib\ssh\interfaces\ISSHConnection;

use App\Lib\ssh\interfaces\ISSHAuthentication;

final class SSHStateEstabilished extends AbstractSSHState {
        /**
         * Efetua a autenticação do usuário
         * @param ISSHAuthentication $auth
         * @param ISSHConnection $context
         * @return boolean
         * @throws RuntimeException se não for possível autenticar o usuário
         * @uses SSHStateAuthenticated
         */
        public function authenticate( ISSHAuthentication $auth , ISSHConnection $context ){
                if ( !$auth->authenticate( $this->resource ) ){
                        throw new RuntimeException( sprintf( 'Não foi possível autenticar o usuário %s.' , $auth->getUser() ) );
                } else {
                        $authenticated = new SSHStateListen();
                        $authenticated->setResource( $this->resource );
                        $context->changeState( $authenticated );
                }
 
                return true;
        }
 
        /**
         * Recupera o hash da chave do servidor da conexão ativa
         * @return string
         * @throws LogicException se o estado não implementar o método execute
         */
        public function getFingerprint( ISSHConnection $context ){
                return \ssh2_fingerprint( $this->resource , \SSH2_FINGERPRINT_MD5 | \SSH2_FINGERPRINT_HEX );
        }
}