<?php

namespace App\Controllers;

use Core\Mvc\Controller;
use Core\Mvc\Model;

class UploadController extends Controller
{
	public function index()
    {    	
    	$model = new Model();
        $this->render('upload.php', ['name'=>$model->getText()]);
    }
}