<?php require_once('../lib/functions.php'); General::validateSession(); ?>
<!DOCTYPE html>
<html>
<?php require_once('../lib/includes/admin-header.php'); ?>
<body>

	<?php General::notification(); ?>
	
	<div class="container">
	
		<?php require_once('../lib/includes/sidebar.php'); ?>
		
		<section id="content">
		
			<div class="title">Current Categories</div>
		
			<?php
			
			$category = new Categories();
			
			$categories = $category->fetchCategories();
			
			if(count($categories) > 0)
			{
				
				?>
				
				<table cellpadding="0" cellspacing="0" border="0" class="standard-table" width="100%">
					
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th>Created</th>
							<th width="20%"></th>
						</tr>
				
					<?php foreach($categories as $realCategory){ ?>
					
						<tr>
							<td><a href="dashboard/edit-category/<?php echo $realCategory['ID']; ?>"><?php echo $realCategory['name']; ?></a></td>
							<td><?php echo $realCategory['description']; ?></td>
							<td><?php echo General::formatDate($realCategory['addedDate']); ?></td>
							<td>
								<a href="javascript:{}" data-id="<?php echo $realCategory['ID']; ?>" class="delete-category <?php if($realCategory['ID'] == 0){ echo 'disabled';} ?> button"></a>
								<a href="dashboard/edit-category/<?php echo $realCategory['ID']; ?>" class="button edit"></a>
							</td>
						</tr>
					
					<?php } ?>
				
				</table>
				
				<?php
				
				
			}
			else
			{
				
				?>
				
				<p class="none">No category has been created...</p>
				
				<?php
				
			}
			
			?>
		
		</section>
		
	</div><!-- End container -->

</body>
</html>