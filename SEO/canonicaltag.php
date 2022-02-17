

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


<?/*Можно и так перезаписать тег, но добавлять его в эпилог*/?>
<?
if(CModule::IncludeModule("iblock")) {
    $iterator = \CIBlockElement::GetList(
        [],
        [
            'ID' => $arResult["ID"],
        ],
        false,
        false,
        [
            'DETAIL_PAGE_URL',
        ]
    );
    if ($item = $iterator->GetNext()) {
        $item['DETAIL_PAGE_URL'];
    }
}
?>
<?$APPLICATION->AddHeadString('<link href="https://'.SITE_SERVER_NAME.$item['DETAIL_PAGE_URL'].'" rel="canonical" />',true);?>
