<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Responsibleperson;

class Responsible extends BaseController
{
	public function index()
	{
		$respPerson=new Responsibleperson();
		$data=$respPerson->findAll();
		echo json_encode($data);
	}

	public function update()
	{
		$respPerson=new Responsibleperson();
		$id=$this->request->getPost('id');
		$respPerson->update($id,$data=null);
	}
}
