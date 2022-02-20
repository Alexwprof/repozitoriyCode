<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/lognewajax.txt', date('d.m.y H:i') . "\n" . print_r($_REQUEST, 1), FILE_APPEND);
use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;

global $USER;

Bitrix\Main\Loader::includeModule("sale");
Bitrix\Main\Loader::includeModule("catalog");

// Допустим некоторые поля приходит в запросе
$request = Context::getCurrent()->getRequest();
if(strlen($_REQUEST["PROPERTY"][52][0]) > 0){
    $productId = $_REQUEST["PROPERTY"][52][0];
}else{
    $productId = $_REQUEST["PROPERTY"][51][0];
}
$phone = $_REQUEST["PROPERTY"][56][0];
$name = $_REQUEST["PROPERTY"][55][0];
$comment = $_REQUEST["PROPERTY"][58][0];
$email = $_REQUEST["PROPERTY"][57][0];
$fixuser = 17254;

$siteId = Context::getCurrent()->getSite();
$currencyCode = CurrencyManager::getBaseCurrency();

// Создаёт новый заказ
$order = Order::create($siteId, $fixuser);
$order->setPersonTypeId(1);
$order->setField('CURRENCY', $currencyCode);
if ($comment) {
    $order->setField('USER_DESCRIPTION', $comment); // Устанавливаем поля комментария покупателя
}
$order->setField('COMMENTS', 'Заказ из формы в один клик');

// Создаём корзину с одним товаром
$basket = Basket::create($siteId);
$item = $basket->createItem('catalog', $productId);
$item->setFields(array(
    'QUANTITY' => 1,
    'CURRENCY' => "RUB",
    'LID' => SITE_ID,
    'PRODUCT_PROVIDER_CLASS' => '\CCatalogProductProvider',
));
$order->setBasket($basket);

// Устанавливаем свойства
$propertyCollection = $order->getPropertyCollection();
$phoneProp = $propertyCollection->getPhone();
$phoneProp->setValue($phone);
$nameProp = $propertyCollection->getPayerName();
$nameProp->setValue($name);
$emailPropValue = $propertyCollection->getUserEmail();
$emailPropValue -> setValue($email);
// Сохраняем
$order->doFinalAction(true);
$result = $order->save();
$orderId = $order->getId();
?>

<?/*отслеживаем отправку формы*/?>
<script>

$("#iblockForm11").submit(function (e) {
    
            let m_datam = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '/ajax/form_one_click.php',
                data: m_datam,
                success: function such(result) {
                    console.log(result);
                    $('.ajax_return').html(result);
                }

            });
        // $(this).submit();
    });

</script>
