<?/*Добавляем подразделы*/
$resultListCategoryForPhoto = array();

<?/*По символьному коду получить ID Раздела*/
$SID = SITE_ID;
$res = CIBlockSection::GetList(array(),
array(
'IBLOCK_ID' => $arParams["IBLOCK_ID"],
'CODE' =>$arParams["SECTION_CODE"],
'SITE_ID' => $SID));
$section = $res->Fetch();


$arFilter = Array(
    'IBLOCK_ID'=>$arParams["IBLOCK_ID"],
   'SECTION_ID'=>$section["ID"]);
$db_list = CIBlockSection::GetList(
   Array("SORT"=>"ASC"),
   $arFilter,
   true);
while($ar_result = $db_list->GetNext())
{
   $arResult["ITEMS"]["CATEGORIES_PARENT_PHOTO"][] = $ar_result;

}

foreach($arResult["ITEMS"]["CATEGORIES_PARENT_PHOTO"] as $key=>$arImageResize){
$image_resize = CFile::ResizeImageGet($arImageResize["PICTURE"], array("width" => 340, "height" => 540));
$image_detail = CFile::ResizeImageGet($arImageResize["DETAIL_PICTURE"], array("width" => 340, "height" => 540));
$arResult["PHOTO_MASS"][] = $arImageResize;
$arResult["PHOTO_MASS"][$key]["PICTURE_NEW_SRC"] = $image_resize["src"];
$arResult["PHOTO_MASS"][$key]["DETAIL_PICTURE_NEW_SRC"] = $image_detail["src"];

}

?>
