<?php
include 'db.php';
$hash = $_GET['code'];
$check = $mysqli->query("SELECT * FROM `link` WHERE `hash` = '$hash'");
if (mysqli_num_rows($check) > 0) {
  while ($row = $check->fetch_assoc()) {
    $link = $row['url'];
  }
  header('location: '.$link);
}
else {
  echo 'Incorrect link';
}