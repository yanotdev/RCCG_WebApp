<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Utility;
class Testtask extends BaseController
{
	
	public function index()
	{
		$util=new Utility();
		$r=$util->sendCode("testing....","solixzsystem@gmail.com","");
	
		echo $r;
	}
	
	public function info(){
	    
	echo phpinfo();
	}
}
