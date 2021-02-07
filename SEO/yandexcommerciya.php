 <? if (isset($arResult["ORDER"])) { ?>
        <script>
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                "ecommerce": {
                    "purchase": {
                        "actionField": {
                            "id": "ORDERID#<?=$arResult["ORDER"]['ID']?>",
                        },
                        "products": [
                            <?foreach ($arResult['ELEMENTS'] as $arElement) { ?>
                            {
                                "id": "<?=$arElement['ID']?>",
                                "name": "<?=$arElement['NAME']?>",
                                "price": <?=$arElement['PROPERTY_PRICE_VALUE']?>,
                                "brand": "<?=$arElement['PROPERTY_BRAND_VALUE']?>",
                                "category": "<?=$arResult['SECTIONS'][$arElement['IBLOCK_SECTION_ID']]?>",
                                "quantity": "<?=$arResult["ORDER_Q"][$arElement['ID']]?>"
                                
                                
                            },
                            <? } ?>
                        ]
                    }
                }
            });
        </script>

<? /*Обычные цели ниже*/ ?>


	<form method="post" action="<?=POST_FORM_ACTION_URI ?>" class="rreserv__form rform"
	<?if($page == '/services/restoran-shayba/'):?>
		onsubmit="ym(53122579, 'reachGoal', 'zakaz_ok'); return true;";
	<?else:?>
		onsubmit="ym(53122579, 'reachGoal', 'zapis_ok'); return true;";
	<?endif?>
	
