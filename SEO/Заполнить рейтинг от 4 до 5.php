<?
$arFilter = Array("IBLOCK_ID" => 12);
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>2000),$arSelect);
while($ob = $res->GetNextElement()) {
    $arItemT = $ob->GetFields();
    $arResultT[] = $arItemT;
};

foreach($arResultT as $list){
    $r = rand(40,50)/10;
    $r2 = rand(15,30); 
    $r3 = rand(10,40);
    $el = new CIBlockElement;
    $PROP = array();
    $PROP[112] = $r3; // кол-во проголосовавших
    $PROP[113] = $r2;   //сумма оценок   
    $PROP[114] = $r; //Рейтинг 
    
    $arLoadProductArray = Array(
      "MODIFIED_BY"=> $USER->GetID(), 
      "PROPERTY_VALUES"=> $PROP,
      );
    
    $res = $el->Update($list["ID"], $arLoadProductArray);
}
//echo count($arResultT);
//echo '<pre>' .print_r($arResultT,true). '</pre>';
