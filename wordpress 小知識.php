<!--=============================
=            get url            =
==============================-->
<a href="<?= get_home_url() ?>">INDEX</a>
<a href="<?= get_site_url(null, 'contact') ?>">CONTACT</a>

<!--=============================================
=            賞你一個乾淨的 wp_head()            =
==============================================-->
把這串加在 functions.php

<?php
//刪除wp_head()多餘的代碼
remove_action( 'wp_head', 'feed_links_extra', 3 ); //去除評論feed
remove_action( 'wp_head', 'feed_links', 2 ); //去除文章feed
remove_action( 'wp_head', 'rsd_link' ); //針對Blog的遠程離線編輯器接口
remove_action( 'wp_head', 'wlwmanifest_link' ); //Windows Live Writer接口
remove_action( 'wp_head', 'index_rel_link' ); //移除當前頁面的索引
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); //移除後面文章的url
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); //移除最開始文章的url
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );//自動生成的短鏈接
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); ///移除相鄰文章的url
remove_action( 'wp_head', 'wp_generator' ); // 移除版本號
remove_action( 'wp_head', 'wp_print_styles', 8 );
remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
//remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'print_emoji_detection_script',7 );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'wp_resource_hints', 2 );

//移除wordpress頂部工具欄css樣式media="screen"
function my_admin_bar_init() {
    remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'admin_bar_init', 'my_admin_bar_init' );

//移除頭部多餘.recentcomments樣式
function Fanly_remove_recentcomments_style() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'Fanly_remove_recentcomments_style' );
?>

<!--=================================
=            分類 or 標籤            =
==================================-->
<?php
// cat id
$cat = get_cat_name( 2 );
echo '<pre>'; print_r($cat); echo '</pre>';

// post id
$terms = get_the_category(get_the_id());
echo '<pre>'; print_r($terms); echo '</pre>';

// tags
$tags = get_the_tags(get_the_id());
?>

<!--=============================
=            自製內頁            =
==============================-->
名字改成 single-{post_type}.php

<?php
$pods = pods( 'projects', get_the_id() );

$title_en = $pods->field('project_title_en');
$title_en = $pods->display('project_title_en');
$title_en = get_post_meta(get_the_id(), 'project_title_en', true);

$row = $pods->row();

?>

<?php
$prev_id = $pods->prev_id(get_the_id());
$next_id = $pods->next_id(get_the_id());
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