<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "CODE"=>"VOICES"));
while($enum_fields = $property_enums->GetNext())
{ 
$arResult["ITEMS"]["FIELD"][] = $enum_fields;
}?>


<?
$arFilter = array(
    'IBLOCK_ID' => $arParams["IBLOCK_ID"],
);
$res = CIBlockElement::GetList(false, $arFilter, array('IBLOCK_ID'));
if ($el = $res->Fetch()){
    $arResult["ITEMS"]["CN"][] = $el['CNT'];
    
}else{
	$arResult["ITEMS"]["CN"][] = 0;
}


?>
