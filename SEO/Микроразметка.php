JSON LD

<?$data = [
'@context' => 'https://schema.org/',
'@type' => 'Organization',
'address' => [ 
  [
'@type' => 'PostalAddress',
'addressLocality' => 'Москва, Россия',
'postalCode' => '​107140',
'streetAddress' => 'БЦ Красносельский,ул. Верхняя Красносельская, д3к1',
  ],

[
  '@type' => 'PostalAddress',
  'addressLocality' => 'Москва, Россия',
  'postalCode' => '​117393',
  'streetAddress' => ',ТЦ Дирижабль, ул. Профсоюзная, 64 к.2',
],

[
  '@type' => 'PostalAddress',
  'addressLocality' => 'Москва, Россия',
  'postalCode' => '​119602',
  'streetAddress' => 'ТЦ Звездочка, ул. Покрышкина, д.4',
],


],
'email' => 'print@mosshar.ru',
'name' => 'МосШар',
'telephone' => '+7 (495) 776 21 88',
];

******

<?$arResult["date_active_from"] = ConvertDateTime($arResult["DATE_CREATE"], "YYYY-MM-DD", "ru"); ?>
<?if(is_nan($arResult["RATING_FIVE"]) === false){
    $num = $arResult["RATING_FIVE"];
}
else{
    $num = 0;   
}
$cnt = count($arResult["REVIEWS"]);
?>


<?
$data = [
'@context' => 'https://schema.org/',
'@type' => 'Product',
'name' => $actualItem["NAME"],
'image' => [
    $picture,
],
'description' => $arResult["DETAIL_TEXT"],
'sku' => '0',
'brand' => [
'@type' => 'http://schema.org/Brand',
'name' => 'МосШар',
],
'aggregateRating' => [
'@type' => 'AggregateRating',
'ratingValue' =>  $num,
'reviewCount' => $cnt,
],
'offers' => [
'@type' => 'Offer',
'url' => $arResult["DETAIL_PAGE_URL"],
'priceCurrency' => $arResult["CURRENCIES"][2]["CURRENCY"],
'price' => $price["RATIO_PRICE"],
'priceValidUntil' => $arResult["date_active_from"],
'itemCondition' => 'https://schema.org/NewCondition', 
'availability' => 'https://schema.org/InStock',
'seller' => [
'@type' => 'Organization',
'name' => 'Интернет-магазин МосШар',
],
],
];

$data = json_encode($data);

echo '<script type="application/ld+json">' . $data . '</script>';

?>


$data = json_encode($data);
?>

<?echo '<script type="application/ld+json">' . $data . '</script>';?>
