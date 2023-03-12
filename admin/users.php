<?php require 'header.php'; 
	if (isset($_SESSION['admin'])) {} else { header("Location: login.php"); }
	$ss_sql = mysql_query("SELECT * FROM users WHERE id='". Filter($_GET[id]) ."'");$s = mysql_fetch_assoc($ss_sql);
?>
<?php if($_GET['id']){ ?>
<?php
	if(isset($_POST['save'])){
		$full_name = Filter($_POST['full_name']);
		$verified = Filter($_POST['verified']);
		$facebook_url = Filter($_POST['facebook_url']);
		$twitter_url = Filter($_POST['twitter_url']);
		$instagram_url = Filter($_POST['instagram_url']);
		$color = Filter($_POST['color']);
		
		if(empty($full_name) && empty($verified) && empty($color)){
			echo "<script>M.toast({html: 'Rellena los campos', displayLength: '4000'});</script>";
		} else {
			echo "<script>M.toast({html: 'Cambios efectuados correctamente', displayLength: '4000'});</script>";
			mysql_query("UPDATE users SET full_name='$full_name', verified='$verified', facebook_url='$facebook_url', twitter_url='$twitter_url', instagram_url='$instagram_url', color='$color' WHERE id='$s[id]'");
		}
	}
?>
<div class="container">
  <div class="row">
    <!--div class="col s12 m3">
      <div class="card">
        <div class="card-content black-text">
          <span class="card-title center"><?php echo $s['username']; ?></span>
		  <br>
		  <img style="border-radius: 3px;width: 100%;" src="<?php echo $site; ?>/<?php echo $s['avatar']; ?>">
        </div>
      </div>
    </div-->
	
	<div class="col s12 m12">
<div class="row" style="margin-bottom: 0px;">
  <div class="input-field col s12 m3" style="margin: 0px;">
    <div class="card-panel" style="margin-bottom: 0px;padding: 10px;background: <?php echo $colorsv; ?>;">
    	<span class="white-text" style="font-size: 16px;"><center><?php echo UserLikes($s['id']); ?> crush</center></span>
    </div>
  </div>
  <div class="input-field col s12 m3" style="margin: 0px;">
    <div class="card-panel" style="margin-bottom: 0px;padding: 10px;background: <?php echo $colorsv; ?>;">
    	<span class="white-text" style="font-size: 16px;"><center><?php echo $s['amount_visits']; ?> stalker<?php if($s['amount_visits'] >= 2){ echo 's'; } elseif($s['amount_visits'] <= 0){ echo 's'; } ?></center></span>
    </div>
  </div>
  <div class="input-field col s12 m3" style="margin: 0px;">
    <a href="<?php echo $site . $folder_admin; ?>/comments.php?id=<?php echo $s['id']; ?>">
	<div class="card-panel" style="margin-bottom: 0px;padding: 10px;background: <?php echo $colorsv; ?>;">
    	<span class="white-text" style="font-size: 16px;"><center><?php echo UserComments($s['id']); ?> preguntas</center></span>
    </div>
	</a>
  </div>
  <div class="input-field col s12 m3" style="margin: 0px;">
    <div class="card-panel" style="margin-bottom: 0px;padding: 10px;background: <?php echo $colorsv; ?>;">
    	<span class="white-text" style="font-size: 16px;"><center><?php echo UserCommentsLikes($s['id']); ?> likes</center></span>
    </div>
  </div>
</div>
      <div class="card">
        <div class="card-content black-text">
  <div class="row">
    <form method="POST" class="col s12">
      <div class="row">
        <div class="input-field col s12 m6">
          <input id="full_name" type="text" class="validate" required name="full_name" value="<?php echo $s['full_name']; ?>">
          <label for="full_name">Nombre completo</label>
        </div>
		<div class="input-field col s12 m6">
          <input id="mail" type="text" class="validate" disabled value="<?php echo $s['mail']; ?>">
          <label for="mail">Correo electrónico</label>
        </div>
		<div class="input-field col s12 m6">
          <input id="ip" type="text" class="validate" disabled value="<?php echo $s['ip']; ?>">
          <label for="ip">Dirección IP</label>
        </div>
		<div class="input-field col s12 m6">
          <select class="browser-default" name="verified" required>
			<?php if($s['verified'] == '1'){ ?>
			<option value="<?php echo $s['verified']; ?>" selected>Verificado</option>
			<option value="">Sin verificar</option>
			<?php } else { ?>
			<option value="1">Verificar</option>
			<option value="" selected>Sin verificar</option>
			<?php } ?>
		  </select>
        </div>
        <div class="input-field col s12 m12"></div>
		<div class="input-field col s12 m4">
          <input id="facebook_url" type="url" class="validate" name="facebook_url" value="<?php echo $s['facebook_url']; ?>">
          <label for="facebook_url">Facebook</label>
        </div>
		<div class="input-field col s12 m4">
          <input id="instagram_url" type="text" class="validate" name="instagram_url" value="<?php echo $s['instagram_url']; ?>">
          <label for="instagram_url">Instagram</label>
        </div>
		<div class="input-field col s12 m4">
          <input id="twitter_url" type="text" class="validate" name="twitter_url" value="<?php echo $s['twitter_url']; ?>">
          <label for="twitter_url">Twitter</label>
        </div>
		<div class="input-field col s12 m6">
          <input id="last_on" type="text" class="validate" value="<?php echo $s['last_on']; ?>" disabled>
          <label for="last_on">Última conexión</label>
        </div>
		<div class="input-field col s12 m6">
          <input id="reg_date" type="text" class="validate" value="<?php echo $s['reg_date']; ?>" disabled>
          <label for="reg_date">Fecha de registro</label>
        </div>
		<div class="input-field col s12 m12">
          <input style="width: 100%;height: 40px;border: none;border-radius: 4px;" id="color" name="color" type="color" class="validate" value="<?php echo $s['color']; ?>">
          <label for="color" style="margin-top: -3px;margin-left: 8px;color: #fff;text-shadow: 0px 0px 4px #000;">Color de su perfil</label>
        </div>
		<div class="input-field col s12 m12">
		  <button name="save" class="btn waves-effect waves-light" style="width: 100%;background: <?php echo $colorsv; ?>;" type="submit">Guardar cambios
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
</div>
<?php } else { ?>
<div class="container">
  <div class="row">
    <div class="col s12 m12">
    <div class="nav-wrapper">
      <form>
        <div class="input-field">
		  <input autocomplete="off" type="search" id="input_search" onkeyup="search()" placeholder="Buscar usuario..." style="width: 100%;background: #fff;padding: 10px 0px;text-align: center;color: #444;" autofocus>
          <label class="label-icon" for="search"><i style="margin-top: 10px;" class="material-icons">search</i></label>
        </div>
      </form>
    </div>
    </div>
    <div class="col s12 m12">
    <div class="row">
      <div class="col s12 m12">
        <div class="card">
          <div class="card-content black-text">
			<table class="striped centered responsive-table" id="table_search">
			  <thead>
			  <tr>
				  <th>Usuario</th>
				  <th>Correo</th>
				  <th>Últ. conexión</th>
				  <th>Opciones</th>
			  </tr>
			  </thead>
			  <tbody>
				<?php $p_sql = mysql_query("SELECT * FROM users ORDER BY id DESC"); while($p = mysql_fetch_assoc($p_sql)){ ?>
				<tr>
						<td><?php echo $p['username']; ?></td>
						<td><?php echo $p['mail']; ?></td>
						<td><?php echo hace_cuanto($ahora, $p['last_on']); ?></td>
						<td>
						<a href="<?php echo $site . $folder_admin; ?>/comments.php?id=<?php echo $p['id']; ?>" style="background: <?php echo $colorsv; ?>;width: auto;padding: 0px 7px;border: none;margin-right: 3px;" class="waves-effect waves-light btn"><i class="material-icons">comment</i></a>
						<a target="_blank" href="<?php echo $site; ?>/~<?php echo $p['username']; ?>" style="background: <?php echo $colorsv; ?>;width: auto;padding: 0px 7px;border: none;margin-right: 3px;" class="waves-effect waves-light btn"><i class="material-icons">open_in_new</i></a>
						<a href="<?php echo $site . $folder_admin; ?>/users.php?id=<?php echo $p['id']; ?>" style="width: auto;padding: 0px 7px;border: none;margin-right: 3px;" class="waves-effect waves-light btn #7cb342 light-green darken-1"><i class="material-icons">create</i></a>
						<a disabled href="<?php $site; ?>/products/delete/<?php echo $p['id']; ?>" style="width: auto;padding: 0px 7px;border: none;margin-right: 3px;" class="waves-effect waves-light btn #b71c1c red darken-4"><i class="material-icons">delete</i></a></td>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
          </div>
        </div>
      </div>
    </div>
	</div>
	</div>
</div>
<?php } ?>