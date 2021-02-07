<?php header('Content-type: text/html; charset=utf-8');?>

<?php require 'load/phpQuery.php';?>
<?php  require 'load/autoloader.php' ?>
<?php require 'load/debug.php';?>


<!-- ***Переменные для передачи в метод*** -->
<?php
$data = [
    '_xsrf' => '99a5c9080d19fc7b67ecc320465d1cae',
    'action' => 'Войти',
    'backUrl' => 'https://kursk.hh.ru/',
    'password' => 'git_checkout-b_hh',
    'remember' => 'remember',
    'username' => 'alexwprof@gmail.com',
];

$head = [
        "Origin: https://kursk.hh.ru",
        "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
        "Content-Type: application/x-www-form-urlencoded",
        "Upgrade-Insecure-Requests: 1",
        "Accept-Language: ru",
        "Cache-Control: max-age=259200",
        "Pragma: no-cache",
        "Via: 1.0 gsg-server.sitegroup:3129 (squid/2.6.STABLE5)",
        "Connection: Keep-Alive"
]

?>


<!-- ***Инициируем метод***  -->
<?php
$obj = New Parser();
//Соединяемся, если необходима авторизация
//$obj->connect('https://kursk.hh.ru/');

//
$obj->connectauth('https://kursk.hh.ru/account/login?backurl=%2F/',$data,$head);

//передаёт 3 параметра url,start,end, работает с пагинацией
//$obj->pagination('https://yandex.ru/search/?text=%D0%BF%D0%BE%D1%80%D0%BE%D1%88%D0%B5%D0%BD%D0%BA%D0%BE&lr=8','0','2');

//Элемент по селектору и аттрибуту, selector,attr
$obj->show('','');

//Работает по произвольным селекторам
//$obj->difitems('https://goo-gl.ru/5e8z');

?>



<!-- ***Полученные переменные*** -->


<!--  Вывестив с пагинпцией -->
<?//= $obj->range  ?>

<!--  Вывести в всю страницу -->
<?=  $obj->pq ?>

<!--  Вывестив только по селектору -->
<?//= $obj->text ?>

<!--  Вывестив атрибут href списком -->
<?php //debug($obj->test) ?>






