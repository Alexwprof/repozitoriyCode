<? /*В init.php*/?>
<? 
AddEventHandler('main', 'OnBeforeEventSend', Array("MyForm", "my_OnBeforeEventSend"));
    class MyForm
  {
      function my_OnBeforeEventSend(&$arFields, &$arTemplate)
      {
          $rsSites = CSite::GetByID(SITE_ID);
          $arSite = $rsSites->Fetch();
          $arFields['EMAIL_TO'] = $arSite['EMAIL'];
          $arFields['DEFAULT_EMAIL_FROM'] = COption::GetOptionString('main','email_from');
     }
  }
  ?>

<?/*тут добавляем для заказа */
AddEventHandler('main', 'OnBeforeEventAdd', 'sendOrderMessage');
function sendOrderMessage(&$arEvent, &$lid, &$arFields)
{
    if ($arEvent == "SALE_NEW_ORDER") {
       $orderId = $arFields['ORDER_ID'];
       $result = CSaleOrderPropsValue::GetList(array(),array('ORDER_ID' => $orderId));
       $arProps = array();
       while ($arProp = $result->Fetch())
       {
           $arProps[$arProp['CODE']] = $arProp['VALUE'];
       }
       $db_sales = CSaleOrder::GetList(array(), array('ID' => $orderId));
       while ($ar_sales = $db_sales->Fetch())
       {
           $arProps['COMMENT'] = $ar_sales['USER_DESCRIPTION'];
           $arProps['DELIVERY_SUM'] = $ar_sales['PRICE_DELIVERY'];
           $arProps['PRICE_WO_DELIVERY'] = floatval($ar_sales['PRICE']) - floatval($ar_sales['PRICE_DELIVERY']);
       }
       $db_basket = CSaleBasket::GetList(array(), array('ORDER_ID' => $orderId), false, false, array());
       while ($ar_basket = $db_basket->Fetch()) {
           $article = CIBlockElement::GetList(array(), array('ID' => $ar_basket['PRODUCT_ID']),false,false, array())->GetNextElement()->GetProperty('2')['VALUE'];
           $arProps['BASKET'][] = '<tr><td>' . $article . '</td><td>' . $ar_basket['NAME'] . '</td><td>' . round($ar_basket['PRICE'], 2) . '</td><td>' . $ar_basket['QUANTITY'] . '</td><td>' . round($ar_basket['PRICE'] * $ar_basket['QUANTITY'], 2) . '</td></tr>';
       }
       $order = \Bitrix\Sale\Order::loadByAccountNumber($orderId);
       $paymentCollection = $order->getPaymentCollection();
       $payment = $paymentCollection[0];
       $arFields['PHONE'] = $arProps['PHONE'];
       $arFields['PHONE_2'] = $arProps['PHONE_2'];
       $arFields['ADDRESS'] = $arProps['ADDRESS'];
       $arFields['COMMENT'] = $arProps['COMMENT'];
       $arFields['DELIVERY_SUM'] = $arProps['DELIVERY_SUM'].' ₽';
       $arFields['PRICE_WO_DELIVERY'] = $arProps['PRICE_WO_DELIVERY'].' ₽';
       $arFields['PAY_SYSTEM'] = $payment->getField('PAY_SYSTEM_NAME');
       $arFields['CART'] = implode('', $arProps['BASKET']);
   }
}
