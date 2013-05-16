<?php

//Configuration file
require_once('config.php');

//Classes
require_once('classes/general.class.php');
require_once('classes/documentor.class.php');
require_once('classes/user.class.php');

function requestHandler()
{

	$functionName = $_GET['function'];
	
	if(function_exists($functionName))
	{
	
		$function = new ReflectionFunction($functionName);
		echo $function->invoke();
		
	}
	else
	{
		
		echo 'Function doesn\'t exist: '.$functionName;
		
	}

}

function logout()
{

	unset($_SESSION['authenticated']);
	
	General::setNotification('Logged out safely', 'positive-notification');
	
	header('Location: '.BASE_URL);

}

function login($url = '')
{

	if(isset($_POST['submit']))
	{
	
		$user = new User();
	
		$username = General::getVar('post', 'user');
		$password = General::getVar('post', 'pass');
		
		if($username && $password)
		{
		
			$user->username = $username;
			$user->password = $password;
		
			if($user->usernameExists())
			{
				
				if($user->verifyPassword())
				{
				
					$_SESSION['user'] = array(
						'username' => $username,
						'authenticated' => true
					);
					
					$url = 'home';
					
				}
				else
				{
					
					General::setNotification('Your username or password are incorrect...', 'negative-notification');
					
				}
			
			}
			else
			{
				
				General::setNotification('User doesn\'t exist', 'negative-notification');
				
			}
			
		}
		else
		{
				
			General::setNotification('You didn\'t enter a username or password', 'negative-notification');
			
		}
		
	}
	
	header('Location: '.BASE_URL.$url);

}

function create()
{

	$doc = new Documentor();
	
	$doc->newDocumentation();

}

function createUser()
{

	$user = new User();
	
	$user->newUser();

}

function save()
{

	$doc = new Documentor();
	
	$doc->saveDocumentation();

}

function saveUser()
{

	$user = new User();
	
	$user->saveUser();

}

function delete()
{

	$doc = new Documentor();
	
	$doc->deleteDocumentation();

}

function deleteUser()
{

	$user = new User();
	
	$user->deleteUser();

}

function errorHandler($num, $str, $file, $line, $context)
{

	echo '
	
	<div class="php-error">
	
		<div class="error-container">
			<h1>PHP Error</h1>
			
			<table cellpadding="0" cellspacing="0" border="0" width="100%">
				<tr>
					<td><strong>Type</strong></td>
					<td>'.$str.'</td>
				</tr>
				<tr>
					<td><strong>File</strong></td>
					<td>'.$file.'</td>
				</tr>
				<tr>
					<td><strong>Line</strong></td>
					<td>'.$line.'</td>
				</tr>
			</table>
		</div>
		
		<div class="full-overlay"></div>
	
	</div>
	';

}