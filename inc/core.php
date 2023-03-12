<?php
	
	error_reporting(1);
	
	require 'config.php';
	require 'geoip.php';

	$sitename		=		"Hiscrush"; //
	$site = $_SERVER['REQUEST_SCHEME'] .'://'. $_SERVER['HTTP_HOST'];
	$folder_admin = "/admin";
	$colorsv = "#9c27b0";
	
	require 'https.php';
	
	session_start();
	if (isset($_SESSION['id'])) {
		$user_sql = mysql_query("SELECT * FROM users WHERE id='$_SESSION[id]'");
		$user = mysql_fetch_assoc($user_sql);
	}
	
	$premium = '2';
	$administrador = '4';
	
	$mensajes_bloqueados = array("Puta", "pUta", "puTa", "putA", "puta", "hijo de puta", "Hijo de puta", "Mierdaseca", "mierdaseca");
	$mensajes_a_reemplazar = array("*", "*", "*", "*", "*", "*", "*", "*");
	
	$correo = array(
		"noreply" => "noreply@domain.tdl"
	);
	
	// Idioma
	if(isSet($_GET['lang']))
		$lang = $_GET['lang'];
	else if(isSet($_SESSION['lang']))
		$lang = $_SESSION['lang'];
	else if(isSet($_COOKIE['lang']))
		$lang = $_COOKIE['lang'];
	else if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
	else
		$lang = 'es';
	
	switch ($lang) {
		case 'en':
		$language_code = "en";
		break;
	 
		case 'ro':
		$language_code = "ro";
		break;
		
		case 'de':
		$language_code = "de";
		break;
		
		case 'es':
		$language_code = "es";
		break;
		
		case 'fr':
		$language_code = "fr";
		break;
		
		case 'it':
		$language_code = "it";
		break;
		
		case 'pt':
		$language_code = "pt";
		break;
		
		case 'tr':
		$language_code = "tr";
		break;
	 
		default:
		$language_code = "es";
	}
	
	$_SESSION['lang'] = $language_code;
	setcookie('lang', $language_code, time() + (3600 * 24 * 30));
	
	include dirname(dirname(__FILE__)) . '/languages/'.$language_code.'.php';
	
	
	$language_codes = array(
			'en' => 'English' , 
			'ro' => 'Română' , 
			'fr' => 'Français' , 
			'it' => 'Italiano' , 
			'pt' => 'Português' , 
			'tr' => 'Türk' , 
			'de' => 'Deutsch' , 
			'es' => 'Español');
	
	// Obtención de dirección IP
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	
	mysql_query("SET NAMES 'utf8'");
	mysql_query('SET character_set_connection=utf8');
	mysql_query('SET character_set_client=utf8');
	mysql_query('SET character_set_results=utf8');
	header('Content-Type: text/html; charset=utf-8');
	ini_set('default_charset', 'utf-8');
	date_default_timezone_set('Europe/Madrid');
	
	function charset_decode_utf_8($string)
    {
        /* Only do the slow convert if there are 8-bit characters */
        if ( !preg_match("/[\200-\237]/", $string) && !preg_match("/[\241-\377]/", $string) )
               return $string;

        // decode three byte unicode characters
          $string = preg_replace_callback("/([\340-\357])([\200-\277])([\200-\277])/",
                    create_function ('$matches', 'return \'&#\'.((ord($matches[1])-224)*4096+(ord($matches[2])-128)*64+(ord($matches[3])-128)).\';\';'),
                    $string);

        // decode two byte unicode characters
          $string = preg_replace_callback("/([\300-\337])([\200-\277])/",
                    create_function ('$matches', 'return \'&#\'.((ord($matches[1])-192)*64+(ord($matches[2])-128)).\';\';'),
                    $string);

        return $string;
    }
	
	function utf16_2_utf8 ($nowytekst) {
        $nowytekst = str_replace('%u0104','Ą',$nowytekst);    //Ą
        $nowytekst = str_replace('%u0106','Ć',$nowytekst);    //Ć
        $nowytekst = str_replace('%u0118','Ę',$nowytekst);    //Ę
        $nowytekst = str_replace('%u0141','Ł',$nowytekst);    //Ł
        $nowytekst = str_replace('%u0143','Ń',$nowytekst);    //Ń
        $nowytekst = str_replace('%u00D3','Ó',$nowytekst);    //Ó
        $nowytekst = str_replace('%u015A','Ś',$nowytekst);    //Ś
        $nowytekst = str_replace('%u0179','Ź',$nowytekst);    //Ź
        $nowytekst = str_replace('%u017B','Ż',$nowytekst);    //Ż
        $nowytekst = str_replace('Ã‘','Ñ',$nowytekst);   	  //Ñ
       
        $nowytekst = str_replace('%u0105','ą',$nowytekst);    //ą
        $nowytekst = str_replace('%u0107','ć',$nowytekst);    //ć
        $nowytekst = str_replace('%u0119','ę',$nowytekst);    //ę
        $nowytekst = str_replace('%u0142','ł',$nowytekst);    //ł
        $nowytekst = str_replace('%u0144','ń',$nowytekst);    //ń
        $nowytekst = str_replace('%u00F3','ó',$nowytekst);    //ó
        $nowytekst = str_replace('%u015B','ś',$nowytekst);    //ś
        $nowytekst = str_replace('%u017A','ź',$nowytekst);    //ź
        $nowytekst = str_replace('%u017C','ż',$nowytekst);    //ż
        $nowytekst = str_replace('í','i',$nowytekst);    //ż
        $nowytekst = str_replace('ì','i',$nowytekst);    //ż
        $nowytekst = str_replace('ï','i',$nowytekst);    //ż
        $nowytekst = str_replace('î','i',$nowytekst);    //ż
        $nowytekst = str_replace('Í','I',$nowytekst);    //ż
        $nowytekst = str_replace('Ì','I',$nowytekst);    //ż
        $nowytekst = str_replace('Ï','I',$nowytekst);    //ż
        $nowytekst = str_replace('Î','I',$nowytekst);    //ż
        $nowytekst = str_replace('ñ','n',$nowytekst);    //ż
        $nowytekst = str_replace('Ñ','n',$nowytekst);    //ż
        $nowytekst = str_replace('😃','<img src="http://127.0.0.1/assets/images/avatar.png">',$nowytekst);    //ż
    return ($nowytekst);
    }
	
	$ahora = date(Y) . '-' . date(m) . '-' . date(d) . ' ' . date(H) . ':' . date(i) . ':' . date(s);
	

	
	function hace_cuanto($date_1 , $date_2){
		$datetime1 = date_create($date_1);
		$datetime2 = date_create($date_2);
    
		$interval = date_diff($datetime1, $datetime2);
    
		echo 'Hace ';
		if($interval->format('%Y') >= 1){
			if($interval->format('%Y') <= 1){
				echo $interval->format('%y año');
			} else {
				echo $interval->format('%y años');
			}
		} elseif($interval->format('%m') >= 1){
			if($interval->format('%m') <= 1){
				echo $interval->format('%m mes');
			} else {
				echo $interval->format('%m meses');
			}
		} elseif($interval->format('%d') >= 1){
			if($interval->format('%d') <= 1){
				echo $interval->format('%d día');
			} else {
				echo $interval->format('%d días');
			}
		} elseif($interval->format('%h') >= 1){
			if($interval->format('%h') <= 1){
				echo $interval->format('%h hora');
			} else {
				echo $interval->format('%h horas');
			}
		} elseif($interval->format('%i') >= 1){
			if($interval->format('%i') <= 1){
				echo $interval->format('%i minuto');
			} else {
				echo $interval->format('%i minutos');
			}
		} elseif($interval->format('%s') >= 1){
			echo $interval->format('%s segundos');
		}
	}
	
	function status($a){
		$uu_sql = mysql_query("SELECT * FROM users WHERE id='$a'");$u = mysql_fetch_assoc($uu_sql);
		
		$R1 = mysql_query("SELECT COUNT(*) as count FROM users WHERE id='$a' AND DATE_SUB(NOW(), INTERVAL 600 SECOND) < last_on");
		$R = mysql_fetch_object($R1)->count;
		
		if($u['show_last_online'] == 'yes'){
			if($R == '1'){
				echo 'background: #4caf50;';
			} else {
				echo 'background: #f44336;';
			}
		} else {
			echo 'background: #9e9e9e;';
		}
		
	}

	function statusGroup($a){		
		$R1 = mysql_query("SELECT COUNT(*) as count FROM users WHERE category_id='$a' AND DATE_SUB(NOW(), INTERVAL 600 SECOND) < last_on");
		$R = mysql_fetch_object($R1)->count;
		echo $R['count'];
	}
	
	function compress_png($path_to_png_file, $max_quality = 90)
	{
		if (!file_exists($path_to_png_file)) {
			throw new Exception("File does not exist: $path_to_png_file");
		}

		// guarantee that quality won't be worse than that.
		$min_quality = 60;

		// '-' makes it use stdout, required to save to $compressed_png_content variable
		// '<' makes it read from the given file path
		// escapeshellarg() makes this safe to use with any path
		$compressed_png_content = shell_exec("pngquant --quality=$min_quality-$max_quality - < ".escapeshellarg(    $path_to_png_file));

		if (!$compressed_png_content) {
			throw new Exception("Conversion to compressed PNG failed. Is pngquant 1.8+ installed on the server?");
		}

		return $compressed_png_content;
	}
	
	function Filter($str) {
		$str = mysql_real_escape_string($str);
		$str = htmlspecialchars($str);
		$str = filter_var($str, FILTER_SANITIZE_STRING);
		return $str;
	}
	
	function NameCategory($a){
		$ss_sql = mysql_query("SELECT * FROM categories WHERE id='$a'");
		$s = mysql_fetch_assoc($ss_sql);
		echo $s['title'];
	}
	
	function UserComments($a){
		$R = mysql_query("SELECT COUNT(*) count FROM users_comments WHERE user_commented='$a'");
		$R1 = mysql_fetch_assoc($R);
		echo $R1['count'];
	}
	
	function CommentsLikes($a){
		$R = mysql_query("SELECT COUNT(*) count FROM users_comments_likes WHERE comment_id='$a'");
		$R1 = mysql_fetch_assoc($R);
		echo $R1['count'];
	}
	
	function UserLikes($a){
		$R = mysql_query("SELECT COUNT(*) count FROM users_likes WHERE user_liked='$a'");
		$R1 = mysql_fetch_assoc($R);
		echo $R1['count'];
	}
	
	function getAvatar($a){
		$R1 = mysql_query("SELECT * FROM users WHERE id='$a'");
		$c = mysql_fetch_assoc($R1);
		
		$foto = strpos($c['avatar'], 'assets');
		if($foto === false){ 
			echo $c['avatar']; 
		} else { 
			echo $site . '/' . $c['avatar']; 
		} 
	}
	
	function statisticUsers(){
		$R = mysql_query("SELECT COUNT(*) count FROM users");
		$R1 = mysql_fetch_assoc($R);
		echo $R1['count'];
	}
	
	function statisticIncidence(){
		$R = mysql_query("SELECT COUNT(*) count FROM users_reporteds WHERE hidden='no'");
		$R1 = mysql_fetch_assoc($R);
		echo $R1['count'];
	}
	
	function statisticQuestions(){
		$R = mysql_query("SELECT COUNT(*) count FROM users_comments");
		$R1 = mysql_fetch_assoc($R);
		echo $R1['count'];
	}
	
	function statisticCrushes(){
		$R = mysql_query("SELECT COUNT(*) count FROM users_likes");
		$R1 = mysql_fetch_assoc($R);
		echo $R1['count'];
	}
	
	function getUser($a){
		$R = mysql_query("SELECT * FROM users WHERE id='$a'");
		$R1 = mysql_fetch_assoc($R);
		echo $R1['username'];
	}
	
	function getStatusReport($a){
		$R = mysql_query("SELECT * FROM users_reporteds WHERE id='$a'");
		$R1 = mysql_fetch_assoc($R);
		if($R1['estado'] == 'pending'){
			echo '<span class="new badge #fbc02d yellow darken-2">Pendiente</span>';
		} elseif($R1['estado'] == 'resolved'){
			echo '<span class="new badge #43a047 green darken-1">Resuelto</span>';
		}
	}
	
	function GetUserRank($a){
		$uu_sql = mysql_query("SELECT * FROM users WHERE id='$a'");$u = mysql_fetch_assoc($uu_sql);
		
		$ss_sql = mysql_query("SELECT * FROM ranks WHERE id='$u[rank]'");
		$s = mysql_fetch_assoc($ss_sql);
		if($u['show_prefix'] == 'yes'){
			//echo $s['prefix'];
			echo '<x class="tooltipped" data-position="top" data-tooltip="'. $s[title] .'">' . $s[prefix] . '</x>';
		}
	}
	
	function MembersGroup($a){
		$R = mysql_query("SELECT COUNT(*) count FROM users WHERE category_id='$a'");
		$R1 = mysql_fetch_assoc($R);
		echo $R1['count'];
	}
	
	function UserCommentsLikes($a){
		$R = mysql_query("SELECT COUNT(*) count FROM users_comments_likes WHERE user_id_liked='$a'");
		$R1 = mysql_fetch_assoc($R);
		echo $R1['count'];
	}
	
?>