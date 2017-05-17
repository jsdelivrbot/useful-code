<!--=================================
=            tiny plugin            =
==================================-->
plugins: [
    "advlist autolink link image lists charmap print preview hr anchor pagebreak",
    "searchreplace wordcount visualblocks visualchars insertdatetime nonbreaking",
    "table contextmenu directionality emoticons textcolor responsivefilemanager image media",    <!-- 新增 responsivefilemanager image media -->
    "insertdatetime nonbreaking save table contextmenu directionality",
    "emoticons template paste textcolor colorpicker textpattern code"
],
ps.可加在toolbar讓使用者點喔

<!--========================================
=            tiny編輯器沒有觸發            =
=========================================-->
文件名不能有兩條底線 ex: news_1_add.php
因為script.php有寫一些條件

<!--==========================================
=            增加可上傳的圖片尺寸            =
===========================================-->
<!-- 新增一個.htaccess在cms folder -->
php_value upload_max_filesize 5M

<!--=========================================
=            內層編輯器抓到source           =
===========================================-->
<!-- 改tinymce.php -->
<script>
	//指向網址後需改成 external_filemanager_path:"/filemanager/",
	external_filemanager_path: "/keller/filemanager/",
	filemanager_title: "Filemanager",
	//指向網址後需改成 external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
	external_plugins: {
	    "filemanager": "/keller/filemanager/plugin.min.js"
	},
</script>

<!-- 改filemanager/config/config.php -->
<script>
    $upload_dir = '/keller/source/'; // path from base_url to base of upload folder (with start and final /)
    $current_path = '../source/'; // relative path from filemanager folder to upload folder (with final /)
    //thumbs folder can't put inside upload folder
    $thumbs_base_path = '../thumbs/'; // relative path from filemanager folder to thumbs folder (with final /)
</script>

<!--========================================
=            編輯器x scroll bar            =
=========================================-->
<!-- 在tinymce.php設定裡面新增 -->
nowrap : true,

<!--====================================================
=            解決編輯器表情符號前台顯示失敗            =
=====================================================-->
<!-- 在tinymce.php設定裡面新增 -->
relative_urls : false,
remove_script_host : false,
convert_urls : true,

<!--================================================
=            解決connect2data.php 連接資料庫時的The mysql extension is deprecated and will be removed in the future: use mysqli or PDO instead in            =
=================================================-->
<?php
error_reporting(E_ALL ^ E_DEPRECATED);
 ?>

<!--=============================================
=            list頁 網頁是否顯示失敗            =
==============================================-->
<!-- html後面引入即可 -->
<script src="jquery/changActive.js"></script>