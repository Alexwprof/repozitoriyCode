<? //Делаем что бы метатеги брались из вкладки Seo раздела
$SID = SITE_ID;
$res = CIBlockSection::GetList(array(),
array(
'IBLOCK_ID' => $arParams["IBLOCK_ID"],
'CODE' =>$arResult["VARIABLES"]["SECTION_CODE"],
'SITE_ID' => $SID));
$section = $res->Fetch();
$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams["IBLOCK_ID"],$section["ID"]); 
 $values = $ipropValues->getValues();
 //echo '<pre>' .print_r($values,true). '</pre>';
if($values['SECTION_META_TITLE']){
  $APPLICATION->SetPageProperty("title", $values['SECTION_META_TITLE']);
}
if($values['SECTION_META_DESCRIPTION']){
  $APPLICATION->SetPageProperty("description", $values['SECTION_META_DESCRIPTION']);
}
if($values['SECTION_META_KEYWORDS']){
  $APPLICATION->SetPageProperty("keywords", $values['SECTION_META_KEYWORDS']);
}
?>

<?/*Для H1 указываем в теге */?>
<?$APPLICATION->ShowTitle("h1")?>
