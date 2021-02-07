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
use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;
?>
<?
if($_SESSION["USER_VOICE_S"] == "Y"){
    setcookie("USER_VOICE_USER", "Y", time()+3600000,"/","scmolodezhka.ru");
}
if($_COOKIE["USER_VOICE_USER"] == "Y"){
    $form = "form_show";
    $form2 = "form_check";
    $form3 = "form_progress";
    $form4 = "form_procent";
    $form5 = "form_hide_btn";
}
?>
<div class="block seo">
    <div class="golosovalka">
        <div id="wrap_vote" class="<?=$form?>">
            <div class="vote_title">   
	            <p class="title_class_vote">Из каких районов вы к нам приезжаете? </p>

	<form class="title_vote_form">
	   <div class="center_input">
       <?foreach($arResult["ITEMS"]["FIELD"] as $listCitySelect):?>
        <?         
        $i = 0;
        $element = GetIBlockElementList(19, false, Array(), false, Array("PROPERTY_VOICES" =>$listCitySelect["ID"]));
        while($arelement = $element->GetNext()) { $i++; }
        ?>
        <?$calc = $i/$arResult["ITEMS"]["CN"][0]*100?>
        <label class="w-input"> <input type="radio" data-id="<?=$listCitySelect["ID"] ?>" name="btn-b" class="list"> <span class="middle_button <?=$form2?>"></span><span class="pad-l"><?=$listCitySelect["VALUE"] ?><span class="procent <?=$form4?>">(<?  echo round($calc). "%" ?>)</span></span> </label>
        <progress class="progreess_bar_line <?= $form3 ?>" max="100" min="0" value="<?= round($calc) ?>">
        </progress>
       <?endforeach?>
        </div>
        <div class="hide_class">
        <input  class="btn_vote_class dsb hide_class <?=$form5?>" type="button" value="Проголосовать" disabled="disabled">		
       </div>		
	</form>
    </div>
</div>


<?//echo '<pre>' .print_r($_SESSION,true). '</pre>'?>




