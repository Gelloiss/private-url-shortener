<?php
session_start();
if (!isset($_SESSION['login'])) {
  header('location: /');
  exit();
}
include 'db.php';
$error = 'Не все данные введены';

if (isset($_POST['loginOld']) && isset($_POST['passwordOld']) && isset($_POST['loginNew']) && isset($_POST['passwordNew'])) {
  $loginOld = $_POST['loginOld'];
  $passwordOld = sha1($_POST['passwordOld']);
  $check = $mysqli->query("SELECT * FROM `admin` WHERE `login` = '$loginOld' AND `password` = '$passwordOld'");
  if (mysqli_num_rows($check) > 0) {
    $loginNew = $_POST['loginNew'];
    $passwordNew = sha1($_POST['passwordNew']);
    $mysqli->query("UPDATE `admin` SET `login` = '$loginNew', `password` = '$passwordNew' WHERE `login` = '$loginOld' AND `password` = '$passwordOld'");
    $error = 'Обновлено';
  }
  else {
    $error = 'Неверный логин или пароль';
  }
}
?>

<head>
  <meta charset="utf-8">
  <title>my private shorting url</title>
  <link rel="stylesheet" href="css.css">
</head>

<body>
<form class="formLogin" method="POST" action="changePassword.php">
  <?=$error?><br/>
  <input required class="inputLogin" name="loginOld" placeholder="Старый логин"><br/>
  <input required class="inputLogin" name="loginNew" placeholder="Новый логин"><br/>
  <input required class="inputLogin" name="passwordOld" type="password" placeholder="Старый пароль"><br/>
  <input required class="inputLogin" name="passwordNew" type="password" placeholder="Новый пароль"><br/>
  <button class="buttonLogin">Сохранить</button><br/>
  <a href="/">На главную</a>
</form>
</body>
