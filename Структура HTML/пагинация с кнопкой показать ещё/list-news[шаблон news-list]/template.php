<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
      <section class="siteSection-innerPage">
        <div class="container">
          <div class="news news-page items-list">
		<?foreach($arResult["ITEMS"] as $key => $list_news):?>
      <?if($list_news["PROPERTIES"]["SHOW_ELEM"]["VALUE_XML_ID"] == "no_show") continue?>
			<?if($list_news["PROPERTIES"]["SHOW_ELEM"]["VALUE_XML_ID"] == "show"):?>
        
             <a class="news__item news__item-lg item-content" onclick='void(0)' href="<?=$list_news["DETAIL_PAGE_URL"];?>">
            
              <div class="news__item__image news__item__image-lg">
                <img src="<?=$list_news["PHOTO_BIG"][0];?>" alt="">
              </div>
              <div class="news__item__body">
                <div class="news__item__top">
                  <div class="heading <?=$list_news["PROPERTIES"]["AX_POLSA"]["VALUE_XML_ID"];?>"><?=$list_news["PROPERTIES"]["AX_POLSA"]["~VALUE"];?></div>
                  <div class="date"><?= CIBlockFormatProperties::DateFormat("j F Y", MakeTimeStamp($arItem["~TIMESTAMP_X"], CSite::GetDateFormat())); ?></div>
                </div>
                <div class="news__item__title">
				<?=$list_news["NAME"];?>
                </div>
                <div class="news__item__excerpt">
				<?=$list_news["PREVIEW_TEXT"];?>
                </div>
              </div>
            </a>
			<?else:?>
				<a class="news__item item-content" onclick='void(0)' href="<?=$list_news["DETAIL_PAGE_URL"];?>">
              <div class="news__item__top">
                <div class="heading <?=$list_news["PROPERTIES"]["AX_POLSA"]["VALUE_XML_ID"];?>"><?=$list_news["PROPERTIES"]["AX_POLSA"]["~VALUE"];?></div>
                <div class="date"><?= CIBlockFormatProperties::DateFormat("j F Y", MakeTimeStamp($arItem["~TIMESTAMP_X"], CSite::GetDateFormat())); ?></div>
              </div>
              <div class="news__item__image">
                <img src="<?=$list_news["PHOTO_SMALL"][0];?>" alt="">
              </div>
              <div class="news__item__title"><?=$list_news["NAME"];?></div>
            </a>
			<?endif?>

		 <?endforeach?>
      </div>
          
<!-- 
          <button class="btn btn-bordered btn-showMore load-more-items" data-url="">
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
            <span>Показать ещё</span>
          </button>
          <br>
          </div> -->
       <?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		  <?=$arResult["NAV_STRING"]?>
			<?endif;?>
      

      <?/*
          <div class="pagination__wrapper pagination__wrapper-mt">
            <div class="pagination pagination-forTest">

              <a class="pagination__arrow pagination__arrow-prev" href="#">
                В начало
              </a>
              <div class="pagination__pages">
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#" class="pagination--non-active">...</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#" class="pagination--active">6</a>
                <a href="#">7</a>
                <a href="#">8</a>
                <a href="#">9</a>
                <a href="#">10</a>
                <a href="#">11</a>
                <a href="#" class="pagination--non-active">...</a>
              </div>
              <a class="pagination__arrow pagination__arrow-next" href="#">
                Дальше
              </a>

            </div>
          </div>

        </div>
     */?>
      </section>
    <!-- <div id="pag">
    <?//$arResult["NAV_STRING"]?>
  </div> -->