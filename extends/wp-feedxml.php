<?php
// инициализация сеанса
$ch = curl_init();

// установка URL и других необходимых параметров
//curl_setopt($ch, CURLOPT_URL, "http://www.wagershare.com/xml/recentwinnersXML.asp?showcasinonames=true");
curl_setopt($ch, CURLOPT_URL, "http://www.buffalopartners.com/xml/recentwinnersXML.asp?showcasinonames=true");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.6) Gecko/20100625 MRA 5.7 (build 03796) Firefox/3.6.6 sputnik 2.4.0.54");

//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// загрузка страницы и выдача её браузеру
curl_exec($ch);
//$content = curl_exec($ch);

// завершение сеанса и освобождение ресурсов
curl_close($ch);
?>