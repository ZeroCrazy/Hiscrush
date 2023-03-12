<?php $page='Home';require 'header.php'; ?>
<meta name="robots" content="index, follow">
<meta name="description" content="Descubre lo que la gente quiere saber sobre ti. ¡Haz preguntas y obten respuestas sobre cualquier tema!" />
<meta property="og:site_name" content="<?php echo $sitename; ?>" />
<meta property="og:type" content="website" />
<meta property="og:title" content="Pregunta y responde - <?php echo $sitename; ?>" />
<meta property="og:description" content="Descubre lo que la gente quiere saber sobre ti. ¡Haz preguntas y obten respuestas sobre cualquier tema!" />
<meta property="og:url" content="<?php echo $site; ?>" />
<meta name="turbolinks-cache-control" content="no-cache" />
<meta name="keywords" content="relacion,desamorio,preguntas,adolescentes,crushtag,tag,crush,love, relationships,teen,instagram,twitter,facebook,romance,crush y novio es lo mismo,crush y otras palabras,crush y platonico es lo mismo">
<!--meta property="og:image" content="https://d1muxuiltlupn6.cloudfront.net/assets/logo-preview-8de04b038ed54339d316d36c3f9ebb1fcae0fad398b7f968908d8e2d4ae20318.png" /-->
<script>
	  function frases_alea(){
		frases = new Array();
		frases[0] = "<?php echo $lang['first_txt']; ?>";
		frases[1] = "<?php echo $lang['second_txt']; ?>";
		var lon = frases.length;
		aleatorio=Math.round(Math.random()*(lon-1));
		return frases[aleatorio];
	  }

	  onload=function(){
	  	document.getElementById('randomessage').innerHTML=frases_alea();
	  	setInterval(function(){document.getElementById('randomessage').innerHTML=frases_alea();},3500)
	  }
</script>
  <div class="sub-header">
  <div class="container">
	<div class="row">
		<div class="col s12 m12 center">
			<span style="font-size: 2.92rem;font-weight: 600;" id="randomessage"></span>
			<p style="margin: 0px;margin-top: 5px;"><?php echo $lang['slogan']; ?></p>
			<p style="padding-bottom: 15px;margin: 0px;margin-top: 27px;margin-bottom: -27px;">
			  <form onsubmit = "this.action += '/username/'+search.value.split(' ').join('-')+''" method="POST" action="<?php echo $site; ?>/search">
			    <input class="search_local animated pulse infinite" autocomplete="off" id="search" name="search" placeholder="<?php echo $lang['search_crush']; ?>...">
			  </form>
			</p>
		</div>
	</div>
  </div>
  </div>
<div class="container">
  <div class="row">
    <div class="col s12 m4">
      <div class="card" style="box-shadow: none;">
        <div class="card-content black-text">
          <span class="card-title center" style="font-size: 44px;color: #515151;"><?php echo $lang['destacado']; ?></span>
          <span class="card-title center" style="font-weight: 400;font-size: 21px;color: <?php echo $colorsv; ?>;text-transform: uppercase;margin-top: -5px;"><?php echo $sitename; ?>es</span>
		  <div class="row">
		  <?php $c_sql = mysql_query("SELECT * FROM users WHERE NOT instagram_url='' ORDER BY RAND() LIMIT 9"); while($c = mysql_fetch_assoc($c_sql)){ ?>
		    <a href="<?php echo $site; ?>/~<?php echo $c['username']; ?>">
			<div class="input-field col s4">
				<center><div style="width: 66px;height: 66px;background: url('<?php echo $c['avatar']; ?>') 50%;background-size: cover;border-radius: 50%;"></div></center>
				<center><div style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;text-align: center;color: <?php if($c['color']){ echo $c['color']; } else { echo $colorsv; } ?>;font-size: 14px;"><?php if($c['verified']){ ?><i class="fal fa-badge-check tooltipped" data-position="top" data-tooltip="<?php echo $lang['verificado']; ?>"></i><?php } ?> <?php echo $c['username']; ?></div></center>
			</div>
			</a>
		  <?php } ?>
		  </div>
        </div>
      </div>
    </div>
    <div class="col s12 m4">
      <div class="card" style="box-shadow: none;">
        <div class="card-content black-text">
          <span class="card-title center" style="font-size: 44px;color: #515151;"><?php echo $lang['descubre']; ?></span>
		  <span class="card-title center" style="font-weight: 400;font-size: 21px;color: <?php echo $colorsv; ?>;text-transform: uppercase;margin-top: -5px;"><?php echo $lang['tu_crush']; ?></span>
		  <div class="row">
		  <?php $c_sql = mysql_query("SELECT * FROM users ORDER BY RAND() LIMIT 9"); while($c = mysql_fetch_assoc($c_sql)){ ?>
		    <a href="<?php echo $site; ?>/~<?php echo $c['username']; ?>">
			<div class="input-field col s4">
				<center><div style="width: 66px;height: 66px;background: url('<?php echo $c['avatar']; ?>') 50%;background-size: cover;border-radius: 50%;"></div></center>
				<center><div style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;text-align: center;color: <?php if($c['color']){ echo $c['color']; } else { echo $colorsv; } ?>;font-size: 14px;"><?php if($c['verified']){ ?><i class="fal fa-badge-check tooltipped" data-position="top" data-tooltip="<?php echo $lang['verificado']; ?>"></i><?php } ?> <?php echo $c['username']; ?></div></center>
			</div>
			</a>
		  <?php } ?>
		  </div>
        </div>
      </div>
    </div>
    <div class="col s12 m4">
      <div class="card" style="box-shadow: none;">
        <div class="card-content black-text">
          <span class="card-title center" style="font-size: 44px;color: #515151;"><?php echo $lang['celebridad']; ?></span>
		  <span class="card-title center" style="font-weight: 400;font-size: 21px;color: <?php echo $colorsv; ?>;text-transform: uppercase;margin-top: -5px;"><?php echo $lang['groups']; ?></span>
		  <div class="row">
		  <?php $c_sql = mysql_query("SELECT * FROM categories ORDER BY RAND() LIMIT 9"); while($c = mysql_fetch_assoc($c_sql)){ ?>
		    <a href="<?php echo $site; ?>/group/<?php echo $c['id']; ?>">
			<div class="input-field col s4">
				<center><div style="width: 66px;height: 66px;background: url('<?php echo $c['avatar']; ?>') 50%;background-size: cover;border-radius: 50%;"></div></center>
				<center><div style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;text-align: center;color: <?php if($c['color']){ echo $c['color']; } else { echo $colorsv; } ?>;font-size: 14px;"><?php if($c['verified']){ ?><i class="fal fa-badge-check tooltipped" data-position="top" data-tooltip="<?php echo $lang['verificado']; ?>"></i><?php } ?> <?php echo $c['title']; ?></div></center>
			</div>
			</a>
		  <?php } ?>
		  </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require 'footer.php'; ?>