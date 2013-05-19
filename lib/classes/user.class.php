<?php

class User extends General
{

	public $username;
	public $password;
	public $email;

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
	
	public function logout()
	{
		
		if(isset($_SESSION['user'])){ unset($_SESSION['user']);}
		
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

	public function emailExists()
	{

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		SELECT email
		FROM users
		WHERE email = "'.$this->email.'"
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
	
	public function saveUser()
	{
		
		$ID = $this->getVar('post', 'ID');
		$username = $this->getVar('post', 'username');
		$email = $this->getVar('post', 'email');
		$password = $this->getVar('post', 'password');
		$confirmPassword = $this->getVar('post', 'confirmPassword');

		if($username == ''){ $this->jsonReply(false, 'Enter a username');}
		if($email == ''){ $this->jsonReply(false, 'Enter an email');}
		if($password != $confirmPassword){ $this->jsonReply(false, 'Passwords should match');}
		
		if($password != ''){ $newPassword = crypt($password);}else{ $newPassword = '';}
		
		$this->save(array(
			'ID' => $ID,
			'username' => $username,
			'email' => $email,
			'password' => $newPassword
		));
		
		$this->jsonReply(true, 'User saved');
		
		$this->setNotification('Updated user');
		
	}
	
	public function newUser()
	{
		
		$username = $this->getVar('post', 'username');
		$email = $this->getVar('post', 'email');
		$password = $this->getVar('post', 'password');
		$confirmPassword = $this->getVar('post', 'confirmPassword');

		$this->username = $username;
		$this->email = $email;
		
		if($this->usernameExists()){ $this->jsonReply(false, 'Username is taken');}
		if($this->emailExists()){ $this->jsonReply(false, 'Email is taken');}
		if($username == ''){ $this->jsonReply(false, 'Enter a username');}
		if($email == ''){ $this->jsonReply(false, 'Enter an email');}
		if($password == ''){ $this->jsonReply(false, 'Enter a password');}
		if($confirmPassword == ''){ $this->jsonReply(false, 'Confirm password');}
		if($password != $confirmPassword){ $this->jsonReply(false, 'Passwords should match');}
		
		$this->create(array(
			'username' => $username,
			'email' => $email,
			'password' => crypt($password)
		));
		
		$this->setNotification('Created new user');
		
		$this->jsonReply(true, 'User created');
		
	}
	
	private function save($fields)
	{
		
		extract($fields);

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$addSql = '';
		
		if($password != ''){ $addSql .= ', password = "'.$password.'"';}
		
		$result = $db->query('
		UPDATE users
		SET
		username = "'.$username.'",
		email = "'.$email.'"
		'.$addSql.'
		WHERE ID = "'.$ID.'"
		');
		
		$this->handleResult($result);
		
	}
	
	private function create($fields)
	{
		
		extract($fields);

		$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		$result = $db->query('
		INSERT INTO users
		(
		username,
		email, 
		password,
		addedDate
		)
		VALUES
		(
		"'.$username.'",
		"'.$email.'",
		"'.$password.'",
		"'.$this->datetime().'"
		)
		');
		
		$this->handleResult($result);
		
	}
	
	public function deleteUser()
	{
	
		$ID = $this->getVar('post', 'ID');
		
		if(!is_numeric($ID)){ $this->jsonReply(false, 'Oh no you don\'t!');}
		
		$this->delete($ID, 'users');
		
		$this->jsonReply(true, 'User deleted');
		
		$this->setNotification('User documentation');
		
	}

}