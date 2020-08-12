<?php
session_start();
if (isset($_SESSION['login'])) {
  header('location: /');
  exit();
}
include 'db.php';
$error = '';

if (isset($_POST['login']) && isset($_POST['password'])) {
  $login = $_POST['login'];
  $password = sha1($_POST['password']);
  $check = $mysqli->query("SELECT * FROM `admin` WHERE `login` = '$login' AND `password` = '$password'");
  if (mysqli_num_rows($check) > 0) {
    $_SESSION['login'] = 1;
    header('location: /');
    exit();
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
  <form class="formLogin" method="POST" action="login.php">
    <?=$error?><br/>
    <input class="inputLogin" name="login" placeholder="Логин"><br/>
    <input class="inputLogin" name="password" type="password" placeholder="Пароль"><br/>
    <button class="buttonLogin">Войти</button>
  </form>
</body>
