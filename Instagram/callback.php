<?php
	//require '../inc/config.php';
	require '../inc/core.php';
	
	session_start();
	
	if(isset($_GET['error'])){
		header("Location: index.php");
		exit();
	}
	
	require 'InstagramAPI.php';
	
	$data = $Instagram->getAccessTokenAndUserDetails($_GET['code']);
	echo '<pre>';
	var_dump($data);
	$_SESSION['loggedIn'] = 1;
	$_SESSION['accessToken'] = $data['access_token'];
	$_SESSION['instagramid'] = $data['user']['id'];
	$_SESSION['username'] = $data['user']['username'];
	$_SESSION['profile_picture'] = $data['user']['profile_picture'];
	$_SESSION['full_name'] = $data['user']['full_name'];
	
	if($_SESSION['id']){
		//mysql_query("UPDATE users SET instagram_url='$_SESSION[username]', avatar='$_SESSION[profile_picture]' WHERE id='$user[id]'");
		mysql_query("UPDATE users SET instagram_url='$_SESSION[username]' WHERE id='$user[id]'");
		
		/*if($_SESSION['username'] == $user['username']){
			mysql_query("UPDATE users SET verified='1' WHERE id='$user[id]'");
		}*/
		
		header("Location: home.php");
		exit();
	} else {
		header("Location: ". $site ."/login");
		exit();
	}
	
?>