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
		
		<?php
		
		$category = new Categories();
			
		$categories = $category->fetchCategories();
		
		?>
		
		<section id="content">
		
			<div class="title">Create Documentation</div>
		
			<form id="create-documentation" class="inside-form" method="post">
			
				<label for="name">Name</label>	
				<input type="text" name="name" id="name" placeholder="e.g. getUsers" autocomplete="off" />
				
				<label for="description">Description</label>
				<input type="text" name="description" id="description" placeholder="e.g. This call rocks the party" autocomplete="off" />
				
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
				
				<?php if(count($categories) > 0){ ?>
		
					<label for="categoryID">Call Category</label>	
					<select name="categoryID" id="categoryID">
				
						<?php foreach($categories as $realCategory){ ?>
							<option value="<?php echo $realCategory['ID']; ?>"><?php echo $realCategory['name']; ?></option>
						<?php } ?>
					
					</select>
							
				<?php }else{ ?>
					
					<p class="no-categories">Before adding a call you must create a category</p>
					
				<?php } ?>
				
				<div class="normal-label">Parameters &middot; <span class="show-hide" title="Show">Hide</span></div>
				<div class="parameters">
				
					<div class="clear"></div>
					
					<div class="parameter-group">
			
						<label for="parameter-0-name">Name</label>	
						<input type="text" name="parameter-0-name" id="parameter-0-name" placeholder="e.g. includeUsers" autocomplete="off" />
									
						<label for="parameter-0-example">Example</label>	
						<input type="text" name="parameter-0-example" id="parameter-0-example" placeholder="e.g. true or 354" autocomplete="off" />
									
						<label for="parameter-0-description">Description</label>	
						<input type="text" name="parameter-0-description" id="parameter-0-description" placeholder="e.g. This call fetches users" autocomplete="off" />
					
						<label for="parameter-0-optional">Optional</label>	
						<select name="parameter-0-optional" id="parameter-0-optional">
							<option value="0">No</option>
							<option value="1">Yes</option>
						</select>
					
					</div><!-- End parameter group -->
					
				</div><!-- End parameters -->
				
				<input type="button" id="add-parameter" name="add-parameter" value="Add Parameter" />
				
				<div class="normal-label">Example Response</div>
				<code contenteditable="true" class="example" id="response"></code>
				
				<input type="submit" name="submit" id="submit" value="Create" />
			
			</form>
			
		</section><!-- End content -->
		
	</div><!-- End wrapper -->

</body>
</html>