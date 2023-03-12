<?php 
$page = 'Grupo';
require 'header.php'; 
$grupo = Filter($_GET['id']);
if($_GET['id']){ 
$ss_sql = mysql_query("SELECT * FROM categories WHERE id='". $grupo ."'");$s = mysql_fetch_assoc($ss_sql);
if($s['id']){} else { echo '<meta http-equiv="refresh" content="0;url='. $site .'" />'; }
if($s['color']){
	$colorsv = $s['color'];
}
?>
<style>
<?php if (in_array($s['color'], array("white", "#fff", "#ffffff"))){ ?>
body {
	text-shadow: 0px 0px 5px #000;
}
<?php } ?>
nav {
	background-color: <?php echo $colorsv; ?>;
}
.sub-header {
	background-color: <?php echo $colorsv; ?>;
}
.center-top {
	margin-top: -105px;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}
</style>
  <div class="sub-header">
  <div class="container">
	<div class="row">
		<div class="col s12 m12 center">
			<h3 style="margin-bottom: 5px;"><?php if($s['verified']){ ?><i style="font-size: 22px;" class="fal fa-badge-check tooltipped" data-position="top" data-tooltip="Verificado"></i><?php } ?> <?php echo $s['title']; ?></h3>
			<?php if($user['category_id'] == $s['id']){} else { ?>
			<?php if($s['privacity'] == 'open'){ ?><p style="margin: 0px;margin-top: 15px;"><form style="margin: 0px;" id="join_group" action="<?php echo $site; ?>/post.php?page=join_group" method="POST"><input type="hidden" name="group_id" value="<?php echo $s['id']; ?>"><button type="submit" style="background: rgba(0, 0, 0, 0.35);margin: 0px;box-shadow: 0 15px 30px 0 rgba(0,0,0,.11), 0 5px 15px 0 rgba(0,0,0,.08);border-radius: .25rem !important;" class="waves-effect waves-light btn" <?php if($s['privacity'] == 'closed'){ echo 'disabled'; } ?>>Unirme</button></form></p><?php } ?>
			<?php } ?>
			<!--br>
			<p style="margin: 0px;margin-top: 27px;margin-bottom: -27px;"><form onsubmit = "this.action += '/'+username.value.split(' ').join('-')+''" method="POST" action="<?php echo $site; ?>/search"><input class="search_local animated pulse infinite" autocomplete="off" id="username" value="<?php echo $usuario; ?>" name="username" placeholder="Buscar crush..." autofocus></form></p-->
		</div>
	</div>
  </div>
  </div>
<?php if($grupo){ ?>
<div id="server-results"></div>
<div class="container">
  <div class="row">
    <div class="col s12 m5">
      <div class="card" style="box-shadow: none;">
        <div class="card-content black-text">
          <span class="card-title center" style="font-size: 44px;color: #515151;">Miembros</span>
		  <span class="card-title center" style="font-weight: 400;font-size: 21px;color: <?php echo $colorsv; ?>;text-transform: uppercase;margin-top: -5px;">Aleatorios</span>
		  <span class="card-title center" style="font-weight: 200;font-size: 14px;color: #ababab;text-transform: none;margin-top: -15px;">En línea <?php echo statusGroup($s['id']); ?>/<?php echo membersGroup($s['id']); ?></span>
		  <div class="row">
		  <?php $c_sql = mysql_query("SELECT * FROM users WHERE category_id='$s[id]' ORDER BY RAND() LIMIT 20"); while($c = mysql_fetch_assoc($c_sql)){ ?>
		    <a href="<?php echo $site; ?>/~<?php echo $c['username']; ?>">
			<div class="input-field col s4 m3">
				<center><div style="width: 66px;height: 66px;background: url('<?php echo $site; ?>/<?php echo $c['avatar']; ?>') 50%;background-size: cover;border-radius: 50%;"></div></center>
				<center><div style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;text-align: center;color: <?php if($c['color']){ echo $c['color']; } else { echo $colorsv; } ?>;font-size: 14px;"><?php if($c['verified']){ ?><i class="fal fa-badge-check tooltipped" data-position="top" data-tooltip="Verificado"></i><?php } ?> <?php echo $c['username']; ?></div></center>
			</div>
			</a>
		  <?php } ?>
		  </div>
        </div>
      </div>
    </div>
    <div class="col s12 m7">
	  <div class="card" style="color: #fff;background: <?php echo $colorsv; ?>;">
        <div class="card-content">
		<?php if($user['category_id'] == $s['id']){ ?>
		    <form id="send_question_group" action="<?php echo $site; ?>/post.php?page=send_question_group" method="POST">
			<input type="hidden" name="group_id" value="<?php echo $s['id']; ?>">
			<div class="row" style="margin: 0px;">
			<div class="input-field col s12 m12" style="margin: 3px 0px;">
			    <p>
				  <label>
					<input name="anonymous" type="checkbox" />
					<span style="color: #fff;">Publicar anónimamente</span>
				  </label>
				</p>
			</div>
			<div class="input-field col s12 m12" style="margin: 5px 0px;">
				<input id="sendprofile" type="text" <?php if($user){ ?>value="<?php echo $user['username']; ?>"<?php } ?> name="username" placeholder="Nombre de usuario" class="materialize-textarea" style="text-align: center;color: #444;background: #fff;border-radius: 3px;border: none !important;box-shadow: none !important;" required>
			</div>
			<div class="input-field col s12 m12" style="margin: 0px;">
				<textarea id="sendmsg" name="content" placeholder="Pregunta a tu crush aquí. Hace cuánto tiempo, por qué, cosas así..." class="materialize-textarea" style="height: 100px;width: 100%;background: #fff;border-radius: 3px;padding: 10px 10px;border: none !important;box-shadow: none !important;" required autofocus></textarea>
			</div>
			<div class="input-field col s12 m12" style="margin: 0px;">
				<button class="waves-effect waves-light btn" type="submit" style="width: 100%;background: rgba(0, 0, 0, 0.50);">Enviar mensaje</button>
			</div>
			</div>
			</form>
	  <?php } else { ?>
		<i style="text-align: center;">Para enviar un mensaje o una pregunta, tienes que estar dentro de <?php echo $s['title']; ?></i>
	  <?php } ?>
        </div>
      </div>
	  <br>
	  <div id="commentsGroup"></div>
    </div>
  </div>
</div>
<script type='text/javascript'>
$("#send_question_group").submit(function(event){
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

$("#join_group").submit(function(event){
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

$(document).ready(function() {
$("#commentsGroup").load("<?php echo $site; ?>/ajax/comments-group.php?id=<?php echo Filter($s['id']); ?>");
var refreshId = setInterval(function() {
$("#commentsGroup").load('<?php echo $site; ?>/ajax/comments-group.php?id=<?php echo Filter($s['id']); ?>&randval='+ Math.random());
}, 1000);
$.ajaxSetup({ cache: false });
});
</script>
<?php } ?>
<?php } elseif($_GET['action'] == 'edit'){ 
$x_verify = mysql_query("SELECT * FROM categories WHERE admin_id='$user[id]' AND id='". Filter($_GET['edit_id']) ."' LIMIT 1");$x = mysql_fetch_assoc($x_verify);
if($x['id']){
} else {
	echo '<meta http-equiv="refresh" content="0;url='. $site .'/group" />';
}
?>
	<div id="server-results3"></div>
<div class="container">
      <h4 class="center"><?php echo $x['title']; ?></h4>
      <div class="row">
		<form id="editar_grupo" method="POST" action="<?php echo $site; ?>/post.php?page=edit_group" class="col s12">
		<input type="hidden" name="group_id" value="<?php echo Filter($_GET['edit_id']); ?>">
			<div class="row">
			  <div class="input-field col s12 m12">
			    <input id="title" type="text" name="title" value="<?php echo $x['title']; ?>" class="validate" required>
			    <label for="title">Nombre del grupo</label>
			  </div>
			  <div class="input-field col s12 m12">
				<select name="privacity" required>
				  <option value="" disabled>Escoge una opción</option>
				  <option value="open" <?php if($x['privacity'] == 'open'){ ?>selected<?php } ?>>Abierto</option>
				  <option value="closed" <?php if($x['privacity'] == 'closed'){ ?>selected<?php } ?>>Cerrado</option>
				</select>
				<label>Privacidad</label>
			  </div>
			  <div class="input-field col s12 m12">
			    <input style="width: 100%;height: 40px;border: none;border-radius: 4px;" id="color" name="color" type="color" class="validate" value="<?php echo $x['color']; ?>">
			    <label for="color" style="margin-top: -3px;margin-left: 8px;color: #fff;text-shadow: 0px 0px 4px #000;">Color principal del grupo</label>
			  </div>
			  <div class="input-field col s12 m2">
				<a href="<?php echo $site; ?>/group" class="btn waves-effect waves-light red" style="width: 100%;text-align: center;padding: 0px;">
					<i class="material-icons">close</i>
				</a>
			  </div>
			  <div class="input-field col s12 m10">
				<button class="btn waves-effect waves-light" type="submit" style="width: 100%;background: <?php echo $colorsv; ?>;">Editar
					<i class="material-icons right">send</i>
				</button>
			  </div>
			</div>
		</form>
	  </div>
</div>
<script>
$("#editar_grupo").submit(function(event){
	event.preventDefault();
	var post_url = $(this).attr("action");
	var request_method = $(this).attr("method");
	var form_data = $(this).serialize();
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){
		$("#server-results3").html(response);
	});
});
</script>
<?php } else { 
if(isset($_SESSION['id'])){} else { echo '<meta http-equiv="refresh" content="0;url='. $site .'" />'; }
?>
<style>
.card .card-content .card-title {
	overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
@media only screen and (max-width: 890px){
	.modal {
		width: 80% !important;
	}
}
</style>
<div id="server-results2"></div>
<div class="container">
  <div class="row">
	<div class="col s12 m3">
      <a class="modal-trigger tooltipped" data-position="right" data-tooltip="Nuevo grupo" href="#new_group">
	  <div class="card" style="box-shadow: none;background: #c5c5c5;margin-bottom: 0px;color: <?php echo $colorsv; ?>;">
        <div class="card-content">
          <span class="card-title center" style="margin: 12px;"><i style="font-size: 48px;" class="far fa-plus"></i></span>
        </div>
      </div>
	  </a>
    </div>
  <?php $c_sql = mysql_query("SELECT * FROM categories WHERE admin_id='$user[id]' ORDER BY id DESC"); while($c = mysql_fetch_assoc($c_sql)){ 
  if(isset($_POST['delete_'. $c[id] .''])){
	  $x_verify = mysql_query("SELECT * FROM categories WHERE admin_id='$user[id]' AND id='$c[id]' LIMIT 1");$x = mysql_fetch_assoc($x_verify);
	  if($x['id']){
		  mysql_query("DELETE FROM categories WHERE id='$c[id]' AND admin_id='$user[id]'");
		  echo '<meta http-equiv="refresh" content="0;url='. $site .'/group" />';	
	  }
  }
  ?>
    <div class="col s12 m3">
	  <div class="card" style="color: <?php echo $c['color']; ?>;">
        <div class="card-content">
          <span class="card-title center" style="margin: 0px;font-weight: 500;"><?php echo $c['title']; ?></span>
          <span class="card-title center" style="margin: 0px;font-size: 18px;"><?php echo MembersGroup($c['id']); ?> miembros</span>
		  <div class="row" style="margin: 0px;">
			<div class="col s12" style="margin: 0px;">
			  <div class="row" style="margin: 0px;margin-top: 5px;">
				<a style="color: <?php echo $c['color']; ?>;" href="<?php echo $site; ?>/group/<?php echo $c['id']; ?>">
				<div class="input-field col s4 m4" style="margin: 0px;text-align: center;">
				  <i class="fal fa-eye"></i>
				</div>
				</a>
				<a style="color: <?php echo $c['color']; ?>;" href="<?php echo $site; ?>/group/edit/<?php echo $c['id']; ?>">
				<div class="input-field col s4 m4" style="margin: 0px;text-align: center;">
				  <i class="fal fa-pencil"></i>
				</div>
				</a>
				<form method="POST">
				<div class="input-field col s4 m4" style="margin: 0px;text-align: center;">
				  <button type="submit" name="delete_<?php echo $c['id']; ?>" style="background: transparent;border: none;color: <?php echo $c['color']; ?>;"><i class="fal fa-trash"></i></button>
				</div>
				</form>
			  </div>
			</div>
		  </div>
        </div>
      </div>
    </div>
<script type='text/javascript'>
$("#odelete_group").submit(function(event){
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
  
  <div id="new_group" class="modal" style="width: 30%;">
    <div class="modal-content">
      <h4 class="center">Nuevo grupo</h4>
      <div class="row">
		<form id="add_new_group" method="POST" action="<?php echo $site; ?>/post.php?page=new_group" class="col s12">
			<div class="row">
			  <div class="input-field col s12 m12">
			    <input id="title" type="text" name="title" class="validate" required>
			    <label for="title">Nombre del grupo</label>
			  </div>
			  <div class="input-field col s12 m12">
			    <input style="width: 100%;height: 40px;border: none;border-radius: 4px;" id="color" name="color" type="color" class="validate" value="<?php echo $colorsv; ?>">
			    <label for="color" style="margin-top: -3px;margin-left: 8px;color: #fff;text-shadow: 0px 0px 4px #000;">Color principal del grupo</label>
			  </div>
			  <div class="input-field col s12 m2">
				<a href="#!" class="modal-close btn waves-effect waves-light red" style="width: 100%;">
					<i class="material-icons">close</i>
				</a>
			  </div>
			  <div class="input-field col s12 m10">
				<button class="btn waves-effect waves-light" type="submit" style="width: 100%;background: <?php echo $colorsv; ?>;">Crear
					<i class="material-icons right">send</i>
				</button>
			  </div>
			</div>
		</form>
	  </div>
    </div>
  </div>
</div>
<script type='text/javascript'>
$("#add_new_group").submit(function(event){
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

$("#editar_grupo").submit(function(event){
	event.preventDefault();
	var post_url = $(this).attr("action");
	var request_method = $(this).attr("method");
	var form_data = $(this).serialize();
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){
		$("#server-results3").html(response);
	});
});
</script>
<?php } ?>
<?php require 'footer.php'; ?>