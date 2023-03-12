<?php require 'header.php'; 
	if (isset($_SESSION['admin'])) { header("Location: home.php"); }
?>
<div id="server-results"></div>
<br>
<div class="container">
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="card">
        <div class="card-content darkgrey-text">
          <span class="card-title center"><?php echo $sitename; ?></span>
		  <br><br>
                  <div class="row">
                    <form id="login" action="<?php echo $site; ?>/post.php?page=adminlogin" class="col s12" method="POST">
                        <div class="row">
                          <div class="input-field col s12 m6">
                            <input id="username" type="text" name="username" class="validate" required autofocus autocomplete="off">
                            <label for="username">Nombre de usuario</label>
                          </div>
						  
                          <div class="input-field col s12 m6">
                            <input id="password" type="password" name="password" class="validate" required>
                            <label for="password">Contraseña</label>
                          </div>
                          <div class="col s12 m8 offset-m2 l6 offset-l3">
                          <br>
                          <center>
                            <button type="submit" style="width: 100%;background: #6573cd;" class="btn btn-primary">
                                Iniciar sesión
                            </button>
                          </center>
                          </div>
                        </div>
                    </form>
                  </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
$("#login").submit(function(event){
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