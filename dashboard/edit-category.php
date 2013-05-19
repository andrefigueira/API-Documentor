<?php require_once('../lib/functions.php'); General::validateSession(); ?>
<!DOCTYPE html>
<html>
<?php require_once('../lib/includes/admin-header.php'); ?>
<body>

	<?php
	
	General::notification(); 
	
	$gen = new General();
	
	$data = $gen->fetchRow(array(
		'table' => 'categories',
		'ID' => true,
		'fields' => array(
			'ID',
			'name',
			'description'
		),
		'sql' => 'LIMIT 1'
	));
	
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