#убираем лишние слеши#
RewriteEngine On

RewriteCond %{THE_REQUEST} // 
# Проверяем, повторяется ли слеш (//) более двух раз. 
RewriteRule .* /$0 [R=301,L] 
# Исключаем все лишние слеши.

# с http на https
RewriteEngine On 
RewriteCond %{ENV:HTTPS} !on 
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

# с www на без  www
RewriteEngine On
RewriteCond %{HTTP_HOST} ^www.solncevo.dr-vita.ru$ [NC]
RewriteRule ^(.*)$ http://solncevo.dr-vita.ru/$1 [R=301,L]

# Удаляет слэш на конце URL
RewriteEngine On
RewriteBase /
RewriteCond %{HTTP_HOST} (.*)
RewriteCond %{REQUEST_URI} /$ [NC]
RewriteRule ^(.*)(/)$ $1 [L,R=301]

# Добавляет слэш на конце URL
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_URI} !(.*)/$
RewriteRule ^(.*[^/])$ $1/ [L,R=301]

