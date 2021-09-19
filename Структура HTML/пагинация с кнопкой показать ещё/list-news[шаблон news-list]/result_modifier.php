<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?foreach($arResult["ITEMS"] as $key => $list_img_resize){
     
     $image_resize1 = CFile::ResizeImageGet($list_img_resize["PREVIEW_PICTURE"], array("width" => 315, "height" => 320));
     $image_resize2 = CFile::ResizeImageGet($list_img_resize["PREVIEW_PICTURE"], array("width" => 340, "height" => 368));
     $arResult["ITEMS"][$key]["PHOTO_SMALL"][] = $image_resize1["src"];
     $arResult["ITEMS"][$key]["PHOTO_BIG"][] = $image_resize2["src"];
  }
  ?>


