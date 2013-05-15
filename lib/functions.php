<?php

//Configuration file
require_once('config.php');

//Classes
require_once('classes/general.class.php');
require_once('classes/documentor.class.php');

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

function isAuthenticated()
{

	if(!isset($_SESSION['authenticated']))
	{
	
		$gen = new General();
		
		$gen->setNotification('You must be logged in to see that...', 'negative-notification');
		header('Location: '.BASE_URL);
		
	}

}

function logout()
{
	
	$gen = new General();

	unset($_SESSION['authenticated']);
	
	$gen->setNotification('Logged out safely', 'positive-notification');
	
	header('Location: '.BASE_URL);

}

function login($url = '')
{

	if(isset($_POST['submit']))
	{
	
		$gen = new General();
	
		$user = $gen->getVar('post', 'user');
		$pass = $gen->getVar('post', 'pass');
		
		if($user && $pass)
		{
			
			if($user == USERNAME && $pass == PASSWORD)
			{
			
				$_SESSION['authenticated'] = true;
				
				$url = 'home';
				
			}
			else
			{
				
				$gen->setNotification('Your username or password are incorrect...', 'negative-notification');
				
			}
			
		}
		else
		{
				
			$gen->setNotification('You didn\'t enter a username or password', 'negative-notification');
			
		}
		
	}
	
	header('Location: '.BASE_URL.$url);

}

function create()
{

	$doc = new Documentor();
	
	$doc->newDocumentation();

}

function save()
{

	$doc = new Documentor();
	
	$doc->saveDocumentation();

}

function delete()
{

	$doc = new Documentor();
	
	$doc->deleteDocumentation();

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