<?php
session_start();
$res = false;
if (isset($_SESSION['login'])) {
  include 'gelloiss.ru.php';
  include 'db.php';
  $link = json_decode(file_get_contents('php://input'), true)['link'];
  $check = $mysqli->query("SELECT * FROM `link` WHERE `url` = '$link'");
  if (mysqli_num_rows($check) > 0) {
    while ($row = $check->fetch_assoc()) {
      $hash = $row['hash'];
    }
  }
  else {
    while (true) {
      $length = 4;
      for ($i = 0; $i < 500; $i++) {
        $hashTemp = getHash($length);
        $check = $mysqli->query("SELECT * FROM `link` WHERE `hash` = '$hashTemp'");
        if (mysqli_num_rows($check) == 0) {
          $hash = $hashTemp;
          break;
        }
      }
      if(isset($hash)) {
        break;
      }
      $length++;
    }
    $mysqli->query("INSERT INTO `link` (`hash`, `url`) VALUES ('$hash', '$link')");
  }
  echo '{"link":"'.$_SERVER['SERVER_NAME'].'/'.$hash.'"}';
  $res = true;
}
if (!$res)
  echo '{"link":0}';