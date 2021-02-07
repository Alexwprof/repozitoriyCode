<?/*Добавить новвое поле в почтовый шаблон битрикс. в примере добавляю поле город*/?>
<?AddEventHandler("sale", "OnOrderNewSendEmail", "modifySendingSaleData");?>

<?
function modifySendingSaleData($orderID, &$eventName, &$arFields) {
$arLocs["CITY_NAME_LANG"] = " ";
    // получаем параметры заказа по ID
    //$arOrder = CSaleOrder::GetByID($orderID);
    //$orderID = "75";
    $dbOrderProps = CSaleOrderPropsValue::GetList(
        array("SORT" => "ASC"),
        array("ORDER_ID" => $orderID, "CODE"=>array("LOCATION"))
    );
    while ($arOrderProps = $dbOrderProps->GetNext()):
          //  echo "<pre>"; print_r($arOrderProps); echo "</pre>";

            $arLocs = CSaleLocation::GetByID($arOrderProps["VALUE"], LANGUAGE_ID);
            //   echo "<pre>"; print_r($arLocs); echo "</pre>";
            $arLocs["CITY_NAME_LANG"];
            $arFields['BX_LOCATION_CT'] = $arLocs["CITY_NAME_LANG"];
        endwhile;
        file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/logtest.txt', date('d.m.y H:i') . "\n" . print_r($arFields, 1), FILE_APPEND);


}
?>
В сам шаблон добавляем макрос #BX_LOCATION_CT#
