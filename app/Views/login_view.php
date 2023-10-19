<div class="container">
		<div class="row">
			<div class="offset-4 col-4">
				<h3 class="mt-4">Login</h3>
				<?php
				$errors = session()->getFlashData('errors');
				if(!empty($errors)){?>
					<div class="alert alert-danger" role="alert">
						<ul>
							<li><?=esc($errors)?></li>
						</ul>
					</div><?php
				}
				?>
				<form method="POST" action="<?=base_url('/users/loginCheck');?>">
				<div class="form-group">
					<label>Email address</label>
					<input type="email" class="form-control" placeholder="Enter email" name="email">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" placeholder="Password" name="password">
				</div>
				<a href="<?=base_url('users/forget')?>">Forget Password</a>
				<div>
					<br>
					<input type="submit" class="btn btn-primary" value="Submit">
				</div>
				</form>
				<br>
			</div>
		</div>
	</div>