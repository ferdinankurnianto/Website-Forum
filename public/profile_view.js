$(this).ready(function(){
	$('#username').click(function(){
		$('.form').remove();
		var rows = '<form method="post" class="form">'+
				'<div class="input"><a>Enter the new username that you want to use</a>'+
				'<input class="form-group col-12" type="text" name="username" value="" size="50" required />'+
				'</div><div><input type="button" class="btn btn-primary mr-2" id="btnSubmit" name="btnSubmit" value="Submit" />'+
				'<input type="button" class="btn btn-primary" name="btnClose" id="btnClose" value="Close" /></div>'+
				'</form>';
		$('#username2').next().html(rows);
	});
	$('#email').click(function(){
		$('.form').remove();
		var rows = '<form method="post" class="form">'+
				'<div class="input"><a>Enter the new email that you want to use</a>'+
				'<input class="form-group col-12" type="email" name="email" value="" size="50" required />'+
				'</div><div><input type="button" class="btn btn-primary mr-2" id="btnSubmit" name="btnSubmit" value="Submit" />'+
				'<input type="button" class="btn btn-primary" name="btnClose" id="btnClose" value="Close" /></div>'+
				'</form>';
		$('#email2').next().html(rows);
	});
	$('#gender').click(function(){
		$('.form').remove();
		var rows = '<form method="post" class="form">'+
				'<div class="input"><div class="mb-3"><a>Gender</a></div>'+
				'<span class="pr-4"><input class="form-group" type="radio" id="male" name="gender" value="Male" required> '+
				'Male</span><input class="form-group" type="radio" id="female" name="gender" value="Female"> Female'+
				'</div><div><input type="button" class="btn btn-primary mr-2" id="btnSubmit" name="btnSubmit" value="Submit" />'+
				'<input type="button" class="btn btn-primary" name="btnClose" id="btnClose" value="Close" /></div>'+
				'</form>';
		$('#gender2').next().html(rows);
	});
	$('#birthdate').click(function(){
		$('.form').remove();
		var rows = '<form method="post" class="form">'+
				'<div class="input"><div class="mb-3"><a>Birthdate</a></div>'+
				'<input class="form-group col-4" type="date" id="birthdate" name="birthdate" required>'+
				'</div><div><input type="buton" class="btn btn-primary mr-2" id="btnSubmit" name="btnSubmit" value="Submit" />'+
				'<input type="button" class="btn btn-primary" name="btnClose" id="btnClose" value="Close" /></div>'+
				'</form>';
		$('#birthdate2').next().html(rows);
	});
	$(document).on('click', '#btnSubmit', function(){
		var dataSend = $('.form').serializeArray();
		$.ajax({
			url:base_url+'/users/editProfile',
			data:{dataSend},
			method:'POST',
			dataType:'JSON',
			success:function(result){
				var alert = '<div class="alert alert-danger" role="alert">';
				if(result.status){
					$('.input').html('<div class="alert alert-primary" role="alert">'
					+result.message+'</div>');
					$('#btnSubmit').hide();
					$('#btnClose').attr('onclick','window.location.reload()');
					$('#btnClose').attr('value', 'Ok');
				} else {
					$.each(result.message, function(index, value){
						alert += '<li>'+value+'</li>';
					});
					$('.form').prepend(alert+'</div>');
				}
			}
		})
	});
	$('#changePassword').click(function(){
		$('.form').remove();
		var rows = '<form class="form" method="post"><div class="col-6">'+
				'<div class="input"><h6>Old Password</h6>'+
				'<input class="form-group col-12" type="password" name="oldPassword" value="" size="50" />'+
				'<h6>New Password</h6>'+
				'<input class="form-group col-12" type="password" name="password" value="" size="50" />'+
				'<h6>Confirm New Password</h6>'+
				'<input class="form-group col-12" type="password" name="password2" value="" size="50" />'+
				'</div><div><input type="button" class="btn btn-primary mr-2" name="btnSubmit" id="btnPassword" value="Submit" />'+
				'<input type="button" class="btn btn-primary" name="btnClose" id="btnClose" value="Close" /></div>'+
				'</div><br></form>';
		$('#about').append(rows);
	});
	$(document).on('click', '#btnPassword', function(){
		var dataSend = $('.form').serialize();
		$.ajax({
			url:base_url+'/users/changePasswordProfile',
			data:dataSend,
			method:'POST',
			dataType:'JSON',
			success:function(result){
				console.log(result);
				var alert = '<div class="alert alert-danger" role="alert">';
				if(result.status){
					$('.input').html('<div class="alert alert-primary" role="alert">'
					+result.message+'</div>');
					$('#btnPassword').hide();
					$('#btnClose').attr('onclick','window.location.reload()');
					$('#btnClose').attr('value', 'Ok');
				} else {
					$.each(result.message, function(index, value){
						alert += '<li>'+value+'</li>';
					});
					$('.form').prepend(alert+'</div>');
				}
			}
		})
	});
	$(document).on('click', '#btnClose', function(){
		$('.form').remove();
	});
})