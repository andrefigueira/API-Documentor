<?php

class Documentor extends General
{

	public function fetchCalls($categoryID = null)
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$addSql = '';
		
		if($categoryID != null){ $addSql .= 'WHERE categoryID = "'.$categoryID.'"';}
		
		$result = $db->query('
		SELECT *
		FROM calls
		'.$addSql.'
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
					'categoryID' => $row->categoryID,
					'name' => stripslashes($row->name),
					'description' => stripslashes($row->description),
					'uri' => stripslashes($row->uri),
					'method' => stripslashes($row->method),
					'auth' => $row->auth,
					'response' => stripslashes($row->response),
					'addedDate' => $row->addedDate,
					'editedDate' => $row->editedDate
				));
			
			}
		
		}
		
		return $results;
			
	}
	
	public function saveDocumentation()
	{
		
		$ID = $this->getVar('post', 'ID');
		$categoryID = $this->getVar('post', 'categoryID');
		$name = $this->getVar('post', 'name');
		$description = $this->getVar('post', 'description');
		$uri = $this->getVar('post', 'uri');
		$method = $this->getVar('post', 'method');
		$auth = $this->getVar('post', 'auth');
		$response = $this->getVar('post', 'response');
		$parameters = $this->getVar('post', 'parameters', false);

		if(!is_numeric($ID)){ $this->jsonReply(false, 'Oh no, Don\'t you do it!');}
		if($name == ''){ $this->jsonReply(false, 'Enter a name for the call');}
		if($uri == ''){ $this->jsonReply(false, 'Enter a URI for the call');}
		if($method == ''){ $this->jsonReply(false, 'Enter a method for the call');}
		if($auth == ''){ $this->jsonReply(false, 'Enter a auth setting for the call');}
		
		$this->save(array(
			'ID' => $ID,
			'categoryID' => $categoryID,
			'name' => $name,
			'description' => $description,
			'uri' => $uri,
			'method' => $method,
			'auth' => $auth,
			'response' => $response,
			'parameters' => $parameters
		));
		
		$this->jsonReply(true, 'Documentation saved');
		
		$this->setNotification('Updated new page of documentation');
		
	}
	
	public function newDocumentation()
	{
		
		$categoryID = $this->getVar('post', 'categoryID');
		$name = $this->getVar('post', 'name');
		$description = $this->getVar('post', 'description');
		$uri = $this->getVar('post', 'uri');
		$method = $this->getVar('post', 'method');
		$auth = $this->getVar('post', 'auth');
		$response = $this->getVar('post', 'response');
		$parameters = $this->getVar('post', 'parameters', false);

		if($name == ''){ $this->jsonReply(false, 'Enter a name for the call');}
		if($uri == ''){ $this->jsonReply(false, 'Enter a URI for the call');}
		if($method == ''){ $this->jsonReply(false, 'Enter a method for the call');}
		if($auth == ''){ $this->jsonReply(false, 'Enter a auth setting for the call');}
		
		$this->create(array(
			'categoryID' => $categoryID,
			'name' => $name,
			'description' => $description,
			'uri' => $uri,
			'method' => $method,
			'auth' => $auth,
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
		categoryID = "'.$categoryID.'",
		name = "'.$name.'",
		description = "'.$description.'",
		uri = "'.$uri.'",
		method = "'.$method.'",
		auth = "'.$auth.'",
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
		categoryID,
		name,
		description,
		uri, 
		method,
		auth,
		response,
		parameters,
		addedDate
		)
		VALUES
		(
		"'.$categoryID.'",
		"'.$name.'",
		"'.$description.'",
		"'.$uri.'",
		"'.$method.'",
		"'.$auth.'",
		"'.$response.'",
		"'.$this->serialize64($parameters).'",
		"'.$this->datetime().'"
		)
		');
		
		$this->handleResult($result);
		
	}
	
	public function exampleRequest($data)
	{
	
		$queryStr = '';
		$queryArray = array();
		
		if(count($data) > 0)
		{
		
			foreach($data as $parameter)
			{
			
				if(!(bool)$parameter['optional'])
				{
					
					$queryArray[$parameter['name']] = $parameter['example'];
					
				}
			
			}
		
		}
		
		if(!empty($queryArray))
		{
			
			$query = http_build_query($queryArray);
			
			$query = str_replace('&', '<br>&', $query);
			
			return $query;
			
		}
		
	}
	
	public function deleteDocumentation()
	{
	
		$ID = $this->getVar('post', 'ID');
		
		if(!is_numeric($ID)){ $this->jsonReply(false, 'Oh no you don\'t!');}
		
		$this->delete($ID, 'calls');
		
		$this->jsonReply(true, 'Documentation deleted');
		
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
	
	public function optionalName($optional)
	{
		
		switch($optional)
		{
			
			case 0:
				return 'Non-Optional';
				break;
			
			case 1:
				return 'Optional';
				break;
			
		}
		
	}

}