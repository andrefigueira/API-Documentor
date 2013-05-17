<?php require_once('../lib/functions.php'); General::validateSession(); ?>
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
	
		<?php require_once('../lib/includes/sidebar.php'); ?>
		
		<section id="content">
		
			<div class="title">Create Category</div>
		
			<form id="create-category" class="inside-form" method="post">
			
				<label for="name">Name</label>	
				<input type="text" name="name" id="name" placeholder="e.g. onealmond" autocomplete="off" />
				
				<label for="description">Description</label>
				<textarea name="description" id="description" placeholder="A category about onealmond.com"></textarea>
				
				<input type="submit" name="submit" id="submit" value="Create" />
			
			</form>
			
		</section><!-- End content -->
		
	</div><!-- End wrapper -->

</body>
</html>