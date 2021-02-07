#убираем лишние слеши#
RewriteEngine On

RewriteCond %{THE_REQUEST} // 
# Проверяем, повторяется ли слеш (//) более двух раз. 
RewriteRule .* /$0 [R=301,L] 
# Исключаем все лишние слеши.
