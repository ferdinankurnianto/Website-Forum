$(this).ready(function(){
	getData();
	
	function getData(){
		$.ajax(
		{
			url:base_url+'/users/getUserLog', 
			method:'POST',
			dataType:'JSON',
			success:function(result){
				var rows='';
				var i=1;
				$.each(result, function(index, value){
					rows += '<tr><td>'+i+'</td>'+
					'<td>'+value.email+'</td>'+
					'<td>'+value.timestamp+'</td>'+
					'<td>'+value.status+'</td>'+
					'<td><button id ="delete" data-id="'+value.id+'" '+
					'class="btn btn-primary" data-toggle="modal" data-target="#mdDelete">Delete</button></td>';
					i++;
				});
				$('tbody').html(rows);
			}
		})
	}
	
	
	
	$(document).on('click', '#delete', function(){
		$('.modal-title2').html('Delete User Log');
		$('#msg').html('Are you sure you want to delete this row?');
		var id = $(this).attr("data-id");
		$("#idDel").attr("value", id);
	});
	
	
	$('#btnYes').click(function(){
		var id = $("#idDel").val();
		$.ajax({	
			data: {id},
			url:base_url+'/users/deleteUserLog',
			method: 'POST',
			dataType: 'json', 
			success: function(result){
				var alert = '<div class="alert alert-danger" role="alert">';
				if(result.status){
					$('.modal-body2').html('<div class="alert alert-primary" role="alert">'
					+result.message+'</div>');
					$('#btnYes').hide();
					$('#btnCls').attr('onclick','window.location.reload()');
				} else {
					$.each(result.message, function(index, value){
						alert += '<li>'+value+'</li>';
					});
					$('.modal-body2').prepend(alert+'</div>');
				}
			}
		});
    })
})