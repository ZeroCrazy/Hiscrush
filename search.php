<?php $page = $_GET['search'];require 'header.php'; 
$search = Filter($_GET['search']);
$type = Filter($_GET['type']);

if($type == 'group'){
	$sqlb = "SELECT * FROM categories WHERE title LIKE '%$search%' ORDER BY RAND()";
} elseif($type == 'username'){
	$sqlb = "SELECT * FROM users WHERE username LIKE '%$search%' ORDER BY RAND()";
}

//$ss_sql = mysql_query("SELECT * FROM users WHERE username='". $usuario ."'");$s = mysql_fetch_assoc($ss_sql);
?>
  <div class="sub-header">
  <div class="container">
	<div class="row">
		<div class="col s12 m12 center">
			<h3 style="margin-bottom: 5px;"><?php echo $lang['title_searched']; ?></h3>
			<?php if($search){ ?><p style="margin: 0px;margin-top: 5px;"><?php echo $lang['searched']; ?> <b><?php echo $search; ?></b></p><?php } ?>
			<br>
			<a style="background: #000;box-shadow: none;color: #fff;" href="<?php echo $site; ?>/search/group<?php if($search){ echo '/' . $search; } ?>" class="waves-effect waves-light btn"><?php echo $lang['search_group']; ?></a>
			<a style="background: #fff;box-shadow: none;color: <?php echo $colorsv; ?>;" href="<?php echo $site; ?>/search/username<?php if($search){ echo '/' . $search; } ?>" class="waves-effect waves-light btn"><?php echo $lang['search_crush']; ?></a><br>
			<p style="margin: 0px;margin-top: 20px;"><form style="margin-bottom: -50px;" onsubmit = "this.action += '/<?php if($type == 'group'){ echo 'group'; } else { echo 'username'; } ?>/'+search.value.split(' ').join('-')+''" method="POST" action="<?php echo $site; ?>/search"><input class="search_local animated pulse infinite" autocomplete="off" id="search" value="<?php echo $search; ?>" name="search" placeholder="<?php if($type == 'group'){ echo $lang['search_group']; } else { echo $lang['search_crush']; } ?>..." autofocus></form></p>
		</div>
	</div>
  </div>
  </div>
<?php if($search){ ?>
<div class="container">
  <div class="row">
    <div class="col s12 m12">
      <div class="card" style="box-shadow: none;">
        <div class="card-content black-text">
          <span class="card-title center" style="font-size: 44px;color: #515151;"><?php echo $lang['descubre']; ?></span>
		  <span class="card-title center" style="font-weight: 400;font-size: 21px;color: <?php echo $colorsv; ?>;text-transform: uppercase;margin-top: -5px;"><?php echo $lang['tu_crush']; ?></span>
		  <div class="row">
		  <?php $c_sql = mysql_query($sqlb); while($c = mysql_fetch_assoc($c_sql)){ ?>
		    <?php if($type == 'username'){ ?>
			<a href="<?php echo $site; ?>/~<?php echo $c['username']; ?>">
			<div class="input-field col s4 m2">
			<?php $foto = strpos($c['avatar'], 'assets'); ?>
				<center><div style="width: 66px;height: 66px;background: url('<?php echo getAvatar($c['id']); ?>') 50%;background-size: cover;border-radius: 50%;"></div></center>
				<center><div style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;text-align: center;color: <?php if($c['color']){ echo $c['color']; } else { echo $colorsv; } ?>;font-size: 14px;"><?php if($c['verified']){ ?><i class="fal fa-badge-check tooltipped" data-position="top" data-tooltip="<?php echo $lang['verificado']; ?>"></i><?php } ?> <?php echo $c['username']; ?></div></center>
			</div>
			</a>
			<?php } else { ?>
			<a href="<?php echo $site; ?>/group/<?php echo $c['id']; ?>">
			<div class="input-field col s4 m2">
				<center><div style="width: 66px;height: 66px;background: url('<?php echo $site; ?>/<?php echo $c['avatar']; ?>') 50%;background-size: cover;border-radius: 50%;"></div></center>
				<center><div style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;text-align: center;color: <?php if($c['color']){ echo $c['color']; } else { echo $colorsv; } ?>;font-size: 14px;"><?php if($c['verified']){ ?><i class="fal fa-badge-check tooltipped" data-position="top" data-tooltip="<?php echo $lang['verificado']; ?>"></i><?php } ?> <?php echo $c['title']; ?></div></center>
			</div>
			</a>
			<?php } ?>
		  <?php } ?>
		  </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>
<?php require 'footer.php'; ?>