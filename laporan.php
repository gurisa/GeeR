<?php session_start(); ?>
<?php include('functions.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="<?php echo get_home_page(); ?>src/bootstrap/css/bootstrap.css" />
  <title>Laporan Partisipan DISPENKASI 30</title>
</head>
<body>

  <?php include_once("src/tracking/self-tracking.php"); ?>
  <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_GET["key"]) && !empty($_POST["pengecualian-laporan"]) && !empty($_POST["mode-laporan-partisipan"]) && isset($_POST["coord"]) && is_array($_POST["coord"])) {
      $_key = anti_injection($_GET["key"]);
      $_rpt = "rpt-part-" . $_SESSION["email"] . "-" . $_SESSION["rpt-time"];
      $exception = anti_injection($_POST["pengecualian-laporan"]);
      $rep_title = "Laporan Partisipan Terdaftar";
      switch ($exception) {
        case 'D': $exception = "DNC"; break;
        case 'N': $exception = "DNC"; break;
        case 'DY': $rep_title = "Laporan Partisipan Belum Terdaftar"; break;
        case 'DN': break;
        case 'DNC': $rep_title = "Laporan Partisipan Sudah Terdaftar"; break;
        default: $exception = "DNC"; break;
      }
      if ($_key == sha1($_rpt)) {
        $access['id'] = $_key;
        $access['file'] = $_rpt . '.xls';
        $tmp = explode(',', $_SESSION["rpt-time"]);
        $access['date'] = $tmp[0];
        $access['time'] = $tmp[1];
        $access['email'] = $_SESSION["email"];
        $valid = true;
        $users = $_POST["coord"];
        for ($i = 0; $i < count($users); $i++) {
          if (!get_user($users[$i])) {
            $valid = false; break;
          }
        }
        if (generate_rpt_access($access) && $valid == true) {
          if (anti_injection($_POST["mode-laporan-partisipan"]) == "D") {
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=" . "rpt-part-" . $_SESSION["email"] . '.xls');
          }
          $users = $_POST["coord"];
          if (count($users) == 0) { ?>
          <div class="row">
            <div class="col-md-12">Tidak ada koordinator terdaftar.</div>
          </div>
          <?php } else { ?>
          <table border="1" cellpadding="0" cellspacing="0" class="table table-hover">
            <tr>
              <td colspan="7" class="text-center"><h1><?php echo $rep_title; ?></h1></td>
            </tr>
            <tr>
              <th class="text-center info">Organisasi/Koordiantor</th>
              <th class="text-center info">Nama</th>
              <th class="text-center info">Jenis Kelamin</th>
              <th class="text-center info">Tanggal Lahir</th>
              <th class="text-center info">Daftar (Minat Bakat)</th>
              <th class="text-center info">Biaya</th>
              <th class="text-center info">Status</th>
            </tr>
          <?php $tmp_allprice = 0;?>
          <?php $tmp_allparts = 0;?>
          <?php for ($i = 0; $i < count($users); $i++) { ?>
            <?php $parts = get_participants($users[$i], $exception); ?>
            <tr>
              <td <?php if ($parts !== "") { echo 'rowspan="' . (count($parts) + 1) . '"'; } ?>>
                <?php $tmp_user = get_user($users[$i]); ?>
                <?php echo switch_region($tmp_user["region_id"]) . '/' . $tmp_user["user_name"] . ' (' . $tmp_user["user_email"] . ')'; ?>
              </td>
              <?php if ($parts !== "") { ?>
                <?php $tmp_price = 0; ?>
                <?php for ($j = 0; $j < count($parts); $j++) { ?>
                <?php
                  $reg_as = switch_class($parts[$j]["class_id"]);
                  if (register_as($parts[$j]["participant_id"]) == "Peserta") {
                    $reg_as .= " (" . empty_to_strip(talent_name($parts[$j]["group_id"])) . ")";
                  }
                ?>
                  <tr>
                    <td><?php echo $parts[$j]["participant_name"]; ?></td>
                    <td class="text-center"><?php echo rewrite_gender($parts[$j]["participant_gender"]); ?></td>
                    <td class="text-center"><?php echo rewrite_date($parts[$j]["participant_birthdate"]); ?></td>
                    <td class="text-center"><?php echo $reg_as; ?></td>
                    <td class="text-center"><?php echo "Rp" . num_to_rupiah(class_price($parts[$j]["class_id"])); ?></td>
                    <td class="text-center"><?php echo switch_status($parts[$j]["participant_status"]); ?></td>
                  </tr>
                  <?php $tmp_price = class_price($parts[$j]["class_id"]) + $tmp_price; ?>
                <?php } ?>
                <?php $tmp_allprice = $tmp_price + $tmp_allprice; ?>
                <?php $tmp_allparts = count($parts) + $tmp_allparts; ?>
              <?php } else { ?>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
              <?php } ?>
              </tr>
              <?php if ($parts !== "") { ?>
              <tr>
                <td class="text-center">Sub-Total</td>
                <td class="text-center" colspan="4"><?php echo count($parts) . " Partisipan"; ?></td>
                <td class="text-center"><?php echo "Rp" . num_to_rupiah($tmp_price); ?></td>
                <td class="text-center"></td>
              </tr>
              <?php } ?>
          <?php } ?>
          <tr>
            <td class="text-center"><b>Total</b></td>
            <td class="text-center" colspan="4"><b><?php echo $tmp_allparts . " Partisipan"; ?></b></td>
            <td class="text-center"><b><?php echo "Rp" . num_to_rupiah($tmp_allprice); ?></b></td>
            <td class="text-center"></td>
          </tr>
          </table>
          <?php
          }

        }
        else {
          see_ya(get_home_page() . 'dispenkasi/#laporan');
        }
      }
      else {
        see_ya(get_home_page() . 'dispenkasi/#laporan');
      }
    }
    else {
      see_ya(get_home_page() . 'dispenkasi/#laporan');
    }
  ?>

</body>
</html>
