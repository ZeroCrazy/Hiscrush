<?php
	
	session_start();
	if(!isset($_SESSION['loggedIn'])){
		header("Location: http://127.0.0.1/");
		exit();
	}
	require '../inc/core.php';
	if($_SESSION['id']){
	header("Location: ". $site ."/ajustes");
	$user = array(
		'username' => $_SESSION['username'],
		'full_name' => $_SESSION['full_name'],
		'avatar' => $_SESSION['profile_picture']
	);
?>
<center>
<b><?php echo $user['username']; ?></b><br><br>
<img src="<?php echo $user['avatar']; ?>" style="border-radius: 50%;">
</center>
	<?php } else { header("Location: ". $site ."/login"); } ?>