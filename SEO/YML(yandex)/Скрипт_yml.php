<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test1");
?>
<?if (!CModule::IncludeModule("iblock")) return;?>
<?
$iblock_id = 6;
$db_elements = CIBlockElement::GetList (Array(),Array("ACTIVE_Y","IBLOCK_ID" => $iblock_id),false,false,Array('ID', 'NAME', 'DETAIL_PAGE_URL','PREVIEW_PICTURE','DETAIL_PICTURE')
);
	while($ob = $db_elements->GetNextElement()) {
		$arItemT = $ob->GetFields();
		$arItemT["PROPERTIES"] = $ob->GetProperties();
		$arResultT[] = $arItemT;
	}
   
	//echo '<pre>' .print_r($arResultT,true). '</pre>';
?>

<?$arFilter = array(
    'ACTIVE' => 'Y',
    'IBLOCK_ID' => 6,
    'GLOBAL_ACTIVE' => 'Y',
);
 
$arSelect = array('IBLOCK_ID', 'ID', 'NAME', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID');
$arOrder = array('DEPTH_LEVEL' => 'ASC', 'SORT' => 'ASC');
$rsSections = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
$sectionLinc = array();
$arResult['ROOT'] = array();
$sectionLinc[0] = &$arResult['ROOT'];
while ($arSection = $rsSections->GetNext()) {
    
    $sectionLinc[(int) $arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']] = $arSection;
    $sectionLinc[$arSection['ID']] = &$sectionLinc[(int) $arSection['IBLOCK_SECTION_ID']]['CHILD'][$arSection['ID']];
}
unset($sectionLinc);
 
$arResult['ROOT'] = $arResult['ROOT']['CHILD'];
 
 ?>

<?php
$out = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
$out .= '<yml_catalog date="' . date('Y-m-d H:i') . '">' . "\r\n";
$out .= '<shop>' . "\r\n";
 
$out .= '<name>Двери в Курске</name>' . "\r\n";
$out .= '<company>Курская Дверная Компания</company>' . "\r\n";
$out .= '<url>https://dveri-v-kurske.ru/</url>' . "\r\n";
 
$out .= '<currencies>' . "\r\n";
$out .= '<currency id="RUR" rate="1"/>' . "\r\n";
$out .= '</currencies>' . "\r\n";
?>
  
<? 
$out .= '<categories>' . "\r\n";
foreach($arResult['ROOT'] as $listYmlElements){
	if($listYmlElements["DEPTH_LEVEL"] == 1){
		if(!$listYmlElements["CHILD"]){
		$out .= '<category id="' . $listYmlElements['ID'] . '" parentId="' . $listYmlElements['IBLOCK_SECTION_ID'] . '">'
		. $listYmlElements['NAME'] . '</category>' . "\r\n";
		}
		else{
			$out .= '<category id="' . $listYmlElements['ID'] .'">'. $listYmlElements['NAME'] . '</category>' . "\r\n";
		}
		
	}
	foreach($listYmlElements["CHILD"] as $listYmlElementsLevel2){
		if($listYmlElementsLevel2["DEPTH_LEVEL"] == 2){
			if(!$listYmlElementsLevel2["CHILD"]){
			$out .= '<category id="' . $listYmlElementsLevel2['ID'] . '" parentId="' . $listYmlElementsLevel2['IBLOCK_SECTION_ID'] . '">'
			. $listYmlElementsLevel2['NAME'] . '</category>' . "\r\n";
			}
			else{
				$out .= '<category id="' . $listYmlElementsLevel2['ID'] .'">'. $listYmlElementsLevel2['NAME'] . '</category>' . "\r\n";
			}
		}
		foreach($listYmlElementsLevel2["CHILD"] as $listYmlElementsLevel3){
			if($listYmlElementsLevel3["DEPTH_LEVEL"] == 3){
				if(!$listYmlElementsLevel3["CHILD"]){
				$out .= '<category id="' . $listYmlElementsLevel3['ID'] . '" parentId="' . $listYmlElementsLevel3['IBLOCK_SECTION_ID'] . '">'
				. $listYmlElementsLevel3['NAME'] . '</category>' . "\r\n";
				}
				else{
					$out .= '<category id="' . $listYmlElementsLevel3['ID'] . '">'. $listYmlElementsLevel3['NAME'] . '</category>' . "\r\n";
				}
			}

			foreach($listYmlElementsLevel3["CHILD"] as $listYmlElementsLevel4){
				if($listYmlElementsLevel4["DEPTH_LEVEL"] == 4){
					if(!$listYmlElementsLevel4["CHILD"]){
					$out .= '<category id="' . $listYmlElementsLevel4['ID'] . '" parentId="' . $listYmlElementsLevel4['IBLOCK_SECTION_ID'] . '">'
					. $listYmlElementsLevel4['NAME'] . '</category>' . "\r\n";
					}
					else{
					$out .= '<category id="' . $listYmlElementsLevel4['ID'] . '">'. $listYmlElementsLevel4['NAME'] . '</category>' . "\r\n";
					}
				}

			}
							
				}

		}
			
	}
	$out .= '</categories>' . "\r\n";
// Вывод товаров:

$out .= '<offers>' . "\r\n";
foreach ($arResultT as $row) {
	if(empty($row['PROPERTIES']["PRICE"]["VALUE"])) continue;

	$out .= '<offer id="' . $row['ID'] . '">' . "\r\n";
 
	$out .= '<url>https://dveri-v-kurske.ru' . $row["DETAIL_PAGE_URL"] . '</url>' . "\r\n";
	
	$cut_str = preg_replace('/[^0-9]/', '', $row['PROPERTIES']["PRICE"]["VALUE"]);

	$out .= '<price>' . $cut_str . '</price>' . "\r\n";

	$out .= '<currencyId>RUR</currencyId>' . "\r\n";

	$out .= '<categoryId>' . $row['IBLOCK_SECTION_ID'] . '</categoryId>' . "\r\n";

	$out .= '<picture>https://dveri-v-kurske.ru' . CFile::GetPath($row["DETAIL_PICTURE"]) .'</picture>' . "\r\n";

	$out .= '<name>'.$row['NAME'].'</name>' . "\r\n";
	
	$dfsgdf = strip_tags($row['PROPERTIES']["OPISANIE"]["~VALUE"]["TEXT"]);
	if(!empty($dfsgdf)){
	$out .= '<description><![CDATA[' . stripslashes($dfsgdf) . ']]></description>' . "\r\n"; 
	}
	else{
		$out .= '<description></description>' . "\r\n"; 
	}
	$out .= '</offer>' . "\r\n";
}
 
$out .= '</offers>' . "\r\n";
$out .= '</shop>' . "\r\n";
$out .= '</yml_catalog>' . "\r\n";
 
//echo $out;

$file = 'ya.xml';
$file_handle = fopen($file, "w");
fwrite($file_handle, $out); 
fclose($file_handle);
exit;
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
