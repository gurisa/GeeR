<?php
  session_start();
  include_once('functions.php');
  if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_GET["k"])) {
    switch ($_GET["k"]) {
      /* BASE HANDLER */
      case "GETHMPG" :
        if (!isEmpty($_POST)) {
          if ($regions = show_regions()) {
            echo json_encode($regions);
          }
          else {
            echo "500";
          }
        }
      break;
      case "REGS" :
        if (!isEmpty($_POST)) {
          if ($regions = show_regions()) {
            echo json_encode($regions);
          }
          else {
            echo "500";
          }
        }
      break;
      case "REGID" :
        if (!isEmpty($_POST)) {
          if ($region = show_region($_POST["id"])) {
            echo json_encode($region);
          }
          else {
            echo "500";
          }
        }
      break;
      case "CRDS" :
        if (!isEmpty($_POST)) {
          if ($coordinators = show_organization($_SESSION)) {
            echo json_encode($coordinators);
          }
          else {
            echo "500";
          }
        }
      break;
      case "TRXH" :
        if (!isEmpty($_POST)) {
          if ($trx_headers = get_user_trx_header("*")) {
            echo json_encode($trx_headers);
          }
          else {
            echo "500";
          }
        }
      break;

      /* PANITIA */
      case "ORG" :
        if ($res = get_action("ORG", $_POST["email"])) {
          echo $res;
        }
        else {
          echo "500";
        }
      break;
      case "ORG-CFR" :
        if (confirm_coordinator($_SESSION["email"])) {

        }
        see_ya(get_home_page() . 'dispenkasi/#peserta');
      break;
      case "PAR-ACT" :
        if ($res = get_action("PAR", $_POST["id"])) {
          echo $res;
        }
        else {
          echo "500";
        }
      break;
      case "PAR-NM" :
        if (has_participants($_POST["email"])) {
          if ($participant = get_participants($_POST["email"], "*")) {
              for ($i = 0; $i < count($participant); $i++) {
                echo '<option value="' .$participant[$i]["participant_id"]. '">' .$participant[$i]["participant_name"]. '</option>';
              }
          }
          else {
            echo "500";
          }
        }
        else {
          echo '<option value="nill">Data peserta tidak ditemukan.</option>';
        }
      break;
      case "SORG" :
        if ($res = detail_organisasi($_POST["id"])) {
          echo $res;
        }
        else {
          echo "500";
        }
      break;
      case "SPAR" :
        if ($res = detail_participant($_POST["id"])) {
          echo $res;
        }
        else {
          echo "500";
        }
      break;
      case "CORG" :
      if ($res = set_status("ORG", $_POST["id"], $_POST["aksi"])) {
        echo "200";
      }
      else {
        echo "500";
      }
      break;
      case "CPAR" :
        if ($res = set_status("PAR", $_POST["id"], $_POST["aksi"])) {
          echo "200";
        }
        else {
          echo "500";
        }
      break;
      case "FORG" :
        if (!isEmpty($_POST)) {
          if ($users = find_organisasi($_POST["cari"])) {
            for ($i = 0; $i < count($users); $i++) {
              echo '<option value="' . $users[$i]["user_email"] . '">' . switch_region($users[$i]["region_id"]) . ' - ' . $users[$i]["user_name"] . '</option>';
            }
          }
        }
        else {
          echo "500";
        }
      break;
      case "FPAR" :
        if (!isEmpty($_POST)) {
          if ($participants = find_peserta($_POST["cari"])) {
            for ($i = 0; $i < count($participants); $i++) {
              echo '<option value="' . $participants[$i]["participant_id"] . '">' . $participants[$i]["participant_name"] . '</option>';
            }
          }
        }
        else {
          echo "500";
        }
      break;
      case "TRXSPAR" :
        if (!isEmpty($_POST)) {
          echo '<ul id="detail-items">';
          if (!organisasi_sudah_bayar($_POST["id"])) {//Jika ada transaksi refund, ubah ini.
            $account = get_user($_POST["id"]);
              echo '<li><label><input type="checkbox" name="items" value="org" class="form-control" /> ' . switch_region($account["region_id"]) . ' - ' . $account["user_name"] . ' [' . $account["user_email"] . '] (Rp' .num_to_rupiah(biaya_organisasi($_POST["id"])) . ')' . '</label>
                    </li>
              ';
          }
          if ($participants = get_participants($_POST["id"], "DY")) {
            for ($i = 0; $i < count($participants); $i++) {
              echo '
                <li><label><input type="checkbox" name="items" value="' . $participants[$i]["participant_id"] .'" class="form-control" /> ' . $participants[$i]["participant_name"] . ' - ' . switch_class($participants[$i]["class_id"]) . ' (Rp' . num_to_rupiah(class_price($participants[$i]["class_id"])) . ')' . '</label>
                </li>
              ';
            }
            echo '</ul>';
          }
        }
        else {
          echo "500";
        }
      break;
      case "TRXAPAR" :
        if (!isEmpty($_POST) && !isEmpty($_SESSION)) {
          if (isEmpty($_SESSION["trx_id"])) {
            $_POST["trx_id"] = get_trx_id();
          }
          else {
            $_POST["trx_id"] = $_SESSION["trx_id"];
          }
          $valid = true;
          $_POST["peserta"] = json_decode(stripslashes($_POST["peserta"]));
          $_POST["peserta"] = array_filter($_POST["peserta"], 'strlen');
          foreach ($_POST["peserta"] as $par) {
            if ($par != "org") {
              if (!is_owner($_POST, $par)) {
                $valid = false;
              }
            }
          }
          if ($valid == true) {
            $_POST["admin"] = $_SESSION["email"];
            if ($res = add_trx_headers($_POST)) {
              foreach ($_POST["peserta"] as $par_id) {
                $tmp = $_SESSION["email"];
                if ($par_id == "org") {
                  $_POST["item"] = "org";
                  $_SESSION["email"] = $_POST["email"];
                  $_POST["price"] = biaya_organisasi($_SESSION);
                  if ($res = add_trx_details($_POST)) {
                    set_status("ORG", $_POST["email"], "Y");
                    $res = true;
                  }
                  else {
                    $res = false;
                    return;
                  }
                }
                else {
                  $_POST["item"] = $par_id;
                  $participant = get_participant($par_id);
                  $_POST["price"] = class_price($participant["class_id"]);
                  if ($res = add_trx_details($_POST)) {
                    set_status("PAR", $par_id, "Y");
                    $res = true;
                  }
                  else {
                    $res = false;
                    return;
                  }
                }
                $_SESSION["email"] = $tmp;
              }
              if (isset($_POST["lain"]) && !empty($_POST["lain"])) {
                $_POST["item"] = "oth";
                $_POST["price"] = $_POST["lain"];
                if ($res = add_trx_details($_POST)) {
                  $res = true;
                }
                else {
                  $res = false;
                  return;
                }
              }
              if ($res == true) {
                echo "200";
              }
            }
            else {
              echo "501";
            }
          }
          else {
            echo "502";
          }
        }
        else {
          echo "503";
        }
      break;
      case "TRXSDTL" :
        if (!isEmpty($_POST)) {
          $details = get_user_trx_details("*", $_POST["id"]);
          $email = get_trx_user_email($_POST["id"]);
          $trx = get_user_trx_header_single($email, $_POST["id"]);
          ?>
          <div class="informasi-transaksi">
            <div class="row">
              <div class="col-md-12">
                <hr class="limit" />
              </div>
            </div>
            <div class="row">
              <div class="col-md-4"><b>ID Transaksi</b></div>
              <div class="col-md-8">
                <?php echo $trx["header_id"]; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4"><b>Tanggal/Waktu</b></div>
              <div class="col-md-8">
                <?php $trx_date = date_create($trx["header_date"]); ?>
                <?php echo switch_day(date_format($trx_date, "w")) . ", " . date_format($trx_date, "j") . " " . switch_month(date_format($trx_date, "m")) . " " . date_format($trx_date, "Y") . "/" . $trx["header_time"]; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4"><b>Jenis/Metode Pembayaran</b></div>
              <div class="col-md-8">
                <?php echo switch_payment($trx["header_type"]) . "/" . $trx["header_payment_methods"]; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4"><b>Koordinator/Panitia</b></div>
              <div class="col-md-8">
                <?php echo $trx["user_email"] . "/" . $trx["admin_email"]; ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4"><b>Catatan</b></div>
              <div class="col-md-8">
                <?php echo $trx["header_information"]; ?>
              </div>
            </div>
          <?php
          if (count($details) == 0) { ?>
          <div class="row">
            <div class="col-md-12">
              Tidak ada riwayat transaksi.
            </div>
          </div>
          <?php } else { ?>
            <?php $tmp_biaya = 0;?>
            <div class="row" style="margin-top:5px;">
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

            <div class="row">
              <div class="col-md-12">
                <?php $_SESSION["trx-rpt-time"] = date("Y-m-d,H:i:s"); ?>
                <?php $_SESSION["trx-rpt-id"] = $trx["header_id"]; ?>
                <a href="<?php echo get_home_page(); ?>riwayat.php?key=<?php echo sha1($_SESSION["trx-rpt-id"] . "D" . $_SESSION["trx-rpt-time"]); ?>" target="_blank">
                  <button type="button" id="download-riwayat-transaksi" class="btn btn-sm btn-danger btn-custom-red">Download <span class="glyphicon glyphicon-download-alt"></span></button>
                </a>
                <a href="<?php echo get_home_page(); ?>riwayat.php?key=<?php echo sha1($_SESSION["trx-rpt-id"] . "I" . $_SESSION["trx-rpt-time"]); ?>" target="_blank">
                  <button type="button" id="print-riwayat-transaksi" class="btn btn-sm btn-danger btn-custom-red pull-right">Print <span class="glyphicon glyphicon-print"></span></button>
                </a>
              </div>
            </div>
          <?php } ?>

          </div>
          <?php
        }
        else {
          echo "500";
        }
      break;

      /* KOORDINATOR */
      case "REG" :
        if (!empty($_POST)) {
          $email = anti_injection($_POST["email"]);
          $_POST["email"] = $email;
          $_POST["nama"] = anti_injection($_POST["nama"]);
          $_POST["asal"] = anti_injection($_POST["asal"]);
          $_POST["telepon"] = anti_injection($_POST["telepon"]);
          $_POST["password"] = anti_injection($_POST["password"]);

          if (email_exists($email)) {
            echo "501"; //email sudah terdaftar
          }
          else {
            if (daftar_dispenkasi($_POST)) {
              if (send_activation($_POST)) {
                echo "200"; //berhasil
              }
              else {
                echo "502"; //berhasil daftar, gagal kirim email aktivasi.
              }
            }
            else {
              echo "500"; //gagal
            }
          }

        }
        else {
          echo "500"; //gagal
        }
      break;
      case "ENT" :
        if (!empty($_POST)) {
          $email = anti_injection($_POST["email"]);
          $password = anti_injection($_POST["password"]);
          if (email_exists($email)) {
            if (sudah_aktivasi($email)) {
              if (check_account($email)) {
                if (masuk_dispenkasi($email, $password)) {
                  echo "200";
                  $_SESSION["email"] = $email;
                  $_SESSION["password"] = $password;
                  $_SESSION["authority"] = get_authority($_POST);
                }
                else {
                  echo "404";
                }
              }
              else {
                echo "402";
              }
            }
            else {
              echo "403";
            }
          }
          else {
            echo "500";
          }
        }
      break;
      case "OUT" :
        echo "200";
        session_unset();
        session_destroy();
      break;
      case "CFG" :
        if (!empty($_POST)) {
          if (old_password($_POST["email"], $_POST["old_password"])) {
            if (ubah_pengaturan($_POST)) {
              if (isset($_POST["new_password"]) && !empty($_POST["new_password"])) {
                $_SESSION["password"] = $_POST["new_password"];
              }
              echo "200"; //berhasil
            }
            else {
              echo "500"; //kesalahan internal server/gagal query
            }
          }
          else {
            echo "404"; //password lama salah
          }
        }
      break;
      case "EXS" :
        if (!empty($_POST)) {
          $email = anti_injection($_POST["email"]);
          if (email_exists($email)) {
            if (sudah_aktivasi($email)) {
              echo "201";
            }
            else {
              echo "200";
            }
          }
          else {
            echo "404";
          }
        }
      break;
      case "ACT" :
        if (!empty($_POST)) {
          $code = anti_injection($_POST["code"]);
          $email = anti_injection($_POST["email"]);
          if (sudah_aktivasi($email)) {
            echo "201";
          }
          else {
            if ($code == get_activation_code($email)) {
              if (activation($email, $code)) {
                if (coordinator_registered($email)) {
                  set_status("ORG", $email, "Y");
                }
                echo "200";
              }
              else {
                echo "500";
              }
            }
            else {
              echo "404";
            }
          }
        }
      break;
      case "REA" :
        if (!empty($_POST)) {
          $email = anti_injection($_POST["email"]);
          if (email_exists($email)) {
            if (sudah_aktivasi($email)) {
              echo "201";
            }
            else {
              $user = get_user($email);
              $data["email"] = anti_injection($user["user_email"]);
              $data["nama"] = anti_injection($user["user_name"]);
              $data["telepon"] = anti_injection($user["user_phone"]);
              $data["asal"] = anti_injection($user["region_id"]);
              $code = get_activation_code($email);
              if ($code == "" || isEmpty($code)) {
                if (create_activation($email)) {
                  $try = send_activation($data);
                  if ($try) {
                    echo "200";
                  }
                  else {
                    echo "500";
                  }
                }
                else {
                  echo "500";
                }
              }
              else {
                $try = send_activation($data);
                if ($try) {
                  echo "200";
                }
                else {
                  echo "500";
                }
              }
            }
          }
          else {
            echo "404";
          }
        }
      break;

      /* PESERTA */

      case "DELPAR" :
        if (delete_participant($_SESSION, $_POST)) {
          echo "200";
        }
        else {
          echo "500";
        }
      break;
      case "ADDPAR" :
        if (add_participant($_SESSION, $_POST)) {
          echo "200";
        }
        else {
          echo "500";
        }
      break;
      case "CHKPAR" : //check participant
        if (!isEmpty($_POST)) {
          if (!isEmpty($_POST["id"])) {
            $id = anti_injection($_POST["id"]);
            if ($participant = get_participant($id)) {
              if ($participant["class_id"] == "IP") {
                $daftar = '
                  <label for="participant">
                    <input type="radio" name="iCheck" id="participant" value="P"> Peserta
                  </label>
                  <label for="inspector">
                    <input type="radio" name="iCheck" id="inspector" value="I" checked> Peninjau
                  </label>
                ';
              }
              else {
                $daftar = '
                  <label for="participant">
                    <input type="radio" name="iCheck" id="participant" value="P" checked> Peserta
                  </label>
                  <label for="inspector">
                    <input type="radio" name="iCheck" id="inspector" value="I"> Peninjau
                  </label>
                ';
              }

              if ($participant["class_id"] == "AD") {
                $kelas_3 = '
                  <option value="TE" title="Remaja">Remaja</option>
                  <option value="AD" title="Dewasa" selected>Dewasa</option>
                ';
              }
              else {
                $kelas_3 = '
                  <option value="TE" title="RAKIN" selected>RAKIN</option>
                  <option value="AD" title="PAKIN">PAKIN</option>
                ';
              }

              if ($participant["group_id"] == "MUSIC") {
                $grup = '
                  <option value="MUSIC" title="Seni Musik" selected>Seni Musik</option>
                  <option value="DANCE" title="Seni Tari">Seni Tari</option>
                  <option value="SELFDEFENSE" title="Seni Bela Diri">Seni Bela Diri</option>
                ';
              }
              else if ($participant["group_id"] == "DANCE") {
                $grup = '
                  <option value="MUSIC" title="Seni Musik">Seni Musik</option>
                  <option value="DANCE" title="Seni Tari" selected>Seni Tari</option>
                  <option value="SELFDEFENSE" title="Seni Bela Diri">Seni Bela Diri</option>
                ';
              }
              else {
                $grup = '
                  <option value="MUSIC" title="Seni Musik">Seni Musik</option>
                  <option value="DANCE" title="Seni Tari">Seni Tari</option>
                  <option value="SELFDEFENSE" title="Seni Bela Diri" selected>Seni Bela Diri</option>
                ';
              }

              if ($participant["participant_gender"] == "F") {
                $kelamin = '
                  <label for="male">
                    <input type="radio" name="jenis-kelamin-peserta" id="male" value="M"> Laki-Laki
                  </label>
                  <label for="female">
                    <input type="radio" name="jenis-kelamin-peserta" id="female" value="F" checked> Perempuan
                  </label>
                ';
              }
              else {
                $kelamin = '
                <label for="male">
                  <input type="radio" name="jenis-kelamin-peserta" id="male" value="M" checked> Laki-Laki
                </label>
                <label for="female">
                  <input type="radio" name="jenis-kelamin-peserta" id="female" value="F"> Perempuan
                </label>
                ';
              }
              echo '
                <form id="ubah-simpan-peserta" method="POST">
                  <div class="row" style="margin-top:10px;">
                    <div class="col-md-2"><label for="nama-peserta">*Nama</label></div>
                    <div class="col-md-4"><input type="text" id="nama-peserta" name="nama-peserta" class="form-control" maxlength="50" placeholder="Tulis nama peserta" value="' . $participant["participant_name"] . '" /></div>
                    <div class="col-md-2"><label for="email-peserta">E-mail</label></div>
                    <div class="col-md-4"><input type="email" id="email-peserta" name="email-peserta" class="form-control" maxlength="100" placeholder="Tulis alamat e-mail peserta" value="' . $participant["participant_email"] . '" /></div>
                  </div>
                  <div class="row">
                    <div class="col-md-2"><label for="jenis-kelamin-peserta">*Jenis Kelamin</label></div>
                    <div class="col-md-4">' . $kelamin . '</div>
                    <div class="col-md-2"><label for="telepon-peserta">Telepon</label></div>
                    <div class="col-md-4"><input type="text" id="telepon-peserta" name="telepon-peserta" class="form-control" maxlength="20" placeholder="Tulis nomor telepon peserta" value="' . $participant["participant_phone"] . '" /></div>
                  </div>
                  <div class="row">
                    <div class="col-md-2"><label for="tanggal-lahir-peserta">*Tanggal Lahir</label></div>
                    <div class="col-md-4"><input type="text" id="tanggal-lahir-peserta" name="tanggal-lahir-peserta" class="form-control" placeholder="Tulis tanggal lahir peserta" value="' .  $participant["participant_birthdate"] . '" /></div>
                    <div class="col-md-2"><label for="facebook-peserta">Facebook</label></div>
                    <div class="col-md-4"><input type="text" id="facebook-peserta" name="facebook-peserta" class="form-control" maxlength="50" placeholder="Tulis ID facebook peserta" value="' . $participant["participant_facebook"] . '" /></div>
                  </div>
                  <div class="row">
                    <div class="col-md-2"><label for="daftar-sebagai">*Daftar</label></div>
                    <div class="col-md-4">' . $daftar . '</div>
                    <div class="col-md-2"><label for="twitter-peserta">Twitter</label></div>
                    <div class="col-md-4"><input type="text" id="twitter-peserta" name="twitter-peserta" class="form-control" maxlength="50" placeholder="Tulis ID twitter peserta" value="' .  $participant["participant_twitter"] . '" /></div>
                  </div>
                  <div class="row">
                    <div class="col-md-2"><label id="label-kelas" for="kelas-peserta">*Kelas</label></div>
                    <div class="col-md-4"><select id="kelas-peserta" name="kelas-peserta" class="form-control">' . $kelas_3 . '</select></div>
                    <div class="col-md-2"><label for="instagram-peserta">Instagram</label></div>
                    <div class="col-md-4"><input type="text" id="instagram-peserta" name="instagram-peserta" class="form-control" maxlength="50" placeholder="Tulis ID instagram peserta" value="' .  $participant["participant_instagram"] . '" /></div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <label id="label-talent" for="talent-peserta">*Minat Bakat</label>
                    </div>
                    <div class="col-md-4">
                      <select id="talent-peserta" name="talent-peserta" class="form-control js-example-basic-single" style="width:100%;">' . $grup . '</select>
                    </div>
                    <div class="col-md-2"><label for="line-peserta">Line</label></div>
                    <div class="col-md-4"><input type="text" id="line-peserta" name="line-peserta" class="form-control" maxlength="50" placeholder="Tulis ID line peserta" value="' .  $participant["participant_line"]  . '" /></div>
                  </div>
                  <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6">
                      <button type="submit" id="simpan-peserta" class="btn btn-danger btn-sm btn-custom-navigasi-red pull-right" onclick="simpan_peserta(' . $participant["participant_id"] . ')">Simpan <span class="glyphicon glyphicon-floppy-saved"></span></button>
                      <a href="' . get_home_page() . 'dispenkasi/"><button type="button" class="btn btn-default btn-sm btn-custom-navigasi-gray btn-sm pull-right">Batalkan <span class="glyphicon glyphicon-refresh"></span></button></a>
                    </div>
                  </div>
                </form>
              ';
            }
            else {
              echo "500";
            }
          }
          else {
            echo "500";
          }
        }
        else {
          echo "500";
        }
      break;
      case "CHGPAR" :
        if (!isEmpty($_POST)) {
          if (!isEmpty($_POST["id"])) {
            if ($participant = get_participant(anti_injection($_POST["id"]))) {
              if (change_participant($_SESSION, $_POST)) {
                echo "200";
              }
              else {
                echo "500";
              }
            }
          }
        }
      break;
      case "MRKPAR" :
        if (confirm_participant($_SESSION, $_POST)) {
          echo "200";
        }
        else {
          echo "500";
        }
      break;
      case "MRKALL" :
        if (confirm_all_participant($_SESSION["email"])) {
          echo "200";
        }
        else {
          echo "500";
        }
      break;

      /* Pengumuman */
      case "ADDANCT" :
        if (!isEmpty($_POST)) {
          $_POST["email"] = $_SESSION["email"];
          if (add_announcement($_POST)) {
            echo "200";
          }
          else {
            echo "500";
          }
        }
      break;
      case "DELANCT" :
        if (!isEmpty($_POST)) {
          if (delete_announcement($_SESSION, $_POST["id"])) {
            echo "200";
          }
          else {
            echo "500";
          }
        }
      break;
      case "STREG" :
        if (!isEmpty($_POST)) {
          $_POST["key"] = anti_injection($_POST["key"]);
          $res = look_status($_POST["cat"], $_POST["key"]);
          if ($res) {
            $show = '
              <div class="row">
                <div class="col-md-12 text-center"><b>Hasil Pencarian</b></div>
              </div>
            ';
            switch ($_POST["cat"]) {
              case 'CO':
                for ($i = 0; $i < count($res); $i++) {
                  $show .= '
                    <div class="row">
                      <div class="col-md-3"><b>Nama</b></div>
                      <div class="col-md-9"> ' . $res[$i]["user_name"] . '</div>
                    </div>
                    <div class="row">
                      <div class="col-md-3"><b>Asal</b></div>
                      <div class="col-md-9"> ' . switch_region($res[$i]["region_id"]) . '</div>
                    </div>
                    <div class="row">
                      <div class="col-md-3"><b>Status</b></div>
                      <div class="col-md-9"><span class="' . get_status($res[$i]["user_status"]) . '">' . switch_status($res[$i]["user_status"]) . '</span></div>
                    </div><hr />
                  ';
                }
              break;
              case 'PI':
                for ($i = 0; $i < count($res); $i++) {
                  if (register_as($res[$i]["participant_id"]) == "Peserta") {
                    $reg_as = "Peserta / Kelas " . switch_class($res[$i]["class_id"]) . " (" . empty_to_strip(talent_name($res[$i]["group_id"])) . ")";
                  }
                  else {
                    $reg_as = switch_class($res[$i]["class_id"]);
                  }
                  $show .= '
                    <div class="row">
                      <div class="col-md-3"><b>Nama</b></div>
                      <div class="col-md-9"> ' . $res[$i]["participant_name"] . '</div>
                    </div>
                    <div class="row">
                      <div class="col-md-3"><b>Asal</b></div>
                      <div class="col-md-9"> ' . switch_region($res[$i]["region_id"]) . '</div>
                    </div>
                    <div class="row">
                      <div class="col-md-3"><b>Daftar</b></div>
                      <div class="col-md-9"> ' . $reg_as . '</div>
                    </div>
                    <div class="row">
                      <div class="col-md-3"><b>Status</b></div>
                      <div class="col-md-9"><span class="' . get_status($res[$i]["participant_status"]) . '">' . switch_status($res[$i]["participant_status"]) . '</span></div>
                    </div><hr />
                  ';
                }
              break;
              default:break;
            }
            echo $show;
          }
          else if ($res == "") {
            echo "<b>Data tidak ditemukan..</b>";
          }
          else {
            echo "500";
          }
        }
      break;
      /* CHART */
      case "REGCTPARGEN" :
        if (!isEmpty($_POST)) {
          $res = array_filter(calculate_participants("REGGEN"));
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;
      case "REGCTPARCLS" :
        if (!isEmpty($_POST)) {
          //$res = array_filter(calculate_participants("CLS"));
          $res = calculate_participants("REGCLS");
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;
      case "REGCTRMB" :
        if (!isEmpty($_POST)) {
          $res = calculate_participants("REGRMB");
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;
      case "REGCTPMB" :
        if (!isEmpty($_POST)) {
          $res = calculate_participants("REGPMB");
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;

      case "UNREGCTPARGEN" :
        if (!isEmpty($_POST)) {
          $res = array_filter(calculate_participants("UNREGGEN"));
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;
      case "UNREGCTPARCLS" :
        if (!isEmpty($_POST)) {
          //$res = array_filter(calculate_participants("CLS"));
          $res = calculate_participants("UNREGCLS");
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;
      case "UNREGCTRMB" :
        if (!isEmpty($_POST)) {
          $res = calculate_participants("UNREGRMB");
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;
      case "UNREGCTPMB" :
        if (!isEmpty($_POST)) {
          $res = calculate_participants("UNREGPMB");
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;

      case "ALLCTPARGEN" :
        if (!isEmpty($_POST)) {
          $res = array_filter(calculate_participants("ALLGEN"));
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;
      case "ALLCTPARCLS" :
        if (!isEmpty($_POST)) {
          $res = calculate_participants("ALLCLS");
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;
      case "ALLCTRMB" :
        if (!isEmpty($_POST)) {
          $res = calculate_participants("ALLRMB");
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;
      case "ALLCTPMB" :
        if (!isEmpty($_POST)) {
          $res = calculate_participants("ALLPMB");
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;

      case "REGCTWEBHIT" :
        if (!isEmpty($_POST)) {
          $res = array_filter(get_logs("CTWEBHIT"));
          echo json_encode($res, JSON_NUMERIC_CHECK);
        }
      break;

      /* OTH */
      default :
      break;
    }
  }
  else {
    header("Location:" . get_home_page() . "dispenkasi/");
  }
?>
