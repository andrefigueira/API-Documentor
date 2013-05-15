<?php

class General 
{

	public function getVar($method, $key)
	{
		
		switch($method)
		{
			
			case 'post':
				if(isset($_POST[$key])){ return addslashes($_POST[$key]);}else{ return false;}
				break;
				
			case 'get':
				if(isset($_GET[$key])){ return addslashes($_GET[$key]);}else{ return false;}
				break;
				
			case 'request':
				if(isset($_REQUEST[$key])){ return addslashes($_REQUEST[$key]);}else{ return false;}
				break;
				
			default:
				return false;
			
		}
		
	}
	
	public function setNotification($message, $css)
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
			
			$notification = '<div class="notification '.$css.'">'.$message.'</div>';
			
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
			
			$this->jsonReply(array(
			'success' => false,
			'message' => $customError
			));
			
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

}