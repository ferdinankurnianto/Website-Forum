$(this).ready(function(){
	getThreads();
	
	function getThreads(){
		$.ajax(
		{
			url:base_url+'/threads/getThreads/'+id, 
			method:'POST',
			dataType:'JSON',
			success:function(result){
				var rows='<input id="forum_name" type="hidden" value="'+result.threads[0].forum_title+'">';
				var length=Object.keys(result.threads).length;
				var reply = new Array();
				var time = new Array();
				var i=1;
				for (let j = 0; j < length; j++) {
					try {
						reply[j] = "by "+result.replies[j].username;
						time[j] = result.replies[j].timestamp;
					}
					catch {
						reply[j] = "";
						time[j] = "";
					}
					rows += '<tr align="center"><td>'+i+'</td>'+
					'<td align="left"><a href="'+base_url+'/threads/index/'+id+'/'+result.threads[j].id+'">'+result.threads[j].title+'</a><a style="float:right;">'+
					result.threads[j].username+'</a></td><td><div>'+reply[j]+'</div><div class="smallfont">'+time[j]+'</div></td></tr>';
					i++;
				}
				$('tbody').html(rows);
				$('#title').text(result.threads[0].forum_title+' Thread List');
			}
		})
	}
	
	$('#btnAdd').click(function(){
		var rows = '<br><form id="formReply" method="POST" action="" enctype="multipart/form-data">'+
				'<table class="tborder" cellpadding="6" cellspacing="1" border="1" width="100%">'+
				'<thead><tr><td style="width:100%;">Post New Thread <a style="float:right;">Forum: '+
				$('#forum_name').attr('value')+'</a></td></tr></thead><tbody><tr><td><div class="form-group">'+
				'<input type="hidden" id="forum_id" name="forum_id" value="'+id+'">'+
				'<input type="hidden" id="user_id" name="user_id" value="'+user_id+'">'+
				'<label>Title:</label>'+
				'<input type="text" class="form-control" id="title" name="title" value="">'+
				'</div></td></tr><tr><td><div class="form-group">'+
				'<label>Message:</label>'+
				'<textarea class="form-control" rows="3" cols="60" id="content" name="content"></textarea>'+
				'</div></td></tr></tbody></table><div class="row justify-content-center">'+
				'<button id="btnSubmit" type="button" class="btn btn-primary mr-2">Submit</button>'+
				'<button id="btnBack" type="button" class="btn btn-primary mr-2" onclick="window.location.reload()">Back</button>'+
				'</div></form><br>';
		$('#threads').html(rows);
	});
	
	$(document).on('click', '#btnSubmit', function(){
		var dataSend = $('#formReply').serializeArray();
		$.ajax({
			url:base_url+'/threads/add',
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