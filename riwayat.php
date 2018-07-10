<?php include('functions.php'); ?>
<?php get_page_part('src/fpdf/fpdf.php','require'); ?>
<?php session_start(); ?>
<?php include_once("src/tracking/self-tracking.php"); ?>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($_GET["key"])) {
    $_key = anti_injection($_GET["key"]);
    $_pr = sha1($_SESSION["trx-rpt-id"] . "I" . $_SESSION["trx-rpt-time"]);
    $_dl = sha1($_SESSION["trx-rpt-id"] . "D" . $_SESSION["trx-rpt-time"]);
    if ($_key ==  $_pr || $_key == $_dl) {
      if ($_key == $_pr) {
        $act = 'I';//print
      }
      else if ($_key == $_dl) {
        $act = 'D';//dl
      }
      $GLOBALS['key'] = $_key;
      $tmp = explode(',', $_SESSION["trx-rpt-time"]);
      $access['date'] = $tmp[0];
      $access['time'] = $tmp[1];

      $title = $_SESSION["trx-rpt-id"] . '-' . $access['date'] . '-' . $access['time'] . '.pdf';
      $author = 'Panitia DISPENKASI 30 - PAKIN Bandung';

      $access['id'] = $_key;
      $access['file'] = $title;
      $access['type'] = $act;
      $access['email'] = $_SESSION["email"];
      //if (generate_trx_access($access)) {
      generate_trx_access($access);
        class PDF extends FPDF {
          function AddCustomPage() {
            $this->AliasNbPages();
            $this->SetMargins(6,2,2);
            $this->SetFont('DroidSerif','B',12);
            $this->AddPage();
            $this->Ln(3);// Line break
          }

          function Header() {// Page header
            $this->Image(get_home_page() . 'src/img/logo/dispenkasi-red.png',6,6,28,25);// Logo
            $this->Cell(30,14,'',0,0);// Move to the right
            $this->SetFont('DroidSerif','B',18);
            $this->Cell(0,14,'DISPENKASI 30 (PAKIN BANDUNG)',0,2,'L');// Title
            $this->SetFont('DroidSerif','B',14);
            $this->Cell(0,2,'Diskusi Pendalaman Kitab Si Shu ke-30',0,2,'L');// Sub-Title
            $this->SetFont('DroidSerif','',11);
            $this->Cell(0,14,'Jalan Cibadak No. 225 Blok I-J, Bandung, Jawa Barat',0,2,'L');// Description
            $this->Line(6,33,203,33);
            $this->Ln(3);// Line break
          }

          function Footer() {// Page footer
            $this->SetY(-10);// Position at 1.5 cm from bottom
            $footer = array(
              '#' . $GLOBALS['key'],
              'Hal. '.$this->PageNo().'/{nb}',
              'Waktu akses: ' . date("d-m-Y H:i:s")
            );
            $this->Cell(1,10,'',0,0,'L',true);
            $this->SetFont('DroidSerif','I',8);
            $this->Cell(92,10,$footer[0],0,0,'L',true);
            $this->SetFont('DroidSerif','B',8);
            $this->Cell(56,10,$footer[1],0,0,'L',true);
            $this->SetFont('DroidSerif','',8);
            $this->Cell(10,10,$footer[2],0,0,'L',true);
            $this->Line(6,140,203,140);
          }

          function FancyTable($data) {
            // Colors, line width and bold font
            $user = get_account_single($data["user_email"]);
            $name = $user["user_name"];
            $this->SetFillColor(255,255,255);
            $this->SetTextColor(0);
            $this->SetDrawColor(0,0,0);
            $this->SetLineWidth(.2);
            $header_main_1 = array('ID','Jenis/Metode Pembayaran','Catatan');
            $header_main_2 = array('Tanggal/Waktu','Koordinator','Panitia');
            $width_detail = array(10,157,30);
            $header_detail = array('No','Deskripsi', 'Biaya');
            $sum_detail = array('Jumlah','Total Biaya');
            if (count($data) == 0) {
              see_ya(get_home_page() . 'dispenkasi/#transaksi');
            }
            else {
              //for ($g = 0; $g < count($data); $g++) {
                $this->AddCustomPage();//add new page every trx header
                $trx_date = date_create($data["header_date"]);
                $current_data_1 = array(
                  $data["header_id"],
                  switch_payment($data["header_type"]) . "/" . $data["header_payment_methods"],
                  empty_to_strip($data["header_information"])
                );
                $current_data_2 = array(
                  switch_day(date_format($trx_date, "w")) . ", " . date_format($trx_date, "j") . " " . switch_month(date_format($trx_date, "m")) . " " . date_format($trx_date, "Y") . "/" . $data["header_time"],
                  $data["user_email"],
                  $data["admin_email"]
                );
                for ($h = 0;$h < count($header_main_1); $h++) {
                  $this->SetFont('DroidSerif','B',10);
                  $this->Cell(50,5,$header_main_1[$h],0,0,'L',true);
                  $this->SetFont('DroidSerif','',9);
                  $this->Cell(48,5,$current_data_1[$h],0,0,'L',true);
                  $this->SetFont('DroidSerif','B',10);
                  $this->Cell(40,5,$header_main_2[$h],0,0,'L',true);
                  $this->SetFont('DroidSerif','',9);
                  $this->Cell(55,5,$current_data_2[$h],0,1,'L',true);
                }
                //$this->SetFont('DroidSerif','B',10);
                //$this->Cell(50,5,$header_main_1[2],0,0,'L',true);
                //$this->SetFont('DroidSerif','',9);
                //$this->Cell(100,5,$data["header_information"],0,0,'L',true);
                //$this->Ln(11);
                $details = get_user_trx_details('*', $data["header_id"]);
                if (count($details) == 0) {

                }
                else {
                  // Header
                  $width_detail = array(10,157, 30);
                  $this->SetFont('DroidSerif','B',10);
                  for ($l = 0; $l < count($header_detail); $l++) {
                    $this->Cell($width_detail[$l],7,$header_detail[$l],1,0,'C',true);
                  }
                  $this->Ln();

                  $tmp_biaya = 0;
                  $this->SetFont('DroidSerif','',9);
                  for ($j = 0; $j < count($details); $j++) {
                    // Color and font restoration
                    if ($j % 2 === 0) {
                      $this->SetFillColor(226,226,226);
                    }
                    else {
                      $this->SetFillColor(255,255,255);
                    }
                    $this->SetTextColor(0);
                    $this->SetFont('');
                    // Data
                    $fill = false;
                    $this->Cell($width_detail[0],6,$j + 1 ,'LR',0,'C',$fill);
                    $this->Cell($width_detail[1],6,$details[$j]["detail_item"] ,'LR',0,'L',$fill);
                    $this->Cell($width_detail[2],6,"Rp" . num_to_rupiah($details[$j]["detail_price"]),'LR',0,'R',$fill);
                    $this->Ln();
                    $fill = !$fill;
                    $tmp_biaya += $details[$j]["detail_price"];
                  }
                  $this->Cell(array_sum($width_detail),0,'','BT',1);
                  // summary
                  $this->SetFillColor(255,255,255);
                  $sum_data = array(
                    count($details),
                    "Rp" . num_to_rupiah($tmp_biaya)
                  );
                  for ($s = 0;$s < count($sum_detail); $s++) {
                    $this->SetFont('DroidSerif','B',10);
                    $this->Cell(array_sum($width_detail) - $width_detail[2],6,$sum_detail[$s],'TLR',0,'R',$fill);
                    $this->SetFont('DroidSerif','',9);
                    $this->Cell($width_detail[2],6,$sum_data[$s],'TLR',1,'R',$fill);
                  }
                  $this->Cell(array_sum($width_detail),0,'','T');
                  $tmp_biaya = 0;
                }
                $this->Ln(2);//EOT
                $notes = array(
                  'Catatan:',
                  '>) Bukti pembayaran ini adalah bukti pembayaran yang sah jika disertai',
                  ' dengan kode transaksi pada kolom "ID", kode hash pada pojok kiri',
                  ' bawah transaksi "#" dan cap resmi panitia DISPENKASI 30 (PAKIN Bandung).',
                  '>) Bukti pembayaran ini wajib dibawa pada saat acara (daftar ulang).',
                  '',
                );
                $coord = array(
                  '',
                  'Koordinator,',
                  '',
                  '',
                  '',
                  $name
                );

                $adm = array(
                  '',
                  'Panitia,',
                  '',
                  '',
                  '',
                  '(DISPENKASI 30)'
                );

                $this->SetFont('DroidSerif','',9);
                for ($a = 0;$a < count($notes); $a++) {
                  $this->SetFont('DroidSerif','',9);
                  $this->Cell(120,3,$notes[$a],0,0,'L',true);
                  $this->SetFont('DroidSerif','B',9);
                  $this->Cell(35,3,$coord[$a],0,0,'R',true);
                  $this->Cell(35,3,$adm[$a],0,1,'R',true);
                }
                $this->SetFont('DroidSerif','',9);
              //}
            }
            //$this->Ln();//EOF
          }
        }

        $pdf = new PDF('L','mm','A5');//landscape
        $pdf->SetTitle($title);
        $pdf->SetAuthor($author);

        $pdf->AddFont('DroidSerif','','DroidSerif.php');
        $pdf->AddFont('DroidSerif','B','DroidSerif-Bold.php');
        $pdf->AddFont('DroidSerif','BI','DroidSerif-BoldItalic.php');
        $pdf->AddFont('DroidSerif','I','DroidSerif-Italic.php');
        $pdf->AddFont('DroidSerif','U','DroidSerif.php');

        $email = get_trx_user_email($_SESSION["trx-rpt-id"]);
        $data = get_user_trx_header_single($email, $_SESSION["trx-rpt-id"]);
        $pdf->FancyTable($data);
        $pdf->Output($act,$title);
      //}
      //else {
        //see_ya(get_home_page() . 'dispenkasi/');
      //}
    }
    else {
      see_ya(get_home_page() . 'dispenkasi/');
    }
  }
  else {
    see_ya(get_home_page() . 'dispenkasi/');
  }
?>
