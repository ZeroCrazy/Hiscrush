	  <?php require '../inc/core.php'; 
	  $ss_sql = mysql_query("SELECT * FROM users WHERE id='". Filter($_GET[id]) ."'");$s = mysql_fetch_assoc($ss_sql);
if($s['color']){
	$colorsv = $s['color'];
}

$R = mysql_query("SELECT COUNT(*) count FROM users_comments WHERE user_commented='$s[id]'");$R1 = mysql_fetch_assoc($R);

mysql_query("UPDATE users SET num_preguntas='$R1[count]' WHERE id='$s[id]'");

//if($s['verified'] == '1'){} else {
//	if($s['instagram_url']){
//		if($R1['count'] >= '30'){
//			// Verificar perfil automáticamente
//			mysql_query("UPDATE users SET verified='1' WHERE id='$s[id]'");
//		}	
//	}
//}
	  ?>
	<div class="card-panel" style="padding: 10px;background: <?php echo $colorsv; ?>;">
		<span class="white-text" style="font-size: 16px;"><center><?php echo UserLikes($s['id']); ?> crush</center></span>
    </div>
	<div class="card-panel" style="padding: 10px;background: <?php echo $colorsv; ?>;">
		<span class="white-text" style="font-size: 16px;"><center><?php echo $s['amount_visits']; ?> <?php echo $lang['profile_views']; ?><?php if($s['amount_visits'] >= 2){ echo 's'; } elseif($s['amount_visits'] <= 0){ echo 's'; } ?></center></span>
    </div>
	<div class="card-panel" style="box-shadow: none;padding: 10px;background: <?php echo $colorsv; ?>;">
		<span class="white-text" style="font-size: 16px;"><center><?php echo UserComments($s['id']); ?> <?php echo $lang['profile_questions']; ?></center></span>
    </div>
	<div class="card-panel" style="box-shadow: none;padding: 10px;background: <?php echo $colorsv; ?>;">
		<span class="white-text" style="font-size: 16px;"><center><?php echo UserCommentsLikes($s['id']); ?> <?php echo $lang['profile_likes']; ?></center></span>
    </div>
	  <div class="card" style="box-shadow: none;">
        <div class="card-content black-text">
          <span class="card-title" style="font-weight: 400;font-size: 20px;"><?php echo $lang['profile_about']; ?> <?php echo $s['full_name']; ?></span>
		  <?php if($s['biografia']){ ?><p style="color: grey;font-size: 14px;"><i style="font-size: 20px;" class="fal fa-book-open left"></i> <?php echo $s['biografia']; ?></p><?php } ?>
		  <p style="color: grey;font-size: 14px;"><i style="font-size: 20px;" class="fal fa-map-marker-alt left"></i> <?php echo getCountryFromIP($s['ip'],'name') ?></p>
		  <?php if($s['category_id']){ ?><a href="<?php echo $site; ?>/group/<?php echo $s['category_id']; ?>"><p style="color: grey;font-size: 14px;"><i style="font-size: 20px;" class="fal fa-stars left"></i> <?php echo NameCategory($s['category_id']); ?></p></a><?php } ?>
        </div>
      </div>