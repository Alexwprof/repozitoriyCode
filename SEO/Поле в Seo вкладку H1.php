<?/*В хедере*/?>
<?$page = $APPLICATION->GetCurPage();?>
<? $seoH1 = explode('/',$page);?>
<?$APPLICATION->ShowViewContent('section_bnr_content');?>
    <?if($seoH1[1] == "catalog"):?>
    <?/* Вывод данных в H1 из файла каталога
    \bitrix\templates\aspro_optimus\components\bitrix\catalog\main\section.php*/
    /*так же добавил из элемента
    \bitrix\templates\aspro_optimus\components\bitrix\catalog\main\element.php*/?>
      <?$APPLICATION->ShowViewContent('meta_add_h1');?> 
    <?else:?>
      <h1 id="pagetitle"><?$APPLICATION->ShowTitle(false);?></h1>
    <?endif?>
    
    
    <?/*В каталоге:*/?>
    
    <?$db_list = CIBlockSection::GetList(Array("SORT"=>"ASC"),
    $arFilter = Array("IBLOCK_ID"=>14, "ID"=>$arSection["ID"]),
    true,$arSelect=Array("UF_SEO_POLE"));
if($ar_result = $db_list->GetNext()) {
    $ar_result["UF_SEO_POLE"];
}
?>
    
    /*Выводим из Seo поля текст в название раздела. если свойство пустое, вывод имени раздела*/	
/*Подставляем данные в h1 в header.php*/
if(!empty($ar_result["UF_SEO_POLE"])):?>
	<?$this->SetViewTarget('meta_add_h1');?>
	<h1 id="pagetitle"><?=$ar_result["UF_SEO_POLE"]?></h1>
	<?$this->EndViewTarget();?>
<?else:?>
	<?$this->SetViewTarget('meta_add_h1');?>
	<h1 id="pagetitle"><?=$arSection["NAME"]?></h1>
	<?$this->EndViewTarget();?>
<?endif?>
