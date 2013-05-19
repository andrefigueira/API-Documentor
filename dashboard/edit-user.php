<?php require_once('../lib/functions.php'); General::validateSession(); ?>
<!DOCTYPE html>
<html>
<?php require_once('../lib/includes/admin-header.php'); ?>
<body>

	<?php
	
	General::notification(); 
	
	$gen = new General();
	
	$data = $gen->fetchRow(array(
		'table' => 'users',
		'ID' => true,
		'fields' => array(
			'ID',
			'username',
			'email'
		),
		'sql' => 'LIMIT 1'
	));
	
	?>
	
	<div class="container">
	
		<?php require_once('../lib/includes/sidebar.php'); ?>
		
		<section id="content">
		
		<?php if(empty($data)){ ?>
		
			<div class="title">Edit User</div>
			
			<p class="none">User doesn't exist...</p>
		
		<?php }else{ ?>
		
			<div class="title">Edit User &raquo; <?php echo $data['username']; ?></div>
		
			<form id="save-user" class="inside-form" method="post">
			
				<input type="hidden" name="ID" id="ID" value="<?php echo $data['ID']; ?>" />
			
				<label for="username">Username</label>	
				<input type="text" name="username" id="username" placeholder="e.g. phprulezwithacapitalp89" value="<?php echo $data['username']; ?>" autocomplete="off" />
				
				<label for="email">Email</label>
				<input type="text" name="email" id="email" placeholder="e.g. megustamuchoburritos@outlook.com" value="<?php echo $data['email']; ?>" autocomplete="off" />
				
				<div class="clear"></div>
			
				<label for="password">Password</label>	
				<input type="password" name="password" id="password" placeholder="" autocomplete="off" />
			
				<label for="confirm-password">Confirm Password</label>	
				<input type="password" name="confirm-password" id="confirm-password" placeholder="" autocomplete="off" />
				
				<input type="submit" name="submit" id="submit" value="Save changes" />
			
			</form>
		
		<?php } ?>
			
		</section><!-- End content -->
		
	</div><!-- End wrapper -->

</body>
</html>