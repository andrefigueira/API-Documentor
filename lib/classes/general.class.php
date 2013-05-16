<?php

class General 
{

	public function getVar($method, $key, $sanitize = true)
	{
		
		switch($method)
		{
			
			case 'post':
				if(isset($_POST[$key])){ $val = $_POST[$key];}else{ $val = false;}
				break;
				
			case 'get':
				if(isset($_GET[$key])){ $val = $_GET[$key];}else{ $val = false;}
				break;
				
			case 'request':
				if(isset($_REQUEST[$key])){ $val = $_REQUEST[$key];}else{ $val = false;}
				break;
				
			default:
				$val = false;
			
		}
		
		if($sanitize){ addslashes($val);}
		
		return $val;
		
	}
	
	public function validateSession()
	{
		
		if(!isset($_SESSION['user']))
		{
			
			General::setNotification('You must be logged in to see that!');
			
			header('Location: '.BASE_URL);
			
		}
		
	}
	
	public function setNotification($message, $css = '')
	{

		$notification = array(
			'message' => $message,
			'css' => $css
		);
		
		$_SESSION['notification'] = serialize($notification);
		
	}
	
	public function arrayToObject($array)
	{
	
		$object = new stdClass();
		
		foreach ($array as $key => $value)
		{
		
		    $object->$key = $value;
		    
		}
		
		return $object;
	
	}
	
	public function notification()
	{
	
		if(isset($_SESSION['notification']))
		{
			
			$notification = unserialize($_SESSION['notification']);
			
			extract($notification);
			
			$notification = '<div id="alert" class="'.$css.'">'.$message.'</div>';
			
			echo $notification;
			
			unset($_SESSION['notification']);
			
		}
				
	}
	
	public function jsonReply($success = true, $message = 'Success', $value = array())
	{
	
		header('Content-type: application/json');
	
		if(empty($value)){ $value = null;}
			
		$jsonArray = array(
		'success' => $success,
		'message' => $message,
		'value' => $value
		);
			
		$jsonResult = json_encode($jsonArray);
	
		echo $jsonResult;
		exit;
		
	}
	
	public function handleResult($result, $customError = 'There was an error running the query')
	{
		
		if(!$result)
		{
			
			$this->jsonReply(false, $customError);
			
		}
		else
		{
			
			return true;
			
		}
		
	}
	
	public function datetime()
	{
		
		return date('Y-m-d H:i:s');
		
	}
	
	public function formatDate($date)
	{
		
		return date('D jS F, Y', strtotime($date));
		
	}

}