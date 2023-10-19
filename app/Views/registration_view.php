	<div class="container">
		<div class="row">
			<div class="offset-3 col-6">
				<br>
				<h2 class="text-center">User Registration</h2>
				<?php
				$errors = session()->getFlashData('errors');
				$success = session()->getFlashData('success');
				$inputs = session()->getFlashData('inputs');
				if(!empty($errors)){?>
					<div class="alert alert-danger" role="alert">
						<ul>
						<?php foreach ($errors as $error) : ?>
							<li><?=esc($error)?></li>
						<?php endforeach; ?>
						</ul>
					</div>
					<?php
				}
				if(!empty($success)){?>
					<div class="alert alert-primary" role="alert">
						<?php echo $success; ?>
					</div>
				<?php } ?>
				
				<form id="formRegister" class="justify-content-center" method="post">
					<h5>Username</h5>
					<input class="form-group col-12" type="text" name="username" 
					value="<?php if(isset($inputs['username'])) echo $inputs['username'];?>" size="50" />
					<h5>Email Address</h5>
					<input class="form-group col-12" type="text" name="email" 
					value="<?php if(isset($inputs['email'])) echo $inputs['email'];?>" size="50"/>
					<h5>Password</h5>
					<input class="form-group col-12" type="password" name="password" 
					value="<?php if(isset($inputs['password'])) echo $inputs['password'];?>" size="50" />
					<h5>Password Confirm</h5>
					<input class="form-group col-12" type="password" name="password2" 
					value="<?php if(isset($inputs['password2'])) echo $inputs['password2'];?>" size="50" />
					<h5>Gender</h5>
					<span class="pr-4"><input class="form-group" type="radio" id="male" name="gender" value="Male"> Male</span>
					<input class="form-group" type="radio" id="female" name="gender" value="Female"> Female
					<h5>Birthdate</h5>
					<input class="form-group col-4" type="date" id="birthdate" name="birthdate">
					<div>
						<input type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" value="Submit"/>
						<input type="submit" class="btn btn-secondary" name="btnCancel" value="Cancel">
					</div>
				</form>
				<br>
			</div>
		</div>
	</div>