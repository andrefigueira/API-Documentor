<?php require_once('lib/functions.php'); ?>
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
		
			<div class="title">Create Documentation</div>
		
			<form id="create-documentation" class="inside-form" method="post">
			
				<label for="name">Name</label>	
				<input type="text" name="name" id="name" placeholder="e.g. getUsers" autocomplete="off" />
				
				<label for="uri">URI</label>
				<input type="text" name="uri" id="uri" placeholder="e.g. https://mysite.com/api/get/users/" autocomplete="off" />
				
				<div class="clear"></div>
				
				<label for="method">Method</label>			
				<select name="method" id="method">
					<option value="0">GET</option>
					<option value="1">POST</option>
					<option value="2">DELETE</option>
					<option value="3">PUT</option>
				</select>
				
				<label for="auth">Authorisation Required</label>	
				<select name="auth" id="auth">
					<option value="0">No</option>
					<option value="1">Yes</option>
				</select>
				
				<div class="normal-label">Example Request</div>
				<code contenteditable="true" class="example" id="request"></code>
				
				<div class="normal-label">Example Response</div>
				<code contenteditable="true" class="example" id="response"></code>
				
				<input type="submit" name="submit" id="submit" value="Create" />
			
			</form>
			
		</section><!-- End content -->
		
	</div><!-- End wrapper -->

</body>
</html>