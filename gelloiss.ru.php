<?php
/*
 * Сервис коротких ссылок,
 * разработанный одним пьяным программистом
 * ©Gelloiss.ru
 * По мотивам urls*/

function getHash($length = 4) { //Получаем символьный hash указанной длинны
  $hash = '';
  for ($i = 0; $i < $length; $i++) {
    switch (mt_rand(1, 3)) { //Рандомим из какого диапазона символов будет выбран символ
      case 1:
        $hash .= chr(mt_rand(65, 90)); //большие англ буквы
      break;

      case 2:
        $hash .= chr(mt_rand(48, 57)); //цифры
      break;

      case 3:
        $hash .= chr(mt_rand(97, 122)); //Маленькие англ буквы
      break;
    }
  }

  return $hash;
}