<?php

namespace Core\Mvc;

interface View 
{
	public function render($view, Array $var = []);
} 
