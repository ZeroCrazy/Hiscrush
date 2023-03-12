<?php
	require '../inc/core.php';
?>
  <!DOCTYPE html>
  <html lang="es">
    <head>
	    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="theme-color" content="#6573cd">
		<title><?php echo $sitename; ?>: Panel de administraci&oacute;n</title>
		<link rel="icon" type="image/png" href="<?php echo $site; ?>/assets/images/favicon.png" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
		<link href="<?php echo $site . $folder_admin; ?>/style.css" rel="stylesheet">
		<link href="<?php echo $site; ?>/assets/css/all.min.css" rel="stylesheet"> 
	
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
	  <style>
		body {
			background: darkgrey;
		}
	  </style>
	  <script>
	    $(document).ready(function(){
			$('.sidenav').sidenav();
			$('.slider').slider({
				indicators: false
			});
			$('.modal').modal();
			$('.tabs').tabs();
			$('.tooltipped').tooltip();
			$(".dropdown-trigger").dropdown();
			$('.collapsible').collapsible({
				accordion: false
			});
			$('select').formSelect();
		});
	  function search() {
	    // Declare variables 
	    var input, filter, table, tr, td, i;
	    input = document.getElementById("input_search");
	    filter = input.value.toUpperCase();
	    table = document.getElementById("table_search");
	    tr = table.getElementsByTagName("tr");
      
	    // Loop through all table rows, and hide those who don't match the search query
	    for (i = 0; i < tr.length; i++) {
	  	td = tr[i].getElementsByTagName("td")[0];
	  	if (td) {
	  	  if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
	  		tr[i].style.display = "";
	  	  } else {
	  		tr[i].style.display = "none";
	  	  }
	  	} 
	    }
	  }
	  </script>
    </head>

    <body>
	<?php if (isset($_SESSION['admin'])) { 
	?>
  <nav>
    <div class="nav-wrapper">
	<div class="container">
      <a href="<?php echo $site . $folder_admin; ?>" class="brand-logo" style="text-align: center;font-weight: bold;text-transform: uppercase;font-size: 38px;color: #6573cd;padding-bottom: 10px;"><?php echo $sitename; ?></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
		<li><a href="<?php echo $site . $folder_admin; ?>/home.php">Inicio</a></li>
		<li><a href="<?php echo $site . $folder_admin; ?>/users.php">Usuarios</a></li>
		<li><a href="<?php echo $site . $folder_admin; ?>/reports.php">Incidencias</a></li>
		<li><a href="<?php echo $site . $folder_admin; ?>/logout.php">Salir</a></li>
	  </ul>
    </div>
    </div>
  </nav>
  
  <ul class="sidenav" id="mobile-demo">
	<li><a href="<?php echo $site . $folder_admin; ?>/home.php">Inicio</a></li>
	<li><a href="<?php echo $site . $folder_admin; ?>/users.php">Usuarios</a></li>
	<li><a href="<?php echo $site . $folder_admin; ?>/reports.php">Incidencias</a></li>
	<li><a href="<?php echo $site . $folder_admin; ?>/logout.php">Salir</a></li>
  </ul>


	<?php } ?>