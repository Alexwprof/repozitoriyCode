<?
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
function mb_ucfirst($text)
{
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}
$transParams = array("replace_space"=>"_","replace_other"=>"_");
$path = $_SERVER["DOCUMENT_ROOT"] . '/perelink.csv';
require_once ($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/csv_data.php");
$csvFile = new CCSVData('R', false);
$csvFile->LoadFile($path);
$csvFile->SetDelimiter(',');
$arRows = array();
$Headers = array();

if (!CModule::IncludeModule('iblock'))
    die();
$count = 0;
while ($arRes = $csvFile->Fetch())
{
    if(empty($Headers))
    {
        foreach ($arRes as $key=>$value)
            $Headers[] = $value;
    }
    else
    {
        $arRow = array();
        foreach ($Headers as $key=>$value)
        {
            //$arRow[$value] = $arRes[$key];
            $arRow[] = $arRes[$key];
        }
        $arRows[] = $arRow;
        $count++;
    }
}

// prr($arRows);
//echo '<pre>' .print_r($arRows,true). '</pre>';
//exit;

foreach ($arRows as $key => $value) {

    $dfsgdfg = $_SERVER['HTTP_X_FORWARDED_PROTO'].'://'.$_SERVER['SERVER_NAME'];

    $currUrl = str_replace($dfsgdfg, '', $value[1]);

    $currUrlerer = str_replace('https://rr46.ru', '', $value[2] );

    $elements[$currUrl]['NAME'] = str_replace('https://rr46.ru', '', $value[1]);

    $search = '/search/?q=' . $value[0];

    $elements[$currUrl]['PERELINK'][] = "<a href='{$value[2]}'>{$value[0]}</a>";

//    $elements[$currUrl]['LINKS'][] = array(
//        'ANCOR' => $value[0],
//        'HREF'  => (empty($value[2]) ? $search : $currUrlerer)
//    );

}
//prr($elements);
//echo '<pre>' .print_r($elements,true). '</pre>';

/*Пример массива, который принимает метод CIBlockElement::SetPropertyValuesEx*/
/*$ewr4wef = array(

'PERELINK'=> array(
'1' => 'печать пластиковых карт',
'2' => 'заказать полиграфию',
'3' => 'сувенирная продукция с логотипом'
)

);*/

//echo '<pre>' .print_r($elements["AR"],true). '</pre>';


//foreach($elements as $wuieqrhfeiduyfisad){
//
//
//    $arSelect = Array("ID", "IBLOCK_ID",
//        "DATE_ACTIVE_FROM","NAME","DETAIL_PAGE_URL"
//    );
//
//    $arFilter = Array("IBLOCK_ID"=>22, "ACTIVE"=>"Y");
//
//    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
//
//    while($ob = $res->GetNextElement()) {
//        $arFields = $ob->GetFields();
//        $ACTIVE_ELEMENTS = $arFields;
//
//        if($wuieqrhfeiduyfisad["NAME"] == $ACTIVE_ELEMENTS["DETAIL_PAGE_URL"]){
//
//            echo '<pre>' .print_r($wuieqrhfeiduyfisad["NAME"],true). '</pre>';
//            echo '<pre>' .print_r($ACTIVE_ELEMENTS["ID"],true). '</pre>';
//            echo '<pre>' .print_r($ACTIVE_ELEMENTS["DETAIL_PAGE_URL"],true). '</pre>';
//            echo '<pre>' .print_r($wuieqrhfeiduyfisad["PERELINK"],true). '</pre>';
//
//
//            CIBlockElement::SetPropertyValuesEx($ACTIVE_ELEMENTS["ID"] ,false, array('PERELINK' => $wuieqrhfeiduyfisad['PERELINK']));
//
//        }
//
//    }
//
//}


$bs = new CIBlockSection;

foreach($elements as $wuieqrhfeiduyfisad){

     $db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"), $arFilter = Array("IBLOCK_ID"=>22), true,
        $arSelect=Array("NAME","SECTION_PAGE_URL", "UF_*"));

    if($ar_result = $db_list->GetNext()) {

		// echo '<pre>' .print_r($wuieqrhfeiduyfisad["NAME"],true). '</pre>';



                if($wuieqrhfeiduyfisad["NAME"] == $ar_result["SECTION_PAGE_URL"]){

					   echo '<pre>' .print_r($wuieqrhfeiduyfisad["NAME"],true). '</pre>';
					  echo '<pre>' . print_r($ar_result, true) . '</pre>';

//            echo '<pre>' .print_r($wuieqrhfeiduyfisad["NAME"],true). '</pre>';
//            echo '<pre>' .print_r($ACTIVE_ELEMENTS["ID"],true). '</pre>';
//            echo '<pre>' .print_r($ACTIVE_ELEMENTS["DETAIL_PAGE_URL"],true). '</pre>';
					//echo '<pre>' .print_r($wuieqrhfeiduyfisad["PERELINK"],true). '</pre>';




					$arFields = Array(
        			"IBLOCK_ID" => 22,
					"UF_PERELINKOVKA" => $wuieqrhfeiduyfisad["PERELINK"]

);

					//$bs->Update($ar_result["ID"], $arFields);



        }

    }













