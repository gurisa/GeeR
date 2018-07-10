<hr class="seperator" />
<footer>
  <div class="row">
    <div class="col-md-4">
      <h1 class="footer">GeeR</h1>
      <p>Copyright &copy; 2016 Gurisa.Com All Rights Reserved</p>
      <p>Author: <a href="https://www.gurisa.com/about/" title="Raka Suryaardi Widjaja" target="_blank">Raka Suryaardi Widjaja</a></p>
      <p>Developed by: <a href="https://www.gurisa.com/" title="Gurisa" target="_blank">Gurisa</a></p>
    </div>
    <div class="col-md-4">
      <h2 class="footer">Peta Situs</h2>
      <ul class="sitemap">
        <li><a href="<?php echo get_home_page(); ?>">Halaman Awal</a></li>
        <li><a href="<?php echo get_home_page(); ?>dispenkasi/">DISPENKASI</a></li>
        <li><a href="<?php echo get_home_page(); ?>barang/">Data Barang</a></li>
        <li><a href="<?php echo get_home_page(); ?>suaraku/">Suaraku</a></li>
        <li><a href="<?php echo get_home_page(); ?>suara/">Suara Genta</a></li>
        <li><a href="<?php echo get_home_page(); ?>developer/">Pengembang</a></li>
      </ul>
    </div>
    <div class="col-md-4">
      <h2 class="footer">Kutipan</h2>
      <blockquote class="kutipan">
        <?php $quote = get_quote(); echo $quote[0]['quote_content']; ?>
        <footer>
        <?php
          if (!empty($quote[0]['quote_source'])) {
            echo $quote[0]['quote_source'] . " | ";
          }
          echo $quote[0]['quote_author'];
        ?>
        </footer>
      </blockquote>
    </div>
  </div>
</footer>

<script data-cfasync="false" src="<?php echo get_home_page(); ?>src/bootstrap/js/jquery.js" language="JavaScript"></script>
<script data-cfasync="false" src="<?php echo get_home_page(); ?>src/jquery-ui/jquery-ui.js" language="JavaScript"></script>
<script data-cfasync="false" src="<?php echo get_home_page(); ?>src/bootstrap/js/bootstrap.js" language="JavaScript"></script>
<script data-cfasync="false" src="<?php echo get_home_page(); ?>src/sweetalert/sweetalert-dev.js"></script>
<script data-cfasync="false" src="<?php echo get_home_page(); ?>style.js"></script>
