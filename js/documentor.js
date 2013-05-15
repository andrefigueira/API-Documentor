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
				response: response
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
		
		$.ajax({
 			type: 'POST',
			url: ajaxURL,
			data: { 
				name: name,
				uri: uri,
				method: method,
				auth: auth,
				request: request,
				response: response
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

function getVal(id, type)
{

	if(type == 'input')
	{
		
		var val = $('#' + id).val();
		
	}
	else if(type == 'select')
	{
		
		var val = $('#' + id + ':selected').val();
		
	}
	else if(type == 'checkbox')
	{
		
		var val = $('#' + id + ':checked').val();
		
	}
	else if(type == 'html')
	{
		
		var val = $('#' + id + '').html();
		
	}

	if(val != undefined){ return val;}else{ return false;}

}