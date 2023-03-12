<?php $page = 'Registro';require 'header.php'; if(isset($_SESSION['id'])){ echo '<meta http-equiv="refresh" content="0;url='. $site .'" />'; } ?>
<div id="server-results"></div>
<div class="container">
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="card" style="box-shadow: none;">
        <div class="card-content black-text">
          <span class="card-title center" style="font-size: 44px;color: #515151;"><?php echo $lang['register_title']; ?></span>
          <span class="card-title center" style="font-weight: 400;font-size: 16px;color: <?php echo $colorsv; ?>;text-transform: uppercase;margin-bottom: -5px;"><?php echo $lang['register_slogan']; ?></span>
		  <form id="register" action="<?php echo $site; ?>/post.php?page=register" method="POST">
		  <div class="row">
		    <div class="input-field col s12 m12">
				<input placeholder="<?php echo $lang['register_mail']; ?>" type="email" name="mail" class="validate register" required autofocus>
			</div>
			<div class="input-field col s12 m12">
				<input placeholder="<?php echo $lang['register_fullname']; ?>" type="text" name="full_name" class="validate register" required>
			</div>
			<div class="input-field col s12 m12">
				<input placeholder="<?php echo $lang['register_username']; ?>" type="text" name="username" class="validate register" required>
			</div>
			<div class="input-field col s12 m12">
				<input placeholder="<?php echo $lang['register_password']; ?>" type="password" name="password" class="validate register" required>
			</div>
			<div class="input-field col s12 m12">
				<button type="submit" class="waves-effect waves-light btn" style="width: 100%;background: <?php echo $colorsv; ?>;"><?php echo $lang['register_button']; ?></button>
			</div>
		  </div>
		  </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
$("#register").submit(function(event){
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