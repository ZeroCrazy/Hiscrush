<?php 
	require '../inc/core.php'; 
	mysql_query("UPDATE users SET last_on='". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."' WHERE id='$user[id]'");
?>