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

	<?php
	
	General::notification(); 
	
	$category = new Categories();
	
	$data = $category->fetchCategory();
	
	?>
	
	<div class="container">
	
		<?php require_once('../lib/includes/sidebar.php'); ?>
		
		<section id="content">
		
		<?php if(empty($data)){ ?>
		
			<div class="title">Edit Category</div>
			
			<p class="none">Category doesn't exist...</p>
		
		<?php }else{ ?>
		
			<div class="title">Edit Category &raquo; <?php echo $data['name']; ?></div>
		
			<form id="save-category" class="inside-form" method="post">
			
				<input type="hidden" name="ID" id="ID" value="<?php echo $data['ID']; ?>" />
			
				<label for="name">Name</label>	
				<input type="text" name="name" id="name" placeholder="e.g. onealmond" value="<?php echo $data['name']; ?>" autocomplete="off" />
				
				<label for="description">Description</label>
				<textarea name="description" id="description" placeholder="A category about onealmond.com"><?php echo $data['description']; ?></textarea>
				
				<input type="submit" name="submit" id="submit" value="Save changes" />
			
			</form>
		
		<?php } ?>
			
		</section><!-- End content -->
		
	</div><!-- End wrapper -->

</body>
</html>