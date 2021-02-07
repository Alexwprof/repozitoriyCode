<?php
spl_autoload_register(function ($class_name) {
    try {
        $test = include 'p/' . $class_name . '.php';
        if($test === false){
            throw new Exception('Отсутствует класс' . '&nbsp;' . $class_name );
        }
    }
    catch (Exception $ex){
        echo $ex->getMessage();
    }
});