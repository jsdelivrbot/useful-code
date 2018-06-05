<!--=============================
=            分類操作            =
==============================-->
<?php
// cat id
$cat = get_cat_name( 2 );
echo '<pre>'; print_r($cat); echo '</pre>';

// post id
$terms = get_the_category(get_the_id());
echo '<pre>'; print_r($terms); echo '</pre>';
?>

<!--=============================
=            自製內頁            =
==============================-->
名字改成 single-{post_type}.php

<?php
$pods = pods( 'projects', get_the_id() );
$title = $pods->field('project_title');
$title_en = $pods->field('project_title_en');
$cover = $pods->field('project_cover');
$row = $pods->row();
?>


<!--=================================
=            自製pods首頁            =
==================================-->
用套件Post Types Order排序

<?php
$param = [
	"orderby" => "menu_order ASC"
];

$pods = pods( 'projects', $param );

while ($pods->fetch()) {
	$title = $pods->field('project_title');
	$title_en = $pods->field('project_title_en');
	$cover = $pods->field('project_cover');

	$row = $pods->row();
	echo '<pre>'; print_r($row); echo '</pre>';
}

?>

<!--========================================
=            新增文章分類 (待研究)           =
=========================================-->
pods framework
advance custom filed


<!--=============================
=            自製模版            =
==============================-->
https://www.zhihu.com/question/20129430

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


<!--=================================
=            轉址到子目錄            =
==================================-->
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