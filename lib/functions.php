<?php

//Configuration file
require_once('config.php');

//Classes
require_once('classes/general.class.php');
require_once('classes/documentor.class.php');
require_once('classes/user.class.php');
require_once('classes/categories.class.php');

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

function login($url = 'dashboard/')
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
					
					$url = 'dashboard/home';
					
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

function createCategory()
{

	$category = new Categories();
	
	$category->newCategory();

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

function saveCategory()
{

	$category = new Categories();
	
	$category->saveCategory();

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

function deleteCategory()
{

	$category = new Categories();
	
	$category->deleteCategory();

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

function testCall()
{

	$gen = new General();
	
	$method = $_POST['method'];
	$url = $_POST['url'];
	$parameters = $_POST['parameters'];
	
	if($method == ''){ $gen->jsonReply(false, 'No method passed');}
	if($url == ''){ $gen->jsonReply(false, 'No URL passed');}
	
	if($method == 'POST'){ $post = 1;}else{ $post = 0;}
	
	$fields = array();
	
	foreach($parameters as $parameter)
	{
		
		$fields[$parameter['ID']] = $parameter['value'];
		
	}
	
	$curl = curl_init();
	
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_HTTPHEADER => array('Expect:'),
	    CURLOPT_HEADER => true,
	    CURLOPT_NOBODY => true,
	    CURLOPT_SSL_VERIFYPEER => false,
	    CURLOPT_SSL_VERIFYHOST => false,
	    CURLOPT_USERAGENT => 'API Documentor REST Tester',
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => $fields
	));
	
	$headers = curl_exec($curl);
	
	curl_setopt_array($curl, array(
	    CURLOPT_RETURNTRANSFER => 1,
	    CURLOPT_URL => $url,
	    CURLOPT_HTTPHEADER => array('Expect:'),
	    CURLOPT_HEADER => false,
	    CURLOPT_NOBODY => false,
	    CURLOPT_SSL_VERIFYPEER => false,
	    CURLOPT_SSL_VERIFYHOST => false,
	    CURLOPT_USERAGENT => 'API Documentor REST Tester',
	    CURLOPT_POST => 1,
	    CURLOPT_POSTFIELDS => $fields
	));
	
	$body = curl_exec($curl);
	
	if(!$headers)
	{
	
    	$resp = '
    	<h1>cURL Error: '.curl_errno($curl).'</h1> 
    	'.curl_error($curl);
	
		//Close request to clear up some resources
		curl_close($curl);
	
		$gen->jsonReply(false, $resp);
    	
	}
	else
	{
	
		curl_close($curl);
		
		$headers = str_replace($body, '', $headers);
	
		$gen->jsonReply(true, array(
			'headers' => $headers,
			'body' => $body
		));
		
	}

}