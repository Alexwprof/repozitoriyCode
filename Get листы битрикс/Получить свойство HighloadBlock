<?php

use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
const MY_HL_BLOCK_ID = 1;
CModule::IncludeModule('highloadblock');
function GetEntityDataClass($HlBlockId) 
{
    if (empty($HlBlockId) || $HlBlockId < 1)
    {
        return false;
    }
    $hlblock = HLBT::getById($HlBlockId)->fetch();
    $entity = HLBT::compileEntity($hlblock);
    $entity_data_class = $entity->getDataClass();
    return $entity_data_class;
}
?>

<?php
const MY_HL_BLOCK_ID = 1;
CModule::IncludeModule('highloadblock');
$entity_data_class = GetEntityDataClass(MY_HL_BLOCK_ID);
$rsData = $entity_data_class::getList(array(
   'select' => array('*')
));
while($el = $rsData->fetch()){
    $arResult["SECTIONS"]["HBL"][] = $el;
}
?>
