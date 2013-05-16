<?php

class Documentor extends General
{

	public function fetchCalls()
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT *
		FROM calls
		ORDER BY name DESC
		');
		
		$totalRows = $result->num_rows;
		
		$results = array();
		
		if($totalRows > 0)
		{
		
			while($row = $result->fetch_object())
			{
			
				array_push($results, array(
					'ID' => $row->ID,
					'name' => stripslashes($row->name),
					'uri' => stripslashes($row->uri),
					'method' => stripslashes($row->method),
					'auth' => $row->auth,
					'request' => stripslashes($row->request),
					'response' => stripslashes($row->response),
					'addedDate' => $row->addedDate,
					'editedDate' => $row->editedDate
				));
			
			}
		
		}
		
		return $results;
			
	}
	
	public function fetchDocumentation()
	{
	
		$ID = $this->getVar('get', 'ID');

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT *
		FROM calls
		WHERE ID = "'.$ID.'"
		LIMIT 1
		');
		
		$totalRows = $result->num_rows;
		
		$results = array();
		
		if($totalRows > 0)
		{
		
			while($row = $result->fetch_object())
			{
			
				$results = array(
					'ID' => $row->ID,
					'name' => stripslashes($row->name),
					'uri' => stripslashes($row->uri),
					'method' => stripslashes($row->method),
					'auth' => $row->auth,
					'parameters' => $this->unserialize64($row->parameters),
					'request' => stripslashes($row->request),
					'response' => stripslashes($row->response),
					'addedDate' => $row->addedDate,
					'editedDate' => $row->editedDate
				);
			
			}
		
		}
		
		return $results;
		
	}
	
	public function saveDocumentation()
	{
		
		$ID = $this->getVar('post', 'ID');
		$name = $this->getVar('post', 'name');
		$uri = $this->getVar('post', 'uri');
		$method = $this->getVar('post', 'method');
		$auth = $this->getVar('post', 'auth');
		$request = $this->getVar('post', 'request');
		$response = $this->getVar('post', 'response');
		$parameters = $this->getVar('post', 'parameters', false);

		if(!is_numeric($ID)){ $this->jsonReply(false, 'Oh no, Don\'t you do it!');}
		if($name == ''){ $this->jsonReply(false, 'Enter a name for the call');}
		if($uri == ''){ $this->jsonReply(false, 'Enter a URI for the call');}
		if($method == ''){ $this->jsonReply(false, 'Enter a method for the call');}
		if($auth == ''){ $this->jsonReply(false, 'Enter a auth setting for the call');}
		
		$this->save(array(
			'ID' => $ID,
			'name' => $name,
			'uri' => $uri,
			'method' => $method,
			'auth' => $auth,
			'request' => $request,
			'response' => $response,
			'parameters' => $parameters
		));
		
		$this->jsonReply(array(
			'success' => true,
			'message' => 'Documentation saved'
		));
		
		$this->setNotification('Updated new page of documentation');
		
	}
	
	public function newDocumentation()
	{
		
		$name = $this->getVar('post', 'name');
		$uri = $this->getVar('post', 'uri');
		$method = $this->getVar('post', 'method');
		$auth = $this->getVar('post', 'auth');
		$request = $this->getVar('post', 'request');
		$response = $this->getVar('post', 'response');
		$parameters = $this->getVar('post', 'parameters', false);

		if($name == ''){ $this->jsonReply(false, 'Enter a name for the call');}
		if($uri == ''){ $this->jsonReply(false, 'Enter a URI for the call');}
		if($method == ''){ $this->jsonReply(false, 'Enter a method for the call');}
		if($auth == ''){ $this->jsonReply(false, 'Enter a auth setting for the call');}
		
		$this->create(array(
			'name' => $name,
			'uri' => $uri,
			'method' => $method,
			'auth' => $auth,
			'request' => $request,
			'response' => $response,
			'parameters' => $parameters
		));
		
		$this->setNotification('Created new page of documentation');
		
		$this->jsonReply(true, 'Documentation created');
		
	}
	
	private function save($fields)
	{
		
		extract($fields);

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		UPDATE calls
		SET
		name = "'.$name.'",
		uri = "'.$uri.'",
		method = "'.$method.'",
		auth = "'.$auth.'",
		request = "'.$request.'",
		response = "'.$response.'",
		parameters = "'.$this->serialize64($parameters).'",
		editedDate = "'.$this->datetime().'"
		WHERE ID = "'.$ID.'"
		');
		
		$this->handleResult($result);
		
		return true;
		
	}
	
	private function create($fields)
	{
		
		extract($fields);

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		INSERT INTO calls
		(
		name,
		uri, 
		method,
		auth,
		request,
		response,
		parameters,
		addedDate
		)
		VALUES
		(
		"'.$name.'",
		"'.$uri.'",
		"'.$method.'",
		"'.$auth.'",
		"'.$request.'",
		"'.$response.'",
		"'.$this->serialize64($parameters).'",
		"'.$this->datetime().'"
		)
		');
		
		$this->handleResult($result);
		
	}
	
	public function serialize64($array)
	{
		
		$array = serialize($array);
		$array = base64_encode($array);
		
		return $array;
		
	}
	
	public function unserialize64($array)
	{
		
		$array = base64_decode($array);
		$array = unserialize($array);
		
		return $array;
		
	}
	
	private function delete($ID)
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		DELETE FROM calls
		WHERE ID = "'.$ID.'"
		');
		
		$this->handleResult($result);
		
		return true;
		
	}
	
	public function deleteDocumentation()
	{
	
		$ID = $this->getVar('post', 'ID');
		
		if(!is_numeric($ID)){ $this->jsonReply(false, 'Oh no you don\'t!');}
		
		$this->delete($ID);
		
		$this->jsonReply(array(
			'success' => true,
			'message' => 'Documentation deleted'
		));
		
		$this->setNotification('Deleted documentation');
		
	}
	
	public function methodName($method)
	{
		
		switch($method)
		{
			
			case 0:
				return 'GET';
				break;
			
			case 1:
				return 'POST';
				break;
			
			case 2:
				return 'DELETE';
				break;
			
			case 3:
				return 'PUT';
				break;
			
		}
		
	}

}