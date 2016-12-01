RewriteEngine On
RewriteBase /
#如果文件存在，就直接訪問文件，不進行下面的RewriteRule.(不是文件或文件不存在就執行重寫)
RewriteCond %{REQUEST_FILENAME} !-f
#如果目錄存在就直接訪問目錄不進行RewriteRule
RewriteCond %{REQUEST_FILENAME} !-d
#如果是這些後綴的文件，就直接訪問文件，不進行Rewrite
RewriteCond %{REQUEST_URI} !^.*(.css|.js|.gif|.png|.jpg|.jpeg)$
RewriteRule (.*) $1.php