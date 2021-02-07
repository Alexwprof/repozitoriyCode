<?
$file = "test1.txt";
$jsonResult = json_decode(file_get_contents($file),TRUE);
//по полю sort
function cmpsort($msort, $bmsort)
{
    if (strcasecmp($msort[0]['SORT'], $bmsort[0]['SORT']) == 0) return 0;
    return strcasecmp($msort[0]['SORT'], $bmsort[0]['SORT']) > 0 ? 1 : -1;
}
//по полю id
function cmpsortid($msort, $bmsort)
{
    if (strcasecmp($msort['ID'], $bmsort['ID']) == 0) return 0;
    return strcasecmp($msort['ID'], $bmsort['ID']) > 0 ? 1 : -1;
}

usort($jsonResult, "cmpsort");
echo "Массив после сортировки по полю SORT";
foreach($jsonResult as $mass1result)
{
    echo "<pre>" .print_r($mass1result,true) ."</pre>";
    $jsonResultTwomass[] = $mass1result;
}

usort($jsonResultTwomass, "cmpsortid");
echo "Массив после второй сортировки по полю ID";
foreach($jsonResultTwomass as $mass1resultList2)
{
    echo "<pre>" .print_r($mass1resultList2,true) ."</pre>";
}

?>
