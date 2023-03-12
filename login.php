<?php $page = 'Iniciar sesión';require 'header.php'; if(isset($_SESSION['id'])){ echo '<meta http-equiv="refresh" content="0;url='. $site .'" />'; }?>
<style>

</style>
<script>
function buscar_imagen() {
	var textoBusqueda = $("input#busquedaC").val();
 
	 if (textoBusqueda != "") {
		$.post("<?php echo $site; ?>/buscar_imagen.php", {valorBusqueda: textoBusqueda}, function(mensaje) {
			$("#resultadoBusquedaC").html(mensaje);
		 }); 
	 } else { 
		$("#resultadoBusquedaC").html('');
		};
};
</script>
<div id="server-results"></div>
<div class="container">
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="card" style="box-shadow: none;">
        <div class="card-content black-text">
          <div id="resultadoBusquedaC"></div>
		  <center><div class="imagenperfil" oncontextmenu="return false" onselectstart="return false" ondragstart="return false" style="z-index: 100;position: relative;background: url('../assets/images/avatar.png') <?php echo $colorsv; ?> 50%;width: 180px;height: 180px;background-size: cover !important;border-radius: 100%;border: 4px solid #fff;"></div></center>
		  <br>
		  <span class="card-title center" style="font-size: 44px;color: #515151;"><?php echo $lang['login_txt']; ?></span>
          <br>
		  <form id="login" action="<?php echo $site; ?>/post.php?page=login" method="POST">
		  <div class="row">
			<div class="input-field col s12 m12">
				<input id="busquedaC" onKeyUp="buscar_imagen();" autocomplete="off" placeholder="<?php echo $lang['login_username']; ?>" type="text" name="userormail" class="validate register" required autofocus>
			</div>
		    <div class="input-field col s12 m12">
				<input placeholder="<?php echo $lang['login_password']; ?>" type="password" name="password" class="validate register" required>
			</div>
			<div class="input-field col s12 m12">
				<button type="submit" class="waves-effect waves-light btn" style="width: 100%;background: <?php echo $colorsv; ?>;"><?php echo $lang['login_button']; ?></button>
				<br>
				<br>
				<center><a style="color: <?php echo $colorsv; ?>;" href="<?php echo $site; ?>/forgot"><?php echo $lang['login_fp']; ?></a></center>
			</div>
		  </div>
		  </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
$("#login").submit(function(event){
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
<?php require 'footer.php'; ?>