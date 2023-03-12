<?php
	require 'InstagramAPI.php';
	header("Location: ". $Instagram->getLoginURL() ."");
?>