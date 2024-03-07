$(this).ready(function(){
	getThread();
	
	function getThread(){
		let promise;
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
					promise = true;
				});
				$('div#thread').append(rows);
				getReplies();
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
				var length=Object.keys(result.replies).length;
				console.log(result);
				var replyOfreply = 0;
				for (let i = 0; i < length; i++) {
					var rows = '';
					if(result.replies[i].reply_id!='0'){
						rows = '<table class="tborder" id="'+result.replies[i].id+'" cellpadding="6" cellspacing="1" border="1" width="100%" align="center"><thead><tr>'
						+'<td nowrap="nowrap">'+result.replies[i].timestamp+'</td><td width="100%" align="right"><button id="btnReply'+result.replies[i].id+'" type="button" class="btnReply btn btn-primary mr-2">Reply</button>#'+result.replies[i].id+'</td></tr></thead><tbody>'
						+'<tr><td>'+result.replies[i].username+'</td><td>'+ '<table border="1" width="100%"><tr><td><a href="#'+result.replies[i].reply_id+'">Reply of '+result.reply_of_reply[replyOfreply].username+':</a></td></tr>'+
						'<tr><td>'+result.reply_of_reply[replyOfreply].content+'</td></tr></table><br>'+result.replies[i].content+'</td></tr></table><br>';
						replyOfreply++;
					} else {
						rows ='<table class="tborder" id="'+result.replies[i].id+'" cellpadding="6" cellspacing="1" border="1" width="100%" align="center"><thead><tr>'
						+'<td nowrap="nowrap">'+result.replies[i].timestamp+'</td><td width="100%" align="right"><button id="btnReply'+result.replies[i].id+'" type="button" class="btnReply btn btn-primary mr-2">Reply</button>#'+result.replies[i].id+'</td></tr></thead><tbody>'
						+'<tr><td>'+result.replies[i].username+'</td><td>'+
						result.replies[i].content+'</td></tr></table><br>';
					}
					$('div#thread').append(rows);
				}
			}
		})
	}
	$(document).on('click', '#btnSubmit', function(){
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
	$(document).on('click', '.btnReply', function(){
		console.log($(this).attr('id'));
		var id = $(this).attr('id');
		$.ajax({
			url: base_url+'/users/sessioncheck',
			type: 'POST',
			success: function(result) {
				if (result == 'success'){
					replyOfReply(id);
				}else{
					alert("Please login first!");
				}
			}
		});
	});
	function replyOfReply(id){
		var reply_id = id;
		reply_id = reply_id.substring(8);
		$('table#'+reply_id).after(`<br><form id="formReply" method="POST" action="" enctype="multipart/form-data" width="100%">
		<table class="tborder" cellpadding="6" cellspacing="1" border="1" width="100%">
			<thead>
				<tr>
					<td style="width:100%;">
						Post Reply
					</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						<div class="form-group">
							<input type="hidden" id="thread_id" name="thread_id" value="">
							<input type="hidden" id="reply_id" name="reply_id" value="`+reply_id+`">
							<input type="hidden" id="user_id" name="user_id" value="'.$user_id["id"].'">
							<label>Message:</label>
							<textarea class="form-control" rows="3" cols="60" id="content" name="content"></textarea>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
		<div class="row justify-content-center">
			<button id="btnSubmit" type="button" class="btn btn-primary mr-2">Submit</button>
		</div>
		</form>`);
	}
})