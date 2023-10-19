$(this).ready(function(){
	getData();
	
	function getData(){
		$.ajax(
		{
			url:base_url+'/users/getData', 
			method:'POST',
			dataType:'JSON',
			success:function(result){
				var rows='';
				var i=1;
				var active;
				$.each(result, function(index, value){
					if(value.active==1)
						active = 'Deactivate User';
					else
						active = 'Activate User';
					rows += '<tr><td>'+i+'</td>'+
					'<td>'+value.username+'</td>'+
					'<td>'+value.email+'</td>'+
					'<td>'+value.password+'</td>'+
					'<td>'+value.gender+'</td>'+
					'<td>'+value.birthdate+'</td>'+
					'<td><div><button id ="edit" data-id="'+value.id+'" class="btn btn-primary" data-toggle="modal" data-target="#mdEdit">Edit</button> '+
					'<button id ="delete" data-id="'+value.id+'" class="btn btn-primary" data-toggle="modal" data-target="#mdDelete">Delete</button></div>'+
					'<div class="mt-1"><button id="active" value="'+value.active+'" data-id="'+value.id+'" class="btn btn-primary" data-toggle="modal" data-target="#mdDelete">'+active+'</button></div></td></tr>';
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
				url:base_url+'/users/edit',
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
				url:base_url+'/users/add',
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
		$('.modal-title').html('Edit User');
		var id = $(this).attr("data-id");
		$.ajax({
			data: {id},
            url:base_url+'/users/getData',
            method: 'POST',
            dataType: 'json', 
            success: function(result){
				$.each(result, function (index, value) {
					console.log(value);
					$('#id').attr("value", value.id);
					$('#username').attr("value", value.username);
					$('#email').attr("value", value.email);
					$('#password').attr("value", value.password);
					$('input[name="gender"][value="' + value.gender + '"]').prop('checked', true);
					$('#birthdate').attr("value", value.birthdate);
				});
			}
		});
	});
	
	$(document).on('click', '#delete', function(){
		$('.modal-title2').html('Delete User');
		$('#msg').html('Are you sure you want to delete this row?');
		var id = $(this).attr("data-id");
		$("#idDel").attr("value", id);
		$("#status").attr("value", '');
	});
	
	$(document).on('click', '#active', function(){
		var id = $(this).attr("data-id");
		var value = $(this).attr('value');
		if(value=='1'){
			$('.modal-title2').html('Deactivate User');
			$('#msg').html('Are you sure you want to deactivate this user?');
		} else {
			$('.modal-title2').html('Activate User');
			$('#msg').html('Are you sure you want to activate this user?');
		}
		$("#idDel").attr("value", id);
		$("#status").attr("value", value);
	});
	
	$('#btnYes').click(function(){
		var id = $("#idDel").val();
		var status = $("#status").val();
		if(status){
			$.ajax({	
				data: {id, status},
				url:base_url+'/admin/setStatus',
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
		} else {
			$.ajax({	
				data: {id},
				url:base_url+'/users/delete',
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
		}
    })
	
	$('#btnAdd').click(function(){
		$('#formEdit  :input:not([name=gender])').attr('value', '');
		$('[name=gender]').prop('checked', false);
		$('.modal-title').html('Add User');
	});
})