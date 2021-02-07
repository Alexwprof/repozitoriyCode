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
<style>
.myclass{padding-top:62px !important}
.pathners__item{display:none;}
.pathners__item.active{display:block;}

</style>

<section class="section section-blue section-guarantee">
  <div class="container">
    <div class="title-h2">Нам доверяют</div>
    <div class="tabs-panel__wrapper">
      <div class="tabs-panel__helper">Длинный заголовок вкладки</div>
      <div class="tabs-panel__arrow"></div>

      <div class="tabs-panel">
	  <div data-id="all" class="tabs-panel__item_select tabs_click ajax_list">Все</div>
    <?/*вкладки*/?>
	  <?foreach($arResult["ITEMS"]["FIELD"] as  $asListSlideTitle):?>
        <div data-id="<?=$asListSlideTitle["VALUE"]?>" class="tabs-panel__item tabs_click ajax_list"><?=$asListSlideTitle["VALUE"]?></div>
	  <?endforeach?>
      </div>
    </div>
    <div class="pathners-wrapper scroll-pagination__controls" for="pathners_scroll">
      <div class="sliderArrow sliderArrow-prev slick-arrow scroll-pagination__controls-prev">
        <div class="fas fa-chevron-left"></div>
      </div>
      <div class="pathners scroll-pagination" id="pathners_scroll">
      <?/*айтемы в слайдере*/?>
	  <?foreach($arResult["ITEMS"]["LIST_S"] as $asListSlide):?>
        <div data-id="<?=$asListSlide["PROPERTIES"]["CATEGORY"]["~VALUE"]?>" class="pathners__item scroll-pagination__item active">
		
		<img src="<?echo CFile::GetPath($asListSlide["PREVIEW_PICTURE"])?>"/>

		</div>
	    <?endforeach?>
      </div>
      <div class="sliderArrow sliderArrow-next slick-arrow scroll-pagination__controls-next">
        <div class="fas fa-chevron-right"></div>
      </div>
    </div>
  </div>
</section>


<script>
$(".tabs_click").on("click",function(){

  $(this).parents(".tabs-panel").find(".tabs_click").removeClass("tabs-panel__item_select").addClass("tabs-panel__item");
  $(this).addClass("tabs-panel__item_select").removeClass("tabs-panel__item");

  let this_id = $(this).attr('data-id');
    if(this_id == "all") {
      $('.pathners__item').addClass('active');
    }
   else{
      $('.pathners__item').removeClass('active');
      $('.pathners__item').each(function()
   {
  if($(this).attr('data-id') == this_id){

      $(this).addClass('active');	
  }

  })
     }


})
</script>
