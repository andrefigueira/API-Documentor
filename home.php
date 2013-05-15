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
		
			<div class="title">Current Documentation</div>
		
			<?php
			
			$doc = new Documentor();
			
			$calls = $doc->fetchCalls();
			
			if(count($calls) > 0)
			{
				
				?>
				
				<table cellpadding="0" cellspacing="0" border="0" class="standard-table" width="100%">
					
						<tr>
							<th>Call</th>
							<th>Method</th>
							<th>Created</th>
							<th width="20%"></th>
						</tr>
				
					<?php foreach($calls as $call){ ?>
					
						<tr>
							<td><a href="edit/<?php echo $call['ID']; ?>"><?php echo $call['name']; ?></a></td>
							<td><pre class="method"><?php echo $doc->methodName($call['method']); ?></pre></td>
							<td><?php echo $doc->formatDate($call['addedDate']); ?></td>
							<td>
								<a href="javascript:{}" data-id="<?php echo $call['ID']; ?>" class="delete button"></a>
								<a href="edit/<?php echo $call['ID']; ?>" class="button edit"></a>
							</td>
						</tr>
					
					<?php } ?>
				
				</table>
				
				<?php
				
				
			}
			else
			{
				
				?>
				
				<p class="none">No documentation has been created...</p>
				
				<?php
				
			}
			
			?>
		
		</section>
		
	</div><!-- End container -->

</body>
</html>