<div class="container">
	<div class="row">
		<div class="offset-3 col-6">
			<h3 class="mt-4 text-center">Change Password</h2>
			<br>
			<?php
			$success = session()->getFlashData('success');
			$errors = session()->getFlashData('errors');
			if(!empty($errors)){?>
				<div class="alert alert-danger" role="alert">
					<ul>
						<?php 
						if (is_array($errors) || is_object($errors))
						{
							foreach ($errors as $error)
							{?>
								<li><?=esc($error)?></li>
							<?php }
						} else ?><li><?=esc($errors)?></li>
					</ul>
				</div>
				<?php
			}
			if(!empty($success)){?>
				<div class="alert alert-primary" role="alert">
					<?php echo $success; ?>
				</div>
			<?php } ?>
			<form class="justify-content-center" method="post">
				<h5>New Password</h5>
				<input class="form-group col-12" type="password" name="password" 
				value="<?php if(isset($inputs['password'])) echo $inputs['password'];?>" size="50" />
				<h5>Confirm New Password</h5>
				<input class="form-group col-12" type="password" name="password2" 
				value="<?php if(isset($inputs['password'])) echo $inputs['password'];?>" size="50" />
				<div>
					<input type="submit" class="btn btn-primary" name="btnSubmit" value="Submit" />
				</div>
			</form>
		<br>
		</div>
	</div>
</div>