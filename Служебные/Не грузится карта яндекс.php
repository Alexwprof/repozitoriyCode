<?/*Если не грузится карта яндекс, скорее всего был переход сайта на https.
Решаем проблему: Заходим в C:\Users\8523~1\AppData\Local\Temp\scp20833\home\webadmin\new.4dk-audit.ru\public\bitrix\components\bitrix\map.yandex.system\component.php

*/?>

В участке кода:
if (!defined('BX_YMAP_SCRIPT_LOADED'))
{
	//Тут убирем http, делаем такую строку:--->>> $scheme =  ("http");
 вместо этой ---->>> $scheme = (CMain::IsHTTPS() ? "https" : "http");

	if(strlen($arParams['API_KEY']) <= 0)
	{
		$host = 'api-maps.yandex.ru';
	}
	else
	{
		$host = 'enterprise.api-maps.yandex.ru';
	}

	$arResult['MAPS_SCRIPT_URL'] = $scheme.'://'.$host.'/'.$arParams['YANDEX_VERSION'].'/?load=package.full&mode=release&lang='.$arParams['LOCALE'].'&wizard=bitrix';

	if(strlen($arParams['API_KEY']) > 0)
	{
		$arResult['MAPS_SCRIPT_URL'] .= '&apikey='.$arParams['API_KEY'];
	}

	if ($arParams['DEV_MODE'] != 'Y')
	{
		?>
		<script>
			var script = document.createElement('script');
			script.src = '<?=$arResult['MAPS_SCRIPT_URL']?>';
			(document.head || document.documentElement).appendChild(script);
			script.onload = function () {
				this.parentNode.removeChild(script);
			};
		</script>
		<?
		define('BX_YMAP_SCRIPT_LOADED', 1);
	}
}
