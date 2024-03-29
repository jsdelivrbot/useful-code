<!--==============================================
=            mysql 5.7 group by error            =
===============================================-->
https://stackoverflow.com/questions/23921117/disable-only-full-group-by

phpmyadmin(上方選單列)->variables->sql mode->only_full_group_by 移除


<!--==============================================================
=            編輯器 d_content source image src replace            =
===============================================================-->
<?php
require_once 'Connections/connect2data.php';

$sql = "SELECT d_content, d_id FROM data_set WHERE d_content LIKE :some";
$temp = 'web';
$argCat = [
    'some' => "%{$temp}%",
];
$sthWork = $conn->prepare($sql);
$sthWork->execute($argCat);

while ($row = $sthWork->fetch()) {

    $description = str_replace("/web/", "/", $row['d_content']);

    $updateSQL = "UPDATE data_set SET d_content=:d_content WHERE d_id=:d_id";

    $sth = $conn->prepare($updateSQL);
    $sth->bindParam(':d_content', $description, PDO::PARAM_STR);
    $sth->bindParam(':d_id', $row['d_id'], PDO::PARAM_INT);
    $sth->execute();
}
?>

<!--==============================================
=            ckeditor 自訂事件 (含範本)           =
===============================================-->
http://www.syscom.com.tw/ePaper_New_Content.aspx?id=631&EPID=240&TableName=sgEPArticle

<!--======================================
=            youtube影片碼說明            =
=======================================-->
<td bgcolor="#e5ecf6" class="table_col_title red_letter">
    <p>*請先自行將影片上傳youtube，再將影片碼輸入於左方文字欄位。<br>例如：影片網址為https://www.youtube.com/watch?v=SygkJv51Ixs，網址watch?v=後面則為影片碼( SygkJv51Ixs )。</p>
</td>

<!--=============================
=            簡易Tag            =
==============================-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.default.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/selectize.js"></script>

<?php
$query_RecnewsTags = "SELECT d_data1 FROM data_set WHERE d_class1 = 'news' AND d_active='1' ORDER BY d_sort ASC";
$RecnewsTags = $conn->query($query_RecnewsTags);
$row_RecnewsTags = $RecnewsTags->fetchAll(PDO::FETCH_NUM);
$totalRows_RecnewsTags = $RecnewsTags->rowCount();

$tagsAll = [];
foreach ($row_RecnewsTags as $value) {
    $tagsAll = array_merge_recursive($value, $tagsAll);
}
$tagsAll = implode(",", $tagsAll);
?>

<input name="d_data1" type="text" class="table_data" id="d_data1" data-tag="<?php echo $tagsAll; ?>" value="<?php echo $row_Recnews['d_data1']; ?>" size="80" />

<script>
    var tag = $('#d_data1').data("tag").split(",")
    var tagObj = []

    for(t of tag){
        var obj = {
            text: t, value: t
        }
        tagObj.push(obj)
    }

    var $data1 = $('#d_data1').selectize({
        delimiter: ',',
        persist: false,
        options: tagObj,
        create: function(input) {
            return {
                value: input,
                text: input
            }
        }
    });
</script>

<!--==================================
=            資料夾不見了            =
===================================-->
RFM filter按一下x看看

<!--================================
=            增加安全性            =
=================================-->
<!-- filemanager/config/config.php -->
<?php

define('USE_ACCESS_KEYS', true); // TRUE or FALSE

'access_keys' => array(md5('ryderawesome')),

// 只給你上傳圖片
'ext'=> array_merge(
    $config['ext_img']
    // $config['ext_file'],
    // $config['ext_misc'],
    // $config['ext_video'],
    // $config['ext_music']
),

?>

<!-- cms\tinymce.php -->
<script>
    $('textarea.tiny').tinymce({

        filemanager_access_key: '<?= md5('ryderawesome') ?>',
    })
</script>

<!--==============================================
=            好用的config, 視情況設定            =
===============================================-->
resize: 'both',
nowrap : true,   <!-- x scroll bar -->

<!-- 解決編輯器表情符號前台顯示失敗 -->
relative_urls : false,
remove_script_host : false,
convert_urls : true,

<!-- style_format -->
http://archive.tinymce.com/wiki.php/Configuration3x:style_formats

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
    function nl2br(str, is_xhtml) {
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }

    tinymce.PluginManager.add('customem', function(editor, url) {
        // Add a button that opens a window
        editor.addButton('customem', {
            text: '鍋物自訂',
            icon: false,
            onclick: function() {
                // Open window
                editor.windowManager.open({
                    title: '請輸入',
                    body: [{
                        type: 'textbox',
                        multiline: true,
                        minWidth: 300,
                        minHeight: 160,
                        name: 'title',
                        label: '大標'
                    }, {
                        type: 'textbox',
                        multiline: true,
                        minWidth: 300,
                        minHeight: 160,
                        name: 'content',
                        label: '內容'
                    }, {
                        type: 'container',
                        label: '額外資訊',
                        layout: 'grid',
                        columns: 2,
                        spacing: 10,
                        items: [{
                            type: 'label',
                            text: 'pic'
                        }, {
                            type: "filepicker",
                            filetype: "image",
                            name: 'additional_pic',
                            label: 'pic'
                        }, {
                            type: 'label',
                            text: 'title'
                        }, {
                            type: 'textbox',
                            name: 'additional_title',
                            label: 'title'
                        }, {
                            type: 'label',
                            text: 'content'
                        }, {
                            type: 'textbox',
                            name: 'additional_content',
                            label: 'content'
                        }]
                    }],
                    onsubmit: function(e) {
                        // Insert content when the window form is submitted

                        var _html = '';

                        _html += '<div class="title">';
                        _html += nl2br(e.data.title);
                        _html += '</div>';

                        _html += '<div class="content">';
                        _html += nl2br(e.data.content);
                        _html += '</div>';

                        if (e.data.additional_pic != '') {
                            _html += '<div class="additional">';
                            _html += '<div class="pic">';
                            _html += '<img src="' + e.data.additional_pic + '" width="108">';
                            _html += '</div>';
                            _html += '<div class="innerWrap">';
                            _html += '<div class="additional-title">';
                            _html += e.data.additional_title;
                            _html += '</div>';
                            _html += '<div class="additional-content">';
                            _html += e.data.additional_content;
                            _html += '</div>';
                            _html += '</div>';
                            _html += '</div>';
                        }

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
https://read01.com/N6KeoO.html#.Wc4J1FuCyUl

<?php
// 平常用這個
error_reporting(E_ALL ^ E_DEPRECATED);

// 尻大絕->只報告致命錯誤
error_reporting(E_ERROR);
?>

<!--=============================================
=            list頁 網頁是否顯示失敗            =
==============================================-->
<!-- html後面引入即可 -->
<script src="jquery/changActive.js"></script>

<!--===================================
=            list頁狀態切換            =
====================================-->
cms/jquery/changActive.js
改 a 的 calss 去觸發 ajax (active_process 啥小的)