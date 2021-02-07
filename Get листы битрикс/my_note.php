<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
//debug($arResult);
?>
<?/* проверяем на админа */?>
<?
global $USER;
if ($USER->IsAdmin()):?>
<?echo "test1"?>
<?else:?>
<div></div>
<?endif?>


<?//echo '<pre>' .print_r($arResultT,true). '</pre>'?>
<?/* Проверяем подключение модуля sale */?>


 <?if (!CModule::IncludeModule("sale")) return;?>

<?/*Получение элементов по заполненному свойству value */?>
<?
if(CModule::IncludeModule("iblock")){
    //$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM");
    $arrFilterMain = ["PROPERTY_CATMAIN_PROD_VALUE"]= "Популярные";
    $res = CIBlockElement::GetList(
        Array(),
        $arrFilterMain,
        false,
        Array("nPageSize"=>50),
        $arSelect
    );
    while($ob = $res->GetNextElement()){
        $arFields = $ob->GetFields();
        debug($arFields);
        $arProps = $ob->GetProperties();
        debug($arProps);
    }
}
?>

<?  /*Получение связанных элементов из другого инфоблока + передача массива за пределы цикла*/ ?>
<?if(CModule::IncludeModule("iblock")){

    $arSelect = Array("ID", "IBLOCK_ID",
        "DATE_ACTIVE_FROM",
        "PROPERTY_SERVICE_PROD.PREVIEW_TEXT",
        "PROPERTY_SERVICE_PROD.NAME"
    );

    $arFilter = Array("IBLOCK_ID"=>6, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y" , "ID" => $arResult["ID"]);
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
    while($ob = $res->GetNextElement()){
        $arFields[] = $ob->GetFields();
        $arResult["SERV"] =  $arFields;

    }
}
?>

<?/* Получить связанный элемент - товар, включая его цену  */?>


<?if(CModule::IncludeModule("iblock")) {
    $arSelect = Array(
        "DATE_ACTIVE_FROM",
        "PREVIEW_TEXT",
        "NAME",
        "ID",
    );
    $arFilter = Array(
        "IBLOCK_ID" => 2,
        "ACTIVE_DATE" => "Y",
        "ACTIVE" => "Y",
        "ID" => $arResult["ID"]
    );
    $res = CIBlockElement::GetList(
        Array(),
        Array("ID" => $arResult["PROPERTIES"]["SERVICE_PROD"]["VALUE"]),
        false,
        Array("nPageSize" => 20),
        Array(
            "DATE_ACTIVE_FROM",
            "PREVIEW_TEXT",
            "NAME",
            "ID",
            "CATALOG_PRICE_1",

        )
    );
    while ($ob = $res->GetNextElement()) {
        $arFields[] = $ob->GetFields();
        $arResult["SERV"] = $arFields ;

        //  debug($arResult["SERV"]);
    }
}
?>


<?/*Форма отправки товара в карзину без торговых предложений*/?>

<script>
    //Ajax запрос

    $(function(){

        $('#test_form').submit(function(e){
//отменяем стандартное действие при отправке формы
            e.preventDefault();
//берем из формы метод передачи данных
            var m_method=$(this).attr('method');
//получаем адрес скрипта на сервере, куда нужно отправить форму
            var m_action=$(this).attr('action');
//получаем данные, введенные пользователем
            var m_data=$(this).serialize();
            $.ajax({
                type: m_method,
                url: m_action,
                data: m_data,
                beforeSend: function(){
                    $('#add').html('Запрос обрабатывается');
                },
                success: function(result){
                    $('#add').html(result);
                }
            });
        });

    });

</script>

<?if($arResult["CAN_BUY"]):?>

    <form action="<?=$arResult["ORIGINAL_PARAMETERS"]["CURRENT_BASE_PAGE"]?>" method="POST" enctype="multipart/form-data" class="add2cart">
        <input type="hidden" name="<?echo $arParams["ACTION_VARIABLE"]?>" value="ADD2BASKET">
        <input type="hidden" name="ajax_basket" value="Y">
        <input type="hidden" name="<?echo $arParams["PRODUCT_ID_VARIABLE"]?>" value="<?echo $arResult["ID"]?>">
        <button  name="<?echo $arParams["ACTION_VARIABLE"]."ADD2BASKET"?>" class="button product-button" type="submit">
            <i class="fas fa-cart-plus button__icon"></i>
            Купить</button>

    </form>

<?endif?>

<div id="add">
</div>

<?/*Получить по id детальную ссылку элемента*/?>

<?
if(CModule::IncludeModule("iblock")) {

    $iterator = \CIBlockElement::GetList(
        [],
        [
            'ID' => $arList["PROPERTY_TO_CART_SERVICE_ID"],
        ],
        false,
        false,
        [
            'DETAIL_PAGE_URL',
        ]
    );
    if ($item = $iterator->GetNext()) {
        echo $item['DETAIL_PAGE_URL'];
    }
}
?>

<?/*Добавление товара в корзину и обновление его количества в иконке - используем две формы*/?>

<script>

    $('.add2cart').submit(function (e){
        e.preventDefault();
        e.stopImmediatePropagation();

        var m_method=$(this).attr('method');

        var m_action=$(this).attr('action');

        var m_data=$(this).serialize();

        $.ajax({
            type: m_method,
            url: m_action,
            data: m_data,
            success: function send(result){
                // $('#add').html(result.MESSAGE);
                // setTimeout(function() { $("#add").hide() }, 2000);
                swal(result.MESSAGE, "","success");


            }
        });
        function sayHi() {
            var m_datam = $('#two2cart').serialize();
            $.ajax({
                type: 'POST',
                url: '/bitrix/components/bitrix/sale.basket.basket.line/ajax.php',
                data: m_datam,
                success: function such(result) {
                    //console.log(result);
                    $('.ajax_return').html(result);
                }

            });

        }

        setTimeout(sayHi, 3000);


    });
</script>

    <?$func = bitrix_sessid_get();

$my_func = str_replace("sessid=", "", $func);

?>
<?/*Поля которые надо отправлять чтобы вернулось обновленное количество товаров */?>
<form action="<?=$item['DETAIL_PAGE_URL']?>"  method="POST" enctype="multipart/form-data" class="add2cart lite_cart">

    <input type="hidden" name="sessid" value="<?=$my_func?>">
    <input type="hidden" name="siteId" value="s1">
    <input type="hidden" name="templateName" value="lite_cart">
    <input type="hidden" name="arParams[COMPOSITE_FRAME_MODE]" value="A">
    <input type="hidden" name="arParams[COMPOSITE_FRAME_TYPE]" value="AUTO">
    <input type="hidden" name="arParams[HIDE_ON_BASKET_PAGES]" value="N">
    <input type="hidden" name="arParams[PATH_TO_BASKET]" value="/personal/cart/">


</form>


<?
if(CModule::IncludeModule("iblock")){

$arSelect = Array(
    "ID",
    "IBLOCK_ID",
    "DETAIL_PAGE_URL",
    "NAME", "PREVIEW_PICTURE",
    "PREVIEW_TEXT",
    "DATE_ACTIVE_FROM",
    "CATALOG_GROUP_1",



);
 $arrFilterMain["PROPERTY_CATMAIN_PROD_VALUE"] = "выгодные комплекты";
 $res = CIBlockElement::GetList(
    Array(),
    $arrFilterMain,
    false,
    Array("nPageSize"=>50),
    $arSelect
);

while($ob = $res->GetNextElement()) {


    $arFields = $ob->GetFields();
    $arProps = $ob->GetProperties();

//debug($arProps);
}

}
?>



<?/*  Добавляем услуги в корзину другим методом*/?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test_test");
?>Text here....
<?if (!CModule::IncludeModule("sale")) return;?>



<?
Bitrix\Main\Loader::includeModule("catalog");
$PRODUCT_ID = $_POST["ID"];
$QUANTITY = $_POST["QT"];
$fields = [
    'PRODUCT_ID' => $PRODUCT_ID, // ID товара, обязательно
    'QUANTITY' => $QUANTITY, // количество, обязательно
];
$r = Bitrix\Catalog\Product\Basket::addProduct($fields);
if (!$r->isSuccess()) {
    var_dump($r->getErrorMessages());
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>


<?/*  Создаём случайный логин*/?>

<?
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
$date = substr(str_shuffle($permitted_chars), 0, 10);
?>


<?/* Получение скидки по  id товара*/ ?>

<?
if(CModule::IncludeModule("iblock")) {
    $arPrice = CCatalogProduct::GetOptimalPrice(
        $arFields["ID"], // id товара
        1,  //количество для которого считаем скидки
        $USER->GetUserGroupArray(), //пользователь
        "N"
    );
    if (!$arPrice || count($arPrice) <= 0)
    {
        if ($nearestQuantity = CCatalogProduct::GetNearestQuantityPrice($arFields["ID"], 1, $USER->GetUserGroupArray()))
        {
            $quantity = $nearestQuantity;
            $arPrice = CCatalogProduct::GetOptimalPrice($arFields["ID"], 1, $USER->GetUserGroupArray(), "N");
        }
    }

}
?>

<?/*ЗАблокировать кнопку и разблокировать по нажатию на другой элемент */?>

<script>
    $("#post-button").attr("disabled", "disabled");
    $("#post-button").css("background-color", "#6cb7ee");
    $(".bx_item_rating").click(function(){
        $("#post-button").removeAttr("disabled");
        $("#post-button").css("background-color","#0063ab");


    });
</script>

<?/*Проверяем каким способом, через Ajax или нет пришли данные */?>
<?
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    // Если к нам идёт Ajax запрос, то ловим его
    echo 'Это ajax запрос, не перезагружаем страницу';


    exit;
}

//Если это не ajax запрос
header("Location: $current_url");
?>


<?/* Отправка письма из формы  */?>
<?if (!CModule::IncludeModule('iblock')) return;?>
<?
/*ОБработчик форм обратной связи*/
$type_event = 'FEEDBACK_FORM'; //Идентификатор типа почтового события
$site = 's1'; //Идентификатор сайта, либо массив идентификаторов сайта.
$duplicate = 'Y'; //Отправить ли копию письма на адрес указанный в настройках главного модуля в поле "E-Mail адрес

if($_REQUEST["PARTNER"]) $message_id = 49;// шаблон обмен компрессоров
if($_REQUEST["OBMEN"]) $message_id = 7; // шаблон стать партнёром
if($_REQUEST["SALE"]) $message_id = 50; // шаблон получить скидку
// шаблон получить скидку

if(empty($_REQUEST["TEXT"]))  exit;
else{
    echo 'error';

}

$arEventField = array(
    "AUTHOR" => $_POST["AUTHOR"],
    "AUTHOR_EMAIL" => $_POST["AUTHOR_EMAIL"],
    "TEL" => $_POST["TEL"],
    "EMAIL_TO" => 'mgupiy@yandex.ru',
    "TEXT" => $_POST["TEXT"],

);
CEvent::Send($type_event, $site, $arEventField,$duplicate,$message_id);

?>

<?/* Следующий и предыдущий товар   */?>
<?
if (CModule::IncludeModule("iblock")) {

// id инфоблока
    $IBLOCK_ID = 2;
// id элемента для которого ищем соседей
    $ID = $arResult["ID"];

    $query = CIBlockElement::GetList(
        array('ID' => 'ASC'),
        array(
            'IBLOCK_ID' => $IBLOCK_ID,
            'ACTIVE' => 'Y',
            'SECTION_GLOBAL_ACTIVE' => 'Y'),
        false, array('nPageSize' => 1, 'nElementID' => $ID),
        array('ID', 'DETAIL_PAGE_URL', 'NAME')
    );
    while ($elem = $query->GetNextElement()) {
        $arFields[] = $elem->GetFields();
//        var_dump($arFields['RANK']);
//        var_dump($arFields['ID']);
        $arResult["PAG"] = $arFields;

    }

}

?>

<div class="PAG">
    <ul class="ulStr">

        <? //debug($arResult["PAG"])?>
        <? $i = 0; ?>
        <? foreach ($arResult["PAG"] as $asNav): ?>
            <? if ($i == 0): ?>
                <li class="str"><a href="<?= $asNav["DETAIL_PAGE_URL"] ?>" style="font-weight:700">Предыдущий</a><b
                            class="space">|</b></li><br>
            <? endif; ?>
            <? if ($i == 1): ?>
                <li class="str"><b style="color:#0063ab;"><?= $asNav["NAME"] ?></b><b class="space">|</b></li><br>
            <? endif; ?>

            <? if ($i == 2): ?>
                <li class="str"><a href="<?= $asNav["DETAIL_PAGE_URL"] ?>" style="font-weight:700">Следующий</a></li>
                <br>
            <? endif; ?>
            <? $i++; ?>
        <? endforeach ?>


    </ul>


</div>


<?/* Следующая и предыдщая новость   */?>


<? if (!CModule::IncludeModule("iblock")) return; ?>

<? // сортировку берем из параметров компонента
$arSort = array(
    $arParams["SORT_BY1"] => $arParams["SORT_ORDER1"],
    $arParams["SORT_BY2"] => $arParams["SORT_ORDER2"],
);
// выбрать нужно id элемента, его имя и ссылку. Можно добавить любые другие поля, например PREVIEW_PICTURE или PREVIEW_TEXT
$arSelect = array(
    "ID",
    "NAME",
    "DETAIL_PAGE_URL"
);
// выбираем активные элементы из нужного инфоблока. Раскомментировав строку можно ограничить секцией
$arFilter = array(
    "IBLOCK_ID" => $arResult["IBLOCK_ID"],
//"SECTION_CODE" => $arParams["SECTION_CODE"],
    "ACTIVE" => "Y",
    "CHECK_PERMISSIONS" => "Y",
);
// выбирать будем по 1 соседу с каждой стороны от текущего
$arNavParams = array(
    "nPageSize" => 1,
    "nElementID" => $arResult["ID"],
);
$arItems = Array();
$rsElement = CIBlockElement::GetList($arSort, $arFilter, false, $arNavParams, $arSelect);
$rsElement->SetUrlTemplates($arParams["DETAIL_URL"]);
while ($obElement = $rsElement->GetNextElement())
    $arItems[] = $obElement->GetFields();
// возвращается от 1го до 3х элементов в зависимости от наличия соседей, обрабатываем эту ситуацию
if (count($arItems) == 3):
    $arResult["TORIGHT"] = Array("NAME" => $arItems[0]["NAME"], "URL" => $arItems[0]["DETAIL_PAGE_URL"]);
    $arResult["TOLEFT"] = Array("NAME" => $arItems[2]["NAME"], "URL" => $arItems[2]["DETAIL_PAGE_URL"]);
elseif (count($arItems) == 2):
    if ($arItems[0]["ID"] != $arResult["ID"])
        $arResult["TORIGHT"] = Array("NAME" => $arItems[0]["NAME"], "URL" => $arItems[0]["DETAIL_PAGE_URL"]);
    else
        $arResult["TOLEFT"] = Array("NAME" => $arItems[1]["NAME"], "URL" => $arItems[1]["DETAIL_PAGE_URL"]);
endif;
// в $arResult["TORIGHT"] и $arResult["TOLEFT"] лежат массивы с информацией о соседних элементах

?>

<div class="PAG">
    <ul class="ulStr">

        <? if (is_array($arResult["TOLEFT"])): ?>
            <li class="str"><a href="<?= $arResult["TOLEFT"]["URL"] ?>" style="font-weight:700">
                    <!--        --><? //=$arResult["TOLEFT"]["NAME"]?><< Предыдущая новость &nbsp;&nbsp;&nbsp;
                </a></li>


        <? endif ?>

        <? if (is_array($arResult["TORIGHT"])): ?>
            <li class="str"><a href="<?= $arResult["TORIGHT"]["URL"] ?>" style="font-weight:700">
                    <!--        --><? //=$arResult["TORIGHT"]["NAME"]?>Следующая новость>>
                </a></li>
        <? endif ?>
    </ul>
</div>


<?/* Форматировать время  */?>
<?= CIBlockFormatProperties::DateFormat("j F Y", MakeTimeStamp($arItem["~TIMESTAMP_X"], CSite::GetDateFormat())); ?>

<?echo FormatDateFromDB($arItem["DATE_CREATE"], 'SHORT');?>

<?$arr = ParseDateTime($arListReviews["DATE_CREATE"], "DD.MM.YYYY HH:MI:SS")?>
              <?echo $arr["HH"] . ":" . $arr["MI"]?>


<?/* ЧПУ urlwrite  */?>
<?
$arUrlRewrite=array (
6 =>
array (
"CONDITION" => "#^/catalog/([a-zA-Z0-9-]+)/([a-zA-Z0-9-]+)/.*#",
"RULE" => "SECTION_CODE=\$1&ELEMENT_CODE=\$2",
"ID" => "",
"PATH" => "/catalog/detail.php",
),

    7 =>
    array(
        "CONDITION" => "#^/catalog/([a-zA-Z0-9-]+)/.*#",
        "RULE" => "SECTION_CODE=\$1",
        "ID" => "",
        "PATH" => "/catalog/list.php",
    ),

      5 =>
  array (
      'CONDITION' => '#^#',
      'RULE' => '',
      'ID' => 'bitrix:catalog',
      'PATH' => '/catalog/index.php',
      'SORT' => 100,
  ),

      3 =>
  array (
      'CONDITION' => '#^/news/#',
      'RULE' => '',
      'ID' => 'bitrix:news',
      'PATH' => '/news/index.php',
      'SORT' => 100,
  ),

     4 =>
  array (
      'CONDITION' => '#^/psychology-services/#',
      'RULE' => '',
      'ID' => 'bitrix:news',
      'PATH' => '/psychology-services/index.php',
      'SORT' => 100,

  )
)



?>

<?/*Пагинация гетлиста*/?>

<?if(CModule::IncludeModule("iblock")) {
$arSelect = Array("ID", "IBLOCK_ID", "DATE_ACTIVE_FROM", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE",
"DETAIL_PAGE_URL", "LIST_PAGE_URL",);
$arFilter = Array("IBLOCK_ID" => 13, "INCLUDE_SUBSECTIONS" => "Y", "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 3), $arSelect);
$res->NavStart(0);
while ($ob = $res->GetNextElement()) {
$arFields[] = $ob->GetFields();
$arResult["ELEM_CATALOG"] = $arFields;

}

$navStr = $res->GetPageNavStringEx($navComponentObject, "Страницы:", "pocrov_pag");

$arResult["ELEM_NAV"] = $navStr;

//echo $arResult["ELEM_NAV"];
}
?>


<?/*Цена. Приводим цену к виду 2 500 руб от 2500.00 руб*/?>

<?$myPricesa = $arSpecList["CATALOG_PURCHASING_PRICE"];
$myPricesa = number_format($myPricesa,0,'.', ' ' ); ?>

от <span class="bigPrice"><?=$myPricesa?></span> руб/сеанс


<?/*Отследить нажатие select и вернуть только часть вёрстки, а не всю */?>

<form>
    <select id="send_select" class="customSelect">
        <!--                                <option>Специалисты</option>-->
        <option id="all_reviews" value="all_r" >Все отзывы</option>
        <? foreach($arResult["SELECT"] as $arSelect): ?>
            <option value="<?=$arSelect["ID"]?>" ><?=$arSelect["NAME"]?></option>
        <?endforeach;?>
    </select>
</form>
<script>

    $('#send_select').change(function() {
        $.ajax({
            url: '',
            data: {
                spec: $(this).val()
            },
            success: function (data) {
                //$('body').html(result);
                $("#rew").html($('.reviewBlock', data).html());
            }
            // ...
        })

        return false;
    });

</script>

<?/*Получаем картинку*/?>
<?echo CFile::GetPath($asSpec["PREVIEW_PICTURE"])?>

<?/*Делаем аякс запрос и решаем проблему отклёченых скриптов при подгрузке аякса */  ?>

<script>

    $('#send_nselect').change(function() {
        $.ajax({
            url: '',
            data: {
                napr: $(this).val()
            },
            success: function (data) {
                //$('body').html(result);
                $("#ret").html($('.table-radius', data).html());
                $(".show-popup").on("click", function() {
                    let calss_popup = ".popUp-" + findCaller($(this));
                    $(".overflow-bg").addClass("active");
                    $(calss_popup).addClass("active");
                });

            }

        })

        return false;
    });


</script>
<script>
    $('.table-radius').on('click','.test', function(){
        $(".overflow-bg").addClass("active");
        $(".popUp-appoint").addClass("active");

    });
</script>

<?/*Получение списка характеристик торгового предложения по его id*/?>
<?
$arFilter = Array("ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y" , "ID" =>$_POST['productID']);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1000),$arSelect);
while($ob = $res->GetNextElement()) {
    $arFields[] = $ob->GetFields();

    $arItemT = $ob->GetFields();
    $arItemT["PROPERTIES"] = $ob->GetProperties();
    $arResultT[] = $arItemT;
}
?>


<?/*Получение ID элемента по ID его торгового предложения */?>
<?$intElementID = $_POST['productID'];
$mxResult = CCatalogSku::GetProductInfo(
    $intElementID
);?>


<?/* По внешнеу коду свойства справочника получаем его имя. Сначала получаем всего его элементы справочника,
     затем конкретное поле нужного поля*/?>
<?if (CModule::IncludeModule('highloadblock')) {

    $ID = 3; // ИД

    $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();
    $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
    $hlDataClass = $hldata["NAME"] . "Table";

    $result = $hlDataClass::getList(array(
        "select" => array("ID", "UF_NAME", "UF_XML_ID"), // Поля для выборки
        "order" => array("UF_SORT" => "ASC"),
        "filter" => array(),
    ));

    while ($res = $result->fetch()) {
        $hl[] = $res;

    }
}
?>

<?/* Проверка на флаг */?>
<?foreach ($basket as $basketItem) {

$idTovar = $basketItem->getProductId();
$idBasTovar = $basketItem->getId();


if ($idTovar == $productId){
echo 1;

$tugle_id = true;
$bas_product_id = $idBasTovar;
$in_basket = $i;
}
$i++;
}


$tugle_id = false;

if ($tugle_id){
echo 2;

$basketItems = $basket->getBasketItems();
$item = $basketItems[$in_basket];

$item->setField('QUANTITY', $item->getQuantity() + $quantity);

$basket->save();

}else{

echo 3;
$item = $basket->createItem('catalog', $productId);


$item->setFields([
'QUANTITY' => $quantity,
'CURRENCY' => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
'LID' => $SITE_ID,
'PRODUCT_PROVIDER_CLASS' => 'CCatalogProductProvider',
]);

$basket->save();

}
?>

<?/*Фильтр по полям в каталог секшен по цене */  ?>


<?global $arrFilter;?>

<?if ($_GET["SORT"] == "PRICE")
{
    $arParams["ELEMENT_SORT_FIELD"] = "catalog_PRICE_1";
}
if ($_GET["ORDER"] == "ASC") $arParams["ELEMENT_SORT_ORDER"]= "asc";
if ($_GET["ORDER"] == "DESC") $arParams["ELEMENT_SORT_ORDER"]= "desc";
?>


<?//echo '<pre>' .print_r($arSortFields,true). '</pre>'?>
<?$APPLICATION->IncludeComponent(
    "dresscode:catalog.section",
    "line",
    array(
        "IBLOCK_TYPE" => "catalog",
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
        "PROPERTY_CODE" => array(
            0 => "",
            1 => $arParams["PROPERTY_CODE"],
            2 => "",
        ),
        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
        "PRICE_CODE" => array(
            0 => "Розничная",
        ),
        "PAGER_TEMPLATE" => "round",
        "CONVERT_CURRENCY" => "N",
        "CURRENCY_ID" => $arParams["CURRENCY_ID"],
        "FILTER_NAME" => $arParams["FILTER_NAME"],
        "HIDE_MEASURES" => "N",
        "LAZY_LOAD_PICTURES" => "N",
        "ADD_SECTIONS_CHAIN" => "N",
        "SHOW_ALL_WO_SECTION" => "Y",
        "COMPONENT_TEMPLATE" => "line",
        "SECTION_ID" => $_REQUEST["SECTION_ID"],
        "SECTION_CODE" => "",
        "INCLUDE_SUBSECTIONS" => "Y",
        "HIDE_NOT_AVAILABLE" => "N",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER2" => "desc",
        "LINE_ELEMENT_COUNT" => "3",
        "SECTION_URL" => "",
        "DETAIL_URL" => "",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "SEF_MODE" => "N",
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "Y",
        "SET_TITLE" => "Y",
        "SET_BROWSER_TITLE" => "Y",
        "BROWSER_TITLE" => "-",
        "SET_META_KEYWORDS" => "Y",
        "META_KEYWORDS" => "-",
        "SET_META_DESCRIPTION" => "Y",
        "META_DESCRIPTION" => "-",
        "SET_LAST_MODIFIED" => "N",
        "USE_MAIN_ELEMENT_SECTION" => "N",
        "CACHE_FILTER" => "N",
        "USE_PRICE_COUNT" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "PAGER_TITLE" => "Товары",
        "PAGER_SHOW_ALWAYS" => "N",
        "PAGER_DESC_NUMBERING" => "N",
        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
        "USE_FILTER" => "Y"
    ),
    false
);?>

<?/*Получить пользовательское поле раздела */  ?>
<? $db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"),
    $arFilter = Array("IBLOCK_ID"=>$arSub["IBLOCK_ID"], "ID"=>$arSub["ID"]),
    true,$arSelect=Array("UF_YESNO"));
if($ar_result = $db_list->GetNext()) {
    $ar_result["UF_YESNO"];
//                            $ar_result["UF_YESNO"] = $ar_result["UF_YESNO"];
    // echo '<pre>' . print_r($ar_result["UF_YESNO"], true) . '</pre>';
}
?>

<?/*Получить свойство раздела  по id */?>
<?  $ar_result=CIBlockSection::GetList(Array("SORT"=>"ASC"),
    Array("IBLOCK_ID"=>3, "ID"=>$sdfsdf["ID"]),false, Array("UF_TITLE_PLITKI_MAIN"));
if($res=$ar_result->GetNext()){$res["UF_TITLE_PLITKI_MAIN"];}
?>
