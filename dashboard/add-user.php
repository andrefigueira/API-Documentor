<?php require_once('../lib/functions.php'); General::validateSession(); ?>
<!DOCTYPE html>
<html>
<?php require_once('../lib/includes/admin-header.php'); ?>
<body>

	<?php General::notification(); ?>
	
	<div class="container">
	
		<?php require_once('../lib/includes/sidebar.php'); ?>
		
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