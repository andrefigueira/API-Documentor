<?php

class User extends General
{

	public $username;
	public $password;

	public function fetchUsers()
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT *
		FROM users
		ORDER BY addedDate DESC
		');
		
		$totalRows = $result->num_rows;
		
		$results = array();
		
		if($totalRows > 0)
		{
		
			while($row = $result->fetch_object())
			{
			
				array_push($results, array(
					'ID' => $row->ID,
					'username' => stripslashes($row->username),
					'email' => stripslashes($row->email),
					'addedDate' => $row->addedDate
				));
			
			}
		
		}
		
		return $results;
			
	}
	
	public function fetchUser()
	{
	
		$ID = $this->getVar('get', 'ID');

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT *
		FROM users
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
					'username' => stripslashes($row->username),
					'email' => stripslashes($row->email)
				);
			
			}
		
		}
		
		return $results;
		
	}

	public function usernameExists()
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT ID
		FROM users
		WHERE username = "'.$this->username.'"
		LIMIT 1
		');
		
		return (bool)$result->num_rows;
		
	}
	
	public function password()
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT ID, username, password
		FROM users
		WHERE username = "'.$this->username.'"
		LIMIT 1
		');
		
		while($row = $result->fetch_object())
		{
			
			return $row->password;
			
		}
		
	}
	
	public function userCredentials()
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT ID, username, password
		FROM users
		WHERE username = "'.$this->username.'"
		LIMIT 1
		');
		
		while($row = $result->fetch_object())
		{
			
			return array(
				'ID' => $row->ID,
				'username' => $row->username,
				'password' => $row->password
			);
			
		}
		
	}

	public function verifyPassword()
	{
		
		return (crypt($this->password, $this->password()) == $this->password());
		
	}

}