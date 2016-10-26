<?php

namespace App\Controllers;

use Core\Mvc\Controller;
use Core\Mvc\Model;

class CryptController extends Controller
{
	public function index()
    {    	
    	$model = new Model();
        $this->render('crypt.php', ['name'=>$model->getText()]);
    }
}