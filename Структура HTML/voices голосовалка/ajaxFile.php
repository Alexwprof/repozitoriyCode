<?require_once($_SERVER['DOCUMENT_ROOT']. "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
?>
<?php
$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
$date = substr(str_shuffle($permitted_chars), 0, 10);

$bs = new CIBlockElement;
$arFields = array(
'IBLOCK_ID' => 19,
'IBLOCK_SECTION_ID' => 0,
'NAME' => $date,
'ACTIVE' => 'Y',
);

$ID = $bs->Add($arFields);

CIblockElement::SetPropertyValuesEx($ID, $arParams["IBLOCK_ID"], ["VOICES" => $_POST["listPAramMain"]]);
session_start();
/*в хедер добавляем проверку, если в сессии есть значение, добавляем куку */
$_SESSION["USER_VOICE_S"] = "Y";

?>
