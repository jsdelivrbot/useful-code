<!--=========================================================
=            內層編輯器抓到source (改tinymce.php)           =
==========================================================-->
<script>
	//指向網址後需改成 external_filemanager_path:"/filemanager/",
	external_filemanager_path: "/keller/filemanager/",
	filemanager_title: "Filemanager",
	//指向網址後需改成 external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
	external_plugins: {
	    "filemanager": "/keller/filemanager/plugin.min.js"
	},
</script>

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