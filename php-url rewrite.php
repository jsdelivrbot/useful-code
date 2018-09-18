https://blog.hinablue.me/apache-note-about-some-rewrite-note-2011-05/

RewriteEngine On
RewriteBase /

#如果文件存在，就直接訪問文件，不進行下面的RewriteRule.(不是文件或文件不存在就執行重寫)
RewriteCond %{REQUEST_FILENAME} !-f

#如果目錄存在就直接訪問目錄不進行RewriteRule
RewriteCond %{REQUEST_FILENAME} !-d

#如果是這些後綴的文件，就直接訪問文件，不進行Rewrite
RewriteCond %{REQUEST_URI} !^.*(.css|.js|.gif|.png|.jpg|.jpeg)$

RewriteRule (.*) $1.php


<!-- 去掉.php -->
RewriteEngine On
#RewriteBase /

RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.*)$ $1.php [NC,L]


<!-- 自訂404 -->
RewriteEngine On
#RewriteBase /

RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.*)$ $1.php [NC,L]

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule (.*) error404.php [L]

<!-- 這個也可以 -->
ErrorDocument 404 /search.php


<!-- 這個好用 (title(要去空白for好看 去斜線for路徑 去中文for我爽)-id) -->
<!-- <a href="<?= preg_replace('/[^\w]/', '', $row_RecWorks['d_title']) ?>-<?= $row_RecWorks['d_id'] ?>"> -->
RewriteEngine On
#RewriteBase /

RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.*)$ $1.php [NC,L]

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule (.*)(-([0-9]+))$ events_detail.php?id=$3 [L]


<!-- 硬寫也行 -->
RewriteEngine On
#RewriteBase /

RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_URI} !^.*(.css|.js|.gif|.png|.jpg|.jpeg)$
RewriteCond %{REQUEST_URI} !^newsDetail
RewriteCond %{REQUEST_URI} !^blogDetail
RewriteCond %{REQUEST_URI} !^rooms
RewriteRule (.*) $1.php

#news_detail
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_URI} !^.*(.css|.js|.gif|.png|.jpg|.jpeg)$
RewriteCond %{REQUEST_URI} !^blogDetail
RewriteCond %{REQUEST_URI} !^rooms
RewriteRule ^newsDetail_([0-9]+)_(.*)$ news_detail.php?d_id=$1

#blog_detail
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_URI} !^.*(.css|.js|.gif|.png|.jpg|.jpeg)$
RewriteCond %{REQUEST_URI} !^newsDetail
RewriteCond %{REQUEST_URI} !^rooms
RewriteRule ^blogDetail_([0-9]+)_(.*)$ blog_detail.php?d_id=$1

#rooms
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_URI} !^.*(.css|.js|.gif|.png|.jpg|.jpeg)$
RewriteCond %{REQUEST_URI} !^newsDetail
RewriteCond %{REQUEST_URI} !^blogDetail
RewriteRule ^rooms_([0-9]+)_(.*)$ rooms.php?d_id=$1