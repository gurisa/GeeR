<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<?php include("functions.php"); ?>
	<?php echo show_meta_tag("index"); ?>
	<?php get_page_part('meta.php','include'); ?>
	<link rel="icon" type="image/x-icon" href="<?php echo get_home_page(); ?>src/img/favicon.ico" />
  <title>GeeR - Genta Rohani | Terjadi Kesalahan</title>
</head>
<body>
	<?php include_once("src/tracking/google-analytics.php"); ?>
	<?php include_once("src/tracking/self-tracking.php"); ?>
  <div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 error-landing landing-merah center-block">
				<a href="<?php echo get_home_page(); ?>" title="GeeR">Oops terjadi sesuatu..</a>
			</div>
		</div>
	</div>
</body>
</html>
<?php close_connection(); ?>
