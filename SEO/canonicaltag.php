

<? /*бОЛЕЕ ПРОСТОЙ ВАРИАНТ НАТСРОЙКИ. ДОСТАТОЧНО РАЗМЕСТИТЬ В HEDFER START*/ ?>

  <?/*Canonical*/?>
	<? $prot = (CMain::IsHTTPS() ? "https://" : "http://");?>
	<link rel="canonical" href="<?= $prot . SITE_SERVER_NAME . $APPLICATION->GetCurPage(); ?>" />
	<?/*Canonical - END*/?>

<? /*бОЛЕЕ ПРОСТОЙ ВАРИАНТ НАТСРОЙКИ. ДОСТАТОЧНО РАЗМЕСТИТЬ В HEDFER END*/ ?>

<?$APPLICATION->ShowViewContent('meta_add');/*Показать на странице*/?> 

<?$page = $APPLICATION->GetCurPage(); ?>

<?$this->SetViewTarget('meta_add');?>

<? if($page == '/spetsialisty/'):?>
<?echo '<link rel="canonical" href="'.$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"].$page.'" />';?>
<? endif ?>

<? if($page !== '/spetsialisty/'):?>
<?echo '<link rel="canonical" href="'.$_SERVER["REQUEST_SCHEME"].'://'.$_SERVER["HTTP_HOST"].$arResult["SECTION"]["SECTION_PAGE_URL"].'" />';?>
<? endif ?>

<?$this->EndViewTarget();?>
