<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}

$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<?if($arResult["NavPageCount"] > 1):?>
	
	<?if ($arResult["NavPageNomer"]+1 <= $arResult["nEndPage"]):?>
		<?
		$plus = $arResult["NavPageNomer"]+1;
		$url = $arResult["sUrlPathParams"] . "PAGEN_".$arResult["NavNum"]."=".$plus;
		?>
	<div id="pag">
	<button class="btn btn-bordered btn-showMore load-more-items" style="margin:21px auto 20px;" data-url="<?=$url;?>">
                  <svg x="0px" y="0px" viewBox="0 0 21 18" xml:space="preserve">
                    <path class="st-blueDark" d="M20.2,7.3c0-0.1,0.1-0.1,0.1-0.2l0.8-4c0.1-0.6-0.3-1.1-0.8-1.2c-0.6-0.1-1.1,0.3-1.2,0.8l0,0l-0.4,2
      c-2.4-4.5-8-6.1-12.5-3.7C4.3,2.1,2.8,3.7,2,5.6c-0.2,0.5,0,1.1,0.6,1.3c0.5,0.2,1.1,0,1.3-0.5c0,0,0,0,0,0C5,3.7,7.7,1.9,10.6,2
      c2.6,0,5,1.4,6.2,3.6l-1.6-0.3c-0.6-0.1-1.1,0.3-1.2,0.8c-0.1,0.6,0.3,1.1,0.8,1.2L19.1,8h0.2c0.1,0,0.2,0,0.3-0.1
      c0,0,0.1,0,0.1-0.1c0.1,0,0.1-0.1,0.2-0.1L20,7.7c0.1,0,0.1-0.1,0.1-0.2C20.1,7.5,20.2,7.4,20.2,7.3z" />
                    <path class="st-green" d="M18.4,11c-0.5-0.2-1.1,0-1.3,0.5c0,0,0,0,0,0C16,14.3,13.3,16,10.4,16c-2.6,0-5-1.4-6.2-3.6l1.7,0.3H6
      c0.6,0,1-0.4,1.1-0.9c0-0.6-0.4-1-0.9-1.1L1.9,10c-0.1,0-0.2,0-0.3,0H1.5c-0.1,0-0.2,0.1-0.3,0.1c-0.1,0.1-0.1,0.1-0.2,0.2l-0.1,0.1
      c0,0.1-0.1,0.1-0.1,0.2c0,0.1-0.1,0.1-0.1,0.2l-0.8,4c-0.1,0.5,0.2,1.1,0.7,1.2c0,0,0,0,0.1,0H1c0.5,0,0.9-0.3,1-0.8l0.4-2
      c2.4,4.5,8,6.1,12.5,3.7c1.8-1,3.3-2.6,4.1-4.5C19.1,11.8,18.9,11.2,18.4,11z" />
                  </svg>
                  <span>Показать ещё </span>
                </button>

               
	</div>

	<?endif?>

<?endif?>


<div class="pagination__wrapper pagination__wrapper-mt">

<?if($arResult["bDescPageNumbering"] === true):?>
	<div class="pagination pagination-forTes">

	<?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<?if($arResult["bSavePage"]):?>
		
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_begin")?></a>&nbsp;|&nbsp;
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">&laquo;</a>&nbsp;|&nbsp;
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a>&nbsp;|&nbsp;
			<?if ($arResult["NavPageCount"] == ($arResult["NavPageNomer"]+1) ):?>
				<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">&laquo;</a>&nbsp;|&nbsp;
			<?else:?>
				<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">&laquo;</a>&nbsp;|&nbsp;
			<?endif?>
		<?endif?>
	<?endif?>

	<?while($arResult["nStartPage"] >= $arResult["nEndPage"]):?>
		<?$NavRecordGroupPrint = $arResult["NavPageCount"] - $arResult["nStartPage"] + 1;?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>
			<span class="nav-current-page">&nbsp;<?=$NavRecordGroupPrint?>&nbsp;</span>&nbsp;
		<?elseif($arResult["nStartPage"] == $arResult["NavPageCount"] && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$NavRecordGroupPrint?></a>&nbsp;
		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$NavRecordGroupPrint?></a>&nbsp;
		<?endif?>

		<?$arResult["nStartPage"]--?>
	<?endwhile?>

	<?if ($arResult["NavPageNomer"] > 1):?>
		
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&raquo;</a>&nbsp;|&nbsp;
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_end")?></a>&nbsp;
	<?endif?>

<?else:?>


	<div class="pagination pagination-forTes">

	<?if ($arResult["NavPageNomer"] > 1):?>

		<?if($arResult["bSavePage"]):?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=1"><?=GetMessage("nav_begin")?></a>&nbsp;|&nbsp;
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&laquo;</a>
			&nbsp;|&nbsp;
		<?else:?>
			<a class="pagination__arrow pagination__arrow-prev" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=GetMessage("nav_begin")?></a>
			<?if ($arResult["NavPageNomer"] > 2):?>
				<?/*<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>">&laquo;</a>*/?>
			<?else:?>
				<a style="font-size:20px;" class="pagination--non-active" href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>">...</a>
			<?endif?>
			
		<?endif?>
	<?endif?>
	<div class="pagination__pages">
	<?while($arResult["nStartPage"] <= $arResult["nEndPage"]):?>

		<?if ($arResult["nStartPage"] == $arResult["NavPageNomer"]):?>

			<a href="" class="pagination--active"><?=$arResult["nStartPage"]?></a>
		<?elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false):?>
			<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>"><?=$arResult["nStartPage"]?></a>&nbsp;

		<?else:?>
			<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>"><?=$arResult["nStartPage"]?></a>&nbsp;
		<?endif?>
		<?$arResult["nStartPage"]++?>
	<?endwhile?>
		</div>


	<?if($arResult["NavPageNomer"] < $arResult["NavPageCount"]):?>
		<a href="#" class="pagination--non-active" style="font-size:20px;"></a>
	<a class="pagination__arrow pagination__arrow-next" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>">
     Дальше
    </a>

	<?/*<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageCount"]?>"><?=GetMessage("nav_end")?></a>&nbsp;*/?>
	<?endif?>

<?endif?>


<?if ($arResult["bShowAll"]):?>
	<noindex>
	<?if ($arResult["NavShowAll"]):?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=0" rel="nofollow"><?=GetMessage("nav_paged")?></a>&nbsp;
	<?else:?>
		|&nbsp;<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>SHOWALL_<?=$arResult["NavNum"]?>=1" rel="nofollow"><?=GetMessage("nav_all")?></a>&nbsp;
	<?endif?>
	</noindex>
<?endif?>

	</div>

</div>