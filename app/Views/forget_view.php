<div class="container">
	<div class="row">
		<div class="offset-3 col-6">
			<h3 class="mt-4 text-center">Forget Password</h2>
			<br>
			<?php
			$success = session()->getFlashData('success');
			$errors = session()->getFlashData('errors');
			if(!empty($errors)){?>
				<div class="alert alert-danger" role="alert">
					<ul>
						<li><?php echo $errors; ?></li>
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
				<h5>Enter the Email of the account you forgot password of</h5>
				<input class="form-group col-12" type="email" name="email" value="" size="50" required />
				<div>
					<input type="submit" class="btn btn-primary" name="btnSubmit" value="Submit" />
				</div>
			</form>
		<br>
		</div>
	</div>
</div>