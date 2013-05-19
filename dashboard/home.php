<?php require_once('../lib/functions.php'); General::validateSession(); ?>
<!DOCTYPE html>
<html>
<?php require_once('../lib/includes/admin-header.php'); ?>
<body>

	<?php General::notification(); ?>
	
	<div class="container">
	
		<?php require_once('../lib/includes/sidebar.php'); ?>
		
		<section id="content">
		
			<div class="title">Current Documentation</div>
		
			<?php
			
			$doc = new Documentor();
			
			$calls = $doc->fetchCalls();
			
			?>
			
			<?php if(count($calls) > 0){ ?>
				
				<table cellpadding="0" cellspacing="0" border="0" class="standard-table" width="100%">
					
						<tr>
							<th>Call</th>
							<th>Method</th>
							<th>Created</th>
							<th width="20%"></th>
						</tr>
				
					<?php foreach($calls as $call){ ?>
					
						<tr>
							<td><a href="dashboard/edit/<?php echo $call['ID']; ?>"><?php echo $call['name']; ?></a></td>
							<td><pre class="method"><?php echo $doc->methodName($call['method']); ?></pre></td>
							<td><?php echo $doc->formatDate($call['addedDate']); ?></td>
							<td>
								<a href="javascript:{}" data-id="<?php echo $call['ID']; ?>" class="delete button"></a>
								<a href="dashboard/edit/<?php echo $call['ID']; ?>" class="button edit"></a>
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