<?php
	require 'inc/core.php';
	header('Content-type: text/xml');
	echo '<?xml version="1.0" encoding="UTF-8"?>
<!-- created by '. $sitename .' -->';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc><?php echo $site; ?>/home</loc>
		<lastmod><?php echo date(Y); ?>-<?php echo date(m); ?>-<?php echo date(d); ?></lastmod>
		<priority>1.00</priority>
	</url>
	<url>
		<loc><?php echo $site; ?>/login</loc>
		<lastmod><?php echo date(Y); ?>-<?php echo date(m); ?>-<?php echo date(d); ?></lastmod>
		<priority>0.73</priority>
	</url>
	<url>
		<loc><?php echo $site; ?>/logout</loc>
		<lastmod><?php echo date(Y); ?>-<?php echo date(m); ?>-<?php echo date(d); ?></lastmod>
		<priority>0.73</priority>
	</url>
	<url>
		<loc><?php echo $site; ?>/register</loc>
		<lastmod><?php echo date(Y); ?>-<?php echo date(m); ?>-<?php echo date(d); ?></lastmod>
		<priority>0.73</priority>
	</url>
	<url>
		<loc><?php echo $site; ?>/ajustes</loc>
		<lastmod><?php echo date(Y); ?>-<?php echo date(m); ?>-<?php echo date(d); ?></lastmod>
		<priority>0.73</priority>
	</url>
	<url>
		<loc><?php echo $site; ?>/search/</loc>
		<lastmod><?php echo date(Y); ?>-<?php echo date(m); ?>-<?php echo date(d); ?></lastmod>
		<priority>0.03</priority>
	</url>
	<?php $cc = mysql_query("SELECT * FROM users ORDER BY RAND()"); while($c = mysql_fetch_assoc($cc)){ ?>
	<url>
		<loc><?php echo $site; ?>/~<?php echo $c['username']; ?></loc>
		<lastmod><?php echo date(Y); ?>-<?php echo date(m); ?>-<?php echo date(d); ?></lastmod>
		<priority>0.07</priority>
	</url>
	<?php } ?>
	<?php $cc = mysql_query("SELECT * FROM categories ORDER BY RAND()"); while($c = mysql_fetch_assoc($cc)){ ?>
	<url>
		<loc><?php echo $site; ?>/group/<?php echo $c['id']; ?></loc>
		<lastmod><?php echo date(Y); ?>-<?php echo date(m); ?>-<?php echo date(d); ?></lastmod>
		<priority>0.03</priority>
	</url>
	<?php } ?>
</urlset>