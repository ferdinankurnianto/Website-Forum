$(this).ready(function(){
	$('#btnSubmit').click(function(){
		var dataSend = $('#formRegister').serialize();
		$.ajax({
			url:base_url+'/users/newAccount',
			data:dataSend,
			method:'POST',
			dataType:'JSON',
			success:function(result){
				console.log(result);
				var alert = '<div class="alert alert-danger" role="alert">';
				if(result.status){
					$('#formRegister').prepend('<div class="alert alert-primary" role="alert">'
					+result.message+'</div>');
					$('#formRegister').reset();
				} else {
					$.each(result.message, function(index, value){
						alert += '<li>'+value+'</li>';
					});
					$('#formRegister').prepend(alert+'</div>');
				}
			}
		})
	});
})