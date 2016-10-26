<?php

namespace App\Controllers;

use Core\Mvc\Controller;
use Core\Mvc\Model;

class IndexController extends Controller
{
	public function index()
    {    	
    	$model = new Model();
        $this->render('index.php', ['name'=>$model->getText()]);
    }
}