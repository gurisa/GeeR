<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <?php include("functions.php"); ?>
  <?php echo show_meta_tag("barang"); ?>
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
        <form class="form-group form-inline" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="cari-barang" onsubmit="return validate_form_barang();">
          <input type="text" id="keywords" name="keywords" class="form-control" placeholder="Ketikan kata kunci.." />
          <input type="submit" class="btn btn-danger btn-md btn-custom-red" value="Cari Barang" />
        </form>
        <?php if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["detail"])) { ?>
          ok detail masuk
        <?php } else { ?>
          <?php if (check_items()) { ?>
          <div class="table-responsive data-barang">
            <table class="table table-hover table-bordered">
              <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Stok</th>
                <th>Harga</th>
              </tr>
              <?php
                $each = 10;
                $offset = 0;
                if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["page"])) {
                  $offset = $each * $_GET["page"];
                }
                $qry = "SELECT item_id, item_name, item_quantity, item_price FROM tb_items ORDER BY item_name ASC LIMIT $offset, $each";

                if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["keywords"])) {
                  $keywords = anti_injection($_POST["keywords"]);
                  $qry = "SELECT item_id, item_name, item_quantity, item_price FROM tb_items WHERE item_id LIKE '%" . $keywords . "%' OR item_name LIKE '%" . $keywords . "%' OR item_unit LIKE '%" . $keywords . "%' OR item_price LIKE '%" . $keywords . "%' OR item_description LIKE '%" . $keywords . "%' ORDER BY item_name ASC LIMIT $offset, $each";
                }
                $try = mysql_query($qry) or die(mysql_error());
                if (mysql_num_rows($try) >= 1) {
                while ($row = mysql_fetch_array($try)) {
              ?>
              <tr>
                <td><?php echo $row[0]; ?></td>
                <td><?php echo $row[1]; ?></td>
                <td><?php echo $row[2]; ?></td>
                <td><?php if ($row[3] == 0) { echo "-"; } else { echo "Rp" . num_to_rupiah($row[3]); } ?></td>
              </tr>
              <?php
                }
                }
              ?>
            </table>
          </div>

          <?php $page_count = mysql_query("SELECT item_id FROM tb_items");?>
          <?php $total_row = mysql_num_rows($page_count); ?>
          <?php $page = 0; if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["page"])) { $page = $_GET["page"]; } ?>
          <?php $max_page = $total_row / $each; ?>
          <?php if ($total_row > 10) { ?>
          <div class="row paging">
            <div class="col-md-12">

              <?php if (($_SERVER["REQUEST_METHOD"] == "GET" || !empty($_POST["keywords"]) )&& !empty($_GET["page"]) && $_GET["page"] > 0) { ?>
              <div class="pull-left item prev-btn">
                <a href="<?php echo get_home_page() . "barang/"; if ($_GET["page"] - 1 > 0) { echo "page/"; echo $_GET["page"] - 1; } ?>" title="Halaman Sebelumnya">&larr; Sebelumnya</a>
              </div>
              <?php } ?>

              <?php if (($_SERVER["REQUEST_METHOD"] == "GET" || !empty($_POST["keywords"])) && $total_row > 10 && ($page < ($max_page - 1))) { ?>
              <div class="pull-right item next-btn">
                <a href="<?php echo get_home_page() . "barang/page/"; if (empty($_GET["page"])) { echo "1"; }
                else { echo $_GET["page"] + 1; } ?>" title="Halaman Selanjutnya">Selanjutnya &rarr;</a>
              </div>
              <?php } ?>

            </div>
          </div>
          <?php } ?>

          <?php
            }
            else {
              echo "Data tidak ditemukan."; //redirect 404
              mysql_close();
            }
          ?>
        <?php }//end if of detail ?>
      </div>
    </main>

    <?php get_page_part('footer.php','include'); ?>
  </div>
</body>
</html>
<?php close_connection(); ?>
