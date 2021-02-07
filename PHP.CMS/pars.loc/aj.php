<?php
//Данные для подключения
$host = "localhost";
$user = "Yii2";
$password = "17051220";
$database = "gl";
$name = $_POST['identifier'];

//Подключаемся
$connect = mysqli_connect("$host", "$user", "$password", "$database");

//Проверяем подключение
if(!$connect){
    printf("Не удалось соединитьсмя: %s\n",
        mysqli_connect_error());
    exit;
}

/************************************************/

/*Ниже работаем после подключения к бд*/

/************************************************/


/*Проверяем есть ли запрос POST с именем send,
если да, то делаем запрос к базе и записываем информацию*/

//


switch ($_POST) {
    case isset($_POST['identifier']):
        session_start();
        $_SESSION['foxy_add'] = $_POST['identifier'];
        var_dump($_SESSION);
//        mysqli_query($connect, "INSERT INTO `table_keys` SET
//`name`= '$name',
//`pass` = '0'
// ");

        echo 'Успех';
        break;

    case isset($_POST['hool']):
        session_start();
        $_SESSION['foxy_add1'] = $_POST['hool'];
        var_dump($_SESSION);
//        mysqli_query($connect, "INSERT INTO `table_keys` SET
//`name`= '$name',
//`pass` = '0'
// ");

        echo 'Успех';
        session_destroy();

        break;


}





mysqli_close($connect);