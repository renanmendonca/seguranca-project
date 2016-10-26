<?php

namespace App\Lib\ssh\state;

use App\Lib\ssh\interfaces\AbstractSSHState;

use App\Lib\ssh\interfaces\ISSHConnection;

final class SSHStateListen extends AbstractSSHState {
        /**
         * @var resource
         */
        private $shell;
 
        /**
         * Executa um comando no servidor remoto
         * @param string $command
         * @param ISSHConnection $context
         * @return string A saída do servidor remoto
         * @throws RuntimeException se não for possível executar o comando
         */
        public function execute( $command , ISSHConnection $context ){
                $ret = null;
 
                $stream = \ssh2_exec( $this->resource , $command );
 
                if ( is_resource( $stream ) ){
                        \stream_set_blocking( $stream , true );
 
                        while ( ( $line = \fgets( $stream , 4096 ) ) !== false ){
                                $ret .= $line;
                        }
                } else {
                        throw new \RuntimeException( 'Não foi possível executar o comando.' );
                }
 
                return $ret;
        }
}