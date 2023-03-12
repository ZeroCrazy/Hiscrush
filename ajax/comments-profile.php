	  <?php require '../inc/core.php'; ?>
	  <link href="https://hiscrush.com/assets/css/all.min.css" rel="stylesheet"> 	  
	  <?php $Varuxx = mysql_query("SELECT * FROM users WHERE id='". Filter($_GET[id]) ."'");$x = mysql_fetch_assoc($Varuxx); ?>
	  <?php $cc = mysql_query("SELECT * FROM users_comments WHERE user_commented='". Filter($_GET[id]) ."' ORDER BY id DESC LIMIT 60"); while($c = mysql_fetch_assoc($cc)){ ?>
	  <?php $Varuxxc = mysql_query("SELECT * FROM users WHERE id='$c[user_id]'");$s = mysql_fetch_assoc($Varuxxc); ?>
	  <?php $Varuxxe = mysql_query("SELECT * FROM users_comments_likes WHERE user_id='$user[id]' AND comment_id='$c[id]'");$m = mysql_fetch_assoc($Varuxxe); ?>
					<?php
						if($s['verified'] == '1'){
							$usuariocom = '<i class="fal fa-badge-check"></i> ' . $c['username'];
						} else {
							$usuariocom = $c['username'];
						}
					?>
        <div class="card-panel" style="">
				<div>
				<div style="float: right;">
				<?php if($c['private'] == 'no'){ ?>
				<form style="float: right;" id="like_comment<?php echo $c['id']; ?>" action="<?php echo $site; ?>/post.php?page=like_comment" method="POST">
					<input type="hidden" name="comment_id" value="<?php echo $c['id']; ?>">
					<input type="hidden" name="user_id_liked" value="<?php echo $x['id']; ?>">
					<button style="background: transparent;border: none;cursor: pointer;font-size: 18px;color: <?php if($x['color']){ echo $x['color']; } else { echo $colorsv; } ?>;font-size: 18px;" type="submit"><i class="<?php if($m['id']){ ?>fas<?php } else { ?>fal<?php } ?> fa-heart"></i></button>
					<div style="float: right;color: <?php if($x['color']){ echo $x['color']; } else { echo $colorsv; } ?>;font-size: 16px;margin-top: -2px;"><?php echo CommentsLikes($c['id']); ?></div>
				</form>
<script>
$("#like_comment<?php echo $c['id']; ?>").submit(function(event){
	event.preventDefault();
	var post_url = $(this).attr("action");
	var request_method = $(this).attr("method");
	var form_data = $(this).serialize();
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){
		$("#server-results2").html(response);
	});
});
</script>
				<?php } ?>
				<?php if($x['id'] == $user['id']){ ?>
				<form style="float: right;" id="delete_comment<?php echo $c['id']; ?>" action="<?php echo $site; ?>/post.php?page=delete_comment" method="POST">
					<input type="hidden" name="user_id" value="<?php echo $s['id']; ?>">
					<input type="hidden" name="comment_id" value="<?php echo $c['id']; ?>">
					<button style="background: transparent;border: none;cursor: pointer;font-size: 18px;color: <?php if($x['color']){ echo $x['color']; } else { echo $colorsv; } ?>;font-size: 18px;" type="submit"><i class="fal fa-trash"></i></button>
				</form>
<script>
$("#delete_comment<?php echo $c['id']; ?>").submit(function(event){
	event.preventDefault();
	var post_url = $(this).attr("action");
	var request_method = $(this).attr("method");
	var form_data = $(this).serialize();
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){
		$("#server-results2").html(response);
	});
});
</script>
				<?php } ?>
				</div>
				<?php if($c['private'] == 'yes'){ ?>
					<?php if($user['id'] == $c['user_commented']){ ?>
					<!-- solo puede ver el comentario el perfil visitado -->
					<b style="color: red;">Comentario privado</b>
				<?php if($c['anonymous'] == 'yes'){} elseif($c['username'] == ''){} elseif($c['user_id']){ echo '<a style="color: #444;" href="'. $site .'/~'. $c[username] .'">'; } ?>
				<div class="header-msg" style="width: 100%;">
					<div style="float: left;background: url(<?php if($c['anonymous'] == 'yes'){ echo '../assets/images/avatar.png'; } else { if($s['avatar']){ echo $s['avatar']; } else { echo '../assets/images/avatar.png'; } } ?>) 50%;width: 50px;height: 50px;background-size: cover;border-radius: 100%;border: 4px solid #fff;"></div>
					<b><?php if($c['anonymous'] == 'yes'){ echo 'Anónimo'; } else { echo $usuariocom; } ?></b><br>
					<?php echo hace_cuanto($ahora, $c['date_reg']); ?>
				</div>
				<br>
				<div>
					<?php echo str_replace($mensajes_bloqueados, $mensajes_a_reemplazar, $c['content']); ?>
				</div>
				<?php if($c['anonymous'] == 'yes'){} else { echo '</a>'; } ?>
					<?php } else { ?>
					<i>Este comentario es privado</i>
					<?php } ?>
				<?php } else { ?>
				<?php if($c['anonymous'] == 'yes'){} elseif($c['username'] == ''){} elseif($c['user_id']){ echo '<a style="color: #444;" href="'. $site .'/~'. $c[username] .'">'; } ?>
				<div class="header-msg" style="width: 100%;">
					<div style="float: left;background: url(<?php if($c['anonymous'] == 'yes'){ echo '../assets/images/avatar.png'; } else { if($s['avatar']){ echo $s['avatar']; } else { echo '../assets/images/avatar.png'; } } ?>) 50%;width: 50px;height: 50px;background-size: cover;border-radius: 100%;border: 4px solid #fff;"></div>
					<b><?php if($c['anonymous'] == 'yes'){ echo 'Anónimo'; } else { echo $usuariocom; } ?></b><br>
					<?php echo hace_cuanto($ahora, $c['date_reg']); ?>
				</div>
				<br>
				<?php

				?>
				<div>
					<?php echo str_replace($mensajes_bloqueados, $mensajes_a_reemplazar, $c['content']); ?>
				</div>
				<?php if($c['anonymous'] == 'yes'){} else { echo '</a>'; } ?>
				<?php } ?>
				</div>
        </div>
	  <?php } ?>