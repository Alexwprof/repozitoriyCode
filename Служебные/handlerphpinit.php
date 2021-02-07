<? /*использовать обработчик в битркис init.php*/ ?>
<? /*инициалзируем обработчик*/ ?>
<?AddEventHandler("sale", "OnBeforeOrderAdd", "OnBeforeOrderAddHandler");?>


<? /*запускаем обработчик*/ ?>
 <?function OnBeforeOrderAddHandler(&$arFields) {

        foreach($arFields["BASKET_ITEMS"] as $arOrderListMoySklad){

            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_RAZMER");

            $arFilter = Array(

                "IBLOCK_ID"=>17,

                "ACTIVE_DATE"=>"Y",

                "ACTIVE"=>"Y",

                "ID"=>$arOrderListMoySklad["PRODUCT_ID"]

            );

            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
            while($ob = $res->GetNextElement()){
                $arFields = $ob->GetFields();
                $gdffdgdfsg[] = $arFields["PROPERTY_RAZMER_VALUE"];
            }
            foreach($gdffdgdfsg as $sdfasd43tg){

                $arOrderListMoySklad["NAME"] = $arOrderListMoySklad["NAME"]. "(". $sdfasd43tg .")";

                $orderId = 97; // id заказа, в корзине которого нужно изменить названия товаров

                $basket = Order::load($orderId)->getBasket();

                foreach ($basket as $basketItem) {
                    $basketItem->setField('NAME',  $arOrderListMoySklad["NAME"]);
                }

                $basket->save();
                file_put_contents($_SERVER['DOCUMENT_ROOT'].'/001.txt', print_r($arOrderListMoySklad["NAME"], 1), FILE_APPEND);
            }


        }

}
?>

