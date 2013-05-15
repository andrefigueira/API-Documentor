<?php require_once('lib/functions.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<title>API Documentor</title>
	<base href="<?php echo BASE_URL; ?>" />
	<link href="css/main.css" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
</head>
<body class="login">

	<?php General::notification(); ?>

	<form class="login" action="request/login/" method="post">
	
		<h1>API Documentor</h1>
	
		<input type="text" name="user" id="user" placeholder="Username..." autocomplete="off" />
		<input type="password" name="pass" id="pass" placeholder="Password..." autocomplete="off" />
		
		<input type="submit" name="submit" id="login" value="Login" />
	
		<span>Version: <?php echo VERSION; ?></span>
	
	</form><!-- End login -->

</body>
</html>