<?php require 'header.php'; 
	if (isset($_SESSION['admin'])) {} else { header("Location: login.php"); }
	
?>
<div class="container">
  <div class="row">
    <div class="col s12 m3">
      <div class="card #43a047 green darken-1">
        <div class="card-content">
          <span class="card-title white-text center" style="font-weight: bold;font-size: 40px;"><?php echo statisticUsers(); ?></span>
		  <span class="card-title white-text center">Usuarios</span>
        </div>
      </div>
	  
      <div class="card #0288d1 light-blue darken-2">
        <div class="card-content">
          <span class="card-title white-text center" style="font-weight: bold;font-size: 40px;"><?php echo statisticQuestions(); ?></span>
		  <span class="card-title white-text center">Preguntas</span>
        </div>
      </div>
    </div>
	<div class="col s12 m3">
      <div class="card #fbc02d yellow darken-2">
        <div class="card-content">
          <span class="card-title white-text center" style="font-weight: bold;font-size: 40px;"><?php echo statisticIncidence(); ?></span>
		  <span class="card-title white-text center">Incidencias</span>
        </div>
      </div>
	  
      <div class="card #5e35b1 deep-purple darken-1">
        <div class="card-content">
          <span class="card-title white-text center" style="font-weight: bold;font-size: 40px;"><?php echo statisticCrushes(); ?></span>
		  <span class="card-title white-text center">Crushes</span>
        </div>
      </div>
    </div>
	<div class="col s12 m6">
      <div class="card">
        <div class="card-content">
		  <span class="card-title">Últimos 30 comentarios</span>
			<div style="height: 334px;overflow-y: scroll;">
			<ul class="collection">
			<?php $p_sql = mysql_query("SELECT * FROM users_comments ORDER BY id DESC LIMIT 30"); while($p = mysql_fetch_assoc($p_sql)){ ?>
			  <li class="collection-item"><a href="<?php echo $site; ?>/~<?php echo getUser($p['user_commented']); ?>"><?php echo getUser($p['user_commented']); ?></a><br><?php echo $p['content']; ?></li>
			<?php } ?>
			</ul>
			</div>
        </div>
      </div>
    </div>
  </div>
</div>