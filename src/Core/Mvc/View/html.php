<?php

namespace Core\Mvc\View;

use Core\Mvc\View;

class html implements View
{
	public function __construct($map)
	{
		$this->map = $map;
	}
	
	public function render($view, array $var=[])
	{
		require $this->map.'/'.$view;
	}
} 
