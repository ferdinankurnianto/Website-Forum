$(this).ready(function(){
	getThread();
	getReplies();
	
	function getThread(){
		$.ajax(
		{
			url:base_url+'/threads/getThread/'+id, 
			method:'POST',
			dataType:'JSON',
			success:function(result){
				var rows = '';
				$.each(result, function(index, value){
					rows = '<table class="tborder" cellpadding="6" cellspacing="1" border="1" width="100%" align="center"><thead><tr>'
					+'<td nowrap="nowrap">'+value.timestamp+'</td><td width="100%" align="right">#'+value.id+'</td></tr></thead><tbody>'
					+'<tr><td>'+value.username+'</td>'+
					'<td><div>'+value.title+'</div><div>'+
					value.content+'</div></td></tr></table><br>';
				});
				$('div#thread').append(rows);
			}
		})
	}
	
	function getReplies(){
		$.ajax(
		{
			url:base_url+'/replies/getReplies/'+id, 
			method:'POST',
			dataType:'JSON',
			success:function(result){
				$.each(result, function(index, value){
					var rows = ''
					rows = '<table class="tborder" cellpadding="6" cellspacing="1" border="1" width="100%" align="center"><thead><tr>'
					+'<td nowrap="nowrap">'+value.timestamp+'</td><td width="100%" align="right">#'+value.id+'</td></tr></thead><tbody>'
					+'<tr><td>'+value.username+'</td><td>'+
					value.content+'</td></tr></table><br>';
					$('div#thread').append(rows);
				});
			}
		})
	}
	$('#btnSubmit').click(function(){
		$('#thread_id').attr('value', id);
		var dataSend = $('#formReply').serialize();
		$.ajax({
			url:base_url+'/replies/add',
			data:dataSend,
			method:'POST',
			dataType:'JSON',
			success:function(result){
				var alert = '<div class="alert alert-danger" role="alert">';
				if(result.status){
					window.location.reload();
				} else {
					$.each(result.message, function(index, value){
						alert += '<li>'+value+'</li>';
					});
					$('#formReply').prepend(alert+'</div>');
				}
			}
		})
	});
})