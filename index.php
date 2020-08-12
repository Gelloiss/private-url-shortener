<?php
session_start();
if (!isset($_SESSION['login'])) {
  header('location: /login.php');
  exit();
}
?>

<head>
  <meta charset="utf-8">
  <title>my private shorting url</title>
  <link href="css.css" rel="stylesheet">
</head>

<body>
  <div class="formShort">
    <input id="htmlInputLink" placeholder="Ссылка для сокращения">
    <button id="htmlButtonSend">сократить</button><br/>
    <span id="htmlTextError"></span><br/>
    <span onclick="copy()" id="htmlLinkResult"></span><span onclick="copy()" style="display: none" id="htmlCopyInfo"> [нажмите, чтобы скопировать]</span>
  </div>
  <a class="link" href="changePassword.php">сменить данные входа</a>
</body>

<script src="js.js"></script>