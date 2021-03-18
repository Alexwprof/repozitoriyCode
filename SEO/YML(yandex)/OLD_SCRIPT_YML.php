<?php
// Подключение к ДБ.
$dbh = new PDO('mysql:dbname=db_name;host=localhost', 'логин', 'пароль');
 
$out = '<?xml version="1.0" encoding="UTF-8"?>' . "\r\n";
$out .= '<yml_catalog date="' . date('Y-m-d H:i') . '">' . "\r\n";
$out .= '<shop>' . "\r\n";
 
// Короткое название магазина, должно содержать не более 20 символов.
$out .= '<name>Название магазина</name>' . "\r\n";
 
// Полное наименование компании, владеющей магазином.
$out .= '<company>ООО «Пупкин»</company>' . "\r\n";
 
// URL главной страницы магазина.
$out .= '<url>http://site.com/</url>' . "\r\n";
 
// Список курсов валют магазина.
$out .= '<currencies>' . "\r\n";
$out .= '<currency id="RUR" rate="1"/>' . "\r\n";
$out .= '</currencies>' . "\r\n";
 
// Список категорий магазина:
// id     - ID категории.
// parent - ID родительской категории.
// name   - Название категории.
$sth = $dbh->prepare("SELECT `id`, `parent`, `name` FROM `category`");
$sth->execute();
$category = $sth->fetchAll(PDO::FETCH_ASSOC);
 
$out .= '<categories>' . "\r\n";
foreach ($category as $row) {
	$out .= '<category id="' . $row['id'] . '" parentId="' . $row['parent'] . '">'
	. $row['name'] . '</category>' . "\r\n";
}
 
$out .= '</categories>' . "\r\n";
 
// Вывод товаров:
$sth = $dbh->prepare("SELECT * FROM `prods`");
$sth->execute();
$prods = $sth->fetchAll(PDO::FETCH_ASSOC);
 
$out .= '<offers>' . "\r\n";
foreach ($prods as $row) {
	$out .= '<offer id="' . $row['id'] . '">' . "\r\n";
 
	// URL страницы товара на сайте магазина.
	$out .= '<url>http://site.com/prod/' . $row['id'] . '.html</url>' . "\r\n";
 
	// Цена, предполагается что в БД хранится цена и цена со скидкой.
	if (!empty($row['price_sale'])) {
		$out .= '<price>' . $row['price_sale'] . '</price>' . "\r\n";
		$out .= '<oldprice>' . $row['price'] . '</oldprice>' . "\r\n";
	} else {
		$out .= '<price>' . $row['price'] . '</price>' . "\r\n";
	}
 
	// Валюта товара.
	$out .= '<currencyId>RUR</currencyId>' . "\r\n";
 
	// ID категории.
	$out .= '<categoryId>' . $row['category'] . '</categoryId>' . "\r\n";
 
	// Изображения товара, до 10 ссылок.
	$out .= '<picture>http://site.com/img/1.jpg</picture>' . "\r\n";
	$out .= '<picture>http://site.com/img/2.jpg</picture>' . "\r\n";
 
	// Название товара.
	$out .= '<name>'.$row['name'].'</name>' . "\r\n";
 
	// Описание товара, максимум 3000 символов.
	$out .= '<description><![CDATA[' . stripslashes($row['text']) . ']]></description>' . "\r\n";    
	$out .= '</offer>' . "\r\n";
}
 
$out .= '</offers>' . "\r\n";
$out .= '</shop>' . "\r\n";
$out .= '</yml_catalog>' . "\r\n";
 
header('Content-Type: text/xml; charset=utf-8');
echo $out;
exit;
