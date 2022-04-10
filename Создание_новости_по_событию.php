
define("IBLOCK_CREATE", "12");
define("IBLOCK_CREATE_SKU", "13");
define("IBLOCK_CREATE_NEWS", "1");


/*отслеживаем создание элемента, и создаём новость на основе созданного элемента *****************/
AddEventHandler("iblock", "OnAfterIBlockElementAdd", Array("CreateElementIblock", "OnAfterIBlockElementAddHandler"));

class CreateElementIblock
{
    function OnAfterIBlockElementAddHandler(&$arFields)
    {
        if($arFields["ID"]>0){

            $arFilter = Array("IBLOCK_ID" => $arFields["IBLOCK_ID"],"ID" => $arFields["ID"]);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, Array("*","CATALOG_GROUP_1"));
            if($ob = $res->GetNextElement()){
             $CreateElementIblock = $ob->GetFields(); 
            }

            if($CreateElementIblock["IBLOCK_ID"] == IBLOCK_CREATE || $CreateElementIblock["IBLOCK_ID"] == IBLOCK_CREATE_SKU ){
                    $ar_res = CPrice::GetBasePrice($CreateElementIblock["ID"]); 
                    $el = new CIBlockElement;
                    $tmp_img = CFile::MakeFileArray($CreateElementIblock['PREVIEW_PICTURE']);
                    $tmp_img_detail = CFile::MakeFileArray($CreateElementIblock['DETAIL_PICTURE']);
                    $params = Array(
                        "max_len" => "100", 
                        "change_case" => "L",
                        "replace_space" => "_",
                        "replace_other" => "_",
                        "delete_repeat_replace" => "true", 
                        "use_google" => "false",
                     );

                     $arLoadProductArray = Array(  
                        'MODIFIED_BY' => $GLOBALS['USER']->GetID(),
                        "CODE" => CUtil::translit($CreateElementIblock["NAME"], "ru" , $params),
                        'IBLOCK_SECTION_ID' => false,
                        'IBLOCK_ID' => IBLOCK_CREATE_NEWS,
                        "PROPERTY_VALUES" => array(
                            "URL_DETAIL_IMG" =>$CreateElementIblock["DETAIL_PAGE_URL"], 
                            "PRICE_NEWS" =>$ar_res["PRICE"], 
                            "ID" => $CreateElementIblock["ID"]
                        ),
                        'NAME' => $CreateElementIblock["~NAME"],  
                        'ACTIVE' => 'Y', 
                        'PREVIEW_TEXT' => "Обновление коллекции, появился новый товар",  
                        'PREVIEW_PICTURE' => CFile::MakeFileArray($tmp_img["tmp_name"]),
                        'DETAIL_PICTURE' => CFile::MakeFileArray($tmp_img_detail["tmp_name"]),
                        'DETAIL_TEXT' => 'У нас на сайте появилась новая композиция. ' .$CreateElementIblock["~NAME"]. ' за '.'{=this.Price}'.' руб. 
                        Подробнее можно посмотреть в карточке товара: 
                        <a href="'.$CreateElementIblock["DETAIL_PAGE_URL"].'">'.$CreateElementIblock["~NAME"].'</a>',
                        );
  
                    $img = CFile::MakeFileArray($CreateElementIblock['PREVIEW_PICTURE']);
                    $PRODUCT_ID = $el->Add($arLoadProductArray);

            }       
    
        }
        else{
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/suc.txt', date('d.m.y H:i') . "\n" . print_r($arFields["RESULT_MESSAGE"], 1), FILE_APPEND);

        }

    }
}


// регистрируем обработчик  - отслеживаем изменение цены***********************

if (!CModule::IncludeModule("sale")) return;
if (!CModule::IncludeModule("catalog")) return;

 AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("ChangePriceCheck", "OnAfterIBlockElementUpdateHandler"));

    class ChangePriceCheck{
        function OnAfterIBlockElementUpdateHandler(&$arFields)
            {   
                $ar_res = CPrice::GetBasePrice($arFields["ID"]); 
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/price1.txt', print_r($ar_res["PRICE"], 1), FILE_APPEND);

                function BXIBlockAfterSave(&$arFields) {

                    $ar_res = CPrice::GetBasePrice($arFields["ID"]);

                     file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/price1.txt',  "\n" . print_r($ar_res["PRICE"], 1), FILE_APPEND);
                
                         $trimmed = file('/home/bitrix/ext_www/sweetgifts.ru/price1.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                       
                         if($trimmed[0] == $trimmed[1] ){
                            echo "";
                            unlink('/home/bitrix/ext_www/sweetgifts.ru/price1.txt');

                         }
                        else{

                                $ar_res123 = CPrice::GetBasePrice($arFields["ID"]);                          
                                $arFilter = Array("IBLOCK_ID" => $arFields["IBLOCK_ID"],"ID" => $arFields["ID"]);
                                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, Array("*","CATALOG_GROUP_1"));
                                if($ob = $res->GetNextElement()){
                                $CreateElementIblock = $ob->GetFields(); 
                                }

                                if($CreateElementIblock["IBLOCK_ID"] == IBLOCK_CREATE || $CreateElementIblock["IBLOCK_ID"] == IBLOCK_CREATE_SKU ){
                                    $ar_res = CPrice::GetBasePrice($CreateElementIblock["ID"]); 
                                    $el = new CIBlockElement;
                                    $tmp_img = CFile::MakeFileArray($CreateElementIblock['PREVIEW_PICTURE']);
                                    $tmp_img_detail = CFile::MakeFileArray($CreateElementIblock['DETAIL_PICTURE']);
                                    $params = Array(
                                        "max_len" => "100", 
                                        "change_case" => "L",
                                        "replace_space" => "_",
                                        "replace_other" => "_",
                                        "delete_repeat_replace" => "true", 
                                        "use_google" => "false",
                                    );

                                    $arLoadProductArray = Array(  
                                        'MODIFIED_BY' => $GLOBALS['USER']->GetID(),
                                        "CODE" => CUtil::translit($CreateElementIblock["NAME"], "ru" , $params),
                                        'IBLOCK_SECTION_ID' => false,
                                        'IBLOCK_ID' => IBLOCK_CREATE_NEWS,
                                        "PROPERTY_VALUES" => array(
                                            "URL_DETAIL_IMG" =>$CreateElementIblock["DETAIL_PAGE_URL"], 
                                            "PRICE_NEWS" =>$ar_res["PRICE"], 
                                            "ID" => $CreateElementIblock["ID"]
                                        ),
                                        'NAME' => $CreateElementIblock["~NAME"],  
                                        'ACTIVE' => 'Y', 
                                        'PREVIEW_TEXT' => "Обновление цены товара",  
                                        'PREVIEW_PICTURE' => CFile::MakeFileArray($tmp_img["tmp_name"]), 
                                        'DETAIL_PICTURE' => CFile::MakeFileArray($tmp_img_detail["tmp_name"]),
                                        'DETAIL_TEXT' => 'У нас на сайте изменилась цена товара. ' .$CreateElementIblock["~NAME"]. ' теперь  стоит '.'{=this.Price}'.' руб. 
                                        Подробнее можно посмотреть в карточке товара: 
                                        <a href="'.$CreateElementIblock["DETAIL_PAGE_URL"].'">'.$CreateElementIblock["~NAME"].'</a>',
                                        ); 
 
                                    $img = CFile::MakeFileArray($CreateElementIblock['PREVIEW_PICTURE']);
                                    $PRODUCT_ID = $el->Add($arLoadProductArray);

                            } 
                          
                           unlink('/home/bitrix/ext_www/sweetgifts.ru/price1.txt');
                           
                        }
                
                    }        
            }

            
}
