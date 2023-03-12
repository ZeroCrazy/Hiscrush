<?php
require 'inc/core.php';
$consultaBusqueda = Filter($_POST['valorBusqueda']);
$mensaje = "";

if(isset($consultaBusqueda)) {
	
	$x_verify = mysql_query("SELECT * FROM users WHERE username LIKE '%$consultaBusqueda%'");$x = mysql_fetch_assoc($x_verify);
	if($x['id']){
		echo '<style>.imagenperfil{background: url('. $x[avatar] .') '. $x[color] .' 50% !important;}</style>';
	} else {
		//echo 'no';
	}
	
}

//Devolvemos el mensaje que tomará jQuery
?>