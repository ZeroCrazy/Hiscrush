<?php
	$page = 'Ajustes';
	require 'header.php';
	if(isset($_SESSION['id'])){} else { echo '<meta http-equiv="refresh" content="0;url='. $site .'" />'; }
	$Varu = mysql_query("SELECT * FROM users WHERE username='". Filter($_GET[username]) ."'");$a = mysql_fetch_assoc($Varu);
	echo '<title>'. $sitename .': Ajustes</title>';
?>
<div id="server-results"></div>
<style>.tabs .tab a:focus, .tabs .tab a:focus.active{background: transparent;}</style>
<br>
<div class="container">
  <div class="row">
  <div class="col s12 m12">
	<h3 class="header" style="font-weight: 100;font-size: 28px;color: <?php echo $colorsv; ?>;">Ajustes</h3>
  </div>
  
  <div class="col s12 m8">
  <div class="card">
    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width" style="border-top-left-radius: 4px;border-top-right-radius: 4px;">
        <li class="tab"><a class="active black-text" href="#cuenta"><i class="fal fa-user-circle iconito"></i> &nbsp; Perfil</a></li>
        <li class="tab"><a class="active black-text" href="#avatar"><i class="fal fa-camera-alt iconito"></i> &nbsp; Avatar</a></li>
        <li class="tab"><a class="active black-text" href="#privacidad"><i class="fal fa-shield-alt iconito"></i> &nbsp; Privacidad</a></li>
      </ul>
    </div>
    <div class="card-content grey lighten-4">
      <div id="cuenta">
	  <div class="row" style="margin: 0px;">
		<form id="perfil" method="POST" action="<?php echo $site; ?>/post.php?page=ajustesperfil" class="col s12">
		  <div class="row" style="margin: 0px;">
			<div class="input-field col s12 m6">
			  <input id="full_name" type="text" name="full_name" class="validate" value="<?php echo $user['full_name']; ?>">
			  <label for="full_name">Nombre completo</label>
			</div>
			<div class="input-field col s12 m6">
			  <select name="gender" required>
				<option value="" disabled>Escoge una opción</option>
				<option value="IDK" <?php if($user['gender'] == 'IDK'){ ?>selected<?php } ?>>Desconocido</option>
				<option value="H" <?php if($user['gender'] == 'H'){ ?>selected<?php } ?>>Hombre</option>
				<option value="M" <?php if($user['gender'] == 'M'){ ?>selected<?php } ?>>Mujer</option>
			  </select>
			  <label>Sexo</label>
			</div>
			<div class="input-field col s12 m12">
			  <input id="biografia" name="biografia" type="text" class="validate" value="<?php echo $user['biografia']; ?>">
			  <label for="biografia">Biografía</label>
			</div>
			<div class="input-field col s12 m12">
			  <input style="width: 100%;height: 40px;border: none;border-radius: 4px;" id="color" name="color" type="color" class="validate" value="<?php echo $user['color']; ?>">
			  <label for="color" style="margin-top: -3px;margin-left: 8px;color: #fff;text-shadow: 0px 0px 4px #000;">Color de tu perfil</label>
			</div>
			<div class="input-field col s12 m12">
				  <button class="btn waves-effect waves-light" style="width: 100%;background: <?php echo $colorsv; ?>;" type="submit">Guardar cambios
					<i class="material-icons right">send</i>
				  </button>
			</div>
		  </div>
		</form>
	  </div>
	  </div>
      <div id="avatar">
	  <div class="row" style="margin: 0px;">
		<div class="input-field col s12 m12">
			<iframe src="ajustes-avatar.php" style="width: 100%;border: none;height: 400px;"></iframe>
		</div>
	  </div>
	  </div>
      <div id="privacidad">
	  <div class="row" style="margin: 0px;">
		<form id="privacidad_ajustes" method="POST" action="<?php echo $site; ?>/post.php?page=ajustesprivacidad" class="col s12">
		  <div class="row" style="margin: 0px;">
			<div class="input-field col s12 m6">
			  <select name="show_last_online" required>
				<option value="" disabled>Escoge una opción</option>
				<option value="yes" <?php if($user['show_last_online'] == 'yes'){ ?>selected<?php } ?>>Mostrar</option>
				<option value="no" <?php if($user['show_last_online'] == 'no'){ ?>selected<?php } ?>>Ocultar</option>
			  </select>
			  <label>Última conexión</label>
			</div>
			<div class="input-field col s12 m6">
			  <select name="show_comment_profile" required>
				<option value="" disabled>Escoge una opción</option>
				<option value="yes" <?php if($user['show_comment_profile'] == 'yes'){ ?>selected<?php } ?>>Mostrar</option>
				<option value="no" <?php if($user['show_comment_profile'] == 'no'){ ?>selected<?php } ?>>Ocultar</option>
			  </select>
			  <label>Permitir nuevas preguntas</label>
			</div>
			<div class="input-field col s12 m12">
				  <button class="btn waves-effect waves-light" style="width: 100%;background: <?php echo $colorsv; ?>;" type="submit">Guardar cambios
					<i class="material-icons right">send</i>
				  </button>
			</div>
		  </div>
		</form>
	  </div>
	  </div>
    </div>
  </div>
  </div>
  
  <div class="col s12 m4">
  <div class="card">
    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width" style="border-top-left-radius: 4px;border-top-right-radius: 4px;">
        <li class="tab"><a class="active black-text" href="#instagram"><i class="fab fa-instagram iconito"></i></a></li>
        <li class="tab"><a class="active black-text" href="#facebook"><i class="fab fa-facebook iconito"></i></a></li>
        <li class="tab"><a class="active black-text" href="#twitter"><i class="fab fa-twitter iconito"></i></a></li>
      </ul>
    </div>
    <div class="card-content grey lighten-4">
      <div id="instagram">
	  <div class="row" style="margin: 0px;">		
		<?php if($user['instagram_url']){ 
		if(isset($_POST['desvincular_ig'])){
			mysql_query("UPDATE users SET instagram_url='', avatar='$user[last_avatar]', verified='' WHERE id='$user[id]'");
			echo "<script>M.toast({html: 'Instagram desvinculado', displayLength: '1500'});</script>";	
			echo '<meta http-equiv="refresh" content="0.5;url='. $site .'/ajustes" />';
		}
		?>
		<a class="btn waves-effect waves-light" disabled style="width: 100%;">@<?php echo $user['instagram_url']; ?></a>
		<br>
		<center><form method="POST" style="margin-top: 3px;">
			<button style="border: none;background: transparent;color: <?php echo $colorsv; ?>;" type="submit" name="desvincular_ig">Desvincular cuenta</button>
		</form></center>
		<?php } else { ?>
		<a class="btn waves-effect waves-light instagram" href="<?php echo $site; ?>/Instagram" style="width: 100%;">Vincular cuenta
			<i class="material-icons right">sync</i>
		</a>
		<?php } ?>
		
	  </div>
	  </div>
	  <div id="facebook">
	  <div class="row" style="margin: 0px;">
		<form id="up_fb" method="POST" action="<?php echo $site; ?>/post.php?page=update_facebook" class="col s12">
		  <div class="row" style="margin: 0px;">
			<div class="input-field col s12 m12">
			  <input id="facebook_url" name="facebook_url" type="url" class="validate" value="<?php echo $user['facebook_url']; ?>">
			  <label for="facebook_url">Facebook</label>
			</div>
			<div class="input-field col s12 m12">
				<button class="btn waves-effect waves-light" style="width: 100%;background: <?php echo $colorsv; ?>;" type="submit">Guardar cambios
					<i class="material-icons right">send</i>
				</button>
			</div>
		  </div>
		</form>
	  </div>
	  </div>
	  <div id="twitter">
	  <div class="row" style="margin: 0px;">
		<?php if($user['twitter_url']){ 
		if(isset($_POST['desvincular_tw'])){
			mysql_query("UPDATE users SET twitter_url='', verified='' WHERE id='$user[id]'");
			echo "<script>M.toast({html: 'Twitter desvinculado', displayLength: '1500'});</script>";	
			echo '<meta http-equiv="refresh" content="0.5;url='. $site .'/ajustes" />';
		}
		?>
		<a class="btn waves-effect waves-light" disabled style="width: 100%;">@<?php echo $user['twitter_url']; ?></a>
		<br>
		<center><form method="POST" style="margin-top: 3px;">
			<button style="border: none;background: transparent;color: <?php echo $colorsv; ?>;" type="submit" name="desvincular_tw">Desvincular cuenta</button>
		</form></center>
		<?php } else { ?>
		<a class="btn waves-effect waves-light twitter" href="<?php echo $site; ?>/Twitter" style="width: 100%;">Vincular cuenta
			<i class="material-icons right">sync</i>
		</a>
		<?php } ?>
	  </div>
	  </div>
    </div>
  </div>
  </div>
  </div>
</div>
<script type='text/javascript'>
$("#perfil").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		$("#server-results").html(response);
	});
});

$("#privacidad_ajustes").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		$("#server-results").html(response);
	});
});

$("#up_ig").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		$("#server-results").html(response);
	});
});

$("#up_tw").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		$("#server-results").html(response);
	});
});

$("#up_fb").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		$("#server-results").html(response);
	});
});
</script>
<?php
	require 'footer.php';
?>