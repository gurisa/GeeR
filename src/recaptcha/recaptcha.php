<?php
  header('Content-Type: application/x-www-form-urlencoded');
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["response"])) {
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = ['secret' => '6LeVJiATAAAAAAv120Y-w9jR-CTY46IB8i7696LS', 'response' => $_POST['response']];
    $query = http_build_query($data);
    $options = array(
      'http' => array(
          'header' => "Content-Type: application/x-www-form-urlencoded\r\n".
                      "Content-Length: ".strlen($query)."\r\n".
                      "User-Agent:MyAgent/1.0\r\n",
          'method'  => "POST",
          'content' => $query,
      ),
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    //$result = json_decode($result, true);
    //if ($result["success"]) {
      //echo "200";
    //}
    //else {
      echo $result;
    //}

  }
  else {
    echo "503";
  }
?>
