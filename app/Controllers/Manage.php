<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Ssattendance;
use App\Models\Sschild;
use App\Models\Ssparent;
use chillerlan\QRCode\QRCode;
use App\Libraries\Utility;
use App\Models\Responsibleperson;

class Manage extends BaseController
{
	public function index()
	{
		$ssparents = new Ssparent();
		$data['parents'] = $ssparents->orderBy('firstname')->findAll();
		return view('manage', $data);
	}
	
	public function sendQR2()
	{
		$utility=new Utility();
		$ssparents = new Ssparent();
		$id = $this->request->getPost('id');

		$parent = $ssparents->where('id', $id)->first();
		$code = $parent->code;
		$msg = "<h1>Registration Confirmation</h1><br />
		<p>Dear sir/ma,<br /><br />
		Thank you for registering your child(ren) for the GWC Children Church.<br />
		Use the code below when dropping or picking up your child(ren):<br />
		<b>" . $code . "</b></p>";


		$mailSend=$utility->sendCode($msg,$parent->email,"");

		if ($mailSend) {
			$payload = array('status' => 1, 'message' => 'Email successfully sent');
			echo json_encode($payload);
		} else {
			// $data=$email->printDebugger(['headers']);
			// print_r($data);
			$payload = array('status' => 0, 'message' => 'Unable to send email');
			echo json_encode($payload);
		}
	}
	public function sendQR()
	{

		$ssparents = new Ssparent();
		$id = $this->request->getVar('id');

		$parent = $ssparents->where('id', $id)->first();
		$code = $parent->code;
		$phonenumber = $parent->phonenumber;
		$qData = (new QRCode)->render($code);


		list($dataType, $imageData) = explode(';', $qData);
		// image file extension
		$imageExtension = explode('/', $dataType)[1];
		// base64-encoded image data
		list(, $encodedImageData) = explode(',', $imageData);
		// decode base64-encoded image data
		$decodedImageData = base64_decode($encodedImageData);
		// save image data as file
		file_put_contents("assets/images/{$phonenumber}.{$imageExtension}", $decodedImageData);

		$path = "assets/images/{$phonenumber}.{$imageExtension}";


		// \Config\Services::image()
		// ->withFile($path)
		// ->convert(IMAGETYPE_JPEG)
		// ->save('assets/images/myQR.jpeg');

		$image = imagecreatefrompng($path);
		imagejpeg($image, "assets/images/{$phonenumber}.jpeg", 70);
		imagedestroy($image);

		$qr_path = base_url("/assets/images/{$phonenumber}.jpeg");


		$msg = '<h3>Here is the QR Code</h3><b>Thanks</b>';

		$this->sendMail($msg, $phonenumber, $qr_path);
	}

	public function createQRForKid()
	{
		$childObj = new Sschild();
		$parentObj = new Ssparent();
		$attendanceObj = new Ssattendance();

		$childId = $this->request->getVar("id");
		$child = $childObj->where("id", $childId)->first();
		$parent = $parentObj->where("id", $child->parentid)->first();
		$phonenumber = $parent->phonenumber;
		$imagefile = $phonenumber . "-" . $child->firstname . "-" . $child->lastname;

		$queryParam = ["childid" => $childId, "droppedoff" => true, "pickedup" => false];
		$attend = $attendanceObj->where($queryParam);
	

		if ($attend->countAllResults() == 0) {

			$childCode = md5(uniqid($child->firstname . $child->lastname, true));
			

			$data = [
				"parentcode" => $parent->code,
				"childcode" => $childCode,
				"childid" => $child->id,
				"droppedoff" => true,
				"pickedup" => false

			];

			$attendanceObj->insert($data);
		
			$qData = (new QRCode)->render($childCode);

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

			echo $qr_path;
		} else {
			$qr_path = base_url("/assets/images/{$imagefile}.jpeg");

			echo $qr_path;
		}
	}

	public function sendMail($msg, $phonenumber, $qr_path)
	{
		$email = \Config\Services::email();

		$config['newline'] = "\r\n";
		$config['mailtype'] = 'html';
		$data['msg'] = $msg;
		$email->setFrom('soliu.adewale@gs1ng.org', 'Adewale Soliu');
		$email->setTo('david.udensi@gs1ng.org');
		$email->setCC('solixzsystem@gmail.com');

		$email->setSubject('QR Code');
		$path = FCPATH . '\assets\images\\' . $phonenumber . ".jpeg";
		// echo $path;
		$email->attach($path);
		$email->setMessage($msg);


		if ($email->send()) {
			$payload = array('status' => 1, 'message' => 'Email successfully sent', 'qrpath' => $qr_path);
			echo json_encode($payload);
		} else {
			// $data=$email->printDebugger(['headers']);
			// print_r($data);
			$payload = array('status' => 0, 'message' => 'Unable to send email', 'qrpath' => $qr_path);
			echo json_encode($payload);
		}


		// $email->setMessage->load->view('qrmail',$data,true);

	}

	public function getKidsByCode()
	{
		$parentObj = new Ssparent();
		$childObj = new Sschild();

		try {
			$code = $this->request->getVar('qrcode');
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
	
	public function getParentDetails()
	{
		$parentObj = new Ssparent();
		$childObj = new Sschild();
		$responsiblePerson=new Responsibleperson();
		try {
			$parent_id = $this->request->getVar('parentId');
			$parent = $parentObj->where('id', $parent_id)->first();
			$children = $childObj->where('parentid', $parent_id)->findAll();
			$responsibleP=$responsiblePerson->where('regid',$parent->regid)->first();

			$status = 1;
			$payload = array('message' => $parent, 'status' => $status, 'children' => $children,'responsibleperson'=>$responsibleP);

			echo json_encode($payload);
		} catch (\Exception $ex) {
			$message = $ex->getMessage();
			$status = 0;
			$payload = array("message" => $message, "status" => $status);

			echo json_encode($payload);
		}
	}

	public function getKidsForPickUp()
	{
		$childObj = new Sschild();
		$parentObj = new Ssparent();
		$attendanceObj = new Ssattendance();

		try {
			$code = $this->request->getVar('qrcode');
			$queryParam = ["parentcode" => $code, "droppedoff" => true, "pickedup" => false];

			$attend = $attendanceObj->select('childid')->where($queryParam);
			$kidsId = $attend->get()->getResultObject();
			$kids_arr = [];
			foreach ($kidsId as $key => $value) {
				array_push($kids_arr, $value->childid);
			}

			$kids = $childObj->whereIn("id", $kids_arr)->findAll();

			$status = 1;
			$payload = array('message' => $kids, 'status' => $status);

			echo json_encode($payload);
		} catch (\Exception $ex) {
			$message = $ex->getMessage();
			$status = 0;
			$payload = array("message" => $message, "status" => $status);

			echo json_encode($payload);
		}
	}

	public function verifypickup()
	{
		$childObj = new Sschild();
		$parentObj = new Ssparent();
		$attendanceObj = new Ssattendance();

		try {
			$code = $this->request->getVar('code');
			
			$queryParam = ["childcode" => $code, "droppedoff" => true, "pickedup" => false];

			$kid = $attendanceObj->where($queryParam)->findAll();
			
			$num= count($kid);
			
			
			if ($num == 1) {
				$id=$kid[0]->id;
				
				
				$data=[
					"pickedup"=>true
				];
				

				$ret=$attendanceObj->update($id,$data);
				
				

				$message = "";
				$status = 1;
				$payload = array("message" => $message, "status" => $status);

				echo json_encode($payload);
			} else {
				$message = "";
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
}
