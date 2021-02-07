<? Получаем значение списка свойства инфоблока (из настроек свойства) + сортируем по алфавиту результат ?>
<?function name_sort($x, $y) {
return strcasecmp($x['VALUE'], $y['VALUE']);
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
