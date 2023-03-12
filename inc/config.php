<?php
# Conexión al MySQL
$datos = array("Información del servidor", "localhost", "user", "pass", "db");
$conexion = mysql_connect (''. $datos[1] .'', ''. $datos[2] .'', ''. $datos[3] .'') or die ("No se ha podido conectar al servidor de Base de datos");
mysql_select_db (''. $datos[4] .'');
?>
