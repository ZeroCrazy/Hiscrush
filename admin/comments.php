<?php require 'header.php'; 
	if (isset($_SESSION['admin'])) {} else { header("Location: login.php"); }
	$ss_sql = mysql_query("SELECT * FROM users WHERE id='". Filter($_GET[id]) ."'");$s = mysql_fetch_assoc($ss_sql);
?>
<?php if($_GET['id']){ ?>
<?php
	if(isset($_POST['search'])){
		$search = $_POST['search'];
		echo '<meta http-equiv="refresh" content="0;url='. $site . $folder_admin .'/comments.php?id='. $s[id] .'#comment'. $search .'" />';	
		
	}
?>
<div class="container">
  <div class="row">	
	<div class="col s12 m12">
<div class="row" style="margin-bottom: 0px;">
  <div class="input-field col s12 m6" style="margin: 0px;">
    <a href="<?php echo $site . $folder_admin; ?>/users.php?id=<?php echo $s['id']; ?>">
    <div class="card-panel" style="margin-bottom: 0px;padding: 10px;background: <?php echo $colorsv; ?>;">
    	<span class="white-text" style="font-size: 16px;"><center><?php echo $s['username']; ?></center></span>
    </div>
	</a>
  </div>
  <div class="input-field col s12 m6" style="margin: 0px;">
    <div class="card-panel" style="margin-bottom: 0px;padding: 10px;background: <?php echo $colorsv; ?>;">
    	<form method="POST"><input placeholder="Buscar ID..." style="text-align: center;height: 23px;margin: 0px;" type="search" name="search" autocomplete="off" id="search"></form>
    </div>
  </div>
</div>
<?php $c_sql = mysql_query("SELECT * FROM users_comments WHERE user_commented='$s[id]' ORDER BY id DESC"); while($c = mysql_fetch_assoc($c_sql)){ 
$Varuxxc = mysql_query("SELECT * FROM users WHERE id='$c[user_id]'");$x = mysql_fetch_assoc($Varuxxc);
if($x['verified'] == '1'){
	$usuariocom = '<i class="fal fa-badge-check"></i> ' . $c['username'];
} else {
	$usuariocom = $c['username'];
}
if(isset($_POST['delete_'. $c[id] .''])){
	mysql_query("DELETE FROM users_comments WHERE id='$c[id]'");
	mysql_query("DELETE FROM users_comments_likes WHERE comment_id='$c[id]'");
	header("Location: ". $site . $folder_admin ."/comments.php?id=$s[id]");
	echo '<meta http-equiv="refresh" content="0;url='. $site . $folder_admin .'/comments.php?id='. $s[id] .'" />';	
}
?>
      <div class="card">
        <div class="card-content black-text">
		<div id="comment<?php echo $c['id']; ?>">
		<div style="float: right;">
				<div style="float: right;">
					<i style="background: transparent;border: none;font-size: 18px;color: <?php echo $colorsv; ?>;margin-right: 3px;" class="fal fa-heart"></i>
					<div style="float: right;color: <?php echo $colorsv; ?>;font-size: 16px;margin-top: -2px;"><?php echo CommentsLikes($c['id']); ?></div>
				</div>
				<form style="float: right;" method="POST">
					<button style="margin-top: -2px;background: transparent;border: none;cursor: pointer;font-size: 18px;color: <?php echo $colorsv; ?>;margin-right: 3px;" type="submit" name="delete_<?php echo $c['id']; ?>"><i class="fal fa-trash"></i></button>
				</form>
		</div>
<div class="header-msg" style="width: 100%;">
	<div style="float: left;background: url(<?php if($c['anonymous'] == 'yes'){ echo '../assets/images/avatar.png'; } elseif($c['username'] == ''){ echo '../assets/images/avatar.png'; } else { echo getAvatar($x['id']); } ?>) 50%;width: 50px;height: 50px;background-size: cover;border-radius: 100%;border: 4px solid #fff;"></div>
	<b><?php if($c['anonymous'] == 'yes'){ echo 'Anónimo ('. $c['ip'] .')'; } elseif($c['username'] == ''){ echo 'Anónimo ('. $c['ip'] .')'; } else { echo $usuariocom; } ?></b><br>
	<?php echo hace_cuanto($ahora, $c['date_reg']); ?>
</div>
<br>
<div>
	<?php echo $c['content']; ?>
</div>
        </div>
        </div>
      </div>
<?php } ?>
    </div>
  </div>
</div>
<?php } else { //header("Location: ". $site . $folder_admin .""); 
} ?>