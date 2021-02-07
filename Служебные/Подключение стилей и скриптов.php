  
use Bitrix\Main\Page\Asset;


<?
    /**
     * JS
     */
    CJSCore::Init();
    // $asset->addCss(SITE_TEMPLATE_PATH . '/fonts/fonts.css');
    // $asset->addCss(SITE_TEMPLATE_PATH . '/css/style.css');
    // $asset->addCss(SITE_TEMPLATE_PATH . '/css/slick.css');
    // $asset->addCss(SITE_TEMPLATE_PATH . '/css/slick-theme.css');
    // $asset->addCss(SITE_TEMPLATE_PATH . '/css/select2.min.css');
    // $asset->addCss(SITE_TEMPLATE_PATH . '/css/jquery.fancybox.min.css');
    // $asset->addCss(SITE_TEMPLATE_PATH . '/css/jquery.datetimepicker.min.css');

    // $asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.min.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/js/slick.min.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/js/select2.min.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.fancybox.min.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/js/edge.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.maskedinput.min.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/js/jquery.datetimepicker.full.min.js');
    // $asset->addJs(SITE_TEMPLATE_PATH . '/js/script.js');
    ?>


<?use Bitrix\Main\Page\Asset;?>

<?/*Для подключения css?*/>
Asset::getInstance()->addCss("/bitrix/css/main/bootstrap.min.css");

<?/*Для подключения скриптов*/?>
Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/myscripts.js");

<?/*Подключение мета тегов или сторонних файлов*/?>
Asset::getInstance()->addString("<link rel='shortcut icon' href='/local/images/favicon.ico' />");

<?/*Если нужно подключить стили и скрипты, в нутри шаблонов компонентов. Например, вы используете слайдер, 
на основе списка новостей: у него может быть много js и css и не целесообразно, подключать его кишочки, глобально ко всему сайту.
Просто поспользуйтесь такой конструкцией */?>
<?
$this->getTemplate()->addExternalCss("/local/addcss.css");
$this->getTemplate()->addExternalJs("/local/addcss.css");

?>
