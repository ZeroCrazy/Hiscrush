<?php 
$page = $_GET['username'];
require 'header.php'; 
$usuario = Filter($_GET['username']);
$ss_sql = mysql_query("SELECT * FROM users WHERE username='". $usuario ."'");$s = mysql_fetch_assoc($ss_sql);
if($s['id']){} else { echo '<meta http-equiv="refresh" content="0;url='. $site .'" />'; }
if(isset($_SESSION['id'])){
	if($s['username'] == $user['username']){
		mysql_query("UPDATE users SET new_messages='no' WHERE id='$user[id]'");
	} else {
		mysql_query("UPDATE users SET amount_visits=amount_visits+1 WHERE id='$s[id]'");
		if($s['username'] == 'BOT'){} else { mysql_query("UPDATE users SET amount_visits=amount_visits+1 WHERE id='129'"); }
	}
	
$Varuxxe = mysql_query("SELECT * FROM users_likes WHERE user_id='$user[id]' AND user_liked='$s[id]'");$l = mysql_fetch_assoc($Varuxxe);
}
if($s['color']){
	$colorsv = $s['color'];
}
$R = mysql_query("SELECT COUNT(*) count FROM users_likes WHERE user_liked='$s[id]'");$R1 = mysql_fetch_assoc($R);
$X = mysql_query("SELECT COUNT(*) count FROM users_comments_likes WHERE user_id_liked='$s[id]'");$X1 = mysql_fetch_assoc($X);
?>
<meta name="theme-color" content="<?php echo $colorsv; ?>">
<meta name="keywords" content="preguntas,anónimo,anonimato,anonimamente,questions,anon,anonymously,crush,mi crush,es mi crush,visitas,visits,views,likes,like,megusta,me gusta,megustas,me gustas,gratis,follow,follows,seguir,seguidores,siguiendo">
<meta name="description" content="<?php if($s['biografia']){ echo $s['biografia']; } else { echo 'Ponte en contacto con ' . $s['full_name'] . ' (@'. $s['username'] .') — ' . $R1['count'] . ' crushes, '. $s['num_preguntas'] .' preguntas, '. $s['amount_visits'] .' visitas, '. $X1['count'] .' Me gusta. Pregunta todo lo que quieras saber sobre '. $s['full_name'] .' obteniendo respuestas en '. $sitename .'.'; } ?>">
<meta property="og:site_name" content="<?php echo $sitename; ?>" />
<meta property="og:type" content="profile" />
<meta property="og:title" content="<?php echo $s['full_name']; ?> (@<?php echo $s['username']; ?>). Pregúntame algo en <?php echo $sitename; ?>" />
<meta property="og:description" content="<?php if($s['biografia']){ echo $s['biografia']; } else { echo 'Ponte en contacto con ' . $s['full_name'] . ' (@'. $s['username'] .') — ' . $R1['count'] . ' crushes, '. $s['num_preguntas'] .' preguntas, '. $s['amount_visits'] .' visitas, '. $X1['count'] .' Me gusta. Pregunta todo lo que quieras saber sobre '. $s['full_name'] .' obteniendo respuestas en '. $sitename .'.'; } ?>" />
<meta property="og:url" content="<?php echo $site; ?>/~<?php echo $s['username']; ?>" />
<meta property="og:image" content="<?php echo $site; ?>/<?php echo getAvatar($s['id']); ?>" />
<meta property="twitter:image" content="<?php echo $site; ?>/<?php echo getAvatar($s['id']); ?>" />
<link rel="canonical" href="<?php echo $site; ?>/~<?php echo $s['username']; ?>" />
<link rel="image_src" href="<?php echo $site; ?>/<?php echo getAvatar($s['id']); ?>" />
<div id="server-results"></div>
<div id="server-results2"></div>
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
	padding: 22px 0px 113px 0px !important;
}
.center-top {
	margin-top: -115px;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
}
@media only screen and (max-width: 890px){
	.modal {
		width: 80% !important;
	}
}
</style>
  <div class="sub-header">
  <div class="container">
	<div class="row">
		<div class="col s12 m12 center">
			<h3 style="margin-bottom: 5px;"><?php if($s['verified']){ ?><i style="font-size: 22px;" class="fal fa-badge-check tooltipped" data-position="top" data-tooltip="<?php echo $lang['verified']; ?>"></i><?php } ?> <?php echo GetUserRank($s['id']); ?> <?php echo $s['username']; ?></h3>
			<!--p style="margin: 0px;margin-top: 5px;"><?php echo $s['biografia']; ?></p-->
		</div>
	</div>
  </div>
  </div>
<input type="text" style="position: absolute;z-index: -100;width: 1px;height: 1px;" id="copyTarget" value="<?php echo $site; ?>/~<?php echo $s['username']; ?>">
  <div class="center-top"><center>
  <div id="statusProfile"></div>
  <button class="btn-floating btn-large waves-effect waves-light" id="copyButton" style="background: <?php echo $colorsv; ?>;box-shadow: none;margin-top: 75px;position: absolute;margin-left: -128px;z-index: 120;"><i class="fal fa-share-alt"></i></button>
  <?php if($s['id'] == $user['id']){ ?><?php } else { ?>
  <a href="#report" class="btn-floating btn-large waves-effect waves-light #fbc02d yellow darken-2 modal-trigger" style="box-shadow: none;z-index: 90;margin-top: 75px;padding-left: 10px;position: absolute;margin-left: 79px;"><i class="fal fa-exclamation"></i></a><?php } ?>
  <div id="report" class="modal" style="width: 30%;">
    <div class="modal-content">
      <h4>Denunciar a <?php echo $s['username']; ?></h4>
      <div class="row">
		<?php if(isset($_SESSION['id'])){ ?>
		<form id="send_report" action="<?php echo $site; ?>/post.php?page=send_report" method="POST" class="col s12">
			<div class="row">
				<div class="input-field col s12 m12">
				<input type="hidden" name="user_id_reported" value="<?php echo $s['id']; ?>">
					<select name="reason" required>
					  <option value="" disabled selected>Selecciona una opción</option>
					  <option value="Foto ofensiva">Foto ofensiva</option>
					  <option value="Contenido inapropiado">Contenido inapropiado</option>
					  <option value="Suplantación de identidad">Suplantación de identidad</option>
					</select>
					<label>Motivo</label>
				</div>
				<div class="input-field col s12 m12">
					<textarea id="content" name="content" class="materialize-textarea" required></textarea>
					<label for="content">Descripción</label>
				</div>
				  <div class="input-field col s12 m2">
					<a href="#!" class="modal-close btn waves-effect waves-light red" style="width: 100%;">
						<i class="material-icons">close</i>
					</a>
				  </div>
				  <div class="input-field col s12 m10">
					<button class="btn waves-effect waves-light" type="submit" style="width: 100%;background: <?php echo $colorsv; ?>;">Enviar
						<i class="material-icons right">send</i>
					</button>
				  </div>
			</div>
		</form>
		<?php } else { ?>
		<p>Hola visitante! Debes iniciar sesión para poder reportar a <?php echo $s['username']; ?>.</p>
		<?php } ?>
	  </div>
    </div>
  </div>
  <div oncontextmenu="return false" onselectstart="return false" ondragstart="return false" style="z-index: 100;position: relative;background: url(<?php echo getAvatar($s['id']); ?>) <?php echo $colorsv; ?> 50%;width: 210px;height: 210px;background-size: cover;border-radius: 100%;border: 4px solid #fff;"></div>
  <?php if($s['id'] == $user['id']){ ?>
  <a href="<?php echo $site; ?>/ajustes#avatar" style="z-index: 140;position: relative;margin-top: -41px;background: <?php echo $colorsv; ?>;" class="btn-floating btn-large waves-effect waves-light"><i class="fal fa-pen"></i></a>
  <?php } else { ?>
	<form style="z-index: 140;position: relative;margin-top: -36px;" id="like" action="<?php echo $site; ?>/post.php?page=like" method="POST">
		<input type="hidden" name="user_liked" value="<?php echo $s['id']; ?>">
		<button <?php if($l['id']){ echo 'disabled '; } ?>class="btn-floating btn-large waves-effect waves-light red" type="submit"><i class="fas fa-heart"></i></button>
	</form>
  <?php } ?>
  </center></div>
  <br>
<div class="container">
  <div class="row">
    <div class="col s12 m4">
	<div class="row" style="margin: 0px;">
		<?php if($s['instagram_url']){ ?>
		<div class="input-field col s4">
			<center><a target="_blank" class="btn-floating btn-large waves-effect waves-light instagram" href="https://www.instagram.com/<?php echo $s['instagram_url']; ?>/"><i class="fab fa-instagram"></i></a></center>
		</div>
		<?php } ?>
		<?php if($s['facebook_url']){ ?>
		<div class="input-field col s4">
			<center><a target="_blank" class="btn-floating btn-large waves-effect waves-light facebook" href="<?php echo $s['facebook_url']; ?>"><i class="fab fa-facebook"></i></a></center>
		</div>
		<?php } ?>
		<?php if($s['twitter_url']){ ?>
		<div class="input-field col s4">
			<center><a target="_blank" class="btn-floating btn-large waves-effect waves-light twitter" href="https://twitter.com/<?php echo $s['twitter_url']; ?>"><i class="fab fa-twitter"></i></a></center>
		</div>
		<?php } ?>
	</div>
	
	  <div id="infoProfile"></div>
    </div>
    <div class="col s12 m8">
	<?php if($s['id'] == $user['id']){} else { ?>
	  <div class="card" style="color: #fff;background: <?php echo $colorsv; ?>;">
        <div class="card-content">
			<div id="results-report"></div>
			<?php if($s['show_comment_profile'] == 'yes'){ ?>
			<form id="send_question" action="<?php echo $site; ?>/post.php?page=send_question" method="POST">
			<input type="hidden" name="user_commented" value="<?php echo $s['id']; ?>">
			<div class="row" style="margin: 0px;">
			<div class="input-field col s12 m6" style="margin: 3px 0px;">
			    <p>
				  <label>
					<input name="anonymous" type="checkbox" />
					<span style="color: #fff;">Publicar anónimamente</span>
				  </label>
				</p>
			</div>
			<div class="input-field col s12 m6" style="margin: 3px 0px;">
			    <p>
				  <label>
					<input name="private" type="checkbox" />
					<span style="color: #fff;">Publicar en privado</span>
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
				<button class="waves-effect waves-light btn" type="submit" style="width: 100%;background: rgba(0, 0, 0, 0.50);">Enviar pregunta</button>
			</div>
			</div>
			</form>
			<?php } else { echo '<i>'. $s[username] .' tiene los comentarios deshabilitados</i>'; } ?>
        </div>
      </div>
	  <?php } ?>
	  
	  <div id="commentsProfile"></div>
    </div>
  </div>
</div>
<script type='text/javascript'>
document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboard(document.getElementById("copyTarget"));
	alert('Enlace de <?php echo $s['username']; ?> copiado!');
});

function copyToClipboard(elem) {
	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}

$("#send_question").submit(function(event){
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

<?php if(isset($_SESSION['id'])){ ?>
$("#send_report").submit(function(event){
	event.preventDefault();
	var post_url = $(this).attr("action");
	var request_method = $(this).attr("method");
	var form_data = $(this).serialize();
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){
		$("#results-report").html(response);
	});
});
<?php } ?>

$("#like").submit(function(event){
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

$(document).ready(function() {
$("#commentsProfile").load("<?php echo $site; ?>/ajax/comments-profile.php?id=<?php echo Filter($s['id']); ?>");
$("#infoProfile").load("<?php echo $site; ?>/ajax/info-profile.php?id=<?php echo Filter($s['id']); ?>");
$("#statusProfile").load("<?php echo $site; ?>/ajax/status-user.php?id=<?php echo Filter($s['id']); ?>");
var refreshId = setInterval(function() {
$("#commentsProfile").load('<?php echo $site; ?>/ajax/comments-profile.php?id=<?php echo Filter($s['id']); ?>&randval='+ Math.random());
$("#infoProfile").load('<?php echo $site; ?>/ajax/info-profile.php?id=<?php echo Filter($s['id']); ?>&randval='+ Math.random());
$("#statusProfile").load('<?php echo $site; ?>/ajax/status-user.php?id=<?php echo Filter($s['id']); ?>&randval='+ Math.random());
}, 1500);
$.ajaxSetup({ cache: false });
});
</script>
<?php require 'footer.php'; ?>