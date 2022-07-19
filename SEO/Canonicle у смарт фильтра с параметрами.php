<?if(strpos($_SERVER["REQUEST_URI"], "filter") !== false ){
 $str = preg_replace('/filter/', '|', $_SERVER["REQUEST_URI"]);
 $ex = explode('|', $str);
 $canonicalfilter = $_SERVER["HTTP_X_FORWARDED_PROTO"]."://". $_SERVER["SERVER_NAME"].$ex[0];
}
$prot = (CMain::IsHTTPS() ? "https://" : "http://");
$notfiltercanonical = $prot . SITE_SERVER_NAME . $APPLICATION->GetCurPage();
?>
<li nk rel="canonical" href="<?echo (!empty($canonicalfilter)) ? $canonicalfilter : $notfiltercanonical; ?>" />
