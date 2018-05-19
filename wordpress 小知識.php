https://www.zhihu.com/question/20129430

<!-- 自製模版 -->
<?php
/*
名字改成 page-template-xx.php
Template Name: xx 模板
*/
?>

<!-- 連結要改 -->
<link href="<?php echo get_theme_file_uri( 'sample.css' ); ?>" rel="stylesheet" type="text/css" />
<script src="<?php echo get_theme_file_uri( 'sample.js' ); ?>" type="text/javascript"></script>
<img src="<?php echo get_theme_file_uri( 'sample.jpg' ); ?>" />

<!-- 轉址到子目錄 -->
wp 設定 一般 網站位址（URL）也要改
<IfModule mod_rewrite.c>
RewriteEngine on
RewriteCond %{HTTP_HOST} ^(www.)?ryderisgood.com$
RewriteCond %{REQUEST_URI} !^/offcial/
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /offcial/$1
RewriteCond %{HTTP_HOST} ^(www.)?ryderisgood.com$
RewriteRule ^(/)?$ offcial/index.php [L]
</IfModule>