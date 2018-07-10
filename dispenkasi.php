<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <?php include("functions.php"); ?>
  <?php echo show_meta_tag("dispenkasi"); ?>
	<?php get_page_part('meta.php','include'); ?>
  <link rel="icon" type="image/x-icon" href="<?php echo get_home_page(); ?>src/img/dispenkasi.ico" />
  <link rel="stylesheet" href="<?php echo get_home_page(); ?>src/icheck/skins/square/red.css" />
  <link rel="stylesheet" href="<?php echo get_home_page(); ?>src/select2/css/select2.css" />
  <link rel="stylesheet" href="<?php echo get_home_page(); ?>src/select2/css/themes/select2-bootstrap.css" />
  <link rel="stylesheet" href="<?php echo get_home_page(); ?>src/tooltip/tooltip-2.css" />
</head>
<body>
  <?php include_once("src/tracking/google-analytics.php"); ?>
  <?php include_once("src/tracking/self-tracking.php"); ?>
  <div class="container content">
    <?php get_page_part('header.php','include'); ?>
    <main class="row panel-group">
      <div class="col-md-3">
        <div class="panel panel-default">
          <ul class="nav nav-pills nav-stacked" role="tablist">
            <li role="presentation" class="active"><a aria-controller="sambutan" role="tab" data-toggle="tab" title="Sambutan DISPENKASI 30" href="#sambutan"><span class="glyphicon glyphicon-fire"></span>&nbsp; Sambutan</a></li>
            <li role="presentation" id="buka-panduan"><a aria-controller="panduan" role="tab" data-toggle="tab" title="Panduan DISPENKASI 30" href="#panduan"><span class="glyphicon glyphicon-random"></span>&nbsp; Panduan</a></li>
            <li role="presentation"><a aria-controller="pengumuman" role="tab" data-toggle="tab" title="Pengumuman DISPENKASI 30" href="#pengumuman"><span class="glyphicon glyphicon-bullhorn"></span>&nbsp; Pengumuman</a></li>
            <li role="presentation"><a aria-controller="galeri" role="tab" data-toggle="tab" title="Galeri DISPENKASI 30" href="#galeri"><span class="glyphicon glyphicon-picture"></span>&nbsp; Galeri</a></li>
            <?php if (!sudah_masuk($_SESSION)) { ?>
            <li role="presentation"><a aria-controller="daftar" role="tab" data-toggle="tab" title="Daftar DISPENKASI 30" href="#daftar"><span class="glyphicon glyphicon-briefcase"></span>&nbsp; Daftar</a></li>
            <li role="presentation"><a aria-controller="masuk" role="tab" data-toggle="tab" title="Masuk DISPENKASI 30" href="#masuk"><span class="glyphicon glyphicon-globe"></span>&nbsp; Masuk</a></li>
            <?php } else if (sudah_masuk($_SESSION)) { ?>
            <li role="presentation"><a aria-controller="pengaturan" role="tab" data-toggle="tab" title="Pengaturan DISPENKASI 30" href="#pengaturan"><span class="glyphicon glyphicon-cog"></span>&nbsp; Pengaturan</a></li>
            <li role="presentation">
              <a aria-controller="peserta" role="tab" data-toggle="tab" title="Peserta DISPENKASI 30" href="#peserta">
                 <span class="glyphicon glyphicon-folder-open"></span>&nbsp; Peserta
                <?php if (has_participants($_SESSION["email"])) { ?>
                  <span class="badge"><?php echo count_participants($_SESSION["email"]); ?></span>
                <?php } ?>
              </a>
            </li>
            <li role="presentation"><a aria-controller="transaksi" role="tab" data-toggle="tab" title="Transaksi DISPENKASI 30" href="#transaksi"><span class="glyphicon glyphicon-book"></span>&nbsp; Transaksi</a></li>

            <?php if (is_authorities($_SESSION["email"], "admin_page")) { ?>
            <li role="presentation"><a aria-controller="pengurus" role="tab" data-toggle="tab" title="Pengurus DISPENKASI 30" href="#pengurus"><span class="glyphicon glyphicon-star-empty"></span>&nbsp; Pengurus</a></li>
            <li role="presentation"><a aria-controller="laporan" role="tab" data-toggle="tab" title="Laporan DISPENKASI 30" href="#laporan"><span class="glyphicon glyphicon-list-alt"></span>&nbsp; Laporan</a></li>
            <li role="presentation"><a aria-controller="statistik" role="tab" data-toggle="tab" title="Statistik DISPENKASI 30" href="#statistik"><span class="glyphicon glyphicon-stats"></span>&nbsp; Statistik</a></li>
            <?php } ?>

            <li id="keluar-dispenkasi" role="presentation"><a aria-controller="keluar" role="tab" data-toggle="tab" title="Keluar DISPENKASI 30" href="#keluar"><span class="glyphicon glyphicon-off"></span>&nbsp; Keluar</a></li>
            <?php } ?>
            <li role="presentation"><a aria-controller="panitia" role="tab" data-toggle="tab" title="Panitia DISPENKASI 30" href="#panitia"><span class="glyphicon glyphicon-envelope"></span>&nbsp; Panitia</a></li>
            <li role="presentation"><a aria-controller="faq" role="tab" data-toggle="tab" title="FAQ DISPENKASI 30" href="#faq"><span class="glyphicon glyphicon-info-sign"></span>&nbsp; FAQ</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-9">
        <div class="panel panel-default tab-content panel-content">
          <div class="tab-pane active" id="sambutan" role="tabpanel">
            <p class="panel-title">Sambutan</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>
            <p style="text-align:justify; margin:30px 0px 20px 0px;">
              <p style="text-align:justify;">
                Wei De Dong Tian,
                <br />
                Selamat datang di Website Resmi DISPENKASI 30.
              </p>
              <br />
              <p style="text-align:justify;">
                Tahun 2045 adalah tahun yang spesial bagi bangsa Indonesia pasalnya, Indonesia akan genap berusia 100 tahun (<a href="http://www.dikti.go.id/membangun-karakter-insan-iptek-menuju-indonesia-emas-2045/" target="_blank"><b>era Indonesia Emas</b></a>). Hal ini menjadi momentum terbaik bagi bangsa Indonesia untuk menjadi negara maju dengan pembangunan yang berdasarkan pada Ilmu Pengetahuan dan Teknologi (IPTEK).
              </p>
              <p style="text-align:justify;">
                Dalam rangka mempersiapkan Indonesia emas diperlukan pemuda-pemudi yang tangguh, berwawasan luas dan inovatif, namun saat ini hal tersebut masih bertolak belakang dengan keadaan saat ini. Berdasarkan data <a href="https://www.bps.go.id/Brs/view/id/1278" target="_blank"><i>Badan Pusat Statistik</i></a>, pada tahun 2015 Indeks Pembangunan Manusia (IPM) Indonesia berada pada angka 69,55 yang berada pada kelompok sedang dan masih cukup terlampau jauh dari kategori negara maju seperti Singapura dan Malaysia dengan IPM 90,1 dan 77,3.
              </p>
              <p style="text-align:justify;">
                Angka ini juga didukung dengan tingkat pendidikan di Indonesia yang relatif rendah. Indonesia berada pada peringkat 110 dari 188 negara di dunia (data <a href="http://hdr.undp.org/en/indicators/137506" target="_blank"><i>United Nations for Development Program tahun 2015</i></a>). Hal ini mengindikasikan masih kurangnya kualitas Sumber Daya Manusia (SDM) di Indonesia.
              </p>
              <p style="text-align:justify;">
                Untuk menjawab tantangangan ini, Pemuda Agama Khonghucu Indonesia (PAKIN) Bandung yang dipercaya untuk menyelengarakan acara Diskusi Pendalaman Kitab Si Shu (DISPENKASI) ke-30 berusaha meningkatkan kualitas dan integritas Pemuda Agama Khonghucu Indonesia (PAKIN).
              </p>
              <p style="text-align:justify;">
                Akhir kata, semoga acara Diskusi Pendalaman Kitab Si Shu (DISPENKASI) ke-30 ini dapat bermanfaat bagi pembangunan di Indonesia, khususnya pembangunan karakter pemuda-pemudi agama Khonghucu Indonesia. (<i>Shanzai</i>).
              </p>
              <br />
              <p style="text-align:right;">Hormat Kami, <br />Panitia DISPENKASI 30</p>
            </p>
            <div id="sambutan-panitia">
              <div class="tooltip-container">
                <a href="#">
                  <img src="<?php echo get_home_page(); ?>src/img/panitia/yoga-wibowo.jpg" class="img-circle" alt="Ketua PAKIN Bandung" />
                  <span>
                    <h3>Yoga Wibowo</h3>
                    Wei De Dong Tian,<br />Selamat datang di Website DISPENKASI 30.
                  </span>
                </a>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="panduan" role="tabpanel">
            <p class="panel-title">Panduan</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>
            <a href="<?php echo get_home_page(); ?>files/panduan-pendaftaran-dispenkasi-30.pdf" alt="Mirror Download" title="Mirror Download" target="_blank"><button type="button" class="btn btn-sm btn-danger btn-custom-red pull-right">Mirror Download <span class="glyphicon glyphicon-download"></span></button></a>
            <div id="tutorial-panduan-pendaftaran"></div>
          </div>

          <div class="tab-pane" id="pengumuman" role="tabpanel">
            <p class="panel-title">Pengumuman</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>

            <div class="panel panel-danger">
              <div class="panel-heading">
                Status Pendaftaran
              </div>
              <div class="panel-body">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" name="form-status-partisipan" id="form-status-partisipan" method="POST">
                  <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                      <label for="keywords-status-partisipan">Kata Kunci (Nama/Email/ID) :</label>
                      <input type="text" id="keywords-status-partisipan" name="keywords-status-partisipan" class="form-control" maxlength="50" placeholder="Tulis kata kunci pencarian.." />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 col-md-offset-2">
                      <label for="coordinator">
                        <input type="radio" name="iCheck" id="coordinator" value="CO"> Koordinator
                      </label>
                      <label for="parins">
                        <input type="radio" name="iCheck" id="parins" value="PI" checked> Peserta/Peninjau
                      </label>
                    </div>
                    <div class="col-md-2">
                      <button type="submit" id="lihat-status-partisipan" class="btn btn-danger btn-sm pull-right btn-custom-red">Lihat <span class="glyphicon glyphicon-search"></span></button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                      <div id="hasil-status-partisipan"></div>
                      <span class="glyphicon glyphicon-exclamation-sign"></span> Pencarian terbatas pada <u>lima</u> data pertama yang ditemukan.
                    </div>
                  </div>
                </form>
              </div>
            </div>

            <?php if (!has_announcement("*")) { ?>
            <p style="text-align:justify; margin:20px 0px 10px 0px; font-size:12pt;">
              Belum ada pengumuman
            </p>
            <?php } else { ?>
            <?php $ant = get_announcement("*"); ?>
            <?php for ($i = 0; $i < count($ant); $i++) { ?>
            <div class="panel-group" id="berita-pengumuman">
              <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#berita-pengumuman" href="#pengumuman-<?php echo $ant[$i]["announcement_id"]; ?>">
                  <div class="ant-title"><?php echo $ant[$i]["announcement_title"]; ?></div>
                </div>
                <div id="pengumuman-<?php echo $ant[$i]["announcement_id"]; ?>" class="panel-collapse collapse <?php if ($i == 0) { echo "in"; }?>">
                  <div class="panel-body ant-content">
                    <hr />
                    <div class="row">
                      <div class="col-md-12">
                        <?php echo deinjecition($ant[$i]["announcement_content"]); ?>
                      </div>
                    </div>
                    <?php if (!empty($_SESSION)) { ?>
                    <?php if (is_authorities($_SESSION["email"], "admin_page")) { ?>
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-danger btn-sm pull-right btn-custom-red" onclick="hapus_pengumuman(<?php echo $ant[$i]["announcement_id"]; ?>);">Hapus <span class="glyphicon glyphicon-remove"></span></button>
                      </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                    <hr />
                    <div class="panel-footer panel-custom">
                      <div class="row">
                        <div class="col-md-6">
                          <?php $tmp_date = date_create($ant[$i]["announcement_date"]); ?>
                          Tanggal/Waktu: <b><?php echo switch_day(date_format($tmp_date, "w")) . ", " . date_format($tmp_date, "j") . " " . switch_month(date_format($tmp_date, "m")) . " " . date_format($tmp_date, "Y") . "/" . $ant[$i]["announcement_time"]; ?></b>
                        </div>
                        <div class="col-md-6">
                          <?php $user = get_user($ant[$i]["user_email"]); ?>
                          Ditulis oleh: <b><?php echo $user["user_name"] . " (" . switch_status($user["user_status"]) .")"; ?></b>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php } ?>

            <?php if (!empty($_SESSION)) { ?>
            <?php if (is_authorities($_SESSION["email"], "admin_page")) { ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                Tambah Pengumuman
              </div>
              <div class="panel-body">
                <form class="form-group" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="form-tambah-pengumuman" id="form-tambah-pengumuman">
                    <div class="form-group">
                      <label for="judul-pengumuman">Judul :</label>
                      <input type="text" id="judul-pengumuman" name="judul-pengumuman" class="form-control" maxlength="100" placeholder="Tulis judul pengumuman/berita di sini.." />
                    </div>
                    <div class="form-group">
                      <textarea name="konten-pengumuman" id="konten-pengumuman" rows="10" cols="80">Pengumuman/berita terkait acara DISPENKASI dapat ditulis di sini.</textarea>
                    </div>
                    <div class="form-group">
                      <button type="submit" id="tambah-pengumuman" class="btn btn-danger btn-sm pull-right btn-custom-red">Tambah <span class="glyphicon glyphicon-plus"></span></button>
                    </div>
                </form>
              </div>
            </div>
            <?php } ?>
            <?php } ?>
          </div>

          <div class="tab-pane" id="galeri" role="tabpanel">
            <?php
              $gallery = array(
                array(
                  "title"=>"I Just Sued the School System",
                  "video"=>"i-just-sued-the-school-system.mp4",
                  "subtitle"=>"no-subtitle.vtt"
                ),
                array(
                  "title"=>"Jack Ma - Change Yourself",
                  "video"=>"jack-ma-change-yourself.mp4",
                  "subtitle"=>"jack-ma-change-yourself.vtt"
                )
              );
            ?>
            <p class="panel-title">Galeri</p>
            <p class="panel-sub-title">Diskusi Pendalaman Kitab Si Shu ke-30</p>
            <div id="target-galeri">

              <div class="row">
                <div class="col-md-12">
                  <p style="text-align:center; padding:5px; font-weight:bold; font-size:12pt;">
                    <?php echo $gallery[0]["title"]; ?>
                  </p>
                </div>
              </div>
              <div class="row">
                <video width="100%" height="100%" controls>
                <source src="<?php echo get_home_page() . 'files/gallery/' . $gallery[0]["video"]; ?>" type="video/mp4">';
                <track src="<?php echo get_home_page() . 'files/gallery/' . $gallery[0]["subtitle"]; ?>" kind="subtitles" srclang="id" label="Bahasa Indonesia" />
                Tidak dapat menampilkan video, <a href="' + video + '">download video</a>.</video>
              </div>

            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="text-center">
                  <ul class="pagination pagination">
                    <?php for ($i=0;$i<count($gallery);$i++) {?>
                      <li title="<?php echo $gallery[$i]["title"]; ?>">
                        <a href="#" title="<?php echo $gallery[$i]["title"]; ?>" onclick="show_galeri('<?php echo $gallery[$i]["title"] . "', '" . get_home_page() . "files/gallery/" . $gallery[$i]["video"] . "', '" . get_home_page() . "files/gallery/" . $gallery[$i]["subtitle"] . "'"; ?>);">
                          <?php echo $i+1; ?>
                        </a>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <?php if (!sudah_masuk($_SESSION)) { ?>
          <div class="tab-pane" id="daftar" role="tabpanel">
            <p class="panel-title">Daftar Koordinator</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="daftar-dispenkasi" id="daftar-dispenkasi">
              <div class="row">
                <div class="col-md-6">
                  <label for="daftar-nama">Nama Koordinator :</label>
                  <input type="text" id="daftar-nama" name="daftar-nama" class="form-control" maxlength="100" placeholder="Tulis nama lengkap" />
                </div>
                <div class="col-md-6">
                  <label for="daftar-email">Alamat E-mail :</label>
                  <input type="daftar-email" id="daftar-email" name="daftar-email" class="form-control" maxlength="100" placeholder="Tulis alamat e-mail" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="daftar-asal">Asal Koordinator :</label>
                  <?php $regions = show_regions(); ?>
                  <select id="daftar-asal" name="daftar-asal" class="form-control js-example-basic-single" style="width:100%; margin-top:15px;">
                    <?php for ($i = 0; $i < count($regions); $i++) { ?>
                    <option value="<?php echo $regions[$i]["region_id"]; ?>" title="<?php echo $regions[$i]["region_name"] . " - " . switch_province($regions[$i]["province_id"]); ?>"><?php echo $regions[$i]["region_name"]; ?></option>
                    <?php } ?>
                  </select>
                  <button type="button" id="tombol-periksa-asal" class="btn btn-danger btn-sm pull-right btn-custom-red"><span class="glyphicon glyphicon-search"></span></button>
                  <a onclick="go_to_tab('panitia');" class="pull-right" style="margin:5px; padding:5px;">Organisasi tidak tersedia?</a>
                </div>
                <div class="col-md-6">
                  <label for="daftar-password">Kata Sandi :</label>
                  <input type="password" id="daftar-password" name="daftar-password" class="form-control" maxlength="30" placeholder="Tulis kata sandi" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="daftar-telepon">Nomor Telepon :</label>
                  <input type="text" id="daftar-telepon" name="daftar-telepon" class="form-control" maxlength="20" placeholder="Tulis nomor telepon" />
                </div>
                <div class="col-md-6">
                  <label for="daftar-confirm-password">Konfirmasi Kata Sandi :</label>
                  <input type="password" id="daftar-confirm-password" name="daftar-confirm-password" class="form-control" maxlength="30" placeholder="Tulis ulang kata sandi" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="col-md-6" style="padding:10px;">
                    <div id="g-recaptcha-reg" class="g-recaptcha" data-sitekey="6LeVJiATAAAAAHZhFYHFIwYBrdkSXtruZnEl06r2"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <button type="submit" id="tombol-daftar" class="btn btn-danger btn-md pull-right btn-custom-red">Daftar <span class="glyphicon glyphicon-saved"></span></button>
                </div>
              </div>
              <div class="row" >
                <div class="col-md-12">
                  <ul class="informasi-daftar">
                    <li>Silahkan isi semua kolom yang tersedia.</li>
                    <li>Harap masukkan alamat e-mail aktif.</li>
                    <li>Isi kolom Asal Koordinator dengan nama daerah asal koordinator, misalkan 'PAKIN Bandung' isi dengan 'MAKIN Bandung'.</li>
                    <li>Jika organisasi (asal koordinator) tidak tersedia, silahkan hubungi <a onclick="go_to_tab('panitia');">panitia</a>.</li>
                    <li>Apabila ada kendala, silahkan hubungi <a onclick="go_to_tab('panitia');">panitia</a>.</li>
                  </ul>
                </div>
              </div>
            </form>

          </div>

          <div class="tab-pane" id="masuk" role="tabpanel">
            <p class="panel-title">Masuk</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="masuk-dispenkasi" id="masuk-dispenkasi">
              <div class="form-group">
                <label class="col-md-3" for="masuk-email">E-mail </label>
                <div class="col-md-9">
                  <input type="text" id="masuk-email" name="masuk-email" class="form-control" placeholder="Tulis e-mail" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-3" for="masuk-password">Kata Sandi </label>
                <div class="col-md-9">
                  <input type="password" id="masuk-password" name="masuk-password" class="form-control" placeholder="Tulis kata sandi" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-7 col-md-offset-3">
                  <a id="link-aktivasi" title="Aktivasi akun?">Aktivasi akun?</a>
                  <a id="link-lupa-password" title="Lupa kata sandi?">Lupa kata sandi?</a>
                  <br />
                  <input type="submit" class="btn btn-danger btn-md pull-left" value="Masuk"  />
                </div>
              </div>
            </form>
            <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="aktivasi-dispenkasi" id="aktivasi-dispenkasi">
              <div class="form-group">
                <label class="col-md-3" for="aktivasi-email">E-mail </label>
                <div class="col-md-9">
                  <input type="text" id="aktivasi-email" name="aktivasi-email" class="form-control" placeholder="Tulis e-mail" />
                </div>
              </div>
              <div id="kolom-kode-aktivasi" class="form-group">
                <label class="col-md-3" for="aktivasi-kode">Kode Aktivasi </label>
                <div class="col-md-9">
                  <input type="text" id="aktivasi-kode" name="aktivasi-kode" class="form-control" maxlength="10" placeholder="Tulis kode aktivasi" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-7 col-md-offset-3">
                  <a id="link-masuk" title="Masuk akun?">Masuk akun?</a>
                  <a id="link-ulang-aktivasi" title="Kirim ulang kode aktivasi?">Kirim ulang kode aktivasi?</a>
                  <br />
                  <input id="konfirmasi-aktivasi" type="submit" class="btn btn-danger btn-md pull-left" value="Lanjutkan"  />
                </div>
              </div>
            </form>
          </div>

          <?php } else if (sudah_masuk($_SESSION)) { ?>

          <div class="tab-pane" id="pengaturan" role="tabpanel">
            <p class="panel-title">Pengaturan</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>
            <p style="text-align:justify; margin:20px 0px 10px 0px;">

            </p>
            <form class="form-group" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="pengaturan-dispenkasi" id="pengaturan-dispenkasi">
              <?php $user = get_account($_SESSION); ?>
              <div class="row">
                <div class="col-md-6">
                  <label for="pengaturan-email">Alamat E-mail :</label>
                  <input type="email" id="pengaturan-email" name="pengaturan-email" class="form-control" maxlength="100" placeholder="Tulis alamat e-mail" disabled="disabled" value="<?php echo $user["user_email"]; ?>" readonly />
                  <label for="pengaturan-nama">Nama Koordinator :</label>
                  <input type="text" id="pengaturan-nama" name="pengaturan-nama" class="form-control" maxlength="100" placeholder="Tulis nama" value="<?php echo $user["user_name"]; ?>" />
                  <label for="pengaturan-telepon">Nomor Telepon :</label>
                  <input type="text" id="pengaturan-telepon" name="pengaturan-telepon" class="form-control" maxlength="20" placeholder="Tulis nomor telepon" value="<?php echo $user["user_phone"]; ?>" />
                </div>
                <div class="col-md-6">
                  <label for="pengaturan-old-password">Kata Sandi Lama :</label>
                  <input type="password" id="pengaturan-old-password" name="pengaturan-old-password" class="form-control" maxlength="30" placeholder="Tulis kata sandi lama" />
                  <label for="pengaturan-new-password">*Kata Sandi Baru :</label>
                  <input type="password" id="pengaturan-new-password" name="pengaturan-new-password" class="form-control" maxlength="30" placeholder="Biarkan kosong apabila tidak akan diubah" />
                  <label for="pengaturan-confirm-new-password">*Konfirmasi Kata Sandi Baru :</label>
                  <input type="password" id="pengaturan-confirm-new-password" name="pengaturan-confirm-new-password" class="form-control" maxlength="30" placeholder="Biarkan kosong apabila tidak akan diubah" />
                </div>
              </div>
              <div class="row">
                <div class="col-md-10">
                  <ul class="informasi-pengaturan">
                    <li>Biarkan kosong bidang isian bertanda (<b>*</b>) apabila tidak akan diubah.</li>
                    <li>Setelah berhasil mengubah data akun DISPENKASI 30, apabila otomatis keluar dari akun, silahkan masuk kembali menggunakan e-mail dan kata sandi yang telah diperbaharui.</li>
                    <li>Untuk mengganti alamat e-mail, silahkan hubungi <a onclick="go_to_tab('panitia');">panitia</a>.</li>
                  </ul>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <button type="submit" id="tombol-pengaturan" class="btn btn-danger btn-sm pull-right btn-custom-red">Simpan <span class="glyphicon glyphicon-lock"></span></button>
                </div>
              </div>
            </form>
          </div>

          <div class="tab-pane" id="peserta" role="tabpanel">
            <?php $account = get_account($_SESSION); ?>
            <p class="panel-title">Peserta</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>
            <div class="panel-group">

              <div class="panel panel-default">
                <div class="panel-heading">
                  Informasi <?php if ($account["user_status"] == "R") { echo "Petugas"; } else if ($account["user_status"] == "A") { echo "Pengurus"; } else { echo "Koordinator"; } ?>
                </div>
                <div class="panel-body">
                  <div id="informasi-pengguna">
                    <div class="row">
                      <div class="col-md-6"><b>E-mail</b></div>
                      <div class="col-md-6"><?php echo empty_to_strip($account["user_email"]); ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Nama</b></div>
                      <div class="col-md-6"><?php echo empty_to_strip($account["user_name"]); ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Organisasi</b></div>
                      <div class="col-md-6"><?php echo empty_to_strip(switch_region($account["region_id"])); ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Telepon</b></div>
                      <div class="col-md-6"><?php echo empty_to_strip($account["user_phone"]); ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-6"><b>Status</b></div>
                      <div class="col-md-6">
                        <span class="<?php echo get_status($account["user_status"]); ?>">
                          <?php echo empty_to_strip(switch_status($account["user_status"])); ?>
                        </span>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-danger btn-sm btn-custom-navigasi-red pull-right" onclick="go_to_tab('pengaturan');">Ubah <span class="glyphicon glyphicon-wrench"></span></button>
                        <?php if (!user_confirmed($_SESSION["email"])) { ?>
                        <form method="POST" action=<?php echo get_home_page() . "handler.php?k=ORG-CFR"; ?>>
                          <button type="submit" class="btn btn-danger btn-sm btn-custom-navigasi-red pull-right">Konfirmasi <span class="glyphicon glyphicon-check"></span></button>
                        </form>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading">
                  Informasi Peserta
                </div>
                <div class="panel-body" id="panel-informasi-peserta">
                  <?php if (has_participants($_SESSION["email"])) { ?>
                  <div class="row">
                    <div class="col-md-12">
                      <div style="margin-left:5px;">
                        Lihat <a onclick="go_to_tab('transaksi');">Riwayat Transaksi</a>?
                      </div>
                      <br />
                      <?php $participants = get_participants($_SESSION["email"], "D"); ?>
                      <?php $unconfirmed = false; ?>
                      <?php for ($i = 0; $i < count($participants); $i++) { ?>
                        <?php if (!is_confirmed($participants[$i]["participant_id"])) { ?>
                        <?php $unconfirmed = true; break; ?>
                        <?php } ?>
                      <?php } ?>
                      <?php if ($unconfirmed) { ?>
                      <button type="button" id="konfirmasi-semua-peserta" class="btn btn-danger btn-custom-navigasi-red btn-sm pull-left">Konfirmasi Semua <span class="glyphicon glyphicon-import"></span></button>
                      <?php } ?>
                      <button type="button" id="show-hide-peserta" class="btn btn-danger btn-sm btn-custom-navigasi-red pull-right"><span class="glyphicon glyphicon-resize-vertical"></span></button>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <hr class="dashed" />
                    </div>
                  </div>
                  <?php $participants = get_participants($_SESSION["email"], "D"); ?>
                  <div id="informasi-peserta">
                    <?php for ($i = 0; $i < count($participants); $i++) { ?>
                    <div id="panel-peserta-<?php echo $participants[$i]["participant_id"]; ?>">
                      <div class="row">
                        <div class="col-md-2"><b>#</b></div>
                        <div class="col-md-4"><?php echo $participants[$i]["participant_id"]; ?></div>
                        <div class="col-md-2"><b>E-mail</b></div>
                        <div class="col-md-4"><?php echo empty_to_strip($participants[$i]["participant_email"]); ?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-2"><b>Nama</b></div>
                        <div class="col-md-4"><?php echo empty_to_strip($participants[$i]["participant_name"]); ?></div>
                        <div class="col-md-2"><b>Telepon</b></div>
                        <div class="col-md-4"><?php echo empty_to_strip($participants[$i]["participant_phone"]); ?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-2"><b>Jenis Kelamin</b></div>
                        <div class="col-md-4"><?php echo rewrite_gender($participants[$i]["participant_gender"]); ?></div>
                        <div class="col-md-2"><b>Facebook</b></div>
                        <div class="col-md-4"><?php echo empty_to_strip($participants[$i]["participant_facebook"]); ?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-2"><b>Tanggal Lahir</b></div>
                        <div class="col-md-4"><?php echo rewrite_date($participants[$i]["participant_birthdate"]); ?></div>
                        <div class="col-md-2"><b>Twitter</b></div>
                        <div class="col-md-4"><?php echo empty_to_strip($participants[$i]["participant_twitter"]); ?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-2"><b>Organisasi</b></div>
                        <div class="col-md-4"><?php echo empty_to_strip(switch_region($participants[$i]["region_id"])); ?></div>
                        <div class="col-md-2"><b>Instagram</b></div>
                        <div class="col-md-4"><?php echo empty_to_strip($participants[$i]["participant_instagram"]); ?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-2"><b>Daftar</b></div>
                        <div class="col-md-4"><?php if (register_as($participants[$i]["participant_id"]) == "Peserta") { echo "Peserta / " . empty_to_strip(switch_class($participants[$i]["class_id"])) . " (" . empty_to_strip(talent_name($participants[$i]["group_id"])) . ")"; } else { echo "Peninjau"; } ?></div>
                        <div class="col-md-2"><b>Line</b></div>
                        <div class="col-md-4"><?php echo empty_to_strip($participants[$i]["participant_line"]); ?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-2"><b>Status</b></div>
                        <div class="col-md-4">
                          <span class="<?php echo get_status($participants[$i]["participant_status"]); ?>"><?php echo switch_status($participants[$i]["participant_status"]); ?></span>
                        </div>
                        <div class="col-md-2"><b>Biaya Daftar</b></div>
                        <div class="col-md-4"><?php echo "Rp" . num_to_rupiah(class_price($participants[$i]["class_id"])); ?></div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <?php if (!is_confirmed($participants[$i]["participant_id"])) { ?>
                          (<b>*</b>) Hanya tekan tombol Konfirmasi apabila sudah melakukan pembayaran dan mengirimkan bukti pembayaran.
                          <?php } ?>
                        </div>
                        <div class="col-md-6">
                          <?php if ($account["group_id"] == "root" || $account["group_id"] == "admin") { ?>
                          <button type="button" class="btn btn-danger btn-sm btn-custom-navigasi-red pull-right" onclick="hapus_peserta(<?php echo $participants[$i]["participant_id"]; ?>);">Hapus <span class="glyphicon glyphicon-trash"></span></button>
                          <button type="button" class="btn btn-danger btn-sm btn-custom-navigasi-red pull-right" onclick="ubah_peserta(<?php echo $participants[$i]["participant_id"]; ?>);">Ubah <span class="glyphicon glyphicon-wrench"></span></button>
                          <?php } ?>
                          <?php if (!is_confirmed($participants[$i]["participant_id"])) { ?>
                          <button type="button" class="btn btn-danger btn-sm btn-custom-navigasi-red pull-right" onclick="konfirmasi_peserta(<?php echo $participants[$i]["participant_id"]; ?>);">Konfirmasi <span class="glyphicon glyphicon-check"></span></button>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <hr class="dashed" />
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>

                  <?php } else if (!has_participants($_SESSION["email"])) { ?>
                    <!-- <p class="pesan-peserta">Data partisipan tidak ditemukan, silahkan tambah data partisipan.</p> -->
                  <?php } ?>

                  <?php if ($account["group_id"] == "root" || $account["group_id"] == "admin") { ?>
                  <div id="form-tambah-peserta">
                    <form class="form-group" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="daftar-peserta" id="daftar-peserta">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="nama-peserta">*Nama</label>
                        </div>
                        <div class="col-md-4">
                          <input type="text" id="nama-peserta" name="nama-peserta" class="form-control" maxlength="50" placeholder="Tulis nama partisipan" value="" />
                        </div>
                        <div class="col-md-2">
                          <label for="email-peserta">E-mail</label>
                        </div>
                        <div class="col-md-4">
                          <input type="email" id="email-peserta" name="email-peserta" class="form-control" maxlength="100" placeholder="Tulis alamat e-mail partisipan" value="" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="jenis-kelamin-peserta">*Jenis Kelamin</label>
                        </div>
                        <div class="col-md-4">
                          <label for="male">
                            <input type="radio" name="jenis-kelamin-peserta" id="male" value="M" checked> Laki-Laki
                          </label>
                          <label for="female">
                            <input type="radio" name="jenis-kelamin-peserta" id="female" value="F"> Perempuan
                          </label>
                        </div>
                        <div class="col-md-2">
                          <label for="telepon-peserta">Telepon</label>
                        </div>
                        <div class="col-md-4">
                          <input type="text" id="telepon-peserta" name="telepon-peserta" class="form-control" maxlength="20" placeholder="Tulis nomor telepon partisipan" value="" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="tanggal-lahir-peserta">*Tanggal Lahir</label>
                        </div>
                        <div class="col-md-4">
                          <input type="text" id="tanggal-lahir-peserta" name="tanggal-lahir-peserta" class="form-control" placeholder="Tulis tanggal lahir partisipan" value="" />
                        </div>
                        <div class="col-md-2">
                          <label for="facebook-peserta">Facebook</label>
                        </div>
                        <div class="col-md-4">
                          <input type="text" id="facebook-peserta" name="facebook-peserta" class="form-control" maxlength="50" placeholder="Tulis ID facebook partisipan" value="" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label for="daftar-sebagai">*Daftar</label>
                        </div>
                        <div class="col-md-4">
                          <label for="participant">
                            <input type="radio" name="iCheck" id="participant" value="P" checked> Peserta
                          </label>
                          <label for="inspector">
                            <input type="radio" name="iCheck" id="inspector" value="I"> Peninjau
                          </label>
                        </div>
                        <div class="col-md-2">
                          <label for="twitter-peserta">Twitter</label>
                        </div>
                        <div class="col-md-4">
                          <input type="text" id="twitter-peserta" name="twitter-peserta" class="form-control" maxlength="50" placeholder="Tulis ID twitter partisipan" value="" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label id="label-kelas" for="kelas-peserta">*Kelas</label>
                        </div>
                        <div class="col-md-4">
                          <select id="kelas-peserta" name="kelas-peserta" class="form-control">
                            <option value="TE" title="RAKIN">RAKIN</option>
                            <option value="AD" title="PAKIN">PAKIN</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label for="instagram-peserta">Instagram</label>
                        </div>
                        <div class="col-md-4">
                          <input type="text" id="instagram-peserta" name="instagram-peserta" class="form-control" maxlength="50" placeholder="Tulis ID instagram partisipan" value="" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <label id="label-talent" for="talent-peserta">*Minat Bakat</label>
                        </div>
                        <div class="col-md-4">
                          <select id="talent-peserta" name="talent-peserta" class="form-control js-example-basic-single" style="width:100%;">
                            <option value="MUSIC" title="Seni Musik">Seni Musik</option>
                            <option value="DANCE" title="Seni Tari">Seni Tari</option>
                            <option value="SELFDEFENSE" title="Seni Bela Diri">Seni Bela Diri</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label for="line-peserta">Line</label>
                        </div>
                        <div class="col-md-4">
                          <input type="text" id="line-peserta" name="line-peserta" class="form-control" maxlength="50" placeholder="Tulis ID line partisipan" value="" />
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <?php if (is_authorities($_SESSION["email"], "admin_page")) { ?>
                          <label for="asal-peserta">*Organisasi</label>
                          <?php } ?>
                        </div>
                        <div class="col-md-4">
                          <?php if (is_authorities($_SESSION["email"], "admin_page")) { ?>
                          <?php $account = get_account($_SESSION); ?>
                          <?php $regions = show_regions(); ?>
                          <select id="asal-peserta" name="asal-peserta" class="form-control js-example-basic-single" style="width:100%;">
                            <?php for ($i = 0; $i < count($regions); $i++) { ?>
                            <option value="<?php echo $regions[$i]["region_id"]; ?>" title="<?php echo $regions[$i]["region_name"] . " - " . switch_province($regions[$i]["province_id"]); ?>" <?php if ($regions[$i]["region_id"] == $user["region_id"]) { echo "selected"; } ?>><?php echo $regions[$i]["region_name"]; ?></option>
                            <?php } ?>
                          </select>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <ul class="informasi-peserta-peninjau">
                            <li>Bidang isian bertanda (<b>*</b>) wajib diisi.</li>
                            <li>Identitas akan digunakan untuk kebutuhan DISPENKASI 30 (sertifikat, konfirmasi, dsb).</li>
                            <li>Pemilihan pendaftaran acara sepenuhnya diserahkan kepada peserta/peninjau DISPENKASI 30. </li>
                            <li>Sangat disarankan untuk mengikuti acara sesuai dengan kriteria batasan usia yakni: <b>(i)</b> Kelas RAKIN (12-18 tahun), <b>(ii)</b> Kelas PAKIN (19-30 tahun), <b>(iii)</b> Peninjau (Lebih dari 30 tahun).</li>
                          </ul>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <button type="submit" id="tambah-peserta" class="btn btn-danger btn-sm btn-custom-red pull-right">Tambah <span class="glyphicon glyphicon-open"></span></button>
                        </div>
                      </div>

                    </form>
                  </div>
                  <?php } else { ?>
                    <p class="pesan-peserta">Periode pendaftaran telah berakhir, sampai jumpa di DISPENKASI 30 [^_^]</p>
                  <?php } ?>
                </div>
              </div>

            </div>
          </div>

          <div class="tab-pane" id="transaksi" role="tabpanel">

            <p class="panel-title">Transaksi</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>

            <div class="panel panel-default">
              <div class="panel-heading">
                Transaksi Tertunda
              </div>
              <div id="biaya-pendaftaran" class="panel-body" style="padding:25px;">
                <?php if ((organisasi_sudah_bayar($_SESSION["email"])) && (biaya_pendaftaran($_SESSION["email"], "P") == 0) && (biaya_pendaftaran($_SESSION["email"], "I") == 0)) { ?>
                <div class="row">
                  <div class="col-xs-12">
                    Tidak ada transaksi tertunda.
                  </div>
                </div>
                <?php } else { ?>
                <div class="row">
                  <div class="col-xs-5"></div>
                  <div class="col-xs-3"><b>Jumlah</b></div>
                  <div class="col-xs-4"><b>Biaya</b></div>
                </div>
                <?php if (!organisasi_sudah_bayar($_SESSION["email"])) { ?>
                <div class="row">
                  <div class="col-xs-5">Organisasi</div>
                  <div class="col-xs-3"><?php if (organisasi_sudah_bayar($_SESSION["email"])) { echo "0"; } else { echo "1"; } ?></div>
                  <div class="col-xs-4">
                    <?php echo "Rp" . num_to_rupiah(biaya_organisasi($_SESSION["email"])); ?>
                  </div>
                </div>
                <?php } ?>
                <?php if (biaya_pendaftaran($_SESSION["email"], "P") > 0) { ?>
                <div class="row">
                  <div class="col-xs-5">Peserta</div>
                  <div class="col-xs-3">
                    <?php echo count_participant_price($_SESSION["email"]); ?>
                  </div>
                  <div class="col-xs-4">
                    <?php echo "Rp" . num_to_rupiah(biaya_pendaftaran($_SESSION["email"], "P")); ?>
                  </div>
                </div>
                <?php } ?>
                <?php if (biaya_pendaftaran($_SESSION["email"], "I") > 0) { ?>
                <div class="row">
                  <div class="col-xs-5">Peninjau</div>
                  <div class="col-xs-3">
                    <?php echo count_inspector_price($_SESSION["email"]); ?>
                  </div>
                  <div class="col-xs-4">
                    <?php echo "Rp" . num_to_rupiah(biaya_pendaftaran($_SESSION["email"], "I")); ?>
                  </div>
                </div>
                <?php } ?>
                <hr style="margin:5px 0px 5px 0px;" />
                <div class="row">
                  <div class="col-xs-5"><b>Jumlah/Total</b></div>
                  <div class="col-xs-3">
                    <?php $org = 0; if (!organisasi_sudah_bayar($_SESSION["email"])) { $org = 1; } ?>
                    <?php echo count_participant_price($_SESSION["email"]) + count_inspector_price($_SESSION["email"]) + $org; ?>
                  </div>
                  <div class="col-xs-4">
                    <?php $org = 0; if (!organisasi_sudah_bayar($_SESSION["email"])) { $org = biaya_organisasi($_SESSION["email"]); } ?>
                    <?php echo "Rp" . num_to_rupiah(biaya_pendaftaran($_SESSION["email"], "P") + biaya_pendaftaran($_SESSION["email"], "I") + $org); ?>
                  </div>
                </div>

                <div class="row" style="margin-top:20px; padding:10px; border:1px dashed #494949;">
                  <div class="col-md-12">
                    <p class="text-center">Pembayaran dapat dilakukan melalui:</p>
                    <div class="row" style="margin-top:10px;">
                      <div class="col-md-3 col-md-offset-2"><b>Bank</b></div>
                      <div class="col-md-5">BCA KCP. Sumber Sari - Bandung</div>
                    </div>
                    <div class="row">
                      <div class="col-md-3 col-md-offset-2"><b>Nomor Rekening</b></div>
                      <div class="col-md-5"><img id="rekening-bank" class="pointer" src="<?php echo get_home_page(); ?>text-to-img.php?k=1570-0704-91" data-clipboard-text="1570070491" /></div>
                    </div>
                    <div class="row">
                      <div class="col-md-3 col-md-offset-2"><b>Atas Nama</b></div>
                      <div class="col-md-5">Rizky Dwikurnia Wanditra, qq<br />Lucky Cahya Wanditra</div>
                    </div>
                  </div>
                </div>
                <div class="row" style="margin-top:10px;">
                  <div class="col-md-12">
                    Catatan:<br />Silahkan konfirmasi terlebih dahulu dengan <a onclick="go_to_tab('panitia');">panitia</a> sebelum melakukan pembayaran (<b>wajib</b>).
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                Riwayat Transaksi
              </div>
              <div id="riwayat-transaksi" class="panel-body" style="padding:25px;">
                <?php $trx = get_user_trx_header($_SESSION["email"]); ?>
                <?php if (count($trx) > 0) { ?>
                <div class="row">
                  <div class="col-md-9">
                    <p id="pesan-riwayat-transaksi" style="text-align:justify; margin-top:10px;"></p>
                  </div>
                  <div class="col-md-3">
                    <button type="button" id="show-hide-transaksi" class="btn btn-danger btn-md btn-custom-navigasi-red pull-right"><span class="glyphicon glyphicon-resize-vertical"></span></button>
                  </div>
                </div>
                <?php } ?>

                <div id="informasi-transaksi" class="informasi-transaksi">

                <?php if (count($trx) == 0) { ?>
                <div class="row">
                  <div class="col-md-12">
                    Tidak ada riwayat transaksi.
                  </div>
                </div>
                <?php } else { ?>
                <?php for ($i = 0; $i < count($trx); $i++) { ?>
                <div class="row">
                  <div class="col-md-12">
                    <hr class="limit" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4"><b>ID Transaksi</b></div>
                  <div class="col-md-8">
                    <?php echo $trx[$i]["header_id"]; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4"><b>Tanggal/Waktu</b></div>
                  <div class="col-md-8">
                    <?php $trx_date = date_create($trx[$i]["header_date"]); ?>
                    <?php echo switch_day(date_format($trx_date, "w")) . ", " . date_format($trx_date, "j") . " " . switch_month(date_format($trx_date, "m")) . " " . date_format($trx_date, "Y") . "/" . $trx[$i]["header_time"]; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4"><b>Jenis/Metode Pembayaran</b></div>
                  <div class="col-md-8">
                    <?php echo switch_payment($trx[$i]["header_type"]) . "/" . $trx[$i]["header_payment_methods"]; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4"><b>Koordinator/Panitia</b></div>
                  <div class="col-md-8">
                    <?php echo $trx[$i]["user_email"] . "/" . $trx[$i]["admin_email"]; ?>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4"><b>Catatan</b></div>
                  <div class="col-md-8">
                    <?php echo $trx[$i]["header_information"]; ?>
                  </div>
                </div>
                <hr />

                  <?php $details = get_user_trx_details('*', $trx[$i]["header_id"]); ?>
                  <?php $tmp_biaya = 0;?>
                  <div class="row">
                    <div class="col-md-9" style="text-align:center;"><b>Deskripsi</b></div>
                    <div class="col-md-3" style="text-align:center;"><b>Biaya</b></div>
                  </div>
                  <?php for ($j = 0; $j < count($details); $j++) { ?>
                  <div class="row <?php if ($j % 2 == 0) { echo "bkg-gray"; } ?>">
                    <div class="col-md-9">
                      <?php echo $details[$j]["detail_item"]; ?>
                    </div>
                    <div class="col-md-3">
                      <?php echo "Rp" . num_to_rupiah($details[$j]["detail_price"]); ?>
                      <?php $tmp_biaya += $details[$j]["detail_price"];?>
                    </div>
                  </div>
                  <?php } ?>
                  <hr />
                  <div class="row" style="margin-top:15px;">
                    <div class="col-md-3 col-md-offset-6"><b>Jumlah</b></div>
                    <div class="col-md-3"><?php echo count($details); ?></div>
                  </div>
                  <div class="row">
                    <div class="col-md-3 col-md-offset-6"><b>Total Biaya</b></div>
                    <div class="col-md-3"><?php echo "Rp" . num_to_rupiah($tmp_biaya); ?></div>
                  </div>
                  <?php $tmp_biaya = 0;?>

                  <div class="row">
                    <div class="col-md-12">
                      <hr class="limit" />
                    </div>
                  </div>

                <?php } ?>
                <div class="row">
                  <div class="col-md-12">
                    <?php $_SESSION["trx-rpt-time"] = date("Y-m-d,H:i:s"); ?>
                    <a href="<?php echo get_home_page(); ?>transaksi.php?key=<?php echo sha1($_SESSION["email"] . "D" . $_SESSION["trx-rpt-time"]); ?>" target="_blank">
                      <button type="button" id="download-transaksi" class="btn btn-sm btn-danger btn-custom-red">Download <span class="glyphicon glyphicon-download-alt"></span></button>
                    </a>
                    <a href="<?php echo get_home_page(); ?>transaksi.php?key=<?php echo sha1($_SESSION["email"] . "I" . $_SESSION["trx-rpt-time"]); ?>" target="_blank">
                      <button type="button" id="print-transaksi" class="btn btn-sm btn-danger btn-custom-red pull-right">Print <span class="glyphicon glyphicon-print"></span></button>
                    </a>
                  </div>
                </div>
                <?php } ?>
                </div>

              </div>
            </div>

          </div>

          <?php if (is_authorities($_SESSION["email"], "admin_page")) { ?>
          <div class="tab-pane" id="pengurus" role="tabpanel">
            <p class="panel-title">Pengurus</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>
            <div class="panel panel-default">
              <div class="panel-heading">
                Organisasi dan Peserta
              </div>
              <div id="pengurus-peserta" class="panel-body">
                <div class="row">
                  <div class="col-md-2">
                    <label for="keyword-organisasi-peserta">Cari</label>
                  </div>
                  <div class="col-md-8">
                    <input type="text" id="keyword-organisasi-peserta" name="keyword-organisasi-peserta" class="form-control" maxlength="100" placeholder="Kata kunci : ID/Email/Nama/Asal/Kelas" />
                  </div>
                  <div class="col-md-2">
                    <button type="button" id="cari-organisasi-peserta" class="btn btn-danger btn-sm">Cari <span class="glyphicon glyphicon-search"></span></button>
                  </div>
                </div>
                <div id="hasil-cari-organisasi-peserta"></div>
                <div class="row">
                  <div class="col-md-2">
                    <label for="pengurus-nama-organisasi">Organisasi</label>
                  </div>
                  <div class="col-md-4">
                    <?php $org = show_organization($_SESSION); ?>
                    <select id="pengurus-nama-organisasi" name="pengurus-nama-organisasi" class="form-control">
                      <?php for ($i = 0; $i < count($org); $i++) { ?>
                      <option value="<?php echo $org[$i]["user_email"]; ?>"><?php echo switch_region($org[$i]["region_id"]) . " - " . $org[$i]["user_name"]; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-1">
                    <button type="button" id="refresh-organisasi" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-refresh"></span></button>
                  </div>
                  <div class="col-md-3">
                    <?php $status = action_status("A"); ?>
                    <select id="pengurus-aksi-organisasi" name="pengurus-aksi-organisasi" class="form-control">
                      <?php foreach($status as $code => $text) { ?>
                      <option value="<?php echo $code; ?>"><?php echo $text; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <button type="button" id="pengurus-status-organisasi" class="btn btn-danger btn-sm">Simpan <span class="glyphicon glyphicon-open"></span></button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div id="pengurus-detail-organisasi"></div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                    <label for="pengurus-nama-peserta">Peserta</label>
                  </div>
                  <div class="col-md-4">
                    <select id="pengurus-nama-peserta" name="pengurus-nama-peserta" class="form-control">
                      <option value="nill">Pilih Organisasi terlebih dahulu</option>
                    </select>
                  </div>
                  <div class="col-md-1">
                    <button type="button" id="refresh-peserta" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-refresh"></span></button>
                  </div>
                  <div class="col-md-3">
                    <?php $status = action_status("A"); ?>
                    <select id="pengurus-aksi-peserta" name="pengurus-aksi-peserta" class="form-control">
                      <?php foreach($status as $code => $text) { ?>
                      <option value="<?php echo $code; ?>"><?php echo $text; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-2">
                    <button type="button" id="pengurus-status-peserta" class="btn btn-danger btn-sm">Simpan <span class="glyphicon glyphicon-open"></span></button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div id="pengurus-detail-peserta"></div>
                  </div>
                </div>
              </div>

            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                Transaksi
              </div>
              <div class="panel-body">
                <div id="form-transaksi-dispenkasi">
                  <form class="form-group" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="transaksi-dispenkasi" id="transaksi-dispenkasi">
                    <div class="row">
                      <div class="col-md-3">
                        <label for="id-transaksi">*ID Transaksi</label>
                      </div>
                      <div class="col-md-9">
                        <?php $_SESSION["trx_id"] = get_trx_id(); ?>
                        <input type="text" id="id-transaksi" name="id-transaksi" class="form-control" maxlength="40" value="<?php echo  $_SESSION["trx_id"]; ?>" disabled="disabled" disabled />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label for="metode-pembayaran">*Transaksi</label>
                      </div>
                      <div class="col-md-3" style="margin:5px 0px 5px 0px;">
                        <label for="jenis-transaksi" class="sr-only">*Jenis Transaksi</label>
                        <select id="jenis-transaksi" name="jenis-transaksi" class="form-control">
                          <option value="P">Pembayaran</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <input type="text" id="metode-pembayaran" name="metode-pembayaran" class="form-control" maxlength="150" placeholder="Tunai, Transfer BCA, e-Banking BCA, Paypal, Payza, Bitcoin" value="" />
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label for="detail-transaksi">*Detail</label>
                      </div>
                      <div class="col-md-8">
                        <?php $org = show_organization($_SESSION); ?>
                        <select id="email-koordinator" name="email-koordinator" class="form-control js-example-basic-single" style="width:100%;">
                          <?php for ($i = 0; $i < count($org); $i++) { ?>
                          <option value="<?php echo $org[$i]["user_email"]; ?>"><?php echo switch_region($org[$i]["region_id"]) . " - " . $org[$i]["user_name"]; ?></option>
                          <?php } ?>
                        </select>
                        <div id="detail-transaksi"></div>
                        <label><input id="transaksi-lain" type="checkbox" name="items" value="oth" class="form-control" /> Transaksi lain <input id="biaya-lain" type="text" class="form-control pull-right" placeholder="Tulis hanya angka, misal : 155123" /></label>
                      </div>
                      <div class="col-md-1">
                        <button type="button" id="refresh-koordinator" class="btn btn-danger btn-sm pull-right"><span class="glyphicon glyphicon-chevron-down"></span></button>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3">
                        <label for="keterangan-transaksi">Keterangan</label>
                      </div>
                      <div class="col-md-9">
                        <textarea id="keterangan-transaksi" name="keterangan-transaksi" class="form-control" rows="5" cols="50" placeholder="Bila diperlukan, tambahkan catatan transaksi."></textarea>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <button type="submit" id="tambah-transaksi" class="btn btn-danger btn-md btn-custom-red pull-right">Tambah <span class="glyphicon glyphicon-open"></span></button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                Riwayat Transaksi
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-3">
                    <label for="cari-id-transaksi">ID Transaksi</label>
                  </div>
                  <div class="col-md-8">
                    <?php $trx = get_user_trx_header("*"); ?>
                    <select id="cari-id-transaksi" name="cari-id-transaksi" class="form-control js-example-basic-single" style="width:100%;">
                      <?php for ($i = 0; $i < count($trx); $i++) { ?>
                      <option value="<?php echo $trx[$i]["header_id"]; ?>"><?php echo $trx[$i]["header_id"]; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="col-md-1">
                    <button type="button" id="refresh-id-transaksi" class="btn btn-danger btn-sm pull-right"><span class="glyphicon glyphicon-chevron-down"></span></button>
                  </div>
                </div>
                <div class="row" style="margin-top:10px;">
                  <div class="col-md-12">
                    <div id="hasil-cari-transaksi-peserta"></div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <div class="tab-pane" id="laporan" role="tabpanel">
            <p class="panel-title">Laporan</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>
            <div class="panel panel-default">
              <div class="panel-heading">
                Partisipan Terdaftar
              </div>
              <div class="panel-body">
                <?php $users = get_user("*"); ?>
                <?php $mid = count($users) / 2; ?>
                <?php  if (count($users) == 0) { ?>
                  <div class="row">
                    <div class="col-md-12">Tidak ada koordinator terdaftar.</div>
                  </div>
                <?php } else { ?>
                  <?php $_SESSION["rpt-time"] = date("Y-m-d,H:i:s");; ?>
                  <form action="<?php echo get_home_page(); ?>laporan.php?key=<?php echo sha1("rpt-part-" . $_SESSION["email"] . "-" . $_SESSION["rpt-time"]); ?>" target="_blank" name="form-laporan-partisipan-terdaftar" id="form-laporan-partisipan-terdaftar" method="POST">
                    <div class="row">
                      <div class="col-md-6">
                        <ul class="no-style">
                          <?php for ($i = 0; $i < count($users); $i++) { ?>
                          <?php if ($i % 2 == 0) { ?>
                          <li>
                            <label>
                              <input type="checkbox" name="coord[]" value="<?php echo $users[$i]["user_email"]; ?>" class="form-control" <?php if (has_participants($users[$i]["user_email"])) { echo 'checked="checked" checked'; } ?> />
                              <?php echo $users[$i]["user_name"] . ' - ' . switch_region($users[$i]["region_id"]); ?>
                            </label>
                          </li>
                          <?php } ?>
                          <?php } ?>
                        </ul>
                      </div>
                      <div class="col-md-6">
                        <ul class="no-style">
                          <?php for ($i = 0; $i < count($users); $i++) { ?>
                          <?php if ($i % 2 == 1) { ?>
                          <li>
                            <label>
                              <input type="checkbox" name="coord[]" value="<?php echo $users[$i]["user_email"]; ?>" class="form-control" <?php if (has_participants($users[$i]["user_email"])) { echo 'checked="checked" checked'; } ?> />
                              <?php echo $users[$i]["user_name"] . ' - ' . switch_region($users[$i]["region_id"]); ?>
                            </label>
                          </li>
                          <?php } ?>
                          <?php } ?>
                        </ul>
                      </div>
                    </div>
                    <div class="row" style="margin-top:10px; margin-bottom:10px;">
                      <div class="col-md-4">
                        <a id="centang-semua-pengguna" style="font-size:11pt; font-weight:bold;"><span class="glyphicon glyphicon-check"> </span> Pilih semua</a>
                        <br />
                        <a id="jangan-centang-semua-pengguna" style="font-size:11pt; font-weight:bold;"><span class="glyphicon glyphicon-unchecked"> </span> Jangan pilih semua</a>
                      </div>
                      <div class="col-md-4">
                        <label for="pengecualian-laporan">Lihat semua data:</label>
                        <select id="pengecualian-laporan" name="pengecualian-laporan" class="form-control">
                          <option value="DY" title="Sudah Terdaftar">Belum Terdaftar</option>
                          <option value="DNC" title="Belum Terdaftar" selected="selected">Sudah Terdaftar</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label for="mode-laporan-partisipan">Pilih metode:</label>
                        <select id="mode-laporan-partisipan" name="mode-laporan-partisipan" class="form-control">
                          <option value="D" title="Download">Download</option>
                          <option value="V" title="Lihat Langsung" selected="selected">Lihat Langsung</option>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <button type="submit" id="print-laporan-partisipan" class="btn btn-sm btn-danger btn-custom-red pull-right">Lihat <span class="glyphicon glyphicon-search"></span></button>
                      </div>
                    </div>
                  </form>
                <?php } ?>
              </div>
            </div>
          </div>

          <div class="tab-pane" id="statistik" role="tabpanel">
            <p class="panel-title">Statistik</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>
            <div class="panel panel-default">
              <div class="panel-heading">
                Partisipan Terdaftar
              </div>
              <div class="panel-body">
                <?php $part_gen = calculate_participants("REGGEN"); ?>
                <?php if ($part_gen[0] !== NULL && $part_gen[1] !== NULL) { ?>
                <div class="row">
                  <div class="col-md-6">
                    <p class="text-center" style="margin:5px 0px 0px 0px; font-weight:bold;">Kategori Daftar</p>
                    <canvas id="reg-peserta-kategori-daftar" width="100" height="100"></canvas>
                  </div>
                  <div class="col-md-6">
                    <p class="text-center" style="margin:5px 0px 0px 0px; font-weight:bold;">Jenis Kelamin</p>
                    <canvas id="reg-peserta-kategori-kelamin" width="100" height="100"></canvas>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <?php $reg_rakin = calculate_participants("REGRMB"); ?>
                    <?php $reg_pakin = calculate_participants("REGPMB"); ?>
                    <p class="text-center" style="margin:10px 0px 5px 0px; font-weight:bold;">Rangkuman Data Minat Bakat</p>
                    <div class="table-responsive" style="margin-top:5px;">
                      <table class="table">
                        <tr>
                          <th></th>
                          <th>RAKIN</th>
                          <th>PAKIN</th>
                          <th>Total</th>
                        </tr>
                        <tr>
                          <td>Seni Musik</td>
                          <td><?php echo $reg_rakin[0]; ?> Peserta</td>
                          <td><?php echo $reg_pakin[0]; ?> Peserta</td>
                          <td><?php echo ($reg_rakin[0] + $reg_pakin[0]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td>Seni Tari</td>
                          <td><?php echo $reg_rakin[1]; ?> Peserta</td>
                          <td><?php echo $reg_pakin[1]; ?> Peserta</td>
                          <td><?php echo ($reg_rakin[1] + $reg_pakin[1]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td>Seni Bela Diri</td>
                          <td><?php echo $reg_rakin[2]; ?> Peserta</td>
                          <td><?php echo $reg_pakin[2]; ?> Peserta</td>
                          <td><?php echo ($reg_rakin[2] + $reg_pakin[2]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td><b>Total</b></td>
                          <td><?php echo array_sum($reg_rakin); ?> Peserta</td>
                          <td> <?php echo array_sum($reg_pakin); ?> Peserta</td>
                          <td><?php echo (array_sum($reg_rakin) + array_sum($reg_pakin)); ?> Peserta</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <?php $par_cls = calculate_participants("REGCLS"); ?>
                    <p class="text-center" style="margin:5px 0px 5px 0px; font-weight:bold;">Rangkuman Data Partisipan</p>
                    <div class="table-responsive" style="margin-top:5px;">
                      <table class="table">
                        <tr>
                          <td>Total Peserta</td>
                          <td><?php echo ($par_cls[0] + $par_cls[1]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td>Total Peninjau</td>
                          <td><?php echo $par_cls[2]; ?> Peninjau</td>
                        </tr>
                        <tr>
                          <td><b>Total Partisipan</b></td>
                          <td><?php echo array_sum($par_cls); ?> Partisipan</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <?php } else { ?>
                <div class="row">
                  <div class="col-md-12">
                    Belum ada partisipan terdaftar.
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                Partisipan Belum Terdaftar
              </div>
              <div class="panel-body">
                <?php $part_gen = calculate_participants("UNREGGEN"); ?>
                <?php if ($part_gen[0] !== NULL && $part_gen[1] !== NULL) { ?>
                <div class="row">
                  <div class="col-md-6">
                    <p class="text-center" style="margin:5px 0px 0px 0px; font-weight:bold;">Kategori Daftar</p>
                    <canvas id="unreg-peserta-kategori-daftar" width="100" height="100"></canvas>
                  </div>
                  <div class="col-md-6">
                    <p class="text-center" style="margin:5px 0px 0px 0px; font-weight:bold;">Jenis Kelamin</p>
                    <canvas id="unreg-peserta-kategori-kelamin" width="100" height="100"></canvas>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <?php $reg_rakin = calculate_participants("UNREGRMB"); ?>
                    <?php $reg_pakin = calculate_participants("UNREGPMB"); ?>
                    <p class="text-center" style="margin:10px 0px 5px 0px; font-weight:bold;">Rangkuman Data Minat Bakat</p>
                    <div class="table-responsive" style="margin-top:5px;">
                      <table class="table">
                        <tr>
                          <th></th>
                          <th>RAKIN</th>
                          <th>PAKIN</th>
                          <th>Total</th>
                        </tr>
                        <tr>
                          <td>Seni Musik</td>
                          <td><?php echo $reg_rakin[0]; ?> Peserta</td>
                          <td><?php echo $reg_pakin[0]; ?> Peserta</td>
                          <td><?php echo ($reg_rakin[0] + $reg_pakin[0]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td>Seni Tari</td>
                          <td><?php echo $reg_rakin[1]; ?> Peserta</td>
                          <td><?php echo $reg_pakin[1]; ?> Peserta</td>
                          <td><?php echo ($reg_rakin[1] + $reg_pakin[1]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td>Seni Bela Diri</td>
                          <td><?php echo $reg_rakin[2]; ?> Peserta</td>
                          <td><?php echo $reg_pakin[2]; ?> Peserta</td>
                          <td><?php echo ($reg_rakin[2] + $reg_pakin[2]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td><b>Total</b></td>
                          <td><?php echo array_sum($reg_rakin); ?> Peserta</td>
                          <td> <?php echo array_sum($reg_pakin); ?> Peserta</td>
                          <td><?php echo (array_sum($reg_rakin) + array_sum($reg_pakin)); ?> Peserta</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <?php $par_cls = calculate_participants("UNREGCLS"); ?>
                    <p class="text-center" style="margin:5px 0px 5px 0px; font-weight:bold;">Rangkuman Data Partisipan</p>
                    <div class="table-responsive" style="margin-top:5px;">
                      <table class="table">
                        <tr>
                          <td>Total Peserta</td>
                          <td><?php echo ($par_cls[0] + $par_cls[1]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td>Total Peninjau</td>
                          <td><?php echo $par_cls[2]; ?> Peninjau</td>
                        </tr>
                        <tr>
                          <td><b>Total Partisipan</b></td>
                          <td><?php echo array_sum($par_cls); ?> Partisipan</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <?php } else { ?>
                <div class="row">
                  <div class="col-md-12">
                    Belum ada partisipan terdaftar.
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                Seluruh Partisipan
              </div>
              <div class="panel-body">
                <?php $part_gen = calculate_participants("UNREGGEN"); ?>
                <?php if ($part_gen[0] !== NULL && $part_gen[1] !== NULL) { ?>
                <div class="row">
                  <div class="col-md-6">
                    <p class="text-center" style="margin:5px 0px 0px 0px; font-weight:bold;">Kategori Daftar</p>
                    <canvas id="all-peserta-kategori-daftar" width="100" height="100"></canvas>
                  </div>
                  <div class="col-md-6">
                    <p class="text-center" style="margin:5px 0px 0px 0px; font-weight:bold;">Jenis Kelamin</p>
                    <canvas id="all-peserta-kategori-kelamin" width="100" height="100"></canvas>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <?php $reg_rakin = calculate_participants("ALLRMB"); ?>
                    <?php $reg_pakin = calculate_participants("ALLPMB"); ?>
                    <p class="text-center" style="margin:10px 0px 5px 0px; font-weight:bold;">Rangkuman Data Minat Bakat</p>
                    <div class="table-responsive" style="margin-top:5px;">
                      <table class="table">
                        <tr>
                          <th></th>
                          <th>RAKIN</th>
                          <th>PAKIN</th>
                          <th>Total</th>
                        </tr>
                        <tr>
                          <td>Seni Musik</td>
                          <td><?php echo $reg_rakin[0]; ?> Peserta</td>
                          <td><?php echo $reg_pakin[0]; ?> Peserta</td>
                          <td><?php echo ($reg_rakin[0] + $reg_pakin[0]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td>Seni Tari</td>
                          <td><?php echo $reg_rakin[1]; ?> Peserta</td>
                          <td><?php echo $reg_pakin[1]; ?> Peserta</td>
                          <td><?php echo ($reg_rakin[1] + $reg_pakin[1]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td>Seni Bela Diri</td>
                          <td><?php echo $reg_rakin[2]; ?> Peserta</td>
                          <td><?php echo $reg_pakin[2]; ?> Peserta</td>
                          <td><?php echo ($reg_rakin[2] + $reg_pakin[2]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td><b>Total</b></td>
                          <td><?php echo array_sum($reg_rakin); ?> Peserta</td>
                          <td> <?php echo array_sum($reg_pakin); ?> Peserta</td>
                          <td><?php echo (array_sum($reg_rakin) + array_sum($reg_pakin)); ?> Peserta</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8 col-md-offset-2">
                    <?php $par_cls = calculate_participants("ALLCLS"); ?>
                    <p class="text-center" style="margin:5px 0px 5px 0px; font-weight:bold;">Rangkuman Data Partisipan</p>
                    <div class="table-responsive" style="margin-top:5px;">
                      <table class="table">
                        <tr>
                          <td>Total Peserta</td>
                          <td><?php echo ($par_cls[0] + $par_cls[1]); ?> Peserta</td>
                        </tr>
                        <tr>
                          <td>Total Peninjau</td>
                          <td><?php echo $par_cls[2]; ?> Peninjau</td>
                        </tr>
                        <tr>
                          <td><b>Total Partisipan</b></td>
                          <td><?php echo array_sum($par_cls); ?> Partisipan</td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>

                <?php } else { ?>
                <div class="row">
                  <div class="col-md-12">
                    Belum ada partisipan terdaftar.
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>

            <div class="panel panel-default">
              <div class="panel-heading">
                Hit Website
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <canvas id="hit-website-harian" width="100" height="100"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php } ?>

          <div class="tab-pane" id="panitia" role="tabpanel">
            <p class="panel-title">Panitia</p>
            <p style="text-align:justify; margin-bottom:20px;">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>
            <h4>PAKIN Bandung</h4>
            <div class="row">
              <div class="col-md-6">
                <h5>Email</h5>
                <ul>
                  <li><a href="mailto:pakin.bandung@gmail.com" target="_blank" title="PAKIN Bandung">pakin.bandung@gmail.com</a></li>
                </ul>
                <h5>Facebook</h5>
                <ul>
                  <li><a href="https://www.facebook.com/groups/Pemuda.Khonghucu.Indonesia/" target="_blank" title="Facebook Group PAKIN Bandung">PAKIN Bandung Facebook Group</a></li>
                  <li><a href="https://www.facebook.com/Pemuda.Khonghucu.Indonesia/" target="_blank" title="Facebook Fans Page PAKIN Bandung">PAKIN Bandung Facebook Fans Page</a></li>
                </ul>
              </div>
              <div class="col-md-6">
                <h5>Twitter</h5>
                <ul>
                  <li><a href="https://twitter.com/pakin_bandung" target="_blank" title="Facebook Group PAKIN Bandung">PAKIN Bandung Twitter</a></li>
                </ul>
                <h5>Instagram</h5>
                <ul>
                  <li><a href="https://www.instagram.com/pakin_bandung/" target="_blank" title="Instagram PAKIN Bandung">PAKIN Bandung Instagram</a></li>
                </ul>
              </div>
            </div>
            <h4>DISPENKASI 30</h4>
            <div class="row">
              <div class="col-md-6">
                <h5>Official Line</h5>
                <ul>
                  <li><a href="http://line.me/ti/p/~@kwu9979q" target="_blank" title="Official Line DISPENKASI 30">DISPENKASI 30</a></li>
                </ul>
                <h5>Yoga Wibowo</h5>
                <ul>
                  <li><a href="mailto:yogawibowo@ymail.com" target="_blank" title="Email Yoga Wibowo">Email: yogawibowo@ymail.com</a></li>
                  <li><a title="Telepon Yoga Wibowo">Telepon: 0813-9830-0981</a></li>
                  <li><a href="http://line.me/ti/p/~yoga_oey" target="_blank" title="Line Yoga Wibowo">Line: Yoga Wibowo</a></li>
                </ul>
              </div>
              <div class="col-md-6">
                <h5>Lucky Cahya Wanditra</h5>
                <ul>
                  <li><a href="mailto:luckycahya@gmail.com" target="_blank" title="Email Lucky Cahya Wanditra">Email: luckycahya@gmail.com</a></li>
                  <li><a title="Telepon Lucky Cahya Wanditra">Telepon: 0878-2386-8543</a></li>
                </ul>
                <h5>Evelyn Jholanda</h5>
                <ul>
                  <li><a title="Telepon Evelin Jholanda">Telepon: 0896-1374-7082</a></li>
                  <li><a href="http://line.me/ti/p/~evelyn28" target="_blank" title="Line Evelin Jholanda">Line: Evelin Jholanda</a></li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                Apabila ada kendala, pertanyaan, kritik, ataupun saran silahkan hubungi panitia.<br />
                *Jika hendak mengirim e-mail terkait kendala teknis harap CC <a href="mailto:raka@gurisa.com" target="_blank" title="Gurisa Developers">raka@gurisa.com</a> / <a href="mailto:raka.suryadi@gmail.com" target="_blank" title="Raka Suryaardi Widjaja">raka.suryadi@gmail.com</a>.
              </div>
            </div>
          </div>

          <div class="tab-pane" id="faq" role="tabpanel">
            <p class="panel-title">FAQ</p>
            <p class="panel-sub-title">
              Diskusi Pendalaman Kitab Si Shu ke-30
            </p>

            <div class="panel-group" id="faq-header">
              <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#faq-header" href="#tentang-dispenkasi-body">
                  <div class="faq-title">
                    Semua Tentang DISPENKASI
                  </div>
                </div>
                <div id="tentang-dispenkasi-body" class="panel-collapse collapse in">
                  <div class="panel-body faq-content">
                    <!-- start of faq content -->
                    <div class="panel-group" id="tentang-dispenkasi-content">
                      <div class="panel panel-default">

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-dispenkasi-content" href="#apa-itu-dispenkasi">
                          <div class="faq-title">
                            Apa itu DISPENKASI?
                          </div>
                        </div>
                        <div id="apa-itu-dispenkasi" class="panel-collapse collapse in">
                          <div class="panel-body faq-content">
                            DISPENKASI adalah akronim dari Diskusi Pendalaman Kitab Si Shu, merupakan acara rutin yang diadakan untuk memperdalam pengetahuan umat Khonghucu, khususnya Pemuda Agama Khonghucu Indonesia (PAKIN) mengenai kitab Si Shu.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-dispenkasi-content" href="#apa-itu-dispenkasi-xxx">
                          <div class="faq-title">
                            Apa itu DISPENKASI 30?
                          </div>
                        </div>
                        <div id="apa-itu-dispenkasi-xxx" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            DISPENKASI 30 adalah acara DISPENKASI yang sudah dilakukan ke-30 kalinya, dimulai dari DISPENKASI ke-1 yang diadakan pada tahun 1989.
                          </div>
                        </div>

                      </div>

                    </div>
                    <!-- end of faq content -->
                  </div>
                </div>
              </div>

              <!-- new division -->
              <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#faq-header" href="#tentang-pendaftaran-body">
                  <div class="faq-title">
                    Semua Tentang DISPENKASI 30
                  </div>
                </div>
                <div id="tentang-pendaftaran-body" class="panel-collapse collapse">
                  <div class="panel-body faq-content">
                    <!-- start of faq content -->
                    <div class="panel-group" id="tentang-pendaftaran-content">
                      <!-- each panel -->
                      <div class="panel panel-default">
                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-pendaftaran-content" href="#apa-tema-dispenkasi-xxx">
                          <div class="faq-title">
                            Apa tema DISPENKASI 30?
                          </div>
                        </div>
                        <div id="apa-tema-dispenkasi-xxx" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            DISPENKASI 30 bertemakan "Mengubah Mimpi Menjadi Kenyataan".
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-pendaftaran-content" href="#siapa-panitia-dispenkasi-xxx">
                          <div class="faq-title">
                            Siapa Panitia DISPENKASI 30?
                          </div>
                        </div>
                        <div id="siapa-panitia-dispenkasi-xxx" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Panitia acara DISPENKASI 30 adalah MAKIN/PAKIN Bandung.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-pendaftaran-content" href="#kapan-dispenkasi-xxx">
                          <div class="faq-title">
                            Kapan DISPENKASI 30 dilaksanakan?
                          </div>
                        </div>
                        <div id="kapan-dispenkasi-xxx" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            DISPENKASI 30 akan dilaksanakan pada tanggal 30 Juni 2017 s.d. 2 Juli 2017.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-pendaftaran-content" href="#di-mana-dispenkasi-xxx">
                          <div class="faq-title">
                            Di mana DISPENKASI 30 dilaksanakan?
                          </div>
                        </div>
                        <div id="di-mana-dispenkasi-xxx" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            DISPENKASI 30 akan dilaksanakan di Wisma Aloysius Gambung, Bandung, Jawa Barat.
                          </div>
                        </div>
                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-pendaftaran-content" href="#cara-daftar-dispenkasi">
                          <div class="faq-title">
                            Bagaimana cara pendaftaran DISPENKASI 30?
                          </div>
                        </div>
                        <div id="cara-daftar-dispenkasi" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Pendaftaran DISPENKASI 30 dapat dilakukan dengan cara mendaftarkan data diri secara kolektif dan dilakukan oleh koordinator di masing-masing PAKIN.<br />
                          </div>
                        </div>
                      </div>
                      <!-- end of each panel -->
                    </div>
                    <!-- end of faq content -->
                  </div>
                </div>
              </div>
              <!-- end of new division -->

              <!-- new division -->
              <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#faq-header" href="#tentang-koordinator-dispenkasi">
                  <div class="faq-title">
                    Semua Tentang Koordiantor DISPENKASI 30
                  </div>
                </div>
                <div id="tentang-koordinator-dispenkasi" class="panel-collapse collapse">
                  <div class="panel-body faq-content">
                    <!-- start of faq content -->
                    <div class="panel-group" id="tentang-koordinator-content">
                      <!-- each panel -->
                      <div class="panel panel-default">

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-koordinator-content" href="#apa-itu-koordinator">
                          <div class="faq-title">
                            Apa itu koordinator DISPENKASI 30?
                          </div>
                        </div>
                        <div id="apa-itu-koordinator" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Koordinator DISPENKASI 30 adalah perwakilan dari masing-masing PAKIN untuk melakukan koordinasi peserta/peninjau acara DISPENKASI 30.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-koordinator-content" href="#siapa-saja-koordinator">
                          <div class="faq-title">
                            Siapa yang dapat menjadi koordinator DISPENKASI 30?
                          </div>
                        </div>
                        <div id="siapa-saja-koordinator" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Yang dapat menjadi koordinator DISPENKASI 30 adalah perwakilan dari masing-masing Organisasi/PAKIN.
                            Setiap organisasi/PAKIN dapat mendaftarkan lebih dari satu koordinator, namun sangat disarankan cukup seorang koordinator saja.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-koordinator-content" href="#batas-daftar-koordinator">
                          <div class="faq-title">
                            Kapan pendaftaran koordinator DISPENKASI 30?
                          </div>
                        </div>
                        <div id="batas-daftar-koordinator" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Waktu pendaftaran koordinator sama dengan waktu pendaftaran peserta/peninjau, yakni:<br />
                            <b>Minggu, 1 Januari 2017, Pukul 00.01 WIB</b> s.d. <b>Jumat, 23 Juni 2017, Pukul 23.59 WIB</b>.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-koordinator-content" href="#dimana-daftar-koordinator">
                          <div class="faq-title">
                            Di mana pendaftaran koordinator dilakukan?
                          </div>
                        </div>
                        <div id="dimana-daftar-koordinator" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Pendaftaran koordinator dapat dilakukan tidak hanya melalui website ini tetapi dapat dilakukan langsung dengan cara menghubungi <a onclick="go_to_tab('panitia');">Panitia DISPENKASI 30</a>.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-koordinator-content" href="#cara-daftar-koordinator">
                          <div class="faq-title">
                            Bagaimana cara pendaftaran koordinator DISPENKASI 30?
                          </div>
                        </div>
                        <div id="cara-daftar-koordinator" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Koordinator dapat mendaftarkan PAKIN/Organisasi yang diwakilinya dengan cara mendaftar akun koordinator terlebih dahulu di website ini.<br />
                            Selengkapnya mengenai panduan teknis pendaftaran DISPENKASI 30 dapat dilihat di menu <a onclick="go_to_tab('panduan');">Panduan</a>.
                          </div>
                        </div>

                      </div>
                      <!-- end of each panel -->
                    </div>
                    <!-- end of faq content -->
                  </div>
                </div>
              </div>
              <!-- end of new division -->

              <!-- new division -->
              <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#faq-header" href="#tentang-peserta-dispenkasi">
                  <div class="faq-title">
                    Semua Tentang Peserta DISPENKASI 30
                  </div>
                </div>
                <div id="tentang-peserta-dispenkasi" class="panel-collapse collapse">
                  <div class="panel-body faq-content">
                    <!-- start of faq content -->
                    <div class="panel-group" id="tentang-peserta-content">
                      <!-- each panel -->
                      <div class="panel panel-default">

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-peserta-content" href="#apa-itu-peserta">
                          <div class="faq-title">
                            Apa itu peserta DISPENKASI 30?
                          </div>
                        </div>
                        <div id="apa-itu-peserta" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Peserta DISPENKASI 30 adalah partisipan acara DISPENKASI 30 yang dikategorikan berdasarkan kelas peserta RAKIN atau PAKIN.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-peserta-content" href="#siapa-saja-peserta">
                          <div class="faq-title">
                            Siapa yang dapat menjadi peserta DISPENKASI 30?
                          </div>
                        </div>
                        <div id="siapa-saja-peserta" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Yang dapat menjadi peserta DISPENKASI 30 adalah individu yang berada dalam kategori kelas peserta RAKIN dan PAKIN yakni peserta yang berusia 12 s.d. 30 tahun per 30 Juni 2017.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-peserta-content" href="#peserta-perlu-daftar">
                          <div class="faq-title">
                            Apa yang harus dilakukan peserta untuk mengikuti DISPENKASI 30?
                          </div>
                        </div>
                        <div id="peserta-perlu-daftar" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Peserta dapat mendaftarkan diri secara individu maupun kolektif, namun sangat disarankan pendaftaran dilakukan secara kolektif. <br />
                            Pendaftaran secara kolektif dilakukan oleh Koordinator yang ditentukan oleh Organisasi peserta masing-masing.
                          </div>
                        </div>

                      </div>
                      <!-- end of each panel -->
                    </div>
                    <!-- end of faq content -->
                  </div>
                </div>
              </div>
              <!-- end of new division -->

              <!-- new division -->
              <div class="panel panel-default">
                <div class="panel-heading" data-toggle="collapse" data-parent="#faq-header" href="#tentang-peninjau-dispenkasi">
                  <div class="faq-title">
                    Semua Tentang Peninjau DISPENKASI 30
                  </div>
                </div>
                <div id="tentang-peninjau-dispenkasi" class="panel-collapse collapse">
                  <div class="panel-body faq-content">
                    <!-- start of faq content -->
                    <div class="panel-group" id="tentang-peninjau-content">
                      <!-- each panel -->
                      <div class="panel panel-default">

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-peninjau-content" href="#apa-itu-peninjau">
                          <div class="faq-title">
                            Apa itu peninjau DISPENKASI 30?
                          </div>
                        </div>
                        <div id="apa-itu-peninjau" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Peninjau DISPENKASI 30 adalah partisipan acara DISPENKASI 30 yang berada dalam kategori peninjau dan berkewajiban mengawasi dan membimbing peserta DISPENKASI 30 dalam melaksanakan kegiatannya pada saat berlangsungnya acara.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-peninjau-content" href="#siapa-saja-peninjau">
                          <div class="faq-title">
                            Siapa yang dapat menjadi peninjau DISPENKASI 30?
                          </div>
                        </div>
                        <div id="siapa-saja-peninjau" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Yang dapat menjadi peninjau DISPENKASI 30 adalah individu yang sekurang-kurangnya berusia 31 tahun per 30 Juni 2017.
                          </div>
                        </div>

                        <div class="panel-heading" data-toggle="collapse" data-parent="#tentang-peninjau-content" href="#peninjau-perlu-daftar">
                          <div class="faq-title">
                            Apa yang harus dilakukan peninjau untuk mengikuti DISPENKASI 30?
                          </div>
                        </div>
                        <div id="peninjau-perlu-daftar" class="panel-collapse collapse">
                          <div class="panel-body faq-content">
                            Peninjau dapat mendaftarkan diri secara individu maupun kolektif, namun sangat disarankan pendaftaran dilakukan secara kolektif. <br />
                            Pendaftaran secara kolektif dilakukan oleh Koordinator yang ditentukan oleh Organisasi peninjau masing-masing.
                          </div>
                        </div>

                      </div>
                      <!-- end of each panel -->
                    </div>
                    <!-- end of faq content -->
                  </div>
                </div>
              </div>
              <!-- end of new division -->

            </div>

          </div> <!-- end of FAQ -->

        </div>
      </div>
    </main>

    <?php get_page_part('footer.php','include'); ?>
    <?php if (empty($_SESSION)) { ?>
    <script data-cfasync="false" src='https://www.google.com/recaptcha/api.js?onload=recaptcha_render&render=explicit&hl=id' async defer></script>
    <?php } ?>
    <script data-cfasync="false" src="<?php echo get_home_page() ?>feedback.js" type="text/javascript" language="javascript"></script>
    <script data-cfasync="false" src="<?php echo get_home_page() ?>dispenkasi.js" type="text/javascript" language="javascript"></script>
    <script data-cfasync="false" src="<?php echo get_home_page(); ?>src/clipboard/clipboard.js" type="text/javascript" language="javascript"></script>
    <script data-cfasync="false" src="<?php echo get_home_page(); ?>src/icheck/icheck.js" type="text/javascript" language="javascript"></script>
    <script data-cfasync="false" src="<?php echo get_home_page(); ?>src/select2/js/select2.full.js" type="text/javascript" language="javascript"></script>
    <?php if (!empty($_SESSION)) { ?>
      <?php if (is_authorities($_SESSION["email"], "admin_page")) { ?>
      <script data-cfasync="false" src="<?php echo get_home_page(); ?>src/ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script>
      <script data-cfasync="false" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.bundle.js" type="text/javascript" language="javascript"></script>
      <script data-cfasync="false" src="<?php echo get_home_page(); ?>src/chart/custom-data.js" type="text/javascript" language="javascript"></script>
      <?php } ?>
    <?php } ?>
  </div>
</body>
</html>
<?php close_connection(); ?>
