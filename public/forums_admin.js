$(this).ready(function(){
	getData();
	
	function getData(){
		$.ajax(
		{
			url:base_url+'/forums/getForums', 
			method:'POST',
			dataType:'JSON',
			success:function(result){
				var rows='';
				var i=1;
				$.each(result.forums, function(index, value){
					rows += '<tr><td>'+i+'</td>'+
					'<td>'+value.forum_title+'</td>'+
					'<td>'+value.subtitle+'</td>'+
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
				url:base_url+'/forums/edit',
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
				url:base_url+'/forums/add',
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
		$('.modal-title').html('Edit Forum');
		var id = $(this).attr("data-id");
		$.ajax({
		data: {id},
            url:base_url+'/forums/getForums',
            method: 'POST',
            dataType: 'json', 
            success: function(result){
				$.each(result, function (index, value) {
					console.log(value);
					$('#id').attr("value", value.id);
					$('#title').attr("value", value.forum_title);
					$('#subtitle').append(value.subtitle);
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
            url:base_url+'/forums/delete',
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
		$('.modal-title').html('Add Forum');
	});
})
