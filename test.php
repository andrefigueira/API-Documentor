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
	<script type="text/javascript" src="http://balupton.github.com/jquery-syntaxhighlighter/scripts/jquery.syntaxhighlighter.min.js"></script>
	<script src="js/documentor.js"></script>
	<script src="js/cfields/scripts/cFields.1.0.js"></script>
	<script>
	
	$(document).ready(function(){
		
		$.SyntaxHighlighter.init({
			lineNumbers: false
		});
		
		$('select').cFields({label:true});
		$('input[type=checkbox]').cFields({label:true});
		
	});
	
	</script>
</head>
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
	
	if(!empty($data) && $data['parameters'] == ''){ $data['parameters'] = array();}
		
	$category = new Categories();
		
	$categories = $category->fetchCategories();
		
	?>
	
	<div class="container">
	
		<?php require_once('lib/includes/documentation-sidebar.php'); ?>
		
		<section id="content">
		
		<?php if(empty($data)){ ?>
		
			<div class="title">API Documentation</div>
			
			<p class="none">Call doesn't exist...</p>
		
		<?php }else{ ?>
		
			<div class="title">API Tester &raquo; <?php echo $data['name']; ?></div>
			
			<div class="content-area">
			
				<form id="rest-tester" class="inside-form">
			
					<p class="call-description"><?php echo $data['description']; ?></p>
					
					<h2>Method</h2>
					<code class="call-method"><?php echo $doc->methodName($data['method']); ?></code>
					
					<h2>Resource URL</h2>
					<code class="call-url"><?php echo $data['uri']; ?></code>
					
					<?php if(count($data['parameters']) > 0){ ?>
					
						<div class="spacer"></div>
					
						<h2>Parameters</h2>
						<table cellpadding="0" cellspacing="0" border="0" class="standard-table parameters-table">
						
							<?php foreach($data['parameters'] as $parameter){ ?>
								
								<tr>
									<td valign="top" width="30%">
										<strong><?php echo $parameter['name']; ?></strong>
										<p class="optional"><?php echo $doc->optionalName($parameter['optional']); ?></p>
									</td>
									<td valign="top">
										<?php echo $parameter['description']; ?>
										<?php if($parameter['example'] != ''){?> 
										
											<p class="example-value"><input name="<?php echo $parameter['name']; ?>" id="<?php echo $parameter['name']; ?>" class="input-parameter" type="text" placeholder="<?php echo $parameter['example']; ?>" /></p>
										
										<?php } ?>
									</td>
								</tr>
							
							<?php } ?>
						
						</table>
						
					<?php }?>
					
					<input type="submit" name="submit" id="submit" value="Run Test" />
				
				</form>
				
				<div class="rest-results">
				
					<div class="rest-error"></div>
					
					<div class="spacer"></div>
					
					<h2>Response Headers</h2>
					<code class="rest-headers example preview-example highlight"></code>
					
					<h2>Response Body</h2>
					<code class="rest-body example preview-example highlight"></code>
					
				</div><!-- End rest results -->
			
			</div><!-- End content area -->
		
		<?php } ?>
		
		</section>
		
	</div><!-- End container -->

</body>
</html>