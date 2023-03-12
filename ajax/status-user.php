	  <?php require '../inc/core.php'; 
	  $ss_sql = mysql_query("SELECT * FROM users WHERE id='". Filter($_GET['id']) ."'");$s = mysql_fetch_assoc($ss_sql);
	  ?>
	<style>
	.statusUser {
		<?php echo status($s['id']); ?>
		width: 25px;
		border-radius: 100%;
		height: 25px;
		border: 2px solid #fff;
		margin-bottom: -13px;
		position: sticky;
		z-index: 140;
	}
	</style>
	<div class="statusUser"></div>