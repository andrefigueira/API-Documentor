$(document).ready(function(){
	
	var BASE_URL = $('#BASE_URL').val();
	
	$('.delete').click(function(){
	
		var id = $(this).data('id');
		
		if(isNaN(id)){ alert('Ohhh no you don\'t!');}
		
		var deleteDocumentation = confirm('Delete this documentation?');
		
		if(deleteDocumentation)
		{
	
			var ajaxURL = BASE_URL + 'request/delete/';
		
			$.ajax({
	 			type: 'POST',
				url: ajaxURL,
				data: { 
					ID: id
				},
				dataType: 'json',
				success: function(data){
				
					if(data.success)
					{
					
						window.location = BASE_URL + 'home';
						
					}
					else
					{
						
						alert(data.message);
						
					}
				
				}
			});
				
		}
		
	});
	
	$('.delete-user').click(function(){
		
		if(!$(this).hasClass('disabled'))
		{
		
			var id = $(this).data('id');
		
			if(isNaN(id)){ alert('Ohhh no you don\'t!');}
			
			var deleteDocumentation = confirm('Delete this user?');
			
			if(deleteDocumentation)
			{
		
				var ajaxURL = BASE_URL + 'request/deleteUser/';
			
				$.ajax({
		 			type: 'POST',
					url: ajaxURL,
					data: { 
						ID: id
					},
					dataType: 'json',
					success: function(data){
					
						if(data.success)
						{
						
							window.location = BASE_URL + 'users';
							
						}
						else
						{
							
							alert(data.message);
							
						}
					
					}
				});
					
			}
		
		}
		
	});
	
	$('#add-parameter').click(function(){
	
		var ID = $('.parameter-group').size();
		
		var parameterHtml = '<div class="parameter-group">' +
							'<label for="parameter-' + ID + '-name">Name</label>' +
							'<input type="text" name="parameter-' + ID + '-name" id="parameter-' + ID + '-name" placeholder="e.g. includeUsers" autocomplete="off" />' +
							'<label for="parameter-' + ID + '-example">Example</label>' +
							'<input type="text" name="parameter-' + ID + '-example" id="parameter-' + ID + '-example" placeholder="e.g. true or 354" autocomplete="off" />' +
							'<label for="parameter-' + ID + '-description">Description</label>' +
							'<input type="text" name="parameter-' + ID + '-description" id="parameter-' + ID + '-description" placeholder="e.g. This call fetches users" autocomplete="off" />' +
							'<label for="parameter-' + ID + '-optional">Optional</label>' +
							'<select name="parameter-' + ID + '-optional" id="parameter-' + ID + '-optional">' +
							'<option value="0">No</option>' +
							'<option value="1">Yes</option>' +
							'</select>' +
							'</div><!-- End parameter group -->';
							
			$('.parameter-group').last().after(parameterHtml);
			
			$('select[name=parameter-' + ID + '-optional]').cFields({label:true});
		
	});
	
	$('.show-hide').click(function(){
	
		var title = $(this).attr('title');
		var label = $(this).html();
		
		$(this).html(title);
		$(this).attr('title', label);
		
		$('.parameters').toggle();
		$('#add-parameter').toggle();
		
	});
	
	$('#save-documentation').submit(function(e){
	
		e.preventDefault();
	
		var ajaxURL = BASE_URL + 'request/save/';
		
		var ID = getVal('ID', 'input');
		var name = getVal('name', 'input');
		var uri = getVal('uri', 'input');
		var method = getVal('method', 'select');
		var auth = getVal('auth', 'select');
		var request = getVal('request', 'html');
		var response = getVal('response', 'html');
		var parameters = [];
		
		$('.parameter-group').each(function(index){
		
			var parameterPrefix = 'parameter-' + index + '-';
			
			parameters.push({
				name: getVal(parameterPrefix + 'name', 'input'),
				example: getVal(parameterPrefix + 'example', 'input'),
				description: getVal(parameterPrefix + 'description', 'input'),
				optional: Number(getVal(parameterPrefix + 'optional', 'select'))
			});
			
		});
		
		$.ajax({
 			type: 'POST',
			url: ajaxURL,
			data: { 
				ID: ID,
				name: name,
				uri: uri,
				method: method,
				auth: auth,
				request: request,
				response: response,
				parameters: parameters
			},
			dataType: 'json',
			success: function(data){
			
				if(data.success)
				{
				
					window.location = BASE_URL + 'edit/' + ID;
					
				}
				else
				{
					
					alert(data.message);
					
				}
			
			}
		});
		
    	return false;
	
	});
	
	$('#create-documentation').submit(function(e){
	
		e.preventDefault();
	
		var ajaxURL = BASE_URL + 'request/create/';
		
		var name = getVal('name', 'input');
		var uri = getVal('uri', 'input');
		var method = getVal('method', 'select');
		var auth = getVal('auth', 'select');
		var request = getVal('request', 'html');
		var response = getVal('response', 'html');
		var parameters = [];
		
		$('.parameter-group').each(function(index){
		
			var parameterPrefix = 'parameter-' + index + '-';
			
			parameters.push({
				name: getVal(parameterPrefix + 'name', 'input'),
				example: getVal(parameterPrefix + 'example', 'input'),
				description: getVal(parameterPrefix + 'description', 'input'),
				optional: Number(getVal(parameterPrefix + 'optional', 'select'))
			});
			
		});
		
		$.ajax({
 			type: 'POST',
			url: ajaxURL,
			data: { 
				name: name,
				uri: uri,
				method: method,
				auth: auth,
				request: request,
				response: response,
				parameters: parameters
			},
			dataType: 'json',
			success: function(data){
			
				if(data.success)
				{
				
					window.location = BASE_URL + 'home';
					
				}
				else
				{
					
					alert(data.message);
					
				}
			
			}
		});
		
    	return false;
	
	});
	
	$('#create-user').submit(function(e){
	
		e.preventDefault();
	
		var ajaxURL = BASE_URL + 'request/createUser/';
		
		var username = getVal('username', 'input');
		var email = getVal('email', 'input');
		var password = getVal('password', 'input');
		var confirmPassword = getVal('confirm-password', 'input');
		
		$.ajax({
 			type: 'POST',
			url: ajaxURL,
			data: { 
				username: username,
				email: email,
				password: password,
				confirmPassword: confirmPassword
			},
			dataType: 'json',
			success: function(data){
			
				if(data.success)
				{
				
					window.location = BASE_URL + 'users';
					
				}
				else
				{
					
					alert(data.message);
					
				}
			
			}
		});
		
    	return false;
	
	});
	
	$('#save-user').submit(function(e){
	
		e.preventDefault();
	
		var ajaxURL = BASE_URL + 'request/saveUser/';
		
		var username = getVal('username', 'input');
		var email = getVal('email', 'input');
		var password = getVal('password', 'input');
		var confirmPassword = getVal('confirm-password', 'input');
		
		$.ajax({
 			type: 'POST',
			url: ajaxURL,
			data: { 
				username: username,
				email: email,
				password: password,
				confirmPassword: confirmPassword
			},
			dataType: 'json',
			success: function(data){
			
				if(data.success)
				{
				
					window.location = BASE_URL + 'edit-user/' + ID;
					
				}
				else
				{
					
					alert(data.message);
					
				}
			
			}
		});
		
    	return false;
	
	});
	
});

function alert(message)
{

	var html = '<div id="alert">' + message + '</div>';
	
	$('body').append(html);
	
	$('#alert').fadeIn().delay(3000).fadeOut(function(){
		
		$('#alert').remove();
		
	});
	
	$('html, body').animate({ scrollTop: 0}, 600);

}

function getVal(ID, type)
{

	if(type == 'input')
	{
		
		var val = $('#' + ID).val();
		
	}
	else if(type == 'select')
	{
		
		var val = $('#' + ID + ' option:selected').val();
		
	}
	else if(type == 'checkbox')
	{
		
		var val = $('#' + ID + ':checked').val();
		
	}
	else if(type == 'html')
	{
		
		var val = $('#' + ID).html();
		
	}

	if(val != undefined){ return val;}else{ return false;}

}