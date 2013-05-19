<?php require_once('../lib/functions.php'); General::validateSession(); ?>
<!DOCTYPE html>
<html>
<?php require_once('../lib/includes/admin-header.php'); ?>
<body>

	<?php 
	
	General::notification(); 
	
	$doc = new Documentor();
	
	$data = $doc->fetchRow(array(
		'table' => 'calls',
		'ID' => true,
		'fields' => array(
			'ID',
			'name',
			'description',
			'uri',
			'method',
			'categoryID',
			'parameters',
			'response',
			'auth'
		),
		'sql' => 'LIMIT 1'
	));
	
	$data['parameters'] = $doc->unserialize64($data['parameters']);
	
	if($data['parameters'] == ''){ $data['parameters'] = array();}
		
	$category = new Categories();
		
	$categories = $category->fetchCategories();
		
	?>
	
	<div class="container">
	
		<?php require_once('../lib/includes/sidebar.php'); ?>
		
		<section id="content">
		
		<?php if(empty($data)){ ?>
		
			<div class="title">Edit Documentation</div>
			
			<p class="none">Documentation doesn't exist...</p>
		
		<?php }else{ ?>
		
			<div class="title">Edit Documentation &raquo; <?php echo $data['name']; ?></div>
		
			<form id="save-documentation" class="inside-form" method="post">
			
				<input type="hidden" name="ID" id="ID" value="<?php echo $data['ID']; ?>" />
			
				<label for="name">Name</label>	
				<input type="text" name="name" id="name" placeholder="e.g. getUsers" value="<?php echo $data['name']; ?>" autocomplete="off" />
				
				<label for="description">Description</label>
				<input type="text" name="description" id="description" placeholder="e.g. This call rocks the party" value="<?php echo $data['description']; ?>" autocomplete="off" />
				
				<label for="uri">URI</label>
				<input type="text" name="uri" id="uri" placeholder="e.g. https://mysite.com/api/get/users/" value="<?php echo $data['uri']; ?>" autocomplete="off" />
				
				<div class="clear"></div>
				
				<label for="method">Method</label>			
				<select name="method" id="method">
					<option <?php if($data['method'] == 0){ echo 'selected="selected"';} ?> value="0">GET</option>
					<option <?php if($data['method'] == 1){ echo 'selected="selected"';} ?> value="1">POST</option>
					<option <?php if($data['method'] == 2){ echo 'selected="selected"';} ?> value="2">DELETE</option>
					<option <?php if($data['method'] == 3){ echo 'selected="selected"';} ?> value="3">PUT</option>
				</select>
				
				<label for="auth">Authorisation Required</label>	
				<select name="auth" id="auth">
					<option <?php if($data['auth'] == 0){ echo 'selected="selected"';} ?> value="0">No</option>
					<option <?php if($data['auth'] == 1){ echo 'selected="selected"';} ?> value="1">Yes</option>
				</select>
				
				<?php if(count($categories) > 0){ ?>
		
					<label for="categoryID">Call Category</label>	
					<select name="categoryID" id="categoryID">
				
						<?php foreach($categories as $realCategory){ ?>
							<option <?php if($data['categoryID'] == $realCategory['ID']){ echo 'selected="selected"';} ?> value="<?php echo $realCategory['ID']; ?>"><?php echo $realCategory['name']; ?></option>
						<?php } ?>
					
					</select>
							
				<?php }else{ ?>
					
					<p class="no-categories">Before adding a call you must create a category</p>
					
				<?php } ?>
				
				<div class="normal-label">Parameters &middot; <span class="show-hide" title="Show">Hide</span></div>
				<div class="parameters">
				
					<div class="clear"></div>
					
					<?php if(count($data['parameters']) > 0){ ?>
					
						<?php $count = 0; foreach($data['parameters'] as $parameter){ ?>
					
							<div class="parameter-group">
					
								<label for="parameter-<?php echo $count; ?>-name">Name</label>	
								<input type="text" name="parameter-<?php echo $count; ?>-name" id="parameter-<?php echo $count; ?>-name" placeholder="e.g. includeUsers" value="<?php echo $parameter['name']; ?>" autocomplete="off" />
											
								<label for="parameter-<?php echo $count; ?>-example">Example</label>	
								<input type="text" name="parameter-<?php echo $count; ?>-example" id="parameter-<?php echo $count; ?>-example" placeholder="e.g. true or 354" value="<?php echo $parameter['example']; ?>" autocomplete="off" />
											
								<label for="parameter-<?php echo $count; ?>-description">Description</label>	
								<input type="text" name="parameter-<?php echo $count; ?>-description" id="parameter-<?php echo $count; ?>-description" placeholder="e.g. This call fetches users" value="<?php echo $parameter['description']; ?>" autocomplete="off" />
							
								<label for="parameter-<?php echo $count; ?>-optional">Optional</label>	
								<select name="parameter-<?php echo $count; ?>-optional" id="parameter-<?php echo $count; ?>-optional">
									<option <?php if($parameter['optional'] == 0){ echo 'selected="selected"';} ?> value="0">No</option>
									<option <?php if($parameter['optional'] == 1){ echo 'selected="selected"';} ?> value="1">Yes</option>
								</select>
							
							</div><!-- End parameter group -->
						
						<?php $count++; } ?>
					
					<?php }else{ ?>
					
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
					
					<?php } ?>
					
				</div><!-- End parameters -->
				
				<input type="button" id="add-parameter" name="add-parameter" value="Add Parameter" />
				
				<div class="normal-label">Example Response</div>
				<code contenteditable="true" class="example" id="response"><?php echo $data['response']; ?></code>
				
				<input type="submit" name="submit" id="submit" value="Save changes" />
			
			</form>
		
		<?php } ?>
			
		</section><!-- End content -->
		
	</div><!-- End wrapper -->

</body>
</html>