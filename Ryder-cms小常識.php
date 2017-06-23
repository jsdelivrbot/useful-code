<!--==============================================
=            好用的config, 視情況設定            =
===============================================-->
resize: 'both',
nowrap : true,   <!-- x scroll bar -->

<!-- 解決編輯器表情符號前台顯示失敗 -->
relative_urls : false,
remove_script_host : false,
convert_urls : true,

<!--========================================
=            tinymce 自製plugin            =
=========================================-->
<script>
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime nonbreaking",
        "table contextmenu directionality emoticons textcolor responsivefilemanager image media",
        "insertdatetime nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern code customem"   //這個customem是自製的
    ],

    toolbar1: "styleselect formatselect fontselect fontsizeselect table customem",    //這個customem是自製的
    toolbar2: "bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify| bullist numlist outdent indent | link unlink | responsivefilemanager image media",
    toolbar3: "hr removeformat | charmap emoticons | ltr rtl  | visualchars visualblocks nonbreaking | undo redo | cut copy paste | print fullscreen | preview code",
</script>

<!-- D:\wamp64\www\stott\cms_admin\tinymce\js\tinymce\plugins\customem\plugin.min.js -->
<script>
    tinymce.PluginManager.add('customem', function(editor, url) {
        // Add a button that opens a window
        editor.addButton('customem', {
            text: 'Custom',
            icon: false,
            onclick: function() {
                // Open window
                editor.windowManager.open({
                    title: '請輸入',
                    body: [
                        {type: 'textbox', name: 'title', label: 'title'},
                        {type: 'textbox', name: 'content', label: 'content'}
                    ],
                    onsubmit: function(e) {
                        // Insert content when the window form is submitted
                        var _html = '';
                        _html += '<li class="row">';
                        _html += '<div class="columns small-4 material-title">';
                        _html += e.data.title;
                        _html += '</div>';
                        _html += '<div class="columns small-8 material-content">';
                        _html += e.data.content;
                        _html += '</div>';
                        _html += '</li>';
                        editor.insertContent(_html);
                    }
                });
            }
        });

        // Adds a menu item to the tools menu
        // editor.addMenuItem('customEmElementMenuItem', {
        //     text: 'Custom EM Element',
        //     context: 'tools',
        //     onclick: function() {
        //         editor.insertContent('<emstart>EM Start</emstart><p>Example text!</p><emend>EM End</emend>');
        //     }
        // });
    });
</script>

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
<!-- ps.以上 ↑ 可加在toolbar讓使用者點喔 -->

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

<!-- 改 filemanager/config/config.php -->
<script>
    $upload_dir = '/keller/source/'; // path from base_url to base of upload folder (with start and final /)
    $current_path = '../source/'; // relative path from filemanager folder to upload folder (with final /)
    //thumbs folder can't put inside upload folder
    $thumbs_base_path = '../thumbs/'; // relative path from filemanager folder to thumbs folder (with final /)
</script>

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