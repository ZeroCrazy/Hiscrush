<?php
	session_destroy();
	$_SESSION['loggedIn'] = 0;
	header("Location: index.php");
	exit();
?>