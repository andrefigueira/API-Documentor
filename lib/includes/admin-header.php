
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