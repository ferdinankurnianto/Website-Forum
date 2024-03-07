<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="<?=base_url('style.css')?>">
		<link href="<?=base_url('_library/fontawesome/css/all.css')?>" rel="stylesheet" type="text/css">
		<script>var base_url='<?=base_url()?>'</script>
		<script type="text/javascript" src="<?=base_url('script.js')?>"> </script>
	</head>
	<body>
		<header id="header">
			<div class="p-0 pb-4">
				<div class="header-img">
					<a href="<?=base_url('')?>">
					<img src="<?=base_url('img/headbanner.jpg')?>" style="width:100%;">
					</a>
				</div>
				<nav class="row navbar navbar-expand navbar-light pl-5 pr-5 mr-0" id="nav">
					<div class="topnav" id="topnav">
						<a class="nav-link" href="<?=base_url('')?>">Home</a>
						<a class="nav-link" href="<?=base_url('index/credit')?>">Credit</a>
						<a href="javascript:void(0);" class="icon" onclick="myFunction()">&#9776;</a>					
					</div>
					<div class="ml-auto" style="text-align:center;">
						<?php
						$logged_in = session()->get('logged_in');
						if($logged_in==true){
							$username = session()->get('username');
							$admin = session()->get('admin');
							echo '<a class="m-auto" style="color:#000000;" href="'.base_url('users/profile').'">'.$username['username'].'</a>
							<a href="'.base_url('users/logout').'" class="btn btn-primary">Log Out</a>';
						} else {
							echo '<a class="m-auto" style="color:#000000;" href="'.base_url('users/login').'">Login</a>
							<a class="m-auto" style="color:#000000;" href="'.base_url('users/register').'">Register</a>';
						}
						if(isset($admin)){
							if($admin['admin']=='1') 
								echo '<a class="m-auto" id="admin" style="color:#000000;"href="'.base_url('admin').'"><image src="'.base_url('img/admin.png').'">Admin</a>';
						}
						?>
						<image type="image" onclick="lightmode()" name="light-mode" src="<?=base_url('img/light.png')?>" alt="text" id="mode">  
					</div>
				</nav>
			</div>
		</header>