<?php
namespace App\Model;

use Core\Mvc\Model;

class Upload extends Model{

    public function save_file($file){
        
        $uploaddir = ROOT.'/storage/';
        
        $uploadfile = $uploaddir . basename($file['file']['name']);
        
        if(file_exists($uploadfile)){
            if (sha1_file($file['file']['tmp_name']) == sha1_file($uploadfile)) {
                return "Arquivo igual encontrado";
            }else{
                return "Arquivo ".$file['file']['name']." já foi salvo porém foi modificado.";
            }
        }
        if (move_uploaded_file($file['file']['tmp_name'], $uploadfile)) {
            return "Arquivo válido e enviado com sucesso.\n";
        } else {
            return "Possível ataque de upload de arquivo!\n";
        }
        
    }
    
    public function gitFiles(){
        $files = array();
        foreach(glob(ROOT."/storage/*") as $filename) {
            $name = explode('/',$filename);
            $name = $name[count($name)-1];
            $files[] = array("name"=>$name, "size"=>filesize($filename));
        }
        return $files;
    }

}