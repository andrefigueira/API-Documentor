<?php require_once('../lib/functions.php'); General::validateSession(); ?>
<!DOCTYPE html>
<html>
<?php require_once('../lib/includes/admin-header.php'); ?>
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