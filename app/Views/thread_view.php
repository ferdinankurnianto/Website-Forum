<!DOCTYPE html>
	<script>var id='<?=$id?>'</script>
	<script src="<?=base_url('thread_view.js')?>"></script>
	<?php $user_id = session()->get('id');?>
		<div class="container">
			<h2 class="mt-4">Thread</h2>
			<a href="<?=base_url('forums/index/'.$forum_id)?>">&lt;-Back to Thread List</a>
			<br>
			<div class="row">
				<div class="col-12" id="thread">
				<br>
					
				</div>
			</div>
		</div>
		<br>
		<?php if(isset($user_id)){
		echo '<div class="container">
		<br>
		<form id="formReply" method="POST" action="" enctype="multipart/form-data">
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
		</form>
		</div>';
		}
		?>
	