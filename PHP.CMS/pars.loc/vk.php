<?php
header('Content-type:text/html; charset=windows-1251');
require 'phpQuery.php';

function print_show($arr){
    echo '<pre>'. print_r($arr,true).'</pre>';
}

$data = [
    '_origin' => 'https://vk.com',
    'act' => 'login',
    'captcha_key' => '',
    'captcha_sid' => '',
    'email' => 'inviz46@yandex.ru',
    'expire' => '',
    'ip_h' => 'ef1368719de28b0132',
    'lg_h' => 'bb389e947dbbcb9db4',
    'pass' => '17051220password17051220',
    'recaptcha' => '',
    'role' => 'al_frame',
    'ul' => '',


];

$url = 'https://login.vk.com';
//Подключение
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/73.0.3683.103 Safari/537.36");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt( $ch, CURLOPT_HEADER, true);
//curl_setopt( $ch, CURLOPT_NOBODY, false); //только заголовки
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_COOKIEJAR, 'cs.txt');
 curl_setopt($ch, CURLOPT_COOKIEFILE, 'cs.txt');
 curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
 $html = curl_exec($ch);
curl_close($ch);

if ($html === false) {
    echo "Произошла оибка в Curl: " . curl_error($ch);
}


var_dump($html);




//  $ch = curl_init();
//  curl_setopt($ch,CURLOPT_URL, $url);
//  curl_setopt($ch,CURLOPT_HEADER, true);
//  curl_setopt($ch,CURLOPT_NOBODY, true);
//  curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
//  curl_exec($ch);
//  curl_close($ch);

//$fl = fopen("file.txt", "w");
//$ch = curl_init();
//curl_setopt($ch,CURLOPT_URL, $url);
//curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($ch,CURLOPT_FILE, $fl);
//$res = curl_exec($ch);
//curl_close($ch);
//var_dump($res);

//$ch = curl_init();
//curl_setopt($ch,CURLOPT_URL, $url);
//curl_setopt($ch,CURLOPT_FOLLOWLOCATION, true);
//curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
//$res = curl_exec($ch);
//curl_close($ch);







//$tbl = $doc->find('.tbl_zebra');
//$tr = $doc->find('.tbl_zebra tr:eq(2)')->text();
//echo $tr;

