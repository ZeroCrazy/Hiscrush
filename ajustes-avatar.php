<?php
	require 'inc/core.php';
	echo '
	<link rel="icon" type="image/png" href="<?php echo $site; ?>/assets/images/favicon.png" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<link href="'. $site .'/assets/css/all.min.css" rel="stylesheet"> 
	
	<!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<style>body {background: transparent !important;}</style>
	';
	echo "
		<script>
	    $(document).ready(function(){
			$('.sidenav').sidenav();
			$('.slider').slider({
				indicators: false
			});
			$('.modal').modal();
			$('.tabs').tabs();
			$('.tooltipped').tooltip();
			$('.dropdown-trigger').dropdown();
			$('.collapsible').collapsible({
				accordion: false
			});
			$('select').formSelect();
		});
		</script>
	";
	
	if(isset($_POST['submit'])){
		
		
	  if(isset($_SESSION['id'])){
		$file = $_POST['file'];
		$name = $_FILES['file']['name'];
		$temp = $_FILES['file']['tmp_name'];
		$size = $_FILES['file']['size'];
		$rand = mt_rand(0, 32);$random_number = md5($rand . time()); //random number
		$target_dir = 'assets/images/uploads/';
		$target_file = $target_dir . basename(utf16_2_utf8($_FILES['file']['name']));


		$partes_ruta = pathinfo(''. $temp .'/assets/images/uploads/'. $name .''); //dirname-basename-extension-filename
		$extension = $partes_ruta['extension'];
		
		if($partes_ruta['extension'] != 'png' && $partes_ruta['extension'] != 'PNG' && $partes_ruta['extension'] != 'jpg' && $partes_ruta['extension'] != 'jpeg' && $partes_ruta['extension'] != 'gif'){
			$msg = '
			<div class="card-panel teal lighten-2" style="width: 100%;background-color: '. $colorsv .' !important;color: white;padding: 7px;text-align: center;">'. $lang['ajustes_avatar_error1'] .'</div>
			';
		} else {
			if (file_exists($target_file)) {
				$msg = '
				<div class="card-panel teal lighten-2" style="width: 100%;background-color: '. $colorsv .' !important;color: white;padding: 7px;text-align: center;">'. $lang['ajustes_avatar_error2'] .' '. $name .'</div>
				';
			} else {
				move_uploaded_file($temp,"assets/images/uploads/".$random_number.'.'.$extension);
				//move_uploaded_file($temp, $target_file);
				$url = "$_SERVER[REQUEST_SCHEME]://$_SERVER[HTTP_HOST]/$target_dir$random_number.$extension";
				$url2 = "$target_dir$random_number.$extension";
				//mysql_query("INSERT INTO uploads (name,size,url,date_upload) VALUES ('$name','$size','$url','". date(Y) ."-". date(m) ."-". date(d) ." ". date(H) .":". date(i) .":". date(s) ."')"); // El tamaño son Bytes
				mysql_query("UPDATE users SET avatar='$url2', last_avatar='$url2' WHERE id='$user[id]'");
				$msg = '
				<div class="card-panel teal lighten-2" style="width: 100%;background-color: '. $colorsv .' !important;color: white;padding: 7px;text-align: center;">'. $lang['ajustes_avatar_ok'] .'</div>
				';
			}	
		}
	  }


	}
?>
	  <div class="row" style="margin: 0px;">
		<div class="input-field col s12 m12">
<?php echo $msg; ?>
  <form method="post" enctype="multipart/form-data">
    <div class="file-field input-field">
      <div class="btn" style="background: <?php echo $colorsv; ?>;">
        <span>File</span>
        <input type="file" name="file" required>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" required>
      </div>
	  <br><br><br><br>
	  <div>
			  <button class="btn waves-effect waves-light" style="width: 100%;background: <?php echo $colorsv; ?>;" name="submit" type="submit"><?php echo $lang['ajustes_avatar_button']; ?>
				<i class="material-icons right">send</i>
			  </button>
	  </div>
    </div>
  </form>
			
			
		</div>
	  </div>