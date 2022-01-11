<?
function AgentALX()
{
	require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

	$url = 'http://www.cbr.ru/scripts/XML_daily.asp';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	$xmlData = curl_exec($ch);
	$err = curl_error($ch);
	curl_close($ch);
	file_put_contents($_SERVER["DOCUMENT_ROOT"].'/curl', $xmlData);

	$xml = simplexml_load_string($xmlData);
	foreach ($xml AS $el){
	    $valutes[strval($el->CharCode)] = strval($el->Value);
	}
	global $DB;

	$DB->PrepareFields("startshop_currency");
	if (!empty($valutes[USD]))
	{
		
		 $usd = str_replace (',', '.', $valutes[USD]);
		 $CODE = "USD";
		 $arFields = array("RATE" => $usd);
		 //$DB->StartTransaction();
		 $DB->Update("startshop_currency", $arFields, "WHERE CODE='".$CODE."'", $err_mess.__LINE__);
	}

	if (!empty($valutes[EUR]))
	{
		$eur = str_replace (',', '.', $valutes[EUR]);
		$CODE = "EUR";
		$arFields = array("RATE" => $eur);
		//$DB->StartTransaction();
		$DB->Update("startshop_currency", $arFields, "WHERE CODE='".$CODE."'", $err_mess.__LINE__);
	}
	return "AgentALX();";
}
?>
