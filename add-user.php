<?php require_once('lib/functions.php'); General::validateSession(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>API Documentor</title>
	<base href="<?php echo BASE_URL; ?>" />
	<link href="css/main.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script src="js/documentor.js"></script>
	<script src="js/cfields/scripts/cFields.1.0.js"></script>
	<script>
	
	$(document).ready(function(){
		
		$('select').cFields({label:true});
		$('input[type=checkbox]').cFields({label:true});
		
	});
	
	</script>
</head>
<body>

	<?php General::notification(); ?>
	
	<div class="container">
	
		<?php require_once('lib/includes/sidebar.php'); ?>
		
		<section id="content">
		
			<div class="title">Create User</div>
		
			<form id="create-user" class="inside-form" method="post">
			
				<label for="username">Username</label>	
				<input type="text" name="username" id="username" placeholder="e.g. phprulezwithacapitalp89" autocomplete="off" />
				
				<label for="email">Email</label>
				<input type="text" name="email" id="email" placeholder="e.g. megustamuchoburritos@outlook.com" autocomplete="off" />
				
				<div class="clear"></div>
			
				<label for="password">Password</label>	
				<input type="password" name="password" id="password" placeholder="" autocomplete="off" />
			
				<label for="confirm-password">Confirm Password</label>	
				<input type="password" name="confirm-password" id="confirm-password" placeholder="" autocomplete="off" />
				
				<input type="submit" name="submit" id="submit" value="Create" />
			
			</form>
			
		</section><!-- End content -->
		
	</div><!-- End wrapper -->

</body>
</html>