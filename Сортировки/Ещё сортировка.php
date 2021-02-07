

<?//Ещё примеры сортировки по полям. Код из result_modifier + использование uasort() ?>
<?function name_sort($x, $y) {
return strcasecmp($x['VALUE'], $y['VALUE']);
}
?>

<?function name_sort2($x, $y) {
return strcasecmp($x['NAME'], $y['NAME']);
}
?>
<?
$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>17, "CODE"=>"FILTER"));
while($enum_fields = $property_enums->GetNext())
{
//echo $enum_fields["ID"]." - ".$enum_fields["VALUE"]."<br>";
$mass_mass_param["FIELD"][] = $enum_fields;
}
?>

<?uasort($mass_mass_param["FIELD"], 'name_sort');?>
<?foreach($mass_mass_param["FIELD"] as $ARDOCTORLIST):?>
<? $arResult["ITEMS"]["LIST_DOCTOR"][] = $ARDOCTORLIST ?>
<?endforeach?>

<?
$arFilterz = Array("IBLOCK_ID" => 17, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$resz = CIBlockElement::GetList(Array(), $arFilterz, false, Array("nPageSize"=>1000),$arSelectz);
while($obz = $resz->GetNextElement()) {
    $arFieldsz[] = $obz->GetFields();
    $arItemTz = $obz->GetFields();
    $arItemTz["PROPERTIES"] = $obz->GetProperties();
    $arResult["ITEMS"]["SORT_ELEM_Z"][] = $arItemTz;
}
?>


<?foreach($arResult["ITEMS"]["SORT_ELEM_Z"] as $listAdereListNew){
	if($listAdereListNew["ID"] == $arResult["ID"]) continue;
	if($listAdereListNew["PROPERTIES"]["FILTER"]["VALUE_ENUM_ID"][0] == $arResult["PROPERTIES"]["FILTER"]["VALUE_ENUM_ID"][0]){
		$arResult["SORT_ELEM_Z_NEW_RESULT"][] = $listAdereListNew;
	}

}?>

<?//echo '<pre>' .print_r($arResult["SORT_ELEM_Z_NEW_RESULT"],true). '</pre>'?>


<?foreach($arResult["PROPERTIES"]["PRIVYAZAT_USLUGI"]["VALUE"] as $listAdere):?>
<?
$arFilterq = Array("IBLOCK_ID" => 13, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","ID" => $listAdere);
$res = CIBlockElement::GetList(Array(), $arFilterq, false, Array("nPageSize"=>1000),$arSelect);
if($obq = $res->GetNextElement()) {
    $arFields[] = $obq->GetFields();
    $arItemTq = $obq->GetFields();
    $arItemTq["PROPERTIES"] = $obq->GetProperties();
	$arResult["SORT_ELEM_S"][] = $arItemTq;
}
?>
<?endforeach?>
