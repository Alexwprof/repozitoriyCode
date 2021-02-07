<?php
require 'simple_html_dom.php';
session_start();

$email = "inviz46@yandex.ru"; //
$pass = "17051220password17051220";
$auth_url = "https://m.vk.com";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $auth_url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0 Iceweasel/43.0.4");
//файл для сохранения кукис - cookie.txt
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//получаем содержимое формы авторизации (URL атрибута action)
$login_page = curl_exec($ch);
curl_close($ch);

//парсим страницу...
$html = str_get_html($login_page);
//..и узнаем урл авторизации (использовал библиотеку Simple PHP DOM Parser)
$login_url = $html->find("form",0)->action;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $login_url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
//отправляем ПОСТ запрос
curl_setopt($ch, CURLOPT_POST, 1);
//следуем за редиректом
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//данные запроса
curl_setopt($ch, CURLOPT_POSTFIELDS, ["email"=>$email, "pass"=>$pass]);
//СНАЧАЛА ЧИТАЕМ КУКИ полученные в первом запросе
curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
//потом ДОБАВЛЯЕМ НОВЫЕ
curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0 Iceweasel/43.0.4");
curl_exec($ch);
curl_close($ch);
//пользователь авторизован


//далее тестируем
//получаем токен доступа

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://oauth.vk.com/authorize?client_id=2890984=&display=page&redirect_uri=https://oauth.vk.com/blank.html&scope=335876&response_type=token&v=5.92&state=123456");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0 Iceweasel/43.0.4");
//только читаем куки

curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$page = curl_exec($ch);
preg_match('/location: (.*)/i', $page, $r);
curl_close($ch);

//если ваш сервер работает на UTF-8, в отличие от VK (windows-1251)
    echo iconv('windows-1251','utf-8',$page);
//echo $page;
//die(print_r($page));
