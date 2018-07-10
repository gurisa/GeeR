<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <?php include("functions.php"); ?>
  <?php echo show_meta_tag("suara"); ?>
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
        <h2 style="margin-bottom:20px;">Suara Genta</h2>
        <?php if(!check_votes()) { ?>
        <p styel="text-align:justify;">
          Suara Genta tidak tersedia, Suara Genta merupakan gabungan suara kita semua.<br />
          Tambahkan suaramu di <a href="<?php echo get_home_page(); ?>suaraku/" title="Suaraku">Suaraku</a>.
        </p>
        <?php } else { ?>
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#minggu-ini" aria-controller="minggu-ini" role="tab" data-toggle="tab" title="Populer Minggu Ini">Populer Minggu Ini</a></li>
          <li role="presentation"><a href="#sepanjang-survei" aria-controller="sepanjang-survei" role="tab" data-toggle="tab" title="Populer Sepanjang Survei">Populer Sepanjang Survei</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="minggu-ini" role="tabpanel">
            <?php $vote = get_vote_result("week"); $total_vote = array_sum($vote); ?>
            <?php if ($vote) { ?>
            <?php while (($index = current($vote)) !== FALSE) { ?>
            <?php $curr_vote = round(((current($vote) / $total_vote) * 100),2); ?>
            <div class="row">
              <div class="col-xs-4">
                  <?php echo get_music_title_by_id(key($vote)); ?>
              </div>
              <div class="col-xs-8">
                <div class="progress">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $curr_vote; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $curr_vote; ?>%;">
                    <span class="sr-only">60% Complete</span>
                  </div>
                </div>
              </div>
            </div>
            <?php next($vote); ?>
            <?php } ?>
            <?php } else { ?>
            <p style="text-align:justify;">
              Belum ada suara minggu ini, <br />
              Silahkan tambahkan suaramu di
              <a href="<?php echo get_home_page(); ?>suaraku/" title="Suaraku">Suaraku</a><br />
            </p>
            <?php } ?>
          </div>
          <div class="tab-pane" id="sepanjang-survei" role="tabpanel">
            <?php $vote = get_vote_result("all"); $total_vote = array_sum($vote); ?>
            <?php if ($vote) { ?>
            <?php while (($index = current($vote)) !== FALSE) { ?>
            <?php $curr_vote = round(((current($vote) / $total_vote) * 100),2); ?>
            <div class="row">
              <div class="col-xs-4">
                  <?php echo get_music_title_by_id(key($vote)); ?>
              </div>
              <div class="col-xs-8">
                <div class="progress">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $curr_vote; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $curr_vote; ?>%;">
                    <span class="sr-only">60% Complete</span>
                  </div>
                </div>
              </div>
            </div>
            <?php next($vote); ?>
            <?php } ?>
            <?php } else { ?>
            <p style="text-align:justify;">
              Belum ada suara untuk vote minggu ini. <br />
              Silahkan tambahkan suaramu di
              <a href="<?php echo get_home_page(); ?>suaraku/" title="Suaraku">Suaraku</a><br />
            </p>
            <?php } ?>
          </div>
        </div>

        <?php } ?>
      </div>
    </main>

    <?php get_page_part('footer.php','include'); ?>
  </div>
</body>
</html>
<?php close_connection(); ?>
