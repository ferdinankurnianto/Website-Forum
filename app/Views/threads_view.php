<!DOCTYPE html>
	<?php $user_id=session()->get('id');?>
	<script>var id='<?=$id?>';
	var user_id='<?php if(isset($user_id)) echo $user_id["id"]?>'</script>
	<script src="<?=base_url('threads_view.js')?>"></script>
		<div class="container" id="threads">
			<div class="row">
				<div class="col-12">
					<h2 id="title" class="mt-3">Thread List</h2>
					<a href="<?=base_url('forums/')?>">&lt;-Back to Forum List</a>
					<br>
					<?php
					if(isset($user_id)){
					echo '<div class="my-3">
						<button id="btnAdd" class="btn btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Thread</button>
					</div>';
					}
					?>
					<table class="tborder" cellpadding="6" cellspacing="1" border="1" width="100%" align="center">
					<thead>
						<tr align="center">
						  <td class="thead">&nbsp;</td>
						  <td class="thead" width="90%" align="left">
							Thread
							<a style="float:right;">Thread Starter</a>
						  </td>
						  <td class="thead" width="10%" align="right">
						  	Latest Reply
						  </td>
						</tr>
					</thead>
					<tbody>
					</tbody>
					</table>
					<br>
				</div>
			</div>
		</div>
	