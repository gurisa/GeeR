<?php
  /* Gurisa Server
  $SERVER = "localhost";
  $USER = "gr";
  $PASSWORD = "RAKA1997";
  $DATABASE = "zadmin_gr";
  */

  /* Local Server */
  $SERVER = "localhost";
  $USER = "root";
  $PASSWORD = "";
  $DATABASE = "gurisa_gr";
  /* */

  $connect = mysql_connect($SERVER, $USER, $PASSWORD);
  if ($connect) {
    $choose = mysql_select_db($DATABASE);
    if ($choose) {
      mysql_query("SET NAMES utf8");
    }
  }
  else {
    die();
  }

?>
