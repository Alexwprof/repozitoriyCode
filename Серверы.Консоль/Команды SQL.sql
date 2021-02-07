SELECT price,title FROM pruducts; /* выводит столбец price и title из таблицы;*/
SELECT NOW() FROM DUAL; /* выводит время*/
SELECT * FROM pruducts WHERE id = 4; /* Выводит 4 строку столбца id*/
SELECT * FROM `pruducts` WHERE cat = 'Pc'; /*Выводит все строки со значением PC */
SELECT * FROM `pruducts` WHERE cat != 'Pc';  /*Выводит все строки с любым значением кроме PC */
SELECT * FROM `Shop` WHERE name LIKE '%tel%'; /*Выводит элементы столбца name, с совпадением букв tel*/
SELECT * FROM `Shop` WHERE id < 10 AND price > 600; /*Выводит два совпадения id<10 и price >600*/
SELECT * FROM `Shop` WHERE id < 10 OR price < 600; /*Выводит два совпадения id<10 и price <600*/
SELECT COUNT(*) FROM `Shop`; /*Отобразить общее количество записей в таблице*/
SELECT * FROM Shop ORDER BY id DESC /* Выводит из столбца id данные по убыванию*/
SELECT * FROM `Shop` LIMIT 5; /*Выводит первые 5 строк*/
SELECT * FROM `Shop` ORDER BY price DESC LIMIT 3 OFFSET 3; /*OFFSET позволяет начать вывод с 3 строки */
SELECT DISTINCT price FROM Shop; /*Выводит из столбца price уникальные значения*/ 
SELECT SUM(PRICE) FROM Shop WHERE categories = 'PC'; /*Сумма всех строк в price по столбцу categories со знчением Pc*/
SELECT AVG(price) FROM `Shop` WHERE id > 5; /* Среднее арифметическое столбца price где id > 5 */
SELECT * FROM Shop ORDER BY RAND() LIMIT 1; /* Случайная запись из таблицы*/



