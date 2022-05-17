<?/*Корректируем поле имя/фамилия в оформлении заказа*/
AddEventHandler("sale", "OnSaleComponentOrderProperties", "onlinePayment");

function onlinePayment(&$arUserResult)
{
     global $USER;
     $arUserResult["ORDER_PROP"][5] = $USER->GetFirstName();
     $arUserResult["ORDER_PROP"][7] = $USER->GetLastName();
     $arUserResult["ORDER_PROP"][3] = "";
}

