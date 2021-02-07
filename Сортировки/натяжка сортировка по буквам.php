<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    .doctors_n{
        padding-top:50px;
        padding-bottom:50px;
    }
    
    .col2 li{
        display:block;
        /*break-inside: avoid;*/
    }
    .alphavit{margin:0;padding:0;list-style-type:none;column-count: 35;}
    
    .alphavit li{
        display:block;
        /*break-inside: avoid;*/
    }
    
    .alphavit {
        padding: 0;
        list-style-type: none;
        column-count: 35;
        display: flex;
        justify-content: space-between;
        border-radius: 4px;
        height: 45px;
        background-color: #e9f0fe;
    }
    .col2{margin:0;padding:0;list-style-type:none;column-count: 4;}
    
    .title_medicine_doctor_wrap{
        background-color: #e9f0fe;
        display: flex;
        justify-content: space-between;
        height: 45px;
        border-radius: 4px;
    }
    
    .title_all_doctors_l {
        font-size: 19px;
        padding-left: 2%;
        font-weight: 700;
        padding-top: 0.6%;
    }
    
    .title_all_doctors_r {
        font-size: 19px;
        padding-right: 2%;
        padding-top: 0.6%;
        color:#979ea7;
    }
    
    .left_doctors:after {
        content: "\203A";
        display: block;
        font-size: 25px;
        width: auto;
        height: 30px;
        position: absolute;
        right: -14px;
        color: #9facbf;
        top: -5.4px;
    }
    
    .title_medicine_doctor_letters {
        padding-left: 7%;
        padding-top: 2%;
        padding-bottom: 5%;
    }
    
    .left_doctors{
        display: block;
        position: relative;
    
    }
    
    .letter_s{
        width: 40px;
        height: 40px;
        background-color: #678abc;
        text-align: center;
        font-size: 28px;
        color: white;
        font-weight: 400;
        border-radius: 4px;
        margin-top: 7px;
        margin-bottom: 7px;
    }
    
    .title_all {
        font-size: 19px;
        padding-left: 2%;
        padding-top: 0.6%;
        color: #979ea7;
    }
    
    .alphavit li {
        display: block;
        padding-left: 17px;
        padding-top: 11px;
        color: #678abc;
        font-weight: 600;
    }
    
    .element_letters{
        padding-right: 12px;
    }
    
    @media(max-width:1100px){
        .alphavit {
            justify-content: center;
            flex-wrap: wrap;
            height: auto;
            padding-bottom:5px;
        }
    
        .title_all {
            font-size: 19px;
            padding-left: 2%;
            padding-top: 0.6%;
            color: #979ea7;
            display: inline-block;
            width: 100%;
            text-align: center;
        }
    }
    
    @media(max-width:900px){
        .col2{margin:0;padding:0;list-style-type:none;column-count: 3;}
        .title_all_doctors_r {
            padding-right: 4%;
        }
        .title_all {
            font-size: 19px;
            padding-left: 2%;
            padding-top: 0.6%;
            color: #979ea7;
            text-align: center;
            display: inline-block;
            width: 100%;
        }
        .element_letters {
             padding-right: 1px;
        }
    }
    
    @media(max-width:600px){
        .col2{margin:0;padding:0;list-style-type:none;column-count: 2;}
        .title_all_doctors_r {
            padding-right: 6%;
        }
    
        .title_medicine_doctor_wrap {
            background-color: #e9f0fe;
            display: flex;
            justify-content: center;
            height: 107px;
            border-radius: 4px;
            flex-direction: column;
            align-items: center;
        }
    }
    
    @media(max-width:400px){
        .col2{margin:0;padding:0;list-style-type:none;column-count: 1;}
        .title_all_doctors_l {
            font-size: 17px;
            padding-left: 2%;
            font-weight: 700;
            padding-top: 0.6%;
        }
    }
    </style>
<body>

    <?/*Новая вёрстка - сортировка по алфавиту*/?>
    <? /*Соритировка категорий по буквам*/ ?>
    <div class="doctors_n">
        <div class="container">
            <div class="doctors_wrap">
                <div class="title_medicine_doctor_wrap">
                    <div class="title_all_doctors_l"> <span class="left_doctors_l">Врачи Медицинского Центра №1</span></div>
                    <div class="title_all_doctors_r"> <span class="left_doctors">Все врачи</span></div>
                </div>
                <div class="title_medicine_doctor_letters">
                    <div class="letters_item">
                         <ul class="col2"> 
                            <?$aaa = ""?>
                            <?foreach($arResult["ITEMS"]["LIST_DOCTOR"] as $LIStList):?>
                            <? $param =  mb_substr($LIStList["VALUE"],0,1,'UTF-8')  ?>
                                <?if($param !== $aaa && !empty($param)):?>
                                    <li class="letter_s"><?echo $param?></li>	
                                <?endif?>
                            <?$aaa = $param;?>
                            <li><a href="?arrFilter_pf[FILTER][]=<?=$LIStList["ID"]?>&set_filter=Y"><?=$LIStList["VALUE"]?></a></li>
                            <?endforeach?>
                        </ul>
                    </div>
                </div>
            </div>
    
            <? /*Соритировка имён по буквам*/ ?>
            <div class="alphavit">
                <div class="title_all">Все врачи </div>
                    <div class="element_letters">
                        <ul class="alphavit">
                                    <? $usortList = ""?>
                            <?foreach ($arResult["ITEMS"]["SORT_ELEM"] as $item): ?>
                                <?$param1 =  mb_substr($item["NAME"],0,1,'UTF-8') ?>
                                <?if ($param1 !== $usortList && !empty($param1) ):?>
                                <li><a href="?sort=<?=$param1?>"><?echo $param =  mb_substr($item["NAME"],0,1,'UTF-8')  ?></a></li>
                                <?endif?>
                                    <?$usortList = $param1?>
                            <?endforeach?>
            
                </ul>
                </div>
            </div>
        </div>
    </div>
    
    <?/*Новая вёрстка - сортировка по алфавиту*/?>


</body>
</html>
