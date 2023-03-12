<?php require 'header.php'; 
	if (isset($_SESSION['admin'])) {} else { header("Location: login.php"); }
	$ss_sql = mysql_query("SELECT * FROM users_reporteds WHERE id='". Filter($_GET[id]) ."'");$s = mysql_fetch_assoc($ss_sql);
?>
<?php if($_GET['id']){ ?>
<?php
	if(isset($_POST['resolved'])){
			if($s['estado'] == 'resolved'){
				echo "<script>M.toast({html: 'La denuncia ya está resuelta', displayLength: '2500'});</script>";
			} else {
				mysql_query("UPDATE users_reporteds SET estado='resolved' WHERE id='$s[id]'");
				header("Location: ". $site . $folder_admin ."/reports.php?id=$s[id]");	
			}
	}
	
	if(isset($_POST['delete'])){
			if($s['estado'] == 'pending'){
				echo "<script>M.toast({html: 'No puedes borrar una denuncia pendiente', displayLength: '2500'});</script>";
			} else {
				mysql_query("UPDATE users_reporteds SET hidden='yes' WHERE id='$s[id]'");
				header("Location: ". $site . $folder_admin ."/reports.php");	
			}
	}
?>
<div class="container">
  <div class="row">	
	<div class="col s12 m12">
<div class="row" style="margin-bottom: 0px;">
  <div class="input-field col s12 m6" style="margin: 0px;">
    <a href="<?php echo $site . $folder_admin; ?>/users.php?id=<?php echo $s['user_id']; ?>">
	<div class="card-panel" style="margin-bottom: 0px;padding: 10px;background: <?php echo $colorsv; ?>;">
    	<span class="white-text" style="font-size: 16px;"><center>Denunciante: <b><?php echo getUser($s['user_id']); ?></b></center></span>
    </div>
	</a>
  </div>
  <div class="input-field col s12 m6" style="margin: 0px;">
    <a href="<?php echo $site . $folder_admin; ?>/users.php?id=<?php echo $s['user_id_reported']; ?>">
	<div class="card-panel" style="margin-bottom: 0px;padding: 10px;background: <?php echo $colorsv; ?>;">
    	<span class="white-text" style="font-size: 16px;"><center>Reportado: <b><?php echo getUser($s['user_id_reported']); ?></b></center></span>
    </div>
	</a>
  </div>
</div>
<div class="row" style="margin-bottom: 0px;">
    <div class="input-field col s12 m4" style="margin: 0px;">
      <?php
		if($s['estado'] == 'pending'){
			echo '<div class="card center #fbc02d yellow darken-2"><div class="card-content"><span class="card-title white-text">Pendiente</span></div></div>';
		} elseif($s['estado'] == 'resolved'){
			echo '<div class="card center #43a047 green darken-1"><div class="card-content"><span class="card-title white-text">Resuelto</span></div></div>';
		}
	  ?>
    </div>
	<div class="input-field col s12 m8" style="margin: 0px;">
	  <div class="card center">
		<div class="card-content">
			<span class="card-title"><?php echo $s['reason']; ?></span>
		</div>
	  </div>
    </div>
</div>
      <div class="card">
        <div class="card-content black-text">
		  <textarea style="width: 100%;height: 400px;" disabled><?php echo $s['content']; ?></textarea>
        </div>
      </div>
	  <div class="row">
		<div class="input-field col s12 m4" style="margin: 2px 0px;">
		  <a href="<?php echo $site . $folder_admin; ?>/reports.php" class="btn waves-effect waves-light" style="width: 100%;background: <?php echo $colorsv; ?>;">Volver atrás</a>
        </div>
		<div class="input-field col s12 m4" style="margin: 2px 0px;">
		  <form method="POST"><button <?php if($s['estado'] == 'pending'){ echo 'disabled '; } ?>name="delete" class="btn waves-effect waves-light #b71c1c red darken-4" style="width: 100%;" type="submit">Borrar</button></form>
        </div>
		<div class="input-field col s12 m4" style="margin: 2px 0px;">
		  <form method="POST"><button <?php if($s['estado'] == 'resolved'){ echo 'disabled '; } ?>name="resolved" class="btn waves-effect waves-light #43a047 green darken-1" style="width: 100%;" type="submit">Marcar como resuelto</button></form>
        </div>
	  </div>
    </div>
  </div>
</div>
<?php } else { ?>
<div class="container">
  <div class="row">
    <div class="col s12 m12">
    <div class="row">
      <div class="col s12 m12">
        <div class="card">
          <div class="card-content black-text">
			<table class="striped centered responsive-table" id="table_search">
			  <thead>
			  <tr>
				  <th>Usuario reportado</th>
				  <th>Estado</th>
				  <th>Razón</th>
				  <th>Fecha</th>
				  <th>Opciones</th>
			  </tr>
			  </thead>
			  <tbody>
				<?php $p_sql = mysql_query("SELECT * FROM users_reporteds WHERE hidden='no' ORDER BY id DESC"); while($p = mysql_fetch_assoc($p_sql)){ ?>
				<tr>
						<td><a style="color: <?php echo $colorsv; ?>;" href="<?php echo $site . $folder_admin; ?>/users.php?id=<?php echo $p['user_id_reported']; ?>"><?php echo getUser($p['user_id_reported']); ?></a></td>
						<td><?php echo getStatusReport($p['id']); ?></td>
						<td><?php echo $p['reason']; ?></td>
						<td><?php echo hace_cuanto($ahora, $p['date_reg']); ?></td>
						<td>
						<a href="<?php echo $site . $folder_admin; ?>/reports.php?id=<?php echo $p['id']; ?>" style="background: <?php echo $colorsv; ?>;width: auto;padding: 0px 7px;border: none;margin-right: 3px;" class="waves-effect waves-light btn"><i class="material-icons">arrow_forward</i></a>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
          </div>
        </div>
      </div>
    </div>
	</div>
	</div>
</div>
<?php } ?>