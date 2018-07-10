<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <?php include("functions.php"); ?>
  <?php echo show_meta_tag("suaraku"); ?>
	<?php get_page_part('meta.php','include'); ?>
  <link rel="icon" type="image/x-icon" href="<?php echo get_home_page(); ?>src/img/favicon.ico" />
</head>
<body>
  <?php include_once("src/tracking/google-analytics.php"); ?>
  <?php include_once("src/tracking/self-tracking.php"); ?>
  <div class="container content">
    <?php get_page_part('header.php','include'); ?>

    <main class="row">
      <div class="col-md-12">
        <h2>Suaraku</h2>
        <?php
          if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nama"]) && isset($_POST["asal"])) {
        ?>
          <p style="text-align:justify;">
            Suara kamu sudah kami terima, terima kasih atas partisipasinya. <br />
            Suaramu dapat kamu lihat di
            <a href="<?php echo get_home_page(); ?>suara.php" title="Suara Genta">Suara Genta</a><br />
            Kamu juga dapat mengirimkan kembali suaramu di
            <a href="<?php echo get_home_page(); ?>suaraku.php" title="Suaraku">Suaraku</a><br />
          </p>
          <meta http-equiv="refresh" content="7; url=<?php echo get_home_page(); ?>suara.php" />
        <?php
          }
          else { ?>
        <p style="text-align:justify;">
          Pilih nyanyian pujian kesukaanmu sekarang juga.
        </p>
        <!-- <p style="font-weight:bold; text-align:justify; margin-top:30px;">Dong Xiu <?php echo get_dong_xiu_date(""); ?></p> -->
        <div class="form-suara">
          <form class="form-group" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="suara-genta" id="suara-genta">
            <div class="row">
              <div class="col-md-6">
                <label for="nama">Nama :</label>
                <input type="text" id="nama" name="nama" class="form-control" placeholder="Tulis nama" />
                <label for="nama">Asal RAKIN/PAKIN/MAKIN :</label>
                <input type="text" id="asal" name="asal" class="form-control" placeholder="Tulis asal RAKIN/PAKIN/MAKIN" />

              </div>
              <div class="col-md-6">
                <label for="saran">Kritik dan Saran :</label>
                <textarea class="form-control" id="saran" rows="5" name ="saran" placeholder="Biarkan kosong jika tidak ada kritik dan saran.." ></textarea>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <b>Pilih Nyanyian Pujian :</b>
                <?php $musics = show_musics(); ?>
                <?php for ($i=1; $i <=3; $i++) { ?>
                <select class="form-control margin-top-10" name="lagu_<?php echo $i; ?>" id="lagu_<?php echo $i; ?>">
                  <?php for ($k=0; $k < count($musics); $k++) { ?><option value="<?php echo $musics[$k]['music_id']; ?>"><?php echo $musics[$k]['music_title']; ?></option><?php } ?>
                </select>
                <?php } ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <br />
                <input type="submit" class="btn btn-danger btn-lg pull-right" value="Kirim"  />
              </div>
            </div>

          </form>
        </div>
        <?php } ?>
      </div>
    </main>

    <?php get_page_part('footer.php','include'); ?>
    <script data-cfasync="false" type="text/javascript" language="javascript">var home_page = "<?php echo get_home_page() ?>";</script>
    <script data-cfasync="false" type="text/javascript" language="javascript" src="<?php echo get_home_page() ?>src/easyautocomplete/jquery.easy-autocomplete.js"></script>

    <?php
      if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["nama"]) && isset($_POST["asal"])) {
        $nama = anti_injection($_POST["nama"]);
        $asal = anti_injection($_POST["asal"]);
        $saran = anti_injection($_POST["saran"]);
        $lagu_1 = anti_injection($_POST["lagu_1"]);
        $lagu_2 = anti_injection($_POST["lagu_2"]);
        $lagu_3 = anti_injection($_POST["lagu_3"]);
        $dongxiu = get_dong_xiu_date("YYYY-MM-DD");
        $tanggal = date("Y-m-d");
        $waktu = date("H:i:s");
        $qry = "INSERT INTO tb_votes (vote_name, vote_origin, vote_suggests, vote_choice_1, vote_choice_2, vote_choice_3, dongxiu_date, vote_date, vote_time) VALUES ('$nama', '$asal', '$saran', '$lagu_1', '$lagu_2', '$lagu_3', '$dongxiu', '$tanggal', '$waktu')";
        $try = mysql_query($qry) or die (mysql_error());
        if ($try) {
    ?>
        <script data-cfasync="false" type="text/javascript" language="javascript">success_submit_form_suara();</script>
    <?php
        }
        else {
          echo "Gagal mengirimkan suara.";
        }
      }
    ?>
  </div>
</body>
</html>
<?php close_connection(); ?>
