<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<?php include("functions.php"); ?>
	<?php echo show_meta_tag("index"); ?>
	<?php get_page_part('meta.php','include'); ?>
	<link rel="icon" type="image/x-icon" href="<?php echo get_home_page(); ?>src/img/favicon.ico" />
</head>
<body>
	<?php include_once("src/tracking/google-analytics.php"); ?>
	<?php include_once("src/tracking/self-tracking.php"); ?>
  <div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 menu-landing landing-merah center-block">
				<a href="<?php echo get_home_page(); ?>dispenkasi/" title="DISPENKASI 30">DISPENKASI</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 menu-landing landing-kuning center-block">
				<a href="<?php echo get_home_page(); ?>barang/" title="Data Barang" >Data Barang</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 menu-landing landing-hijau center-block">
				<a href="<?php echo get_home_page(); ?>suaraku/" title="Suaraku">Suaraku</a>
			</div>
		</div>
	</div>
</body>
</html>
