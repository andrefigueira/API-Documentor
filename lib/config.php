<?php

//Start the output buffer
ob_start();

//Start the session yo...
session_start();

//Set a custom error handler, just because...
set_error_handler('error_handler', E_ALL);

//Set the server default timezone
date_default_timezone_set('Europe/London');

//Base folder of the monitor
define('BASE_URL', 'https://staging.hollatme.com/dashboard/api/');

//Version of this monitoring thingy
define('VERSION', '0.1');

//If debug if true, then if there are errors, they'll be displayed
define('DEBUG', false);

//User details for access to the service
define('USERNAME', 'andrefigueira');
define('PASSWORD', 'lolipop=1989');

//Memcache details
//Set this to your details...
define('MC_HOST', '127.0.0.1');
define('MC_PORT', '11211');

if(DEBUG == true)
{

	error_reporting(E_ALL);
	ini_set('display_errors', 1);

}

?>