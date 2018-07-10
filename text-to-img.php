<?php include_once('functions.php'); ?>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["k"]) && !empty($_GET["k"])) {
    $text = anti_injection($_GET["k"]);
  }
  else {
    $text = 'Gagal memuat konten..';
  }
  header('Content-Type: image/png');
  $font = 'src/fonts/OpenSans-Regular.ttf';
  $size = 16;
  $bbox = imagettfbbox($size, 0, $font, $text);
  $width = abs($bbox[2] - $bbox[0]);
  $height = abs($bbox[7] - $bbox[1]);

  $image = imagecreatetruecolor($width, $height);
  // Create some colors
  $white = imagecolorallocate($image, 255, 255, 255);
  $grey = imagecolorallocate($image, 128, 128, 128);
  $black = imagecolorallocate($image, 0, 0, 0);

  $x = $bbox[0] + ($width / 2) - ($bbox[4] / 2);
  $y = $bbox[1] + ($height / 2) - ($bbox[5] / 2);
  imagefilledrectangle($image, 0, 0, $width - 1, $height - 1, $white);
  // Replace path by your own font path

  // Add some shadow to the text
  imagettftext($image, $size, 0, $x, $y, $grey, $font, $text);
  // Add the text
  imagettftext($image, $size, 0, $x + 1, $y + 1, $black, $font, $text);
  // Using imagepng() results in clearer text compared with imagejpeg()
  imagepng($image);
  imagedestroy($image);
?>
