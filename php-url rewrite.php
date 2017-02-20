<!-- 自訂404 -->
ErrorDocument 404 /error404.php


RewriteEngine On
RewriteBase /

#如果文件存在，就直接訪問文件，不進行下面的RewriteRule.(不是文件或文件不存在就執行重寫)
RewriteCond %{REQUEST_FILENAME} !-f

#如果目錄存在就直接訪問目錄不進行RewriteRule
RewriteCond %{REQUEST_FILENAME} !-d

#如果是這些後綴的文件，就直接訪問文件，不進行Rewrite
RewriteCond %{REQUEST_URI} !^.*(.css|.js|.gif|.png|.jpg|.jpeg)$

RewriteRule (.*) $1.php


<!-- lets do it -->
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