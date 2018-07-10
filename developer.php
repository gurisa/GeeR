<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <?php include("functions.php"); ?>
  <?php echo show_meta_tag("developer"); ?>
	<?php get_page_part('meta.php','include'); ?>
  <link rel="icon" type="image/x-icon" href="<?php echo get_home_page(); ?>src/img/favicon.ico" />
</head>
<body>
  <?php include_once("src/tracking/google-analytics.php"); ?>
  <?php include_once("src/tracking/self-tracking.php"); ?>
  <div class="container content">
    <?php get_page_part('header.php','include'); ?>
    <main>
      <h3>Pengembang</h3>
      <div class="row">
        <div class="col-md-12">
          <p style="text-align:justify; margin:20px 0px 20px 0px;">
            Gurisa Developers didirikan pada 5 Mei 2015, Gurisa Developers adalah salah satu pengembang yang berfokus pada pembangunan teknologi digital meliputi aspek teknologi masa lalu, masa kini dan teknologi yang akan datang. Dengan berorientasi kepada aspek pengembangan Software, Hardware, Network, dan Development Gurisa Developers mempunyai salah satu tujuan utama yakni membantu perkembangan masyarakat dunia, khususnya Indonesia dalam menghadapi perkembangan teknologi yang kian pesat nya.
          </p>
        </div>
      </div>
      <h3>Kontak</h3>
      <div class="row">
        <div class="col-md-6">
          <p style="text-align:justify; margin:20px 0px 20px 0px;">
            <h4>Website</h4>
            <ul>
              <li><a href="https://www.gurisa.com" target="_blank" title="Gurisa Developers">Gurisa Developers</a></li>
            </ul>
            <h4>Facebook</h4>
            <ul>
              <li><a href="https://www.facebook.com/Raka.S.W" target="_blank" title="Raka Suryaardi Widjaja">Raka Suryaardi Widjaja</a></li>
              <li><a href="https://www.facebook.com/GurisaDevs" target="_blank" title="Gurisa Developers">Gurisa Developers</a></li>
            </ul>
            <h4>Twitter</h4>
            <ul>
              <li><a href="https://www.twitter.com/Raka_S" target="_blank" title="Raka Suryaardi Widjaja">Raka Suryaardi Widjaja</a></li>
              <li><a href="https://www.twitter.com/GurisaDevs" target="_blank" title="Gurisa Developers">Gurisa Developers</a></li>
            </ul>
          </p>
        </div>
        <div class="col-md-6">
          <h4>Email</h4>
          <ul>
            <li><a href="mailto:raka.suryadi@gmail.com" target="_blank" title="Raka Suryaardi Widjaja">Raka Suryaardi Widjaja</a></li>
            <li><a href="mailto:admin@gurisa.com" target="_blank" title="Gurisa Developers">Gurisa Developers</a></li>
          </ul>
          <h4>Phone</h4>
          <ul>
            <li><a href="#">(+62)87 825 720 207</a></li>
          </ul>
        </div>
      </div>
    </main>

    <?php get_page_part('footer.php','include'); ?>
  </div>

</body>
</html>
<?php close_connection(); ?>
