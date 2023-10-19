$(this).ready(function(){
	getData();
	
	function getData(){
		$.ajax(
		{
			url:base_url+'/replies/getData', 
			method:'POST',
			dataType:'JSON',
			success:function(result){
				var rows='';
				var i=1;
				$.each(result, function(index, value){
					rows += '<tr><td>'+i+'</td>'+
					'<td>'+value.thread_id+'</td>'+
					'<td>'+value.user_id+'</td>'+
					'<td>'+value.content+'</td>'+
					'<td>'+value.timestamp+'</td>'+
					'<td><button id ="edit" data-id="'+value.id+'" class="btn btn-primary" data-toggle="modal" data-target="#mdEdit">Edit</button> '+
					'<button id ="delete" data-id="'+value.id+'" class="btn btn-primary" data-toggle="modal" data-target="#mdDelete">Delete</button></td></tr>';
					i++;
				});
				$('tbody').html(rows);
			}
		})
	}
	
	$('#btnSubmit').click(function(){
		var dataSend = $('#formEdit').serialize();
		var id = $('#id').val();
		if(id){
			$.ajax({
				url:base_url+'/replies/edit',
				data:dataSend,
				method:'POST',
				dataType:'JSON',
				success:function(result){
					var alert = '<div class="alert alert-danger" role="alert">';
					if(result.status){
						$('.modal-body').html('<div class="alert alert-primary" role="alert">'
						+result.message+'</div>');
						$('#btnSubmit').hide();
						$('#btnClose').attr('onclick','window.location.reload()');
					} else {
						$.each(result.message, function(index, value){
							alert += '<li>'+value+'</li>';
						});
						$('.modal-body').prepend(alert+'</div>');
					}
				}
			})
		} else {
			$.ajax({
				url:base_url+'/replies/add',
				data:dataSend,
				method:'POST',
				dataType:'JSON',
				success:function(result){
					var alert = '<div class="alert alert-danger" role="alert">';
					if(result.status){
						$('.modal-body').html('<div class="alert alert-primary" role="alert">'
						+result.message+'</div>');
						$('#btnSubmit').hide();
						$('#btnClose').attr('onclick','window.location.reload()');
					} else {
						$.each(result.message, function(index, value){
							alert += '<li>'+value+'</li>';
						});
						$('.modal-body').prepend(alert+'</div>');
					}
				}
			})
		}
	});
	
	$(document).on('click', '#edit', function(){
		$('.modal-title').html('Edit Reply');
		var id = $(this).attr("data-id");
		$.ajax({
			data: {id},
            url:base_url+'/replies/getData',
            method: 'POST',
            dataType: 'json', 
            success: function(result){
				$.each(result, function (index, value) {
					console.log(value);
					$('#id').attr("value", value.id);
					$('#thread_id').attr("value", value.thread_id);
					$('#user_id').attr("value", value.user_id);
					$('#content').append(value.content);
				});
			}
		});
	});
	
	$(document).on('click', '#delete', function(){
		var id = $(this).attr("data-id");
		$("#idDel").attr("value", id);
	});
	
	$('#btnYes').click(function(){
		var id = $("#idDel").val();
		
        $.ajax({	
            data: {id},
            url:base_url+'/replies/delete',
            method: 'POST',
            dataType: 'json', 
            success: function(result){
				var alert = '<div class="alert alert-danger" role="alert">';
				if(result.status){
					$('.modal-body').html('<div class="alert alert-primary" role="alert">'
					+result.message+'</div>');
					$('#btnYes').hide();
					$('#btnCls').attr('onclick','window.location.reload()');
				} else {
					$.each(result.message, function(index, value){
						alert += '<li>'+value+'</li>';
					});
					$('.modal-body').prepend(alert+'</div>');
				}
            }
        });
    })
	
	$('#btnAdd').click(function(){
		$('#formEdit :input').attr('value', '');
		$('.modal-title').html('Add Reply');
	});
})