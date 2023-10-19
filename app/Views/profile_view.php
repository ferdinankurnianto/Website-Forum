<?php
$usernames = session()->get('username');
?>
<script type="text/javascript" src="<?=base_url('profile_view.js')?>"> </script>
<div class="container">
	<h1><?php print($usernames['username'])?></h1>
	<br>
</div>
<div class="container" id="about">
	<h4>About <?php print($usernames['username'])?></h4>
	<ul id="username2"><b>Username <a href="#/" id="username"><i class="far fa-edit" aria-hidden="true"></i></a>:</b></ul>
	<ul><?=$username?></ul>
	<ul id="email2"><b>Email <a href="#/" id="email"><i class="far fa-edit" aria-hidden="true"></i></a>:</b></ul>
	<ul><?=$email?></ul>
	<ul id="gender2"><b>Gender <a href="#/" id="gender"><i class="far fa-edit" aria-hidden="true"></i></a>:</b></ul>
	<ul><?=$gender?></ul>
	<ul id="birthdate2"><b>Birthdate <a href="#/" id="birthdate"><i class="far fa-edit" aria-hidden="true"></i></a>:</b></ul>
	<ul><?=$birthdate?></ul>
	<div class="container">
		<a href="#/" class="btn btn-primary" id="changePassword">Change Password</a>
		<a href="<?=base_url('users/logout')?>" class="btn btn-primary">Log Out</a>
	</div>
	<br>
</div>