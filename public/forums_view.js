$(this).ready(function(){
	getForums();
	
	function getForums(){
		$.ajax(
		{
			url:base_url+'/forums/getForums', 
			method:'POST',
			dataType:'JSON',
			success:function(result){
				var rows='';
				var length=Object.keys(result.forums).length;
				for (let i = 0; i < length; i++) {
					rows += '<tr align="center"><td>'+result.forums[i].id+'</td>'+
					'<td align="left"><div><a href="'+base_url+'/forums/index/'+result.forums[i].id+'"><strong>'+
					result.forums[i].forum_title+'</strong></a></div><div class="smallfont">'+
					result.forums[i].subtitle+'</div></td><td align="right"><div><a href="'+base_url+'/threads/index/'+result.forums[i].id+'/';
					if(result.threads[i]){
						rows+=result.threads[i].id+'"><strong>'+
						result.threads[i].title+'</strong></a></div><div class="smallfont">'+result.threads[i].timestamp+'</div></td></tr>';
					}
				}
				$('tbody').html(rows);
			}
		})
	}
})