<?php
  include("settings.php");

  function close_connection() {
    mysql_close();
  }

  function see_ya($where) {
    header('Location:' . $where);
  }

  function random_strings($length) {
    $string = "";
    //, range('0','9')
    $character_sets = array_merge(range('A','Z'));
    $max = count($character_sets) - 1;
    for ($i = 0; $i <= $length; $i++) {
      $rand = mt_rand(0, $max);
      $string .= $character_sets[$rand];
    }
    return($string);
  }

  function isEmpty($param) {
    $result = false;
    if (!isset($param) && empty($param)) {
      $result = true;
    }
    return $result;
  }

  function get_page_part($page, $param) {
    if ($param == 'include') {
      $result = include($page);
    }
    else if ($param == 'require') {
      $result = require($page);
    }
    else {
      $result = include($page);
    }
    return $result;
  }

  function num_to_rupiah($number, $digit = 0) {
    if (isset($number) && isset($digit)) {
      return number_format($number, $digit, ',','.');
    }
  }

  function get_home_page() {
    $currentPath = $_SERVER['PHP_SELF'];
    $pathInfo = pathinfo($currentPath);
    $hostName = $_SERVER['HTTP_HOST'];//$_SERVER['SERVER_NAME'];
    $protocol = "";
    if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO'])){
      $protocol .= $_SERVER['HTTP_X_FORWARDED_PROTO'] . '://';
    }
    else {
      $protocol .= (!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] != 'off') || ($_SERVER['SERVER_PORT'] == 443)) ? "https://" : "http://";
    }
    $home_page = $protocol . $hostName . $pathInfo['dirname'];
    if (substr($home_page, -1) != "/") {
      $home_page .= "/";
    }
    return $home_page;
  }

  function switch_day($id) {
    $result = "";
    if (!isEmpty($id)) {
      switch ($id) {
        case '0':$result = "Minggu";break;
        case '1':$result = "Senin";break;
        case '2':$result = "Selasa";break;
        case '3':$result = "Rabu";break;
        case '4':$result = "Kamis";break;
        case '5':$result = "Jumat";break;
        case '6':$result = "Sabtu";break;
        default:break;
      }
    }
    return $result;
  }

  function switch_month($id) {
    $result = "";
    if (!isEmpty($id)) {
      switch ($id) {
        case '01':$result = "Januari";break;
        case '02':$result = "Februari";break;
        case '03':$result = "Maret";break;
        case '04':$result = "April";break;
        case '05':$result = "Mei";break;
        case '06':$result = "Juni";break;
        case '07':$result = "Juli";break;
        case '08':$result = "Agustus";break;
        case '09':$result = "September";break;
        case '10':$result = "Oktober";break;
        case '11':$result = "November";break;
        case '12':$result = "Desember";break;
        default:break;
      }
    }
    return $result;
  }

  /* Rewrite */
  function rewrite_gender($gender) {
    if (isset($gender) && !empty($gender)) {
      switch ($gender) {
        case 'M': $gender = "Laki-Laki"; break;
        case 'F': $gender = "Perempuan"; break;
        default : break;
      }
    }
    return $gender;
  }

  function rewrite_date($date) {
    if (isset($date) && !empty($date)) {
      date_default_timezone_set("Asia/Jakarta");
      $date = date_create($date);
      switch(date_format($date, "M")) {
        case 'Jan' : $bulan="Januari"; break;
        case 'Feb' : $bulan="Februari"; break;
        case 'Mar' : $bulan="Maret"; break;
        case 'Apr' : $bulan="April"; break;
        case 'May' : $bulan="Mei"; break;
        case 'Jun': $bulan="Juni"; break;
        case 'June': $bulan="Juni"; break;
        case 'Jul' : $bulan="Juli"; break;
        case 'Aug' : $bulan="Agustus"; break;
        case 'Sep' : $bulan="September"; break;
        case 'Oct' : $bulan="Oktober"; break;
        case 'Nov' : $bulan="November"; break;
        case 'Dec' : $bulan="Desember"; break;
        default   : $bulan=date_format($date, "M"); break;
      }
      $date = date_format($date, "j ") . $bulan . date_format($date, " Y");
    }
    return $date;
  }

  function empty_to_strip($data) {
    if (!isset($data) || empty($data)) {
      $data = "-";
    }
    return $data;
  }

  function anti_injection($data) {
		$data = mysql_real_escape_string($data);
    $data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		$data = htmlentities($data);
		return $data;
	}

  function deinjecition($data) {
    $data = htmlspecialchars_decode($data);
    $data = html_entity_decode($data);
    return $data;
  }

  function get_token() {
    return uniqid();
  }

  /* */
  function check_items() {
    $result = false;
    $qry = "SELECT * FROM tb_items LIMIT 0,1";
    $try = mysql_query($qry);
    if ($try) {
      if (mysql_num_rows($try) == 1) {
        $result = true;
      }
    }
    return $result;
  }

  function check_votes() {
    $result = true;
    $qry = "SELECT vote_id FROM tb_votes LIMIT 0,1";
    $try = mysql_query($qry);
    if ($try) {
      if (mysql_num_rows($try) == 0) {
        $result = false;
      }
    }
    return $result;

  }

  function show_musics() {
    $qry = mysql_query("SELECT * FROM tb_musics");
    if ($qry) {
      $array = array();
      while($row = mysql_fetch_assoc($qry)){
        $array[] = $row;
      }
      return $array;
    }
  }

  function get_dong_xiu_date($param) {
    $sunday = strtotime("next Sunday");
    switch(date("l", $sunday)) {
      case 'Monday':$hari="Senin";break;
      case 'Tuesday':$hari="Selasa";break;
      case 'Wednesday':$hari="Rabu";break;
      case 'Thursday':$hari="Kamis";break;
      case 'Friday':$hari="Jumat";break;
      case 'Saturday':$hari="Sabtu";break;
      case 'Sunday':$hari="Minggu";break;
    }

    switch(date("M", $sunday)) {
      case 'Jan':$bulan="Januari";break;
      case 'Feb':$bulan="Februari";break;
      case 'Mar':$bulan="Maret";break;
      case 'Apr':$bulan="April";break;
      case 'May':$bulan="Mei";break;
      case 'June':$bulan="Juni";break;
      case 'Jul':$bulan="Juli";break;
      case 'Aug':$bulan="Agustus";break;
      case 'Sep':$bulan="September";break;
      case 'Oct':$bulan="Oktober";break;
      case 'Nov':$bulan="November";break;
      case 'Dec':$bulan="Desember";break;
    }

    if (isset($param) && !empty($param)) {
      if ($param == "YYYY-MM-DD") {
        $result = date("Y-m-d", $sunday);
      }
      else {
        $result = date("d-m-Y", $sunday);
      }
    }
    else {
      $result = $hari . date(", d ", $sunday) . $bulan . date(" Y", $sunday);
    }
    return $result;
  }

  function get_quote() {
    $qry = mysql_query("SELECT * FROM tb_quotes ORDER BY RAND() LIMIT 1");
    if ($qry) {
      $array = array();
      while($row = mysql_fetch_assoc($qry)){
        $array[] = $row;
      }
      return $array;
    }
  }

  function get_vote_result($param) {
    $qry = "SELECT vote_choice_1, vote_choice_2, vote_choice_3 FROM tb_votes";
    if (isset($param) && !empty($param)) {
      switch ($param) {
        case "week" :
                      $dongxiu = get_dong_xiu_date("YYYY-MM-DD");
                      $qry = "SELECT vote_choice_1, vote_choice_2, vote_choice_3 FROM tb_votes WHERE dongxiu_date='$dongxiu'";
        break;
        case "all"  :
                      $qry = "SELECT vote_choice_1, vote_choice_2, vote_choice_3 FROM tb_votes";
        break;
        default     : $qry = "SELECT vote_choice_1, vote_choice_2, vote_choice_3 FROM tb_votes";
      }
    }

    $try = mysql_query($qry);
    if ($try) {
      $vote_array = array();
      $vote_result = array();
      while($vote = mysql_fetch_assoc($try)){
        $vote_array[] = $vote;
      }

      for($i=0;$i<count($vote_array);$i++) {
        $vote_result[] = $vote_array[$i]["vote_choice_1"];
        $vote_result[] = $vote_array[$i]["vote_choice_2"];
        $vote_result[] = $vote_array[$i]["vote_choice_3"];
      }
      $vote_result = array_count_values($vote_result);
      arsort($vote_result);
    }
    return $vote_result;
  }

  function get_music_title_by_id($param) {
    $result = false;
    if (isset($param) && !empty($param)) {
      $qry = "SELECT music_title FROM tb_musics WHERE music_id='$param'";
      $try = mysql_query($qry) or die();
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          $result = mysql_fetch_assoc($try);
          $result = $result["music_title"];
        }
      }
    }
    return $result;
  }

  function get_meta($id) {
    $result = "";
    if (!isEmpty($id)) {
      $id = anti_injection($id);
      $qry = "SELECT * FROM tb_meta_tags WHERE meta_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          if ($row = mysql_fetch_assoc($try)) {
            $result["meta_id"] = $row["meta_id"];
            $result["meta_author"] = $row["meta_author"];
            $result["meta_keywords"] = $row["meta_keywords"];
            $result["meta_description"] = $row["meta_description"];
            $result["meta_title"] = $row["meta_title"];
          }
        }
      }
    }
    return $result;
  }

  function show_meta_tag($id) {
    if (isEmpty($id)) {
      $id = "index";
    }
    $meta = get_meta($id);
    $home = get_home_page();
    if ($id == "dispenkasi") {
      $path = "src/img/logo/dispenkasi.png";
    }
    else if ($id == "developer") {
      $path = "src/img/logo/gurisa-com.png";
    }
    else {
      $path = "src/img/logo/makin.png";
    }
    $img = $home . $path;
    /*
          <meta property="og:image:secure_url" content="' . $img . '" />
          <meta property="og:image:width" content="" />
          <meta property="og:image:height" content="" />
    */
    if ($id == "index") {
      $page = "";
    }
    else {
      $page = $id . "/";
    }

    return '
      <!--
        Developed by : Raka Suryaardi Widjaja;
        Copyright    : Copyright (c) 2016 Gurisa.Com All Rights Reserved;
        Version      : 1.3;
      -->
      <title>' . $meta["meta_title"] . '</title>
      <meta property="og:title" content="' . $meta["meta_title"] . '" />
      <meta property="og:url" content="' . $home . $page . '" />
      <meta property="og:type" content="website" />

      <meta property="og:image" content="' . $img . '" />
      <meta property="og:image" content="' . get_home_page() . 'src/img/logo/dispenkasi-red.png" />
      <meta property="og:image" content="' . get_home_page() . 'src/img/logo/gurisa-com.png" />

      <meta property="og:description" content="' . $meta["meta_description"] . '" />

      <meta name="author" content="' . $meta["meta_author"] . '">
      <meta name="keywords" content="' . $meta["meta_keywords"] . '" />
      <meta name="description" content="' . $meta["meta_description"] . '">
    ';
  }
  /* DISPENKASI */

  function email_exists($email) {
    $result = false;
    if ((isset($email) && !empty($email))) {
      $email = anti_injection($email);
      $qry = "SELECT user_email FROM tb_users WHERE user_email='$email'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function sudah_masuk($sesi) {
    $result = false;
    if (isset($sesi) && !empty($sesi)) {
      $email = $sesi["email"];
      $email = anti_injection($email);
      $password = sha1(md5($sesi["password"]));
      $password = anti_injection($password);
      if ((isset($email) && !empty($email)) && (isset($password) && !empty($password))) {
        $qry = "SELECT user_email, user_password FROM tb_users WHERE user_email='$email' AND user_password ='$password'";
        $try = mysql_query($qry);
        if ($try) {
          if (mysql_num_rows($try) == 1) {
            $result = true;
          }
        }
      }
    }
    return $result;
  }

  function get_authority($sesi) {
    if (isset($sesi) && !empty($sesi)) {
      $email = $sesi["email"];
      $password = sha1(md5($sesi["password"]));
      if ((isset($email) && !empty($email)) && (isset($password) && !empty($password))) {
        $qry = "SELECT group_id FROM tb_users WHERE user_email='$email' AND user_password ='$password'";
        $try = mysql_query($qry);
        if ($try) {
          if (mysql_num_rows($try) == 1) {
            $result = mysql_fetch_assoc($try);
            $result = $result["group_id"];
          }
        }
      }
    }
    return $result;
  }

  function get_account($sesi) {
    if (isset($sesi) && !empty($sesi)) {
      $email = $sesi["email"];
      $password = sha1(md5($sesi["password"]));
      $result;
      if ((isset($email) && !empty($email)) && (isset($password) && !empty($password))) {
        $qry = "SELECT * FROM tb_users WHERE user_email='$email' AND user_password ='$password'";
        $try = mysql_query($qry);
        if ($try) {
          if (mysql_num_rows($try) == 1) {
            if ($row = mysql_fetch_assoc($try)) {
              $result["user_email"] = $row["user_email"];
              $result["user_name"] = $row["user_name"];
              $result["user_phone"] = $row["user_phone"];
              $result["user_password"] = $row["user_password"];
              $result["user_status"] = $row["user_status"];
              $result["region_id"] = $row["region_id"];
              $result["group_id"] = $row["group_id"];
            }
          }
        }
      }
    }
    return $result;
  }

  function get_account_single($email) {
    if (isset($email) && !empty($email)) {
      $email = anti_injection($email);
      $result;
      if (isset($email) && !empty($email)) {
        $qry = "SELECT * FROM tb_users WHERE user_email='$email'";
        $try = mysql_query($qry);
        if ($try) {
          if (mysql_num_rows($try) == 1) {
            if ($row = mysql_fetch_assoc($try)) {
              $result["user_email"] = $row["user_email"];
              $result["user_name"] = $row["user_name"];
              $result["user_phone"] = $row["user_phone"];
              $result["user_password"] = $row["user_password"];
              $result["user_status"] = $row["user_status"];
              $result["region_id"] = $row["region_id"];
              $result["group_id"] = $row["group_id"];
            }
          }
        }
      }
    }
    return $result;
  }

  function show_regions() {
    $qry = "SELECT * FROM tb_regions ORDER BY region_name ASC";
    $try = mysql_query($qry);
    if ($try) {
      if (mysql_num_rows($try) >= 1) {
        while ($row = mysql_fetch_assoc($try)) {
          $result[] = $row;
        }
      }
      return $result;
    }
  }

  function show_region($id) {
    $result = '';
    if (!isEmpty($id)) {
      $id = anti_injection($id);
      $qry = "SELECT * FROM tb_regions WHERE region_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          if ($row = mysql_fetch_assoc($try)) {
            $result["region_id"] = $row["region_id"];
            $result["region_name"] = $row["region_name"];
            $result["region_address"] = $row["region_address"];
            $result["region_phone"] = $row["region_phone"];
            $result["region_email"] = $row["region_email"];
            $result["region_chariman"] = $row["region_chariman"];
            $result["province_id"] = $row["province_id"];
          }
        }
      }
    }
    return $result;
  }

  function switch_payment($id) {
    $result = "";
    if (!isEmpty($id)) {
      switch ($id) {
        case 'P':$result = "Pembayaran";break;
        case 'R':$result = "Pengembalian";break;
        default: $result = "-";break;
      }
    }
    return $result;
  }

  function switch_province($id) {
    $result;
    if (isset($id) && !empty($id)) {
      $qry = "SELECT province_name FROM tb_provinces WHERE province_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          if ($row = mysql_fetch_assoc($try)) {
            $result = $row["province_name"];
          }
        }
      }
    }
    return $result;
  }

  function switch_region($id) {
    $result = '';
    if (isset($id) && !empty($id)) {
      $id = anti_injection($id);
      $qry = "SELECT region_name FROM tb_regions WHERE region_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          if ($row = mysql_fetch_assoc($try)) {
            $result = $row["region_name"];
          }
        }
      }
    }
    return $result;
  }

  function switch_class($id) {
    $result;
    if (isset($id) && !empty($id)) {
      switch ($id) {
        case 'IP': $result = "Peninjau"; break;
        case 'TE': $result = "RAKIN"; break;
        case 'AD': $result = "PAKIN"; break;
        default : $result = "Peninjau"; break;
      }
    }
    return $result;
  }

  function class_price($id) {
    $result;
    $id = anti_injection($id);
    if (!isEmpty($id)) {
      $qry = "SELECT class_price FROM tb_class WHERE class_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          if ($row = mysql_fetch_assoc($try)) {
            $result = $row["class_price"];
          }
        }
      }
    }
    return $result;
  }

  function activation($email, $code) {
    $result = false;
    if (!isEmpty($email) && !isEmpty($code)) {
      $email = anti_injection($email);
      $code = anti_injection($code);
      if (email_exists($email)) {
        if ($code == get_activation_code($email)) {
          date_default_timezone_set("Asia/Jakarta");
          $date = date("Y-m-d");
          $time = date("H:i:s");
          $qry = "UPDATE tb_user_activations SET activation_date='$date', activation_time='$time', activation_confirm='$code' WHERE user_email='$email'";
          $try = mysql_query($qry);
          if ($try) {
            $result = true;
          }
        }
      }
    }
    return $result;
  }

  function get_activation_code($email) {
    $result = "";
    if (!isEmpty($email)) {
      if (email_exists($email)) {
        $email = anti_injection($email);
        $qry = "SELECT activation_code FROM tb_user_activations WHERE user_email='$email'";
        $try = mysql_query($qry);
        if ($try) {
          if (mysql_num_rows($try) === 1) {
            if ($row = mysql_fetch_assoc($try)) {
              $result = $row["activation_code"];
            }
          }
        }
      }
    }
    return $result;
  }

  function create_activation($email) {
    $result = false;
    if (isset($email) && !empty($email)) {
      if (email_exists($email)) {
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $code = random_strings(5);
        $email = anti_injection($email);
        $qry = "INSERT INTO tb_user_activations(user_email, activation_date, activation_time, activation_code) VALUES('$email','$date','$time','$code')";
        $try = mysql_query($qry);
        if ($try) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function coordinator_registered($email) {
    $result = false;
    if (!isEmpty($email)) {
      $email = anti_injection($email);
      $user = get_user($email);
      $region = $user["region_id"];
      $qry = "SELECT * FROM tb_users WHERE region_id='$region' AND user_status ='Y'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) > 0) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function daftar_dispenkasi($data) {
    date_default_timezone_set("Asia/Jakarta");
    $result = false;
    $nama = anti_injection(ucwords($data["nama"]));
    $email = anti_injection(strtolower($data["email"]));
    $password = sha1(md5(anti_injection($data["password"])));
    $telepon = anti_injection($data["telepon"]);
    $asal = $data["asal"];
    $date = date("Y-m-d");
    $time = date("H:i:s");
    if (!email_exists($email)) {
      if ((isset($email) && !empty($email)) || (isset($password) && !empty($password)) || (isset($telepon) && !empty($telepon)) || (isset($asal) && !empty($asal))) {
        $qry = "INSERT INTO tb_users(user_email, user_name, user_phone, user_password, user_status, user_registered_date, user_registered_time, region_id, group_id) VALUES('$email','$nama','$telepon','$password','N','$date','$time','$asal','user')";
        $try = mysql_query($qry);
        if ($try) {
          if (create_activation($email)) {
            $result = true;
          }
        }
      }
    }
    return $result;
  }

  function send_activation($data) {
    $result = false;
    if (!isEmpty($data)) {
      //include(get_home_page() . "src/php-mailer/PHPMailerAutoload.php");
      $email = anti_injection($data["email"]);
      $nama = anti_injection($data["nama"]);
      $telepon = anti_injection($data["telepon"]);
      $asal = anti_injection($data["asal"]);
      $kode = get_activation_code($email);

      $subject = 'Konfirmasi Pendaftaran DISPENKASI 30';
      $headers = "From:Panitia DISPENKASI 30 <panitia@gr.gurisa.com>\r\n";
      $headers .= "Reply-To:Panitia DISPENKASI 30 <pakin.bandung@gmail.com>\r\n";
      $headers .= "BCC:pakin.bandung@gmail.com\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

      $messages = '<html>';
      $messages .= '<body style="background-color:#e7e7e7; color:#454545; font-family:"Open Sans","OpenSans","Arial","Verdana","Times New Roman"; text-align:justify;">';
      $messages .= '<div id="konfirmasi-pendaftaran" style="width:480px; overflow-x:auto;">';
      $messages .= '<h1 style="margin:0px;">DISPENKASI 30</h1>';
      $messages .= '<p style="margin:5px 0px 25px 0px;">Diskusi Pendalaman Kitab Si Shu ke-30</p>';
      $messages .= '<p>Wei De Dong Tian,<br />Terima kasih sudah mendaftar sebagai Koordinator DISPENKASI 30, untuk melengkapi proses pendaftaran silahkan aktivasi akun koordinator dan tambahkan peserta/peninjau DISPENKASI 30.</p>';
      $messages .= '<table width="480px" cellpadding="0" cellspacing="0" border="1" style="border-collapse:collapse; border:1px solid #454545; margin:0px 0px 15px 0px;">';
      $messages .= '<tr>';
      $messages .= '<td height="30px" style="background-color:#e73c3c; font-weight:bold; color:#e7e7e7; padding:5px;">Email Koordiantor</td>';
      $messages .= '<td style="padding:5px; font-weight:bold;">'.strip_tags($email).'</td>';
      $messages .= '</tr>';
      $messages .= '<tr>';
      $messages .= '<td height="30px" style="background-color:#e73c3c; font-weight:bold; color:#e7e7e7; padding:5px;">Nama Koordinator</td>';
      $messages .= '<td style="padding:5px; font-weight:bold;">'.strip_tags($nama).'</td>';
      $messages .= '</tr>';
      $messages .= '<tr>';
      $messages .= '<td height="30px" style="background-color:#e73c3c; font-weight:bold; color:#e7e7e7; padding:5px;">Nomor Telepon</td>';
      $messages .= '<td style="padding:5px; font-weight:bold;">'.strip_tags($telepon).'</td>';
      $messages .= '</tr>';
      $messages .= '<tr>';
      $messages .= '<td height="30px" style="background-color:#e73c3c; font-weight:bold; color:#e7e7e7; padding:5px;">Asal Koordinator</td>';
      $messages .= '<td style="padding:5px; font-weight:bold;">'.empty_to_strip(strip_tags(switch_region($asal))).'</td>';
      $messages .= '</tr>';
      $messages .= '</table>';
      $messages .= '<p style="font-weight:bold; text-align:center">Kode Aktivasi Pendaftaran</p>';
      $messages .= '<table width="480px" cellpadding="0" cellspacing="0" border="1" style="border-collapse:separate; border:1px solid #454545; border-radius:5px; -moz-border-radius:5px; margin:0px 0px 10px 0px;">';
      $messages .= '<tr>';
      $messages .= '<td height="50px" style="background-color:#454545; color:#e7e7e7; text-align:center; font-size:16pt; font-weight:bold; border-top:none; border-left:none;">'.strip_tags($kode).'</td>';
      $messages .= '</tr>';
      $messages .= '</table>';
      /*
      $messages .= '<table width="480px" cellpadding="0" cellspacing="0" border="1" style="border-collapse:separate; border:1px solid #e73c3c; border-radius:5px; -moz-border-radius:5px;">';
      $messages .= '<tr>';
      $messages .= '<td height="50px" style="background-color:#e73c3c; color:#e7e7e7; text-align:center; font-size:14pt; font-weight:bold; border-top:none; border-left:none;"><a href="'.get_home_page().'dispenkasi/#masuk" title="Aktivasi Sekarang" style="color:#1d1d1d; text-decoration:none;">Aktivasi Sekarang</a></td>';
      $messages .= '</tr>';
      $messages .= '</table>';
      */
      $messages .= '<p>Pastikan informasi yang didaftarkan <i>valid</i>, karena informasi tersebut akan digunakan untuk <u>Daftar Ulang</u> dan pembuatan <u>Sertifikat</u>.</p>';
      $messages .= '<p style="text-align:right;">Hormat Kami,<br /><b>Panitia DISPENKASI 30</b></p>';
      $messages .= '</div>';
      $messages .= '</body>';
      $messages .= '</html>';

      /* new uses
      $mail = new PHPMailer;
      //$mail->SMTPDebug = 3;                      // Enable verbose debug output
      $mail->isSMTP();                             // Set mailer to use SMTP
      $mail->Host = 'server.gurisa.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                     // Enable SMTP authentication
      $mail->Username = 'panitia@gr.gurisa.com'; // SMTP username
      $mail->Password = 'RAKA1997';  // SMTP password
      $mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;        // TCP port to connect to

      $mail->setFrom('panitia@gr.gurisa.com', 'Panitia DISPENKASI 30');
      $mail->addAddress($email, $nama);     // Add a recipient
      $mail->addReplyTo('pakin.bandung@gmail.com', 'Panitia DISPENKASI 30');
      $mail->addBCC('pakin.bandung@gmail.com');

      $mail->addAttachment(get_home_page() . 'files/panduan-pendaftaran-dispenkasi-30.pdf');// Add attachments
      $mail->isHTML(true);// Set email format to HTML

      $mail->Subject = $subject;
      $mail->Body    = $messages;
      $mail->AltBody = $messages;

      if (!$mail->send()) {
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;
      }
      else {
          $result = true;
      }
      */
      $try = mail($email,$subject,$messages,$headers);
      if ($try) {
        $result = true;
      }
    }
    return $result;
  }

  function sudah_aktivasi($email) {
    $result = false;
    if (!isEmpty($email)) {
      $email = anti_injection($email);
      if (email_exists($email)) {
        $qry = "SELECT activation_confirm FROM tb_user_activations WHERE user_email='$email'";
        $try = mysql_query($qry);
        if ($try) {
          if (mysql_num_rows($try) === 1) {
            if ($row = mysql_fetch_assoc($try)) {
              if ($row["activation_confirm"] == get_activation_code($email)) {
                $result = true;
              }
            }
          }
        }
      }
    }
    return $result;
  }

  function check_account($email) {
    $result = false;
    if (!isEmpty($email)) {
      $email = anti_injection($email);
      $qry = "SELECT user_email FROM tb_users WHERE user_email='$email' AND user_status !='D' AND user_status !='B' AND group_id !='block'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function masuk_dispenkasi($email, $password) {
    $result = false;
    $email = anti_injection($email);
    $password = anti_injection(sha1(md5($password)));
    if ((isset($email) && !empty($email)) && (isset($password) && !empty($password))) {
      $qry = "SELECT user_email, user_password FROM tb_users WHERE user_email='$email' AND user_password ='$password'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function old_password($email, $password) {
    $result = false;
    if (isset($email) && !empty($email) && isset($password) && !empty($password)) {
      $email = anti_injection($email);
      $password = sha1(md5(anti_injection($password)));
      $qry = "SELECT user_password FROM tb_users WHERE user_email='$email' AND user_password='$password'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function ubah_pengaturan($data) {
    $result = false;
    $nama = anti_injection($data["nama"]);
    $email = anti_injection($data["email"]);
    $old_password = anti_injection($data["old_password"]);
    $telepon = anti_injection($data["telepon"]);
    if (email_exists($email) && old_password($email, $old_password)) {
      if ((isset($nama) && !empty($nama)) || (isset($email) && !empty($email)) || (isset($old_password) && !empty($old_password)) || (isset($telepon) && !empty($telepon)) || (isset($asal) && !empty($asal))) {
        $qry = "UPDATE tb_users SET user_name='$nama', user_phone='$telepon' WHERE user_email='$email'";
        if (isset($data["new_password"]) && !empty($data["new_password"])) {
          $new_password = anti_injection(sha1(md5($data["new_password"])));
          $qry = "UPDATE tb_users SET user_name='$nama', user_phone='$telepon', user_password='$new_password' WHERE user_email='$email'";
        }
        $try = mysql_query($qry);
        if ($try) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function switch_status($status)  {
    if (isset($status) && !empty($status)) {
      switch ($status) {
        case "N" : $status = "Menunggu Pembayaran"; break;
        case "C" : $status = "Menunggu Konfirmasi"; break;
        case "Y" : $status = "Pembayaran Selesai"; break;
        case "R" : $status = "√(toor)²"; break;
        case "A" : $status = "Panitia"; break;
        case "D" : $status = "Dihapus"; break;
        case "B" : $status = "Diblokir"; break;
        default  : $status = "-"; break;
      }
    }
    return $status;
  }

  function get_status($status) {
    if (isset($status) && !empty($status)) {
      switch ($status) {
        case "N" : $status = "menunggu-pembayaran"; break;
        case "C" : $status = "menunggu-konfirmasi"; break;
        case "Y" : $status = "selesai-membayar"; break;
        case "R" : $status = "root"; break;
        case "A" : $status = "panitia"; break;
        case "D" : $status = "dihapus"; break;
        case "B" : $status = "diblokir"; break;
        default  : $status = "menunggu-pembayaran"; break;
      }
    }
    return $status;
  }

  function register_as($id) {
    $id = anti_injection($id);
    if (!isEmpty($id)) {
      $qry = "SELECT class_id FROM tb_participants WHERE participant_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if ($participants = mysql_fetch_assoc($try)) {
          $result = "Peninjau";
          if ($participants["class_id"] == "TE" || $participants["class_id"] == "AD") {
            $result = "Peserta";
          }
          return $result;
        }
      }
    }
  }

  function talent_name($id) {
    $result = "";
    if (!isEmpty($id)) {
      $id = anti_injection($id);
      $qry = "SELECT group_name FROM tb_talentgroups WHERE group_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if ($name = mysql_fetch_assoc($try)) {
          $result = $name["group_name"];
        }
      }
      return $result;
    }
  }

  function has_participants($email) {
    $result = false;
    if ((isset($email) && !empty($email))) {
      $qry = "SELECT participant_id FROM tb_participants WHERE user_email='$email' AND participant_status != 'D' LIMIT 0,1";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function add_participant($sesi, $post) {
    $result = false;
    if (isset($sesi) && !empty($sesi) && isset($post) && !empty($post)) {
      if (sudah_masuk($sesi)) {
        date_default_timezone_set("Asia/Jakarta");
        $email_pengguna = anti_injection($sesi["email"]);
        $kelamin = anti_injection($post["kelamin"]);
        $tanggal_lahir = anti_injection($post["tanggal"]);
        $asal = anti_injection($post["asal"]);
        $nama = anti_injection(ucwords($post["nama"]));
        $email_peserta = anti_injection($post["email"]);
        $telepon = anti_injection($post["telepon"]);
        $facebook = anti_injection($post["facebook"]);
        $twitter = anti_injection($post["twitter"]);
        $instagram = anti_injection($post["instagram"]);
        $line = anti_injection($post["line"]);
        $kelas = anti_injection($post["kelas"]);
        $tanggal_daftar = date("Y-m-d");
        $waktu_daftar = date("H:i:s");
        if (!empty($post["talent"]) && isset($post["talent"])) {
          $talent = anti_injection($post["talent"]);
        }

        if ($asal == "default") {
          if ($acc = get_account($sesi)) {
            $asal = $acc["region_id"];
          }
        }
        $qry  = "INSERT INTO tb_participants(participant_name, participant_gender,";
        $qry .= "participant_birthdate, participant_email,";
        $qry .= "participant_phone, participant_facebook, participant_twitter,";
        $qry .= "participant_instagram, participant_line, participant_registered_date,";
        $qry .= "participant_registered_time, participant_status, group_id, region_id, class_id, user_email)";
        $qry .= "VALUES('$nama','$kelamin','$tanggal_lahir','$email_peserta',";
        $qry .= "'$telepon','$facebook','$twitter','$instagram','$line','$tanggal_daftar',";
        $qry .= "'$waktu_daftar','N','$talent','$asal','$kelas','$email_pengguna')";
        $try = mysql_query($qry);
        if ($try) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function change_participant($sesi, $post) {
    $result = false;
    if (isset($sesi) && !empty($sesi) && isset($post) && !empty($post)) {
      $id = anti_injection($_POST["id"]);
      if (sudah_masuk($sesi) && is_owner($sesi, $id)) {
        date_default_timezone_set("Asia/Jakarta");
        $nama = anti_injection(ucwords($post["nama"]));
        $kelamin = anti_injection($post["kelamin"]);
        $tanggal = anti_injection($post["tanggal"]);
        $email = anti_injection($post["email"]);
        $telepon = anti_injection($post["telepon"]);
        $facebook = anti_injection($post["facebook"]);
        $twitter = anti_injection($post["twitter"]);
        $instagram = anti_injection($post["instagram"]);
        $line = anti_injection($post["line"]);
        $kelas = anti_injection($post["kelas"]);
        if (!empty($post["talent"]) && isset($post["talent"])) {
          $talent = anti_injection($post["talent"]);
        }
        $qry  = "UPDATE tb_participants SET participant_name='$nama', participant_gender='$kelamin',";
        $qry .= "participant_birthdate='$tanggal', participant_email='$email',";
        $qry .= "participant_phone='$telepon', participant_facebook='$facebook',";
        $qry .= "participant_twitter='$twitter', participant_instagram='$instagram',";
        $qry .= "participant_line='$line', group_id='$talent', class_id='$kelas' WHERE participant_id='$id'";
        $try = mysql_query($qry);
        if ($try) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function get_participants($email, $exception) {
    $result = "";
    if (!isEmpty($email) && !isEmpty($exception)) {
      switch ($exception) {
        case 'D':
          $qry = "SELECT * FROM tb_participants WHERE user_email='$email' AND participant_status != 'D'";
        break;
        case 'N':
          $qry = "SELECT * FROM tb_participants WHERE user_email='$email' AND participant_status != 'N'";
        break;
        case 'DY':
          $qry = "SELECT * FROM tb_participants WHERE user_email='$email' AND (participant_status != 'D' AND participant_status != 'Y') ORDER BY participant_gender DESC, participant_name ASC";
        break;
        case 'DN':
          $qry = "SELECT * FROM tb_participants WHERE user_email='$email' AND (participant_status != 'D' AND participant_status != 'N') ORDER BY participant_gender DESC, participant_name ASC";
        break;
        case 'DNC':
          $qry = "SELECT * FROM tb_participants WHERE user_email='$email' AND (participant_status != 'D' AND participant_status != 'N' AND participant_status != 'C') ORDER BY participant_gender DESC, participant_name ASC";
        break;
        default:
          $qry = "SELECT * FROM tb_participants WHERE user_email='$email'";
        break;
      }
      $try = mysql_query($qry);
      if ($try) {
        while ($row = mysql_fetch_assoc($try)) {
          $result[] = $row;
        }
      }
    }
    return $result;
  }

  function get_participant($id) {
    $id = anti_injection($id);
    if (!isEmpty($id)) {
      $qry = "SELECT * FROM tb_participants WHERE participant_id ='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          $result = array();
          if ($row = mysql_fetch_assoc($try)) {
            $result["participant_id"] = $row["participant_id"];
            $result["participant_name"] = $row["participant_name"];
            $result["participant_gender"] = $row["participant_gender"];
            $result["participant_birthdate"] = $row["participant_birthdate"];
            $result["participant_email"] = $row["participant_email"];
            $result["participant_phone"] = $row["participant_phone"];
            $result["participant_facebook"] = $row["participant_facebook"];
            $result["participant_twitter"] = $row["participant_twitter"];
            $result["participant_instagram"] = $row["participant_instagram"];
            $result["participant_line"] = $row["participant_line"];
            $result["participant_registered_date"] = $row["participant_registered_date"];
            $result["participant_registered_time"] = $row["participant_registered_time"];
            $result["participant_status"] = $row["participant_status"];
            $result["group_id"] = $row["group_id"];
            $result["region_id"] = $row["region_id"];
            $result["class_id"] = $row["class_id"];
            $result["user_email"] = $row["user_email"];
          }
          return $result;
        }
      }
    }
  }

  function count_participants($email) {
    $result = 0;
    if ((isset($email) && !empty($email))) {
      $email = anti_injection($email);
      if (has_participants($email)) {
        $qry = "SELECT COUNT(participant_id) AS participant_sum FROM tb_participants WHERE user_email='$email' AND participant_status != 'D'";
        $try = mysql_query($qry);
        if ($try) {
          if ($row = mysql_fetch_assoc($try)) {
            $result = $row["participant_sum"];
          }
        }
      }
    }
    return $result;
  }

  function count_participant_price($email) {
    $result = 0;
      if ((isset($email) && !empty($email))) {
        $email = anti_injection($email);
        if (has_participants($email)) {
          $qry = "SELECT COUNT(participant_id) AS participant_sum FROM tb_participants WHERE user_email='$email' AND participant_status != 'D' AND participant_status != 'Y' AND participant_status != 'B' AND class_id != 'IP'";
          $try = mysql_query($qry);
          if ($try) {
            if ($row = mysql_fetch_assoc($try)) {
              $result = $row["participant_sum"];
            }
          }
        }
      }
    return $result;
  }

  function count_inspector_price($email) {
    $result = 0;
    if ((isset($email) && !empty($email))) {
      $email = anti_injection($email);
      if (has_participants($email)) {
        $qry = "SELECT COUNT(participant_id) AS participant_sum FROM tb_participants WHERE user_email='$email' AND participant_status != 'D' AND participant_status != 'Y' AND participant_status != 'B' AND class_id = 'IP'";
        $try = mysql_query($qry);
        if ($try) {
          if ($row = mysql_fetch_assoc($try)) {
            $result = $row["participant_sum"];
          }
        }
      }
    }
    return $result;
  }

  function biaya_pendaftaran($email, $id) {
    $result = 0;
    if (isset($email) && !empty($email) && isset($id) && !empty($id)) {
      $email = anti_injection($email);
      $id = anti_injection($id);
      if (has_participants($email)) {
        $te = "SELECT COUNT(participant_id) AS count_te FROM tb_participants WHERE user_email='$email' AND participant_status != 'D' AND participant_status != 'Y' AND participant_status != 'B' AND class_id = 'TE'";
        $ad = "SELECT COUNT(participant_id) AS count_ad FROM tb_participants WHERE user_email='$email' AND participant_status != 'D' AND participant_status != 'Y' AND participant_status != 'B' AND class_id = 'AD'";
        $ip = "SELECT COUNT(participant_id) AS count_ip FROM tb_participants WHERE user_email='$email' AND participant_status != 'D' AND participant_status != 'Y' AND participant_status != 'B' AND class_id = 'IP'";

        $try_te = mysql_query($te);
        if ($try_te) {
          if ($row = mysql_fetch_assoc($try_te)) {
            $result_te = $row["count_te"] * class_price("TE");
          }
        }

        $try_ad = mysql_query($ad);
        if ($try_ad) {
          if ($row = mysql_fetch_assoc($try_ad)) {
            $result_ad = $row["count_ad"] * class_price("AD");
          }
        }

        $try_ip = mysql_query($ip);
        if ($try_ip) {
          if ($row = mysql_fetch_assoc($try_ip)) {
            $result_ip = $row["count_ip"] * class_price("IP");
          }
        }

        if ($id == "I") {
          $result = $result_ip;
        }
        else if ($id == "P") {
          $result = $result_ad + $result_te;
        }
      }
    }
    return $result;
  }

  function organisasi_sudah_bayar($email) {
    $result = false;
    if (isset($email) && !empty($email)) {
      $qry = "SELECT user_status FROM tb_users WHERE user_email='$email'";
      $try = mysql_query($qry);
      if ($try) {
        if ($row = mysql_fetch_assoc($try)) {
          if ($row["user_status"] == "Y" || $row["user_status"] == "R" || $row["user_status"] == "A") {
            $result = true;
          }
        }
      }
    }
    return $result;
  }

  function biaya_organisasi($sesi) {
    $result = 0;
    if (isset($sesi) && !empty($sesi)) {
      $qry = "SELECT group_price FROM tb_usergroups WHERE group_id='user'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          if ($row = mysql_fetch_assoc($try)) {
            $result = $row["group_price"];
          }
        }
      }
    }
    return $result;
  }

  function show_organization($sesi) {
    $result = '';
    $qry = "SELECT * FROM tb_users WHERE user_status !='R'";
    if (!isEmpty($sesi) && get_authority($sesi) == 'root') {
      $qry = "SELECT * FROM tb_users";
    }
    $try = mysql_query($qry);
    if ($try) {
      while ($row = mysql_fetch_assoc($try)) {
        $result[] = $row;
      }
      return $result;
    }
  }

  function is_owner($sesi, $id) {
    $result = false;
    if (isset($sesi) && !empty($sesi) && isset($id) && !empty($id)) {
      $email = anti_injection($sesi["email"]);
      $id = anti_injection($id);
      $qry = "SELECT participant_id FROM tb_participants WHERE participant_id='$id' AND user_email='$email'";
      $try = mysql_query($qry);
      if ($try) {
        $result = true;
      }
    }
    return $result;
  }

  function get_user_authority($id) {
    if (!isEmpty($id)) {
      $qry = "SELECT group_id FROM tb_users WHERE user_email ='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          if ($row = mysql_fetch_assoc($try)) {
            $result = $row["group_id"];
            return $result;
          }
        }
      }
    }
  }

  function is_authorities($email, $page) {
    $result = false;
    if (!isEmpty($email) && !isEmpty($page)) {
      $email = anti_injection($email);
      $qry = "SELECT group_id FROM tb_users WHERE user_email='$email'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          if ($row = mysql_fetch_assoc($try)) {
            $group_id = $row["group_id"];
            $qry = "SELECT $page FROM tb_usergroups WHERE group_id='$group_id'";
            $try = mysql_query($qry);
            if ($try) {
              if ($row = mysql_fetch_assoc($try)) {
                if ($row["$page"] == 1) {
                  $result = true;
                }
              }
            }
          }
        }
      }
    }
    return $result;
  }

  function is_confirmed($id) {
    $result = false;
    if (!isEmpty($id)) {
      $id = anti_injection($id);
      $qry = "SELECT participant_status FROM tb_participants WHERE participant_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if ($row = mysql_fetch_assoc($try)) {
          if ($row["participant_status"] == "Y" || $row["participant_status"] == "C" || $row["participant_status"] == "B" || $row["participant_status"] == "D") {
            $result = true;
          }
        }
      }
    }
    return $result;
  }

  function user_confirmed($email) {
    $result = false;
    if (!isEmpty($email)) {
      $email = anti_injection($email);
      $user = get_user($email);
      if ($user["user_status"] == "Y" || $user["user_status"] == "C" || $user["user_status"] == "B" || $user["user_status"] == "D" || $user["user_status"] == "R") {
        $result = true;
      }
    }
    return $result;
  }

  function delete_participant($sesi, $post) {
    $result = false;
    if (isset($sesi) && !empty($sesi) && isset($post) && !empty($post)) {
      $email = anti_injection($sesi["email"]);
      $id = anti_injection($post["id"]);
      if (sudah_masuk($sesi) && is_owner($sesi, $id)) {
        $qry = "UPDATE tb_participants SET participant_status='D' WHERE participant_id='$id' AND user_email='$email'";
        if (mysql_query($qry)) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function confirm_coordinator($email) {
    $result = false;
    if (isset($email) && !empty($email)) {
      $email = anti_injection($email);
      if (!user_confirmed($email)) {
        $qry = "UPDATE tb_users SET user_status='C' WHERE user_email='$email'";
        if (mysql_query($qry)) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function confirm_participant($sesi, $post) {
    $result = false;
    if (isset($sesi) && !empty($sesi) && isset($post) && !empty($post)) {
      $email = anti_injection($sesi["email"]);
      $id = anti_injection($post["id"]);
      if (!is_confirmed($id)) {
        if (sudah_masuk($sesi) && is_owner($sesi, $id)) {
          $qry = "UPDATE tb_participants SET participant_status='C' WHERE participant_id='$id' AND user_email='$email'";
          if (mysql_query($qry)) {
            $result = true;
          }
        }
      }
    }
    return $result;
  }

  function confirm_all_participant($email) {
    $result = false;
    if (isset($email) && !empty($email)) {
      $email = anti_injection($email);
      $qry = "SELECT participant_id, participant_status FROM tb_participants WHERE user_email='$email'";
      $try = mysql_query($qry);
      if ($try) {
        while ($row = mysql_fetch_assoc($try)) {
          $par[] = $row;
        }
        for ($i = 0; $i < count($par); $i++) {
          if (!is_confirmed($par[$i]["participant_id"])) {
            $id = $par[$i]["participant_id"];
            $qry = "UPDATE tb_participants SET participant_status='C' WHERE participant_id='$id' AND user_email='$email'";
            $try = mysql_query($qry);
            if ($try) {
              $result = true;
            }
          }
        }
      }
    }
    return $result;
  }

  function action_status($auth) {
    $status;
    if (isset($auth) && !empty($auth)) {
      switch ($auth) {
        case 'A':
          $status = array ("N"=>"Belum Bayar","C"=>"Sudah Konfirmasi","Y"=>"Sudah Bayar","B"=>"Blokir","D"=>"Hapus");
        break;
        case 'R':
          $status = array ("N"=>"Belum Bayar","C"=>"Sudah Konfirmasi","Y"=>"Sudah Bayar","B"=>"Blokir","D"=>"Hapus","A"=>"Panitia","R"=>"√(toor)²");
        break;
        case 'O':
          $status = array ("C"=>"Ubah","D"=>"Hapus");
        break;
        default:
          //avoid injection
        break;
      }
    }
    return $status;
  }

  function get_action($who, $id) {
    $result;
    $id = anti_injection($id);
    if (isset($id) && !empty($id) && isset($who) && !empty($who)) {
      switch ($who) {
        case 'ORG':
          $col = "user_status";
          $tb = "tb_users";
          $qry = "SELECT $col FROM $tb WHERE user_email='$id'";
        break;
        case 'PAR':
          $col = "participant_status";
          $tb = "tb_participants";
          $qry = "SELECT $col FROM $tb WHERE participant_id='$id'";
        break;
        default:
          $col = "user_status";
          $tb = "tb_users";
          $qry = "SELECT $col FROM $tb WHERE user_email='$id'";
        break;
      }

      $try = mysql_query($qry);
      if ($try) {
        if ($row = mysql_fetch_assoc($try)) {
          $result = $row[$col];
        }
      }
    }
    return $result;
  }

  function detail_organisasi($id) {
    $result;
    if (isset($id) && !empty($id)) {
      $id = anti_injection($id);
      $qry = "SELECT * FROM tb_users WHERE user_email='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          if ($row = mysql_fetch_assoc($try)) {
            $result["user_email"] = $row["user_email"];
            $result["user_name"] = $row["user_name"];
            $result["user_phone"] = $row["user_phone"];
            $result["user_password"] = $row["user_password"];
            $result["user_status"] = $row["user_status"];
            $result["region_id"] = $row["region_id"];
            $result["group_id"] = $row["group_id"];
          }
        }
      }
    }
    $account = $result;
    $result = '
      <div class="row">
        <div class="col-sm-6"><b>E-mail</b></div>
        <div class="col-sm-6">'. empty_to_strip($account["user_email"]) .'</div>
      </div>
      <div class="row">
        <div class="col-sm-6"><b>Nama</b></div>
        <div class="col-sm-6">'. empty_to_strip($account["user_name"]) .'</div>
      </div>
      <div class="row">
        <div class="col-sm-6"><b>Asal</b></div>
        <div class="col-sm-6">'. empty_to_strip(switch_region($account["region_id"])) .'</div>
      </div>
      <div class="row">
        <div class="col-sm-6"><b>Telepon</b></div>
        <div class="col-sm-6">'. empty_to_strip($account["user_phone"]) .'</div>
      </div>
      <div class="row">
        <div class="col-sm-6"><b>Status</b></div>
        <div class="col-sm-6">
          <span class="'. get_status($account["user_status"]) .'">
            '. empty_to_strip(switch_status($account["user_status"])) .'
          </span>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <hr class="dashed" />
        </div>
      </div>
    ';
    return $result;
  }

  function detail_participant($id) {
    if (!isEmpty($id)) {
      $id = anti_injection($id);
      $qry = "SELECT * FROM tb_participants WHERE participant_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) == 1) {
          $result = array();
          if ($row = mysql_fetch_assoc($try)) {
            $result["participant_id"] = $row["participant_id"];
            $result["participant_name"] = $row["participant_name"];
            $result["participant_gender"] = $row["participant_gender"];
            $result["participant_birthdate"] = $row["participant_birthdate"];
            $result["participant_email"] = $row["participant_email"];
            $result["participant_phone"] = $row["participant_phone"];
            $result["participant_facebook"] = $row["participant_facebook"];
            $result["participant_twitter"] = $row["participant_twitter"];
            $result["participant_instagram"] = $row["participant_instagram"];
            $result["participant_line"] = $row["participant_line"];
            $result["participant_registered_date"] = $row["participant_registered_date"];
            $result["participant_registered_time"] = $row["participant_registered_time"];
            $result["participant_status"] = $row["participant_status"];
            $result["region_id"] = $row["region_id"];
            $result["class_id"] = $row["class_id"];
            $result["user_email"] = $row["user_email"];
          }
        }
        $participants = $result;
        if ($participants["class_id"] == "TE" || $participants["class_id"] == "AD") {
          $register_as = "Peserta / " . empty_to_strip(switch_class($participants["class_id"]));
        }
        else {
          $register_as = empty_to_strip(switch_class($participants["class_id"]));
        }
        $result = '
          <div class="row">
            <div class="col-md-3"><b>#</b></div>
            <div class="col-md-4">'. $participants["participant_id"] .'</div>
            <div class="col-md-2"><b>E-mail</b></div>
            <div class="col-md-3">'. empty_to_strip($participants["participant_email"]) .'</div>
          </div>
          <div class="row">
            <div class="col-md-3"><b>Nama ' . register_as($participants["participant_id"]) . '</b></div>
            <div class="col-md-4">'. empty_to_strip($participants["participant_name"]) .'</div>
            <div class="col-md-2"><b>Telepon</b></div>
            <div class="col-md-3">'. empty_to_strip($participants["participant_phone"]) .'</div>
          </div>
          <div class="row">
            <div class="col-md-3"><b>Jenis Kelamin</b></div>
            <div class="col-md-4">'. rewrite_gender($participants["participant_gender"]) .'</div>
            <div class="col-md-2"><b>Facebook</b></div>
            <div class="col-md-3">'. empty_to_strip($participants["participant_facebook"]) .'</div>
          </div>
          <div class="row">
            <div class="col-md-3"><b>Tanggal Lahir</b></div>
            <div class="col-md-4">'. rewrite_date($participants["participant_birthdate"]) .'</div>
            <div class="col-md-2"><b>Twitter</b></div>
            <div class="col-md-3">'. empty_to_strip($participants["participant_twitter"]) .'</div>
          </div>
          <div class="row">
            <div class="col-md-3"><b>Asal ' . register_as($participants["participant_id"]) . '</b></div>
            <div class="col-md-4">'. empty_to_strip(switch_region($participants["region_id"])) .'</div>
            <div class="col-md-2"><b>Instagram</b></div>
            <div class="col-md-3">'. empty_to_strip($participants["participant_instagram"]) .'</div>
          </div>
          <div class="row">
            <div class="col-md-3"><b>Daftar Sebagai</b></div>
            <div class="col-md-4">'. $register_as .'</div>
            <div class="col-md-2"><b>Line</b></div>
            <div class="col-md-3">'. empty_to_strip($participants["participant_line"]) .'</div>
          </div>
          <div class="row">
            <div class="col-md-3"><b>Status</b></div>
            <div class="col-md-4">
              <span class="'. get_status($participants["participant_status"]) .'">'. switch_status($participants["participant_status"]) .'</span>
            </div>
            <div class="col-md-2"><b>Biaya Daftar</b></div>
            <div class="col-md-3">Rp' . num_to_rupiah(class_price($participants["class_id"])) .'</div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <hr class="dashed" />
            </div>
          </div>
        ';
        return $result;
      }
    }
  }

  function set_status($who, $id, $change) {
    $result = false;
    $id = anti_injection($id);
    $who = anti_injection($who);
    $change = anti_injection($change);
    if (!isEmpty($who) && !isEmpty($change) && !isEmpty($id)) {
      switch ($who) {
        case 'ORG':
          if (get_user_authority($id) != "root" && get_user_authority($id) != "admin") {
            $qry = "UPDATE tb_users SET user_status='$change' WHERE user_email='$id'";
            $try = mysql_query($qry);
            if ($try) {
              $result = true;
            }
          }
          else {
            $result = false;
          }
        break;
        case 'PAR':
          $qry = "UPDATE tb_participants SET participant_status='$change' WHERE participant_id='$id'";
          $try = mysql_query($qry);
          if ($try) {
            $result = true;
          }
        break;
        default:

        break;
      }
    }
    return $result;
  }

  function find_organisasi($keywords) {
    $keywords = anti_injection($keywords);
    if (!isEmpty($keywords)) {
      $qry = "SELECT * FROM tb_users WHERE user_email LIKE '%" . $keywords . "%' OR user_name LIKE '%" . $keywords . "%' OR user_phone LIKE '%" . $keywords . "%'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) > 0) {
          $users = array();
          while ($row = mysql_fetch_assoc($try)) {
            $users[] = $row;
          }
          return $users;
        }
      }
    }
  }

  function find_peserta($keywords) {
    $keywords = anti_injection($keywords);
    if (!isEmpty($keywords)) {
      $qry = "SELECT * FROM tb_participants WHERE participant_id LIKE '%" . $keywords . "%' OR participant_name LIKE '%" . $keywords . "%' OR participant_email LIKE '%" . $keywords . "%' OR class_id LIKE '%" . $keywords . "%'";
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) > 0) {
          $participants = array();
          while ($row = mysql_fetch_assoc($try)) {
            $participants[] = $row;
          }
          return $participants;
        }
      }
    }
  }

  function get_user($email) {
    if (!isEmpty($email)) {
      if ($email == "*") {
        $qry = "SELECT * FROM tb_users WHERE group_id !='block' AND user_status!='D' AND user_status!='B' ORDER BY group_id ASC";
        $try = mysql_query($qry);
        if ($try) {
          while ($row = mysql_fetch_assoc($try)) {
            $result[] = $row;
          }
        }
      }
      else {
        $qry = "SELECT * FROM tb_users WHERE user_email='$email'";
        $try = mysql_query($qry);
        if ($try) {
          if (mysql_num_rows($try) == 1) {
            if ($row = mysql_fetch_assoc($try)) {
              $result["user_email"] = $row["user_email"];
              $result["user_name"] = $row["user_name"];
              $result["user_phone"] = $row["user_phone"];
              $result["user_password"] = $row["user_password"];
              $result["user_status"] = $row["user_status"];
              $result["region_id"] = $row["region_id"];
              $result["group_id"] = $row["group_id"];
            }
          }
        }
      }
      return $result;
    }
  }

/* Transaction */

  function count_trx() {
    $qry = "SELECT header_id FROM tb_transaction_headers";
    $try = mysql_query($qry);
    if ($try) {
      $result = mysql_num_rows($try);
      return $result;
    }
  }

  function get_trx_id() {
    $count = count_trx() + 1;
    if ($count > 0 && $count < 10) {
      $random = random_strings(2);
    }
    else if ($count > 9 && $count < 100) {
      $random = random_strings(1);
    }
    else if ($count > 99 && $count < 1000) {
      $random = random_strings(0);
    }
    if (!isEmpty($count) && !isEmpty($random)) {
      date_default_timezone_set("Asia/Jakarta");
      $date = date("dmY");
      $time = date("His");
      $result = "TRX/" . $date . "/" . $time . "/" . $count . $random;
      return $result;
    }
  }

  function add_trx_headers($data) {
    $result = false;
    if (!isEmpty($data)) {
      date_default_timezone_set("Asia/Jakarta");
      $id = anti_injection($data["trx_id"]);
      $jenis = anti_injection($data["jenis"]);
      $metode = anti_injection($data["metode"]);
      $informasi = anti_injection($data["informasi"]);
      $user = anti_injection($data["email"]);
      $admin = anti_injection($data["admin"]);
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $qry = "INSERT INTO tb_transaction_headers ";
      $qry .= "(header_id, header_date, header_time, header_type, header_payment_methods, header_information, user_email, admin_email) ";
      $qry .= "VALUES ('$id','$date','$time','$jenis','$metode','$informasi','$user','$admin')";
      $try = mysql_query($qry);
      if ($try) {
        $result = true;
      }
    }
    return $result;
  }

  function add_trx_details($data) {
    $result = false;
    if (!isEmpty($data)) {
      if ($data["jenis"] == "P") {
          $item = "Pembayaran ";
        if ($data["item"] == "oth") {
          $item .= "Lain";
        }
        else if ($data["item"] == "org") {
          $account = get_user($data["email"]);
          $item .= switch_region($account["region_id"]) . ' - ' . $account["user_name"] . ' [' . $account["user_email"] . ']';
        }
        else {
          $participant = get_participant($data["item"]);
          if ($participant["class_id"] == "IP") {
            $item .= switch_class($participant["class_id"]) . ' - ' . $participant["participant_name"] . ' [' . $participant["participant_id"] . ']';
          }
          else {
            $item .= 'Peserta Kelas ' . switch_class($participant["class_id"]) . ' - ' . $participant["participant_name"] . ' [' . $participant["participant_id"] . ']';
          }
        }
      }
      else {
        $item = "Pembayaran Lainnya";//avoid this one.
      }
      date_default_timezone_set("Asia/Jakarta");
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $price = $data["price"];
      $id = anti_injection($data["trx_id"]);
      $qry = "INSERT INTO tb_transaction_details ";
      $qry .= "(detail_date, detail_time, detail_item, detail_price, header_id) ";
      $qry .= "VALUES ('$date','$time','$item','$price','$id')";
      $try = mysql_query($qry);
      if ($try) {
        $result = true;
      }
    }
    return $result;
  }

  function get_user_trx_header($email) {
    if (!isEmpty($email)) {
      $email = anti_injection($email);
      $qry = "SELECT * FROM tb_transaction_headers WHERE user_email='$email'";
      if ($email == "*") {
        $qry = "SELECT * FROM tb_transaction_headers";
      }
      $try = mysql_query($qry);
      if ($try) {
        $result = array();
        while ($row = mysql_fetch_assoc($try)) {
          $result[] = $row;
        }
        return $result;
      }
    }
  }

  function get_user_trx_details($case, $id) {
    if (!isEmpty($case) && !isEmpty($id)) {
      $id = anti_injection($id);
      switch ($case) {
        case '*':
          $qry = "SELECT * FROM tb_transaction_details WHERE header_id='$id'";
        break;
        case '1':
          $qry = "SELECT * FROM tb_transaction_details WHERE detail_id='$id'";
        break;
        default:
          $qry = "SELECT * FROM tb_transaction_details";
        break;
      }
      $try = mysql_query($qry);
      if ($try) {
        $result = array();
        while ($row = mysql_fetch_assoc($try)) {
          $result[] = $row;
        }
        return $result;
      }
    }
  }

  function get_user_trx_header_single($email, $id) {
    if (!isEmpty($email) && !isEmpty($id)) {
      $email = anti_injection($email);
      $id = anti_injection($id);
      $qry = "SELECT * FROM tb_transaction_headers WHERE user_email='$email' AND header_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        $result = array();
        if ($row = mysql_fetch_assoc($try)) {
          $result["header_id"] = $row["header_id"];
          $result["header_date"] = $row["header_date"];
          $result["header_time"] = $row["header_time"];
          $result["header_type"] = $row["header_type"];
          $result["header_payment_methods"] = $row["header_payment_methods"];
          $result["header_information"] = $row["header_information"];
          $result["user_email"] = $row["user_email"];
          $result["admin_email"] = $row["admin_email"];
        }
        return $result;
      }
    }
  }


  function get_trx_user_email($id) {
    if (!isEmpty($id)) {
      $id = anti_injection($id);
      $qry = "SELECT user_email FROM tb_transaction_headers WHERE header_id='$id'";
      $try = mysql_query($qry);
      if ($try) {
        $result = array();
        while ($row = mysql_fetch_assoc($try)) {
          $result = $row["user_email"];
        }
        return $result;
      }
    }
  }

  function generate_trx_access($data) {
    $result = false;
    if (!isEmpty($data)) {
      $id = anti_injection($data['id']);
      $file = anti_injection($data['file']);
      $type = anti_injection($data['type']);
      $date = anti_injection($data['date']);
      $time = anti_injection($data['time']);
      $email = anti_injection($data['email']);
      $qry = "INSERT INTO tb_transaction_access(access_id, access_file, access_type, access_date, access_time, user_email)";
      $qry .= " VALUES('$id','$file','$type','$date','$time','$email')";
      $try = mysql_query($qry);
      if ($try) {
        $result = true;
      }
    }
    return $result;
  }

  /* Pengumuman */

  function add_announcement($data) {
    $result = false;
    if (!isEmpty($data)) {
      date_default_timezone_set("Asia/Jakarta");
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $title = anti_injection($data['title']);
      $content = mysql_real_escape_string(stripslashes(htmlspecialchars(htmlentities($data['content']))));
      $email = anti_injection($data['email']);
      $qry = "INSERT INTO tb_announcements (announcement_id, announcement_title, announcement_content, announcement_date, announcement_time, user_email)";
      $qry .= " VALUES('','$title','$content','$date','$time','$email')";
      $try = mysql_query($qry);
      if ($try) {
        $result = true;
      }
    }
    return $result;
  }

  function has_announcement($who) {
    $result = false;
    if (!isEmpty($who)) {
      switch ($who) {
        case '*':
          $qry = "SELECT * FROM tb_announcements LIMIT 0,1";
        break;
        default:
          $qry = "SELECT * FROM tb_announcements WHERE announcement_id='$who'";
        break;
      }
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try)) {
          $result = true;
        }
      }
    }
    return $result;
  }

  function get_announcement($id) {
    if (!isEmpty($id)) {
      switch ($id) {
        case '*':
          $qry = "SELECT * FROM tb_announcements ORDER BY announcement_date DESC";
        break;
        default:
          $qry = "SELECT * FROM tb_announcements WHERE announcement_id='$id' ORDER BY announcement_date AND announcement_time DESC";
        break;
      }
      $try = mysql_query($qry);
      if ($try) {
        $result = array();
        while ($row = mysql_fetch_assoc($try)) {
          $result[] = $row;
        }
        return $result;
      }
    }
  }

  function delete_announcement($sesi, $id) {
    $result = false;
    if (isset($sesi) && !empty($sesi) && isset($id) && !empty($id)) {
      $email = anti_injection($sesi["email"]);
      $id = anti_injection($id);
      if (sudah_masuk($sesi) && has_announcement($id)) {
        $ac = get_user($email);
        if ($ac["group_id"] == "root" || $ac["group_id"] == "admin") {
          $qry = "DELETE FROM tb_announcements WHERE announcement_id='$id'";
          if (mysql_query($qry)) {
            $result = true;
          }
        }
      }
    }
    return $result;
  }

  function look_status($cat, $keywords) {
    $result = "";
    if (!isEmpty($cat) && !isEmpty($keywords)) {
      $keywords = anti_injection($keywords);
      switch ($cat) {
        case 'CO':
          $qry = "SELECT * FROM tb_users WHERE (user_email LIKE '%" . $keywords . "%' OR user_name LIKE '%" . $keywords . "%') AND group_id='user' LIMIT 0,5";
        break;
        case 'PI':
          $qry = "SELECT * FROM tb_participants WHERE participant_id LIKE '%" . $keywords . "%' OR participant_email LIKE '%" . $keywords . "%' OR participant_name LIKE '%" . $keywords . "%' LIMIT 0,5";
        break;
        default:break;
      }
      $try = mysql_query($qry);
      if ($try) {
        if (mysql_num_rows($try) > 0) {
          while ($row = mysql_fetch_assoc($try)) {
            $result[] = $row;
          }
        }
      }
    }
    return $result;
  }

  function calculate_participants($param) {
    $result = "";
    if (!isEmpty($param)) {
      switch ($param) {
        case 'REGGEN':
          $qry = "SELECT SUM(CASE WHEN participant_status='Y' AND participant_gender='M' THEN 1 ELSE 0 END) AS male_participant, SUM(CASE WHEN participant_status='Y' AND participant_gender='F' THEN 1 ELSE 0 END) AS female_participant FROM tb_participants";
        break;
        case 'REGCLS':
          $qry = "SELECT SUM(CASE WHEN participant_status='Y' AND class_id='AD' THEN 1 ELSE 0 END) AS adult_participant, SUM(CASE WHEN participant_status='Y' AND class_id='TE' THEN 1 ELSE 0 END) AS teenager_participant, SUM(CASE WHEN participant_status='Y' AND class_id='IP' THEN 1 ELSE 0 END) AS inspector_participant FROM tb_participants";
        break;
        case 'REGRMB':
          $qry = "SELECT SUM(CASE WHEN participant_status='Y' AND class_id='TE' AND group_id='MUSIC' THEN 1 ELSE 0 END) AS teenager_music, SUM(CASE WHEN participant_status='Y' AND class_id='TE' AND group_id='DANCE' THEN 1 ELSE 0 END) AS teenager_dance, SUM(CASE WHEN participant_status='Y' AND class_id='TE' AND group_id='SELFDEFENSE' THEN 1 ELSE 0 END) AS teenager_selfdefense FROM tb_participants";
        break;
        case 'REGPMB':
          $qry = "SELECT SUM(CASE WHEN participant_status='Y' AND class_id='AD' AND group_id='MUSIC' THEN 1 ELSE 0 END) AS adult_music, SUM(CASE WHEN participant_status='Y' AND class_id='AD' AND group_id='DANCE' THEN 1 ELSE 0 END) AS adult_dance, SUM(CASE WHEN participant_status='Y' AND class_id='AD' AND group_id='SELFDEFENSE' THEN 1 ELSE 0 END) AS adult_selfdefense FROM tb_participants";
        break;

        case 'UNREGGEN':
          $qry = "SELECT SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND participant_gender='M' THEN 1 ELSE 0 END) AS male_participant, SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND participant_gender='F' THEN 1 ELSE 0 END) AS female_participant FROM tb_participants";
        break;
        case 'UNREGCLS':
          $qry = "SELECT SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND class_id='AD' THEN 1 ELSE 0 END) AS adult_participant, SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND class_id='TE' THEN 1 ELSE 0 END) AS teenager_participant, SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND class_id='IP' THEN 1 ELSE 0 END) AS inspector_participant FROM tb_participants";
        break;
        case 'UNREGRMB':
          $qry = "SELECT SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND class_id='TE' AND group_id='MUSIC' THEN 1 ELSE 0 END) AS teenager_music, SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND class_id='TE' AND group_id='DANCE' THEN 1 ELSE 0 END) AS teenager_dance, SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND class_id='TE' AND group_id='SELFDEFENSE' THEN 1 ELSE 0 END) AS teenager_selfdefense FROM tb_participants";
        break;
        case 'UNREGPMB':
          $qry = "SELECT SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND class_id='AD' AND group_id='MUSIC' THEN 1 ELSE 0 END) AS adult_music, SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND class_id='AD' AND group_id='DANCE' THEN 1 ELSE 0 END) AS adult_dance, SUM(CASE WHEN (participant_status='N' OR participant_status='C') AND class_id='AD' AND group_id='SELFDEFENSE' THEN 1 ELSE 0 END) AS adult_selfdefense FROM tb_participants";
        break;

        case 'ALLGEN':
          $qry = "SELECT SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND participant_gender='M' THEN 1 ELSE 0 END) AS male_participant, SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND participant_gender='F' THEN 1 ELSE 0 END) AS female_participant FROM tb_participants";
        break;
        case 'ALLCLS':
          $qry = "SELECT SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND class_id='AD' THEN 1 ELSE 0 END) AS adult_participant, SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND class_id='TE' THEN 1 ELSE 0 END) AS teenager_participant, SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND class_id='IP' THEN 1 ELSE 0 END) AS inspector_participant FROM tb_participants";
        break;
        case 'ALLRMB':
          $qry = "SELECT SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND class_id='TE' AND group_id='MUSIC' THEN 1 ELSE 0 END) AS teenager_music, SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND class_id='TE' AND group_id='DANCE' THEN 1 ELSE 0 END) AS teenager_dance, SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND class_id='TE' AND group_id='SELFDEFENSE' THEN 1 ELSE 0 END) AS teenager_selfdefense FROM tb_participants";
        break;
        case 'ALLPMB':
          $qry = "SELECT SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND class_id='AD' AND group_id='MUSIC' THEN 1 ELSE 0 END) AS adult_music, SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND class_id='AD' AND group_id='DANCE' THEN 1 ELSE 0 END) AS adult_dance, SUM(CASE WHEN (participant_status='N' OR participant_status='C' OR participant_status='Y') AND class_id='AD' AND group_id='SELFDEFENSE' THEN 1 ELSE 0 END) AS adult_selfdefense FROM tb_participants";
        break;

        default:break;
      }
      $try = mysql_query($qry);
      if ($try) {
        $try = mysql_fetch_assoc($try);
        foreach ($try as $row) {
        	$result[] = $row;
        }
      }
    }
    return $result;
  }

  function generate_rpt_access($data) {
    $result = false;
    if (!isEmpty($data)) {
      $id = anti_injection($data['id']);
      $file = anti_injection($data['file']);
      $date = anti_injection($data['date']);
      $time = anti_injection($data['time']);
      $email = anti_injection($data['email']);
      $qry = "INSERT INTO tb_report_access(access_id, access_file, access_date, access_time, user_email)";
      $qry .= " VALUES('$id','$file','$date','$time','$email')";
      $try = mysql_query($qry);
      if ($try) {
        $result = true;
      }
    }
    return $result;
  }

  function get_client_ip() {
    $ip = "";
    if (isset($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    else if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else if (isset($_SERVER['HTTP_X_FORWARDED'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED'];
    }
    else if (isset($_SERVER['HTTP_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    }
    else if (isset($_SERVER['HTTP_FORWARDED'])) {
      $ip = $_SERVER['HTTP_FORWARDED'];
    }
    else if (isset($_SERVER['REMOTE_ADDR'])) {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

  function logs($data) {
    $result = false;
    if (!isEmpty($data)) {
      date_default_timezone_set("Asia/Jakarta");
      $date = date("Y-m-d");
      $time = date("H:i:s");
      $description = anti_injection($data['desc']);
      $ip = anti_injection($data['ip']);
      $agent = anti_injection($data['agent']);
      $page = anti_injection($data['page']);
      $user = anti_injection($data['user']);
      $qry = "INSERT INTO tb_logs(log_description, log_page, log_ip, log_agent, log_date, log_time, log_user)";
      $qry .= " VALUES('$description','$page','$ip','$agent','$date','$time','$user')";
      $try = mysql_query($qry);
      if ($try) {
        $result = true;
      }
    }
    return $result;
  }

  function get_logs($cat) {
    $result = "";
    if (!isEmpty($cat)) {
      switch ($cat) {
        case 'CTWEBHIT':
          $qry = "SELECT COUNT(log_id) AS hit_ws_count, DATE(log_date) AS hit_ws_date FROM tb_logs WHERE tb_logs.log_date >= DATE(NOW()) - INTERVAL 7 DAY GROUP BY DATE(tb_logs.log_date) ORDER BY log_date ASC LIMIT 0,7";
        break;
        default:break;
      }
      $try = mysql_query($qry);
      if ($try) {
        while ($row = mysql_fetch_assoc($try)) {
          $result[] = $row;
        }
      }
    }
    return $result;
  }
?>
