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
		
			<div class="title">Current Users</div>
		
			<?php
			
			$user = new User();
			
			$users = $user->fetchUsers();
			
			if(count($users) > 0)
			{
				
				?>
				
				<table cellpadding="0" cellspacing="0" border="0" class="standard-table" width="100%">
					
						<tr>
							<th>Username</th>
							<th>Email</th>
							<th>Created</th>
							<th width="20%"></th>
						</tr>
				
					<?php foreach($users as $realUser){ ?>
					
						<tr>
							<td><a href="dashboard/edit-user/<?php echo $realUser['ID']; ?>"><?php echo $realUser['username']; ?></a></td>
							<td><?php echo $realUser['email']; ?></td>
							<td><?php echo General::formatDate($realUser['addedDate']); ?></td>
							<td>
								<a href="javascript:{}" data-id="<?php echo $realUser['ID']; ?>" class="delete-user <?php if($realUser['username'] == $_SESSION['user']['username']){ echo 'disabled';} ?> button"></a>
								<a href="dashboard/edit-user/<?php echo $realUser['ID']; ?>" class="button edit"></a>
							</td>
						</tr>
					
					<?php } ?>
				
				</table>
				
				<?php
				
				
			}
			else
			{
				
				?>
				
				<p class="none">No user has been created...</p>
				
				<?php
				
			}
			
			?>
		
		</section>
		
	</div><!-- End container -->

</body>
</html>