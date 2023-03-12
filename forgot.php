<?php
	$page = 'Recuperar contraseña';
	require 'header.php';
	if(isset($_SESSION['id'])){ echo '<meta http-equiv="refresh" content="0;url='. $site .'" />'; }
?>
<div id="server-results"></div>
<?php if($_GET['token']){ $ss_sql = mysql_query("SELECT * FROM users WHERE password_reset_token='". Filter($_GET[token]) ."'");$s = mysql_fetch_assoc($ss_sql); ?>
<?php if($s['id']){ ?>
<div class="container">
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="card" style="box-shadow: none;">
        <div class="card-content black-text">
		  <span class="card-title center" style="font-size: 44px;color: #515151;">Recuperar contraseña</span>
		  <br>
		  <p style="text-align: center;">Hola <?php echo $s['username']; ?>! Introduce a continuación la nueva contraseña para tu cuenta. Una vez presionado el botón de finalizar, podrás acceder correctamente con la nueva contraseña.</p>
          <br>
		  <form id="forgotPassword" action="<?php echo $site; ?>/post.php?page=recovery_password_confirmation" method="POST">
		  <div class="row">
			<div class="input-field col s12 m12">
				<input type="hidden" name="confirmation_token" value="<?php echo $s['password_reset_token']; ?>" required>
				<input id="campo" autocomplete="off" placeholder="Nueva contraseña" type="password" name="password" class="validate register" required autofocus>
			</div>
			<div class="input-field col s12 m12">
				<button type="submit" class="waves-effect waves-light btn" style="width: 100%;background: <?php echo $colorsv; ?>;">Recuperar contraseña</button>
			</div>
		  </div>
		  </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
$("#forgotPassword").submit(function(event){
	event.preventDefault();
	var post_url = $(this).attr("action");
	var request_method = $(this).attr("method");
	var form_data = $(this).serialize();
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){
		$("#server-results").html(response);
	});
});
</script>
<?php } else { echo '?'; } ?>
<?php } else { ?>
<div class="container">
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="card" style="box-shadow: none;">
        <div class="card-content black-text">
		  <span class="card-title center" style="font-size: 44px;color: #515151;">Recuperar contraseña</span>
		  <br>
		  <p style="text-align: center;">Introduce tu nombre de usuario y te enviaremos un enlace para que recuperes el acceso a tu cuenta.</p>
          <br>
		  <form id="forgotPassword" action="<?php echo $site; ?>/post.php?page=recovery_password" method="POST">
		  <div class="row">
			<div class="input-field col s12 m12">
				<input id="campo" autocomplete="off" placeholder="Nombre de usuario" type="text" name="username" class="validate register" required autofocus>
			</div>
			<div class="input-field col s12 m12">
				<button type="submit" class="waves-effect waves-light btn" style="width: 100%;background: <?php echo $colorsv; ?>;">Enviar enlace de acceso</button>
			</div>
		  </div>
		  </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
$("#forgotPassword").submit(function(event){
	event.preventDefault();
	var post_url = $(this).attr("action");
	var request_method = $(this).attr("method");
	var form_data = $(this).serialize();
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){
		$("#server-results").html(response);
	});
});
</script>
<?php } ?>
<?php require 'footer.php'; ?>