<?php $page='Feedback';require 'header.php'; 
if(isset($_POST['send'])){
	$full_name = Filter($_POST['full_name']);
	$content = Filter($_POST['content']);
	
	if(empty($full_name) && empty($content)){
		echo "<script>M.toast({html: '". $lang['input_empty'] ."', displayLength: '4500'});</script>";
	} else {
		echo "<script>M.toast({html: 'Se ha enviado tu opinión correctamente, ¡gracias!', displayLength: '4500'});</script>";
		mysql_query("INSERT INTO opinions (full_name,content,date,ip) VALUES ('$full_name','$content','". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."','$ip')");
	}
}
?>
<div class="container">
  <div class="row">
    <div class="col s12 m8 offset-m2 l6 offset-l3">
      <div class="card" style="background: transparent;box-shadow: none;">
        <div class="card-content">
          <span class="card-title center">¡Nos gustaría saber tu opinión!</span>
		  <br>
  <div class="row">
    <form method="POST" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="full_name" type="text" name="full_name" class="validate" required autofocus>
          <label for="full_name">Nombre completo</label>
        </div>
		<div class="input-field col s12">
		  <textarea style="height: 150px;" name="content" placeholder="Escribe brevemente una opinión de <?php echo $sitename; ?> o que podría mejorar a mejor, ideas, etc..." id="textarea1" class="materialize-textarea" required></textarea>
          <label for="textarea1">Opinión</label>
        </div>
		<div class="input-field col s12">
		  <button type="submit" name="send" style="background: <?php echo $colorsv; ?>;width: 100%;" class="waves-effect waves-light btn">Enviar opinión</button>
        </div>
      </div>
    </form>
  </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>