<?php
	require 'inc/core.php';
	// cuando llegue la barra de likes al 100% dar el perfil verificado
		if($_GET['page'] == 'send_question'){
			if($_POST['anonymous']){
				$anonymous = 'yes';
			} else {
				$anonymous = 'no';
			}
			if($_POST['private']){
				$private = 'yes';
			} else {
				$private = 'no';
			}
			$username = Filter($_POST['username']);
			$user_commented = $_POST['user_commented'];
			$content = Filter($_POST['content']);
			
			$x_verify = mysql_query("SELECT * FROM users WHERE id='$user_commented' LIMIT 1");
			$x = mysql_fetch_assoc($x_verify);
			
			if(empty($username) && empty($content)){
				echo "<script>M.toast({html: '". $lang['input_empty'] ."', displayLength: '1500'});</script>";
			} else {
				if($x['show_comment_profile'] == 'yes'){
					if (isset($_SESSION['id'])) {
						mysql_query("INSERT INTO users_comments (user_id,username,anonymous,ip,content,private,user_commented,date_reg) VALUES ('$user[id]','$username','$anonymous','$ip','$content','$private','$user_commented','". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."')");
					} else {
						mysql_query("INSERT INTO users_comments (username,anonymous,ip,content,private,user_commented,date_reg) VALUES ('$username','$anonymous','$ip','$content','$private','$user_commented','". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."')");
					}
					mysql_query("UPDATE users SET new_messages='yes' WHERE id='$x[id]'");
					echo "<script>M.toast({html: '". $lang['sended'] ."', displayLength: '1500'});</script>";
					echo '<script>document.getElementById("sendmsg").value = "";</script>';
					echo '<script>document.getElementById("sendprofile").value = "";</script>';
				} else {
					echo "<script>M.toast({html: '". $lang['msg_blocked'] ."', displayLength: '1500'});</script>";
				}
			}
		}
		
		if($_GET['page'] == 'send_question_group'){
			if($_POST['anonymous']){
				$anonymous = 'yes';
			} else {
				$anonymous = 'no';
			}
			$username = $_POST['username'];
			$group_id = $_POST['group_id'];
			$content = Filter($_POST['content']);
			
			if(empty($content) && empty($username)){
				echo "<script>M.toast({html: '". $lang['input_empty'] ."', displayLength: '1500'});</script>";
			} else {
				if (isset($_SESSION['id'])) {
					mysql_query("INSERT INTO users_comments (user_id,username,anonymous,ip,content,group_id,date_reg) VALUES ('$user[id]','$username','$anonymous','$ip','$content','$group_id','". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."')");
				} else {
					mysql_query("INSERT INTO users_comments (username,anonymous,ip,content,group_id,date_reg) VALUES ('$username','$anonymous','$ip','$content','$group_id','". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."')");
				}
				echo "<script>M.toast({html: '". $lang['sended'] ."', displayLength: '1500'});</script>";
				echo '<script>document.getElementById("sendmsg").value = "";</script>';
				echo '<script>document.getElementById("sendprofile").value = "";</script>';
			}
		}
	
	if (isset($_SESSION['id'])) {
		if($_GET['page'] == 'join_group'){
			$group_id = Filter($_POST['group_id']);
			
			$x_verify = mysql_query("SELECT * FROM categories WHERE id='$group_id' LIMIT 1");
			$x = mysql_fetch_assoc($x_verify);
			
			if($x['id']){
				if($x['privacity'] == 'open'){
					mysql_query("UPDATE users SET category_id='$group_id' WHERE id='$user[id]'");
					echo "<script>M.toast({html: '". $lang['group_join'] ."', displayLength: '1500'});</script>";
				} else {
					echo "<script>M.toast({html: '". $lang['group_private'] ."', displayLength: '1500'});</script>";
				}
			} else {
				echo "<script>M.toast({html: '". $lang['group_error'] ."', displayLength: '1500'});</script>";
			}
		}
		
		if($_GET['page'] == 'send_report'){
			$user_id_reported = Filter($_POST['user_id_reported']);
			$reason = Filter($_POST['reason']);
			$content = Filter($_POST['content']);
			
			$x_verify = mysql_query("SELECT * FROM users_reporteds WHERE user_id='$user[id]' AND user_id_reported='$user_id_reported' LIMIT 1");
			$x = mysql_fetch_assoc($x_verify);
			
			if($x['id']){
				echo "<script>M.toast({html: '". $lang['report_send'] ."', displayLength: '1500'});</script>";
			} else {
				if(empty($reason) && empty($content)){
					echo "<script>M.toast({html: '". $lang['obligatory_input'] ."', displayLength: '1500'});</script>";
				} else {
					echo "<script>M.toast({html: '". $lang['report_ok'] ."', displayLength: '1500'});</script>";
					mysql_query("INSERT INTO users_reporteds (user_id,user_id_reported,reason,content,date_reg) VALUES ('$user[id]','$user_id_reported','$reason','$content','". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."')");
				}
			}
		}
		
		if($_GET['page'] == 'edit_group'){
			$group_id = Filter($_POST['group_id']);
			$title = Filter($_POST['title']);
			$privacity = Filter($_POST['privacity']);
			$color = Filter($_POST['color']);
			
			$x_verify = mysql_query("SELECT * FROM categories WHERE admin_id='$user[id]' AND id='$group_id' LIMIT 1");
			$x = mysql_fetch_assoc($x_verify);
			
			if($x['id']){
				if(empty($title) && empty($privacity) && empty($color)){
					echo "<script>M.toast({html: '". $lang['obligatory_input'] ."', displayLength: '1500'});</script>";
				} else {
					mysql_query("UPDATE categories SET title='$title', privacity='$privacity', color='$color' WHERE id='$group_id'");
					echo "<script>M.toast({html: '". $lang['group_ok'] ."', displayLength: '1500'});</script>";	
					echo '<meta http-equiv="refresh" content="1;url='. $site .'/group" />';
				}
			} else {
				echo "<script>M.toast({html: '". $lang['ops_error'] ."', displayLength: '1500'});</script>";
			}
		}
		
		if($_GET['page'] == 'delete_comment'){
			$user_id = Filter($_POST['user_id']);
			$comment_id = Filter($_POST['comment_id']);
			
			$x_verify = mysql_query("SELECT * FROM users_comments WHERE id='$comment_id' AND user_commented='$user[id]'");
			$x = mysql_fetch_assoc($x_verify);
			
			if($x['id']){
				mysql_query("DELETE FROM users_comments WHERE id='$comment_id' AND user_commented='$user[id]'");
				mysql_query("DELETE FROM users_comments_likes WHERE comment_id='$comment_id' AND user_id_liked='$user[id]'");
				echo "<script>M.toast({html: '". $lang['delete_comment'] ."', displayLength: '1500'});</script>";
			} else {
				echo "<script>M.toast({html: '". $lang['ops_error'] ."', displayLength: '1500'});</script>";
			}
		}
		
		if($_GET['page'] == 'update_instagram'){
			$instagram_url = Filter($_POST['instagram_url']);
			
			$borrar = array('https://www.instagram.com/','http://www.instagram.com/','https://instagram.com/','http://instagram.com/','/','@','https:','http:','google.es','4chan.org',
							'https://www.facebook.com/','http://www.facebook.com/','https://facebook.com/','http://facebook.com/',
							'https://www.twitter.com/','http://www.twitter.com/','https://twitter.com/','http://twitter.com/');
			$insta = str_replace($borrar, '', $instagram_url);
			
			$findme   = 'instagram.com'; //lo que busca
			$mystring = $instagram_url; //en el texto que busca
			$pos = strpos($mystring, $findme);
			
			if ($pos === false) {
				// dejar continuar
				mysql_query("UPDATE users SET instagram_url='$insta' WHERE id='$user[id]'");
				echo "<script>M.toast({html: 'Instagram actualizado', displayLength: '1500'});</script>";
			} else {
				// no dejar 
				echo "<script>M.toast({html: 'Introduce solo tu nombre de usuario', displayLength: '1500'});</script>";
			}
		}
		
		if($_GET['page'] == 'update_twitter'){
			$twitter_url = Filter($_POST['twitter_url']);
			
			$borrar = array('https://www.instagram.com/','http://www.instagram.com/','https://instagram.com/','http://instagram.com/','/','@','https:','http:','google.es','4chan.org',
							'https://www.facebook.com/','http://www.facebook.com/','https://facebook.com/','http://facebook.com/',
							'https://www.twitter.com/','http://www.twitter.com/','https://twitter.com/','http://twitter.com/');
			$tw = str_replace($borrar, '', $twitter_url);
			
			$findme   = 'twitter.com'; //lo que busca
			$mystring = $twitter_url; //en el texto que busca
			$pos = strpos($mystring, $findme);
			
			if ($pos === false) {
				// dejar continuar
				mysql_query("UPDATE users SET twitter_url='$tw' WHERE id='$user[id]'");
				echo "<script>M.toast({html: 'Twitter actualizado', displayLength: '1500'});</script>";
			} else {
				// no dejar 
				echo "<script>M.toast({html: 'Introduce solo tu nombre de usuario', displayLength: '1500'});</script>";
			}
		}
		
		if($_GET['page'] == 'update_facebook'){
			$facebook_url = Filter($_POST['facebook_url']);
			
			$findme   = 'facebook.com'; //lo que busca
			$mystring = $facebook_url; //en el texto que busca
			$pos = strpos($mystring, $findme);
			
			if ($pos === false) {
				// dejar continuar
				echo "<script>M.toast({html: 'Introduce enlace de tu Facebook', displayLength: '1500'});</script>";
			} else {
				// no dejar 
				mysql_query("UPDATE users SET facebook_url='$facebook_url' WHERE id='$user[id]'");
				echo "<script>M.toast({html: 'Facebook actualizado', displayLength: '1500'});</script>";
			}
		}
		
		if($_GET['page'] == 'delete_group'){
			$group_id = Filter($_POST['group_id']);
			
			$x_verify = mysql_query("SELECT * FROM categories WHERE admin_id='$user[id]' AND id='$group_id' LIMIT 1");
			$x = mysql_fetch_assoc($x_verify);
			
			if($x['id']){
				mysql_query("DELETE FROM categories WHERE id='$group_id' AND admin_id='$user[id]'");
				echo "<script>M.toast({html: '". $lang['group_delete'] ."', displayLength: '1500'});</script>";
				echo '<meta http-equiv="refresh" content="1;url='. $site .'/group" />';	
			} else {
				echo "<script>M.toast({html: '". $lang['ops_error'] ."', displayLength: '1500'});</script>";
			}
		}
		
		if($_GET['page'] == 'like_comment'){
			$comment_id = Filter($_POST['comment_id']);
			$user_id_liked = Filter($_POST['user_id_liked']);

			$x_verify = mysql_query("SELECT * FROM users_comments_likes WHERE user_id='$user[id]' AND comment_id='$comment_id' LIMIT 1");
			$x = mysql_fetch_assoc($x_verify);
			
			if($x['id']){
				//echo "<script>M.toast({html: 'No te gusta', displayLength: '1500'});</script>";
				mysql_query("DELETE FROM users_comments_likes WHERE id='$x[id]'");
			} else {
				//echo "<script>M.toast({html: 'Te ha gustado', displayLength: '1500'});</script>";
				mysql_query("INSERT INTO users_comments_likes (user_id,comment_id,user_id_liked,yeslike,date_reg) VALUES ('$user[id]','$comment_id','$user_id_liked','1','". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."')");
			}	
		}
		
		if($_GET['page'] == 'new_group'){
			$title = Filter($_POST['title']);
			$color = Filter($_POST['color']);
			
			if(empty($title) && empty($color)) {
				echo "<script>M.toast({html: '". $lang['input_empty'] ."', displayLength: '1500'});</script>";
			} else {
				echo "<script>M.toast({html: '". $lang['group_new'] ."', displayLength: '1500'});</script>";
				mysql_query("INSERT INTO categories (title,admin_id,color) VALUES ('$title','$user[id]','$color')");
				echo '<meta http-equiv="refresh" content="1.5;url='. $site .'/group" />';
			}
		}
		
		if($_GET['page'] == 'ajustesprivacidad'){
			$show_last_online = $_POST['show_last_online'];
			$show_comment_profile = $_POST['show_comment_profile'];
			
			if(empty($show_last_online) && empty($show_comment_profile)){
				echo "<script>M.toast({html: '". $lang['input_empty'] ."', displayLength: '1500'});</script>";
			} else {
				echo "<script>M.toast({html: '". $lang['profile_updated'] ."', displayLength: '1500'});</script>";
				mysql_query("UPDATE users SET show_last_online='$show_last_online', show_comment_profile='$show_comment_profile' WHERE id='$user[id]'");	
			}
		}
		
		if($_GET['page'] == 'ajustesperfil'){
			$gender = Filter($_POST['gender']);
			$full_name = Filter($_POST['full_name']);
			$color = Filter($_POST['color']);
			$biografia = Filter($_POST['biografia']);
			
			if(empty($full_name)){
				echo "<script>M.toast({html: '". $lang['input_empty'] ."', displayLength: '1500'});</script>";
			} else {
				echo "<script>M.toast({html: '". $lang['profile_updated'] ."', displayLength: '1500'});</script>";
				mysql_query("UPDATE users SET full_name='$full_name', gender='$gender', biografia='$biografia', color='$color' WHERE id='$user[id]'");	
			}
		}
		
		if($_GET['page'] == 'like'){
			$user_liked = Filter($_POST['user_liked']);
			
			$x_verify = mysql_query("SELECT * FROM users_likes WHERE user_id='$user[id]' AND user_liked='$user_liked' LIMIT 1");
			$x = mysql_fetch_assoc($x_verify);
			
			if($user_liked == $user['id']){
				//echo "<script>M.toast({html: 'A ti mismo no puedes', displayLength: '1500'});</script>";
			} else {
				if($x['id']){
					//echo "<script>M.toast({html: 'Ya diste crush', displayLength: '1500'});</script>";
				} else {
					echo "<script>M.toast({html: 'CRUSH!', displayLength: '1500'});</script>";
					mysql_query("INSERT INTO users_likes (user_id,user_liked,yeslike,date_reg) VALUES ('$user[id]','$user_liked','1','". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."')");
				}	
			}
		}
		
	} else {
		
		if($_GET['page'] == 'recovery_password_confirmation'){
			
			$confirmation_token = Filter($_POST['confirmation_token']);
			$password = $_POST['password'];
			
			$x_verify = mysql_query("SELECT * FROM users WHERE password_reset_token='$confirmation_token' LIMIT 1");
			$x = mysql_fetch_assoc($x_verify);
			
			if($x['id']){
				mysql_query("UPDATE users SET password='". md5($password) ."', password_reset_token='' WHERE id='$x[id]'");
				echo "<script>M.toast({html: 'Contraseña cambiada correctamente', displayLength: '2500'});</script>";
				echo '<script>document.getElementById("campo").value = "";</script>';
			} else {
				echo "<script>M.toast({html: 'Vuelve a intentarlo más tarde', displayLength: '1500'});</script>";
			}
			
		}
		
		if($_GET['page'] == 'recovery_password'){
			$username = Filter($_POST['username']);
			
			$x_verify = mysql_query("SELECT * FROM users WHERE username='$username' LIMIT 1");
			$x = mysql_fetch_assoc($x_verify);
			
			if($x['id']){
				$mostrar = strlen($x['mail'])-10;
				echo "<script>M.toast({html: 'Recuerda revisar el correo de SPAM', displayLength: '10000'});</script>";
				echo "<script>M.toast({html: 'Gracias. Consulta ". substr($x['mail'], 0, 1) ."*****". substr($x['mail'], $mostrar, 10) ." para obtener un enlace para cambiar la contraseña.', displayLength: '10000'});</script>";
				
				$token = $x['username'] . $x['password'] . time() . $x['mail'];
				mysql_query("UPDATE users SET password_reset_token='". strtoupper(sha1(md5($token))) ."' WHERE id='$x[id]'");
				echo '<script>document.getElementById("campo").value = "";</script>';
				
			// INICIO CORREO ENVIO AL USUARIO
			$sc = array("http://","https://","/");
			$tucorreo = $correo['noreply'];
			$para  = $x['mail'];
			$titulo = 'Recuperar contraseña';// titulo
			// mensaje
			$mensaje = '
			<html>
				<head>
				
				</head>
				<body>
					<div style="font-family: unset;font-weight: bold;font-size: 28px;padding: 25px 0;text-align: center;background: #e8e8e8;color: #696969;">
						'. $sitename .'
					</div>
					<br><br>
					<div style="color: #5a5a5a;text-align: left;padding: 10px 40px;margin-left: auto;margin-right: auto;width: 460px;font-size: 18px;">
						Hola '. $x[username] .',<br>
						Recibimos una solicitud para restablecer su contraseña de '. $sitename .'.
						<br>
						<br>
						<center><a href="'. $site .'/forgot/reset/'. strtoupper(sha1(md5($token))) .'" style="background: '. $colorsv .';text-decoration: none;padding: 10px 40px;border-radius: 2px;font-weight: bold;color: #fff;">Restablecer la contraseña</a></center>
						<br>
						Si ignora este mensaje, su contraseña no será cambiada.
					</div>
				</body>
			</html>
			';
			// Para enviar un correo HTML, debe establecerse la cabecera Content-type
			$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
			$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			// Cabeceras adicionales
			$cabeceras .= 'To: ' . "\r\n";
			$cabeceras .= 'From: '.$sitename.' <noreply@hiscrush.com>' . "\r\n";
			$cabeceras .= 'Cc: noreply@hiscrush.com' . "\r\n";
			$cabeceras .= 'Bcc: noreply@hiscrush.com' . "\r\n";

			mail($para, $titulo, $mensaje, $cabeceras);// Enviarlo
			// FINAL CORREO ENVIO AL USUARIO
				
			} else {
				echo "<script>M.toast({html: 'No se han encontrado usuarios', displayLength: '1500'});</script>";
			}
			
		}
			
		if($_GET['page'] == 'like_comment'){
			echo '<meta http-equiv="refresh" content="0;url='. $site .'/login" />';
		}
		
		if($_GET['page'] == 'like'){
			echo "<script>M.toast({html: '". $lang['msg_login'] ."', displayLength: '1500'});</script>";
		}
		
		//echo "<script>M.toast({html: '". $lang['msg_login'] ."', displayLength: '1500'});</script>";

		
		if($_GET['page'] == 'login'){
			$userormail = Filter($_POST['userormail']);
			$password = $_POST['password'];
			
			$login_verify = mysql_query("SELECT * FROM users WHERE username='$userormail' && password='". md5($password) ."' LIMIT 1");
			$login_fetch = mysql_fetch_assoc($login_verify);
			
			if(empty($userormail) && empty($password)){
				echo "<script>M.toast({html: '". $lang['input_empty'] ."', displayLength: '1500'});</script>";
			} elseif(mysql_num_rows($login_verify) == 0){
				echo "<script>M.toast({html: '". $lang['login_error'] ."', displayLength: '1500'});</script>";
			} else {
				$_SESSION['id'] = $login_fetch['id'];
				echo "<script>M.toast({html: '". $lang['login_okmsg'] ."', displayLength: '1500'});</script>";
				mysql_query("UPDATE users SET ip='$ip' WHERE id='$login_fetch[id]'");
				echo '<meta http-equiv="refresh" content="1;url='. $site .'/home" />';
			}
		}
		
		if($_GET['page'] == 'register'){

			$mail = Filter($_POST['mail']);
			$full_name = Filter($_POST['full_name']);
			$username = Filter($_POST['username']);
			$password = $_POST['password'];
			
			$ip_verify = mysql_query("SELECT * FROM users WHERE ip='$ip' LIMIT 1");
			$ip_fetch = mysql_fetch_assoc($ip_verify);
			
			$login_verify = mysql_query("SELECT * FROM users WHERE username='$username' LIMIT 1");
			$login_fetch = mysql_fetch_assoc($login_verify);
			
			$email_verify = mysql_query("SELECT * FROM users WHERE mail='$mail' LIMIT 1");
			$email_fetch = mysql_fetch_assoc($email_verify);
			
			$no_valido = array('@', ' ', '[]');
			
			if(mysql_num_rows($ip_verify) == 1){
				echo "<script>M.toast({html: '". $lang['register_uniqueip'] ."', displayLength: '1500'});</script>";
			} elseif(empty($mail) && empty($username) && empty($password) && empty($full_name)){
				echo "<script>M.toast({html: '". $lang['input_empty'] ."', displayLength: '1500'});</script>";
			} elseif(mysql_num_rows($login_verify) == 1){
				echo "<script>M.toast({html: '". $lang['register_username_error'] ."', displayLength: '1500'});</script>";
			} elseif(mysql_num_rows($email_verify) == 1){
				echo "<script>M.toast({html: '". $lang['regiser_mail_error'] ."', displayLength: '1500'});</script>";
			}elseif(!preg_match('/^[A-Z0-9_]{0,100}$/i', $username)){
				echo "<script>M.toast({html: '". $lang['register_username_error2'] ."', displayLength: '1500'});</script>";
			} elseif(strlen($password) < 6){
				echo "<script>M.toast({html: '". $lang['register_password_low'] ."', displayLength: '1500'});</script>";
			} else {
				echo "<script>M.toast({html: '". $lang['login_okmsg'] ."', displayLength: '1500'});</script>";
				mysql_query("INSERT INTO users (username,password,mail,ip,country,reg_date,full_name) VALUES ('$username','". md5($password) ."','$mail','$ip','". getCountryFromIP($ip) ."','". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."','$full_name')");
				$x_verify = mysql_query("SELECT * FROM users WHERE mail='$mail' && password='". md5($password) ."' LIMIT 1");
				$x_fetch = mysql_fetch_assoc($x_verify);
				$_SESSION['id'] = $x_fetch['id'];
				//mysql_query("UPDATE users SET ip='$ip', country='". getCountryFromIP($ip) ."', date_login='". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."' WHERE id='$x_fetch[id]'");
				echo '<meta http-equiv="refresh" content="2;url='. $site .'/home" />';
			}
		}
		
		//if($_GET['page'] == 'userlogin'){
		//	$email = Filter($_POST['email']);
		//	$password = $_POST['password'];
		//	
		//	$email_verify = mysql_query("SELECT * FROM users WHERE email='$email' && password='". md5($password) ."' LIMIT 1");
		//	$email_fetch = mysql_fetch_assoc($email_verify);
		//	
		//	if(empty($email) && empty($password)){
		//		echo "<script>M.toast({html: '". $lang['input_empty'] ."', displayLength: '1500'});</script>";
		//	} elseif(mysql_num_rows($email_verify) == 0){
		//		echo "<script>M.toast({html: 'Hay algún dato incorrecto', displayLength: '1500'});</script>";
		//	} else {
		//		echo "<script>M.toast({html: 'Iniciando sesión...', displayLength: '1500'});</script>";
		//		$_SESSION['id'] = $email_fetch['id'];
		//		mysql_query("UPDATE users SET ip='$ip', country='". getCountryFromIP($ip) ."', date_login='". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."' WHERE id='$email_fetch[id]'");
		//		echo '<meta http-equiv="refresh" content="2;url='. $site .'/home" />';
		//	}
		//}
	}
	
	if (isset($_SESSION['admin'])) {
		
	} else {
		
		if($_GET['page'] == 'adminlogin'){
			$username	=	Filter($_POST['username']);
			$password	=	Filter($_POST['password']);
			
			$login_verify = mysql_query("SELECT * FROM users WHERE username='$username' AND password='".md5($password)."' LIMIT 1");
			$login_fetch = mysql_fetch_assoc($login_verify);
			
			if (mysql_num_rows($login_verify) == 0) {
				echo "<script>M.toast({html: 'Usuario o contraseña incorrecto', displayLength: '1500'});</script>";
			} elseif($login_fetch[rank] < $administrador) {
				echo "<script>M.toast({html: 'No tienes permisos para entrar', displayLength: '1500'});</script>";
			} else {
				$_SESSION['admin'] = $login_fetch['id'];
				echo '<meta http-equiv="refresh" content="0;url='. $site . $folder_admin . '/home.php" />';
			}
		}
		
	}
	
	//mysql_query("DELETE FROM caratulas_likes WHERE episode_id=''");
	//mysql_query("DELETE FROM caratulas_users_options WHERE caratula_id='0'");
?>
