<?
	require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
	function mb_ucfirst($text)
	{
	    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
	}
	$transParams = array("replace_space"=>"_","replace_other"=>"_");
    $path = $_SERVER["DOCUMENT_ROOT"] . '/upload/tags.csv';
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
     exit;
    $elements = [];
    foreach ($arRows as $key => $value) {
    	$currUrl = str_replace($_SERVER['HTTP_X_FORWARDED_PROTO'].'://'.$_SERVER['SERVER_NAME'], '', $value[1]);
    	$elements[$currUrl]['NAME'] = $value[1];
    	$search = '/search/?q=' . $value[0];
    	$elements[$currUrl]['LINKS'][] = array(
    		'ANCOR' => $value[0],
    		'HREF'  => (empty($value[2]) ? $search : $value[2])
    	);
    }
    //prr($elements);
    //exit;
    $c = 0;
    foreach ($elements as $key => $value)
    {
	    $arFilter = array(
	    	'IBLOCK_ID' => 22,
	    	'CODE' => $key
	    );
	    $res = CIBlockElement::GetList(array(), $arFilter, false, false, array());
	    if ($elem = $res->GetNextElement())
	    {
	    	$pr = $elem->getProperties();
	    	$PROPS = [];
	    	foreach ($value['LINKS'] as $k => $val)
	    	{
	    		$have = false;
			    $ancor = mb_ucfirst(trim($val['ANCOR']));
				$pp = "<a href='{$val['HREF']}'>{$ancor}</a>";
				// $ppR = "<a href='#'>{$ancor}</a>";
			    foreach ($pr['LINKS']['~VALUE'] as $key => $link)
			    {
			    	if ($pp == $link['TEXT'])
			    	{
			    		$have = true;
			    		break;
			    	}
			    }			
			    if (!$have)		    		
			    {
			    	$PROPS['LINKS'][] = $pp;
			    }
			    else
			    {
			    	// if ($link['TEXT'] != $ppR)
			    	$PROPS['LINKS'][] = $link['TEXT'];
			    }
	    	}
	    	if (!empty($PROPS))
	    	{
	    		echo 'UPDATED'.'<br>';
	    		CIBlockElement::SetPropertyValuesEx($elem->getFields()['ID'], false, $PROPS);
	    	}
	    	// $fields = $elem->getFields();
	    	// $props = $elem->getProperties();
	    	// prr($PROPS);
	    }
	    else
	    {
	    	//$bs = new CIBlockElement;
		    $arFields = array(
		    	'IBLOCK_ID' => 35,
		        'IBLOCK_SECTION_ID' => 0,
		        'NAME' => $value['NAME'],
		        'ACTIVE' => 'Y',
		        'CODE' => $key
		    );
		    $PROPS = [];

		    foreach ($value['LINKS'] as $k => $val) {
		    	$ancor = mb_ucfirst(trim($val['ANCOR']));
		    	// echo $ancor.'<br>';
		    	$PROPS['LINKS'][] = "<a href='{$val['HREF']}'>{$ancor}</a>";
		    }
		   // $ID = $bs->Add($arFields);
	    	echo 'NEW '.$ID;
	    	// prr($PROPS);
		   // CIBlockElement::SetPropertyValuesEx($ID, false, $PROPS);
	    }
	    echo '<br>';
	}



 //    $url = $_SERVER['HTTP_X_FORWARDED_PROTO'].'://'.$_SERVER['SERVER_NAME'];
 //    echo $url.'<br>';
 //    $c = 0;

	// $arF = array(
	// 	'IBLOCK_ID' => 2,
	// );
	// $elements = [];
	// $res = CIBlockElement::GetList(array(), $arF, false, false, array());
	// $count = 0;
	// while ($rr = $res->GetNextElement())
	// {
	// 	// if ($count > 2) continue;
	// 	$count++;
	// 	$elements[] = array(
	// 		'FIELDS' => $rr->getFields(),
	// 		'PROPERTIES' => $rr->getProperties(),
	// 		'NAV' => $url . $rr->getFields()['DETAIL_PAGE_URL']
	// 	);
	// }
	// $arF = array(
	// 	'IBLOCK_ID' => 2,
	// );
	// $sections = [];
	// $res = CIBlockSection::GetList(array("left_margin"=>"asc"), $arF, false, array('UF_*'));
	// $count = 0;
	// while ($rr = $res->Fetch())
	// {
	// 	$nav = CIBlockSection::GetNavChain(false, $rr['ID']);
	// 	$nn = '';
	// 	while ($n = $nav->Fetch())
	// 	{
	// 		$nn .= $n['CODE'] . '/';
	// 	}
	// 	// if ($count > 2) continue;
	// 	$rr['NAV'] = $url . substr(str_replace("#SECTION_CODE_PATH#", $nn, str_replace('#SITE_DIR#', '', $rr['SECTION_PAGE_URL'])), 0, -1);
	// 	$count++;
	// 	$sections[] = $rr;
	// }
	// foreach ($arRows as $key => $value)
 //    {
 //    	$find = false;
 //    	$currUrl = $value[1];
 //    	// echo 'search sections'.'<br>';
 //    	foreach ($sections as $val)
 //    	{
 //    		// echo $val['NAV'] . '<br>' . $currUrl.'<br>';
 //    		if ($val['NAV'] == $currUrl)
 //    		{
 //    			echo 'section ' . $val['NAME'] . '<br>';
 //    			// prr($value);
 //    			$find = true;
 //    			$c++;
 //    		}
 //    	}
 //    	if (!$find)
 //    	{
 //    		// echo 'search elements'.'<br>';
 //    		foreach ($elements as $val)
 //    		{
 //    			// echo $val['NAV'] . '<br>' . $currUrl.'<br>';
	//     		if ($val['NAV'] == $currUrl)
	//     		{
	//     			echo 'element ' . $val['FIELDS']['NAME'];
	//     			// prr($value);
	//     			$find = true;
	//     			$c++;
	//     		}
	//     	}
 //    	}
 //    	if (!$find)
 //    	{
 //    		echo 'NO: ' . $currUrl;
 //    	}
 //    	echo '<br>';
 //    }
 //    echo count($arRows).'?'.$c;
	// echo 'Sections:<br>';
	// prr($sections);
	// echo 'Elements:<br>';
	// prr($elements[0]);
?>
