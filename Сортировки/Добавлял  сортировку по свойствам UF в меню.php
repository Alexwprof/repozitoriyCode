<ul class="furnitura-nav">

	<?
  $uniq_arr = array(); 
  $param = ""; 
  ?>

<?foreach ($arSubMenu["SUB_MENU"] as $arSubSub) :?>
      
  <? /*Условие сопоставления со свойством UF*/?>
  <?if ($arSubSub["PARAMS"]["UF_PROPERTIES_DVERI"] !== $param && !empty($arSubSub["PARAMS"]["UF_PROPERTIES_DVERI"]) ):?>
  
  <? /*Добавляем Li перед блоком со ссылками*/?>
    <li class="sub-menu" style="color: black; padding-bottom:15px;padding-top:15px;font-weight:600"> <?=$arSubSub["PARAMS"]["UF_PROPERTIES_DVERI"]?> </li>

  <?endif?>

 <? /*Присваиваем предыдщее значение переменной*/?>
				<?$param = $arSubSub["PARAMS"]["UF_PROPERTIES_DVERI"];?>

 <? /*Основные li*/?>
						 <li class="sub-menu" style="color: black">

						<a href="<?=$arSubSub["LINK"]?>">
						<?=$arSubSub["TEXT"]?> <?$arSubSub["PROPERTIES_DVERI"]?>
						
						<?$arSubSub["PARAMS"]["UF_PROPERTIES_DVERI"]?>

						 </a>

						 </li>				
		<?endforeach?>
					
	</ul>
