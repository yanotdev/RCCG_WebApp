<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Sschild;
use App\Models\Ssparent;
use App\Libraries\Utility;
use App\Models\Responsibleperson;
use chillerlan\QRCode\QRCode;

class Registration extends BaseController
{
	public function index()
	{
		return view("register");
	}

	public function returning()
	{
		return view("returning");
	}

	public function error()
	{
		return view("error");
	}

	public function error_duplicate()
	{
		return view("error_duplicate");
	}

	public function registration_success()
	{
		return view("registration_success");
	}

	public function phpinfo()
	{
		echo phpinfo();
	}

	public function register()
	{

		//if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

			$ssparent = new Ssparent();
			$parentObj = new Ssparent();
			$sschild = new Sschild();
			$responsiblePerson = new Responsibleperson();
			$utility = new Utility();
			$genQr = new Registration(); 
			$regId = $utility->generateRand(8);
			$code = $utility->generateRand(6);

			// parent registration
			$pdata = [
				'firstname' => $this->request->getVar('parentfn'),
				'lastname' => $this->request->getVar('parentln'),
				'address' => $this->request->getVar('address'),
				'email'  => $this->request->getVar('email'),
				'phonenumber' => $this->request->getVar('phonenumber'),
				'church_member'  => $this->request->getVar('member'),
				'number_of_kids'  => intval($this->request->getVar('kidnumber')),
				'regid' => $regId,
				'code' => $code,
				'active'=> true,
				'approved' => false
				//'code'	=> md5(uniqid($this->request->getVar('email'), true))
				

			];
			$parent_phone = $this->request->getVar('phonenumber');
			$parent_email = $this->request->getVar('email');
			$param = ["phonenumber" => $parent_phone, "email" => $parent_email];
			$parent = $parentObj->where($param)->first();

			$imagefile = $parent_phone;
			if(empty($parent))
			{
				$ssparent->insert($pdata);   //to prevent multiple registration

				
				


					// children registration
			$child_class = $this->request->getVar('cclass');
			$date_of_birth = $this->request->getVar('dob');
			$firstname = $this->request->getVar('cfirstname');
			$lastname = $this->request->getVar('clastname');


			$parentid = $ssparent->getInsertID();
			for ($i = 0; $i < count($firstname); $i++) {
				$cdata = [
					'child_class' => $child_class[$i],
					'date_of_birth' => $date_of_birth[$i],
					'firstname' => $firstname[$i],
					'lastname' => $lastname[$i],
					'parentid' => $parentid,
					'regid' => $regId
				];

				$sschild->insert($cdata);
			}

			// Relative registration
			$responsiblePary = $this->request->getVar("responsible-party");
			$relfn = $this->request->getVar("relfn");
			$relln = $this->request->getVar("relln");
			$relemail = $this->request->getVar("relemail");
			$phonenumber = $this->request->getVar("relphonenumber");
			$respkid = $this->request->getVar("resp-kid");

			if ($responsiblePary == "0") {
				$rdata = [
					'regid' => $regId,
					'fullname' => $pdata["firstname"] . ' ' . $pdata["lastname"],
					'email' => $pdata["email"],
					'phonenumber' => $pdata["phonenumber"],
					'persontype' => "parent"

				];
				$responsiblePerson->insert($rdata);
			} elseif ($responsiblePary == "1") {
				$rdata = [
					'regid' => $regId,
					'fullname' => $respkid,
					'persontype' => "kid"
				];
				$responsiblePerson->insert($rdata);
			} elseif ($responsiblePary == "2") {
				$rdata = [
					'regid' => $regId,
					'fullname' => $relfn . ' ' . $relln,
					'email' => $relemail,
					'phonenumber' => $phonenumber,
					'persontype' => "relative"

				];
				$responsiblePerson->insert($rdata);
			}
			
			
			//call function to generate Parent QRcode
			
			$pathh = $genQr->generateParentQRcode($code, $parent_phone);

			$msg = "<h1>Registration Confirmation</h1><br />
		<p>Dear sir/ma,<br /><br />
		Thank you for registering your child(ren) for the GWC Children Church.<br />
		Use the code below when dropping or picking up your child(ren):<br />
		<b>" . $code . "</b>
		<b>Attached is also the QR code for scanning</b></p>";

			//$msg="<p>Thanks for registration for our Sunday School</p>Here is your pass code <b>".$code."</b>";


			$mailSend = $utility->sendCode($msg, $pdata["email"], "david.udensi@gs1ng.org", );
			echo $mailSend;
			return $this->response->redirect('/registration/registration_success');
			}
			
		

		
		 else {
			return $this->response->redirect('/registration/error_duplicate');
		 }
	}

	public function getParentDetails()
	{
		$parentObj = new Ssparent();

		try {
			$parent_lastname = $this->request->getVar('code');
			$parent_email = $this->request->getVar('email');
			$param = ["code" => $parent_lastname, "email" => $parent_email];
			$parent = $parentObj->where($param)->first();
		
			$status = 1;
			$payload = array('message' => $parent, 'status' => $status);

			echo json_encode($payload);
		
		} catch (\Exception $ex) {
			$message = $ex->getMessage();
			$status = 0;
			$payload = array("message" => $message, "status" => $status);

			echo json_encode($payload);
		}
	}

	public function getParentKidRespDetails(){
		$parentObj = new Ssparent();
		$childObj = new Sschild();
		$responsiblePerson=new Responsibleperson();
		try {
			$parent_id = $this->request->getVar('parentId');
			$parent_email = $this->request->getVar('parentemail');
			$param = ["code"=> $parent_id, "email"=>$parent_email];
			$parent = $parentObj->where($param)->first();

			if($parent !== null) {
			$children = $childObj->where('parentid', $parent->id)->findAll();
			$responsibleP=$responsiblePerson->where('regid',$parent->regid)->first();

			$status = 1;
			$payload = array('message' => $parent, 'status' => $status, 'children' => $children,'responsibleperson'=>$responsibleP);
			echo json_encode($payload);
			}
			else{
				$status = 0;
				$payload = array("message" =>" email or password incorrect", "status" => $status);
	
				echo json_encode($payload);
			}

			
		} catch (\Exception $ex) {
			$message = $ex->getMessage();
			$status = 0;
			$payload = array("message" => $message, "status" => $status);

			echo json_encode($payload);
		}
	}

	public function generateParentQRcode($id, $imagefile){
		
		$qData = (new QRCode)->render($id); 


			list($dataType, $imageData) = explode(';', $qData);
			// image file extension
			$imageExtension = explode('/', $dataType)[1];
			// base64-encoded image data
			list(, $encodedImageData) = explode(',', $imageData);
			// decode base64-encoded image data
			$decodedImageData = base64_decode($encodedImageData);
			// save image data as file
			
			file_put_contents("assets/images/{$imagefile}.{$imageExtension}", $decodedImageData);

			$path = "assets/images/{$imagefile}.{$imageExtension}";


			$image = imagecreatefrompng($path);
			imagejpeg($image, "assets/images/{$imagefile}.jpeg", 70);
			//imagedestroy($image);

			$qr_path = base_url("/assets/images/{$imagefile}.jpeg");

			return $qr_path; 
	}

	public function deactivateaccount(){
		$parentObj = new Ssparent();
		try{
		
			$parent_phone = $this->request->getVar('phonenumber');
			$parent_email = $this->request->getVar('email');
			$param = ["phonenumber" => $parent_phone, "email" => $parent_email];
			$parent = $parentObj->where($param)->findAll();
			$num= count($parent);
			$active = $this->request->getVar('active');
			if ($num == 1){

				$id=$parent[0]->id;

				$load = [
					'active' =>	$active
				];
				$result = $parentObj->update($id, $load);

				$message = "successfully deactivated";
				$status = 1;
				$payload = array("message" => $message, "status" => $status);

				echo json_encode($payload);

			}
			else{
				$message = "No Person to deactivate";
				$status = 0;
				$payload = array("message" => $message, "status" => $status);
				echo json_encode($payload);
			}
		}catch (\Exception $ex) {
			$message = $ex->getMessage();
			$status = 0;
			$payload = array("message" => $message, "status" => $status);

			echo json_encode($payload);
		}
		

	}

	public function updaterepperson(){
			$responsiblePersonObj = new Responsibleperson();
		try{
		
			$person_type = $this->request->getVar('personType');
			$Fullname = $this->request->getVar('Fullname');
			$Email = $this->request->getVar('Email');
			$Phoneno = $this->request->getVar('Phoneno');
			$Id = $this->request->getVar('Id');
			$param = [ "id" => $Id];
			$responsiblePerson = $responsiblePersonObj->where($param)->findAll();
			$num= count($responsiblePerson);

			if ($num ==1){
		

				$load = [
					'persontype' => $person_type,
					'fullname' => $Fullname,
					'email' => $Email,
					'phonenumber' => $Phoneno
					
				];
				$result = $responsiblePersonObj->update($Id, $load);

				$message = "successfully updated";
				$status = 1;
				$payload = array("message" => $message, "status" => $status);

				echo json_encode($payload);

			}
			else{
				$message = "No Record to Update";
				$status = 0;
				$payload = array("message" => $message, "status" => $status);
				echo json_encode($payload);
			}
		}catch (\Exception $ex) {
			$message = $ex->getMessage();
			$status = 0;
			$payload = array("message" => $message, "status" => $status);

			echo json_encode($payload);
		}

	}
			



	public function updateregisteredkid(){
			$sschild = new Sschild();
		try{
			$child_class = $this->request->getVar('cclass');
			$date_of_birth = $this->request->getVar('dob');
			$firstname = $this->request->getVar('cfirstname');
			$lastname = $this->request->getVar('clastname');
			$parentid = $this->request->getVar('parentid');
			$regid = $this->request->getVar('regid');
			$Id = $this->request->getVar('Id');

					$load = [
						'child_class' => $child_class,
						'date_of_birth' => $date_of_birth,
						'firstname' => $firstname,
						'lastname' => $lastname,
						'regid' =>$regid,
						'parentid'=>$Id,
						'parentid'=>$parentid	
					];
				$sschild->insert($load);
				$message = "kid(s) successfully added";
				$status = 1;
				$payload = array("message" => $message, "status" => $status);
				echo json_encode($payload);
	} catch (\Exception $ex) {
			$message = $ex->getMessage();
			$status = 0;
			$payload = array("message" => $message, "status" => $status);

			echo json_encode($payload);
		}		
	}

	public function deletekid(){
		$sschild = new Sschild();
	try{
		$Id = $this->request->getVar('Id');
		$param = [ "id" => $Id];
		$SSchildd= $sschild->where($param)->findAll();
		$num= count($SSchildd);
		
		if ($num ==1){
		$load = [
			'Id' => $Id
		];
		$result = $sschild->delete($Id);

				$message = "successfully Deleted";
				$status = 1;
				$payload = array("message" => $message, "status" => $status);

				echo json_encode($payload);
			}
			else{
				$message = "No Record to Delete";
				$status = 0;
				$payload = array("message" => $message, "status" => $status);
				echo json_encode($payload);
			}
		
	
} catch (\Exception $ex) {
		$message = $ex->getMessage();
		$status = 0;
		$payload = array("message" => $message, "status" => $status);

		echo json_encode($payload);
	}		
	}

	

	}public function getKids()
	{
		$parentObj = new Ssparent();
		$childObj = new Sschild();

		try {
			$Id = $this->request->getVar('Id');
			$parent = $parentObj->where('code', $code)->first();
			$parentId = $parent->id;

			$child = $childObj->where('parentid', $parentId)->findAll();

			$status = 1;
			$payload = array('message' => $child, 'status' => $status);

			echo json_encode($payload);
		} catch (\Exception $ex) {
			$message = $ex->getMessage();
			$status = 0;
			$payload = array("message" => $message, "status" => $status);

			echo json_encode($payload);
		}
	}


}

