<?php
require 'inc/core.php';
if(isset($_SESSION['id'])){
	$g_sql = mysql_query("SELECT * FROM categories WHERE admin_id='". $user[id] ."'");$g = mysql_fetch_assoc($g_sql);
}
?>
<!DOCTYPE html>
<html lang="<?php echo $language_code; ?>">
  <head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title><?php echo $sitename; ?>: <?php echo $page; ?></title>
    <link rel="icon" type="image/png" href="<?php echo $site; ?>/assets/images/favicon.png" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="<?php echo $site; ?>/assets/css/animate.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo $site; ?>/assets/css/materialize.min.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="<?php echo $site; ?>/assets/css/emoji.css"  media="screen,projection"/>
	<link href="<?php echo $site; ?>/assets/css/all.min.css" rel="stylesheet"> 
	<!--link rel="alternate" media="only screen and (max-width: 640px)" href="LINK PARA MÓVIL"-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script type="text/javascript" src="<?php echo $site; ?>/assets/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $site; ?>/assets/js/materialize.min.js"></script>
	<script>
	    $(document).ready(function(){
			$('.sidenav').sidenav();
			$('.slider').slider({
				indicators: false
			});
			$('.modal').modal();
			$('.tabs').tabs();
			$('.tooltipped').tooltip({
				outDuration: 0,
				inDuration: 300
			});
			$(".dropdown-trigger").dropdown();
			$('.materialboxed').materialbox();
			$('.collapsible').collapsible({
				accordion: false
			});
			$('select').formSelect();
			$('.fixed-action-btn').floatingActionButton();
		});
		
		<?php if(isset($_SESSION['id'])){ ?>
		$(document).ready(function() {
			$("#lastOnline").load("<?php echo $site; ?>/ajax/last-online.php");
			$("#notificationsProfile").load("<?php echo $site; ?>/ajax/notifications-profile.php");
		var refreshId = setInterval(function() {
			$("#lastOnline").load('<?php echo $site; ?>/ajax/last-online.php?randval='+ Math.random());
			$("#notificationsProfile").load('<?php echo $site; ?>/ajax/notifications-profile.php?randval='+ Math.random());
		}, 1000);
			$.ajaxSetup({ cache: false });
		});
		<?php } ?>
	</script>
	<style>
/*@media screen and (min-width: 250px) and (max-width: 1024px) {html, body {height: 100% !important;overflow-y: scroll !important;-webkit-overflow-scrolling: touch !important;}}*/
	nav {
		background-color: #9c27b0;
	}
	
	.sub-header {
		background-color: #9c27b0;
		color: #fff;
		padding: 35px 0px 60px 0px;
	}
	.search_local {
		background: rgba(0, 0, 0, 0.25) !important;
		border-radius: 4px !important;
		padding: 0px 10px !important;
		border-bottom: 0px !important;
		border: none !important;
		margin: 0px !important;
		box-shadow: none !important;
		width: 60% !important;
		margin-top: -40px;
		color: #e6e6e6;
	}
	.tabs .indicator {
		background-color: <?php echo $colorsv; ?> !important;
	}
	.register {
		background: #444 !important;
		border-radius: .25rem !important;
		text-align: center;
		border-bottom: 0px !important;
		border: none !important;
		margin: 0px !important;
		box-shadow: 0 15px 30px 0 rgba(0,0,0,.11), 0 5px 15px 0 rgba(0,0,0,.08) !important;
		margin-top: -40px;
		color: #e6e6e6;
	}
	.search_local:hover,.search_local:focus {
		animation-play-state: paused;
	}
	nav ul a:hover {
		background-color: transparent !important;
	}
	.dropdown-content {
		margin-top: 70px !important;
		border-radius: .25rem !important;
		top: 0px !important;
	}

	.dropdown-content li>a, .dropdown-content li>span {
		color: <?php echo $colorsv; ?>;
	}
	.card, .card-panel {
		box-shadow: 0 15px 30px 0 rgba(0,0,0,.11), 0 5px 15px 0 rgba(0,0,0,.08);
		border-radius: .25rem !important;
	}
	.instagram {
		background: #f09433 !important;
		background: -moz-linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%) !important;
		background: -webkit-linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%) !important;
		background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%) !important;
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f09433', endColorstr='#bc1888',GradientType=1 ) !important;
	}
	
	.facebook {
		background-color: #2b4170; 
		background: -moz-linear-gradient(top, #3b5998, #2b4170);
		background: -ms-linear-gradient(top, #3b5998, #2b4170);
		background: -webkit-linear-gradient(top, #3b5998, #2b4170);
	}
	
	.twitter {
		background:linear-gradient(45deg, #66757f, #00ACEE, #00ACEE, #36D8FF, #f5f8fa);
	}
	</style>
	
  </head>
  <body>
  <?php if(isset($_SESSION['id'])){ ?><div id="lastOnline"></div><?php } ?>
  <nav>
    <div class="nav-wrapper">
    <div class="container">
      <a href="<?php echo $site; ?>/home" class="brand-logo" style="font-weight: bold;text-transform: uppercase;"><?php echo $sitename; ?> <?php if(isset($_SESSION['id'])){ ?><a href="<?php echo $site; ?>/~<?php echo $user['username']; ?>" id="notificationsProfile"></a><?php } ?></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
		<ul id="lang" class="dropdown-content">
		  <li><a style="text-align: center;" href="<?php echo $site; ?>/home?lang=es"><img src="<?php echo $site; ?>/assets/images/flags/es.png"></a></li>
		  <li><a style="text-align: center;" href="<?php echo $site; ?>/home?lang=es"><img src="<?php echo $site; ?>/assets/images/flags/us.png"></a></li>
		</ul>
		<li><a class="dropdown-trigger" href="#!" data-target="lang"><?php echo $lang['lang_title']; ?></a></li>
		<?php if(isset($_SESSION['id'])){ ?>
		<ul id="user_panel_header" class="dropdown-content">
		  <li><a href="<?php echo $site; ?>/~<?php echo $user['username']; ?>">Perfil</a></li>
		  <li><a href="<?php echo $site; ?>/ajustes">Ajustes</a></li>
		  <li><a href="<?php echo $site; ?>/logout">Salir</a></li>
		</ul>
		<?php if($g['id']){ ?><li><a href="<?php echo $site; ?>/group">Grupos</a></li><?php } else { ?><li><a href="<?php echo $site; ?>/group">Crear grupo</a></li><?php } ?>
		<?php if($user['rank'] >= $administrador){ ?><li><a href="<?php echo $site . $folder_admin; ?>">Administración</a></li><?php } ?>
		<li><a class="dropdown-trigger" href="#!" data-target="user_panel_header"><?php echo $user['username']; ?><i class="material-icons right">account_circle</i></a></li>
		<?php } else {?>
        <li><a href="<?php echo $site; ?>/login"><i class="material-icons tooltipped" data-position="bottom" data-tooltip="<?php echo $lang['menu_login']; ?>">account_circle</i></a></li>
        <li><a href="<?php echo $site; ?>/register"><i class="material-icons tooltipped" data-position="bottom" data-tooltip="<?php echo $lang['menu_register']; ?>">person_add</i></a></li>
		<?php } ?>
      </ul>
    </div>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
		<?php if(isset($_SESSION['id'])){ ?>
		<?php if($user['rank'] >= $administrador){ ?><li><a href="<?php echo $site . $folder_admin; ?>">Administración</a></li><?php } ?>
		<li><a href="<?php echo $site; ?>/~<?php echo $user['username']; ?>">Perfil</a></li>
		<?php if($g['id']){ ?><li><a href="<?php echo $site; ?>/group">Grupos</a></li><?php } else { ?><li><a href="<?php echo $site; ?>/group">Crear grupo</a></li><?php } ?>
		<!--li><a href="#!"><?php echo $user['username']; ?><i class="material-icons left">account_circle</i></a></li-->
		<li><a href="<?php echo $site; ?>/ajustes">Ajustes</a></li>
		<li><a href="<?php echo $site; ?>/logout">Salir</a></li>
		<?php } else {?>
		<li><a href="<?php echo $site; ?>/login"><i class="left material-icons">account_circle</i> <?php echo $lang['menu_login']; ?></a></li>
		<li><a href="<?php echo $site; ?>/register"><i class="left material-icons">person_add</i> <?php echo $lang['menu_register']; ?></a></li>
		<?php } ?>
  </ul>
 