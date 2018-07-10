<?php
  logs($data = array(
    "desc"=>"Akses laman",
    "page"=>$_SERVER['REQUEST_URI'],
    "user"=>!empty($_SESSION) ? $_SESSION['email'] : 'anon',
    "ip"=> get_client_ip(),
    "agent"=>isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'unknown')
  );
?>
