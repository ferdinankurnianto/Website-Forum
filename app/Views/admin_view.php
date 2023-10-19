<?php
$username = session()->get('username');
?>
<div class="container container_fluid">
	<h1>Welcome <?=$username['username']?></h1>
	<p>This is the admin page for the ArshSV website.</p>
	<br>
</div>