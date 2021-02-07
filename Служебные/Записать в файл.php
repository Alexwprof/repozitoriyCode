<?
file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/log.txt', date('d.m.y H:i') . "\n" . print_r($arFields, 1), FILE_APPEND);
?>
