<script type="text/javascript" src="tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript">
//var $ = jQuery.noConflict();
	$().ready(function() {
        function initTinyMce(){
            var tinymce = $('textarea.tiny').tinymce({
                // Location of TinyMCE script
                script_url : 'tinymce/js/tinymce/tinymce.min.js',
                language : "zh_TW", // change language here
                theme: "modern",
                content_css : "css/tinymceContent.css",    // resolved to http://domain.mine/tinymceContent.css

                // General options
                //selector: "textarea",
               /* plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                        "wordcount visualblocks visualchars code fullscreen nonbreaking",
                        "table contextmenu directionality emoticons template textcolor paste textcolor"
                ],

                toolbar1: "undo redo | cut copy paste | styleselect formatselect fontselect fontsizeselect",
                toolbar2: "bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify| bullist numlistoutdent indent | table  | link unlink | image",
                toolbar3: "subscript superscript | hr removeformat | charmap emoticons | ltr rtl  | visualchars visualblocks nonbreaking | print fullscreen | preview code",*/
                
                plugins: [
                /*"advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste moxiemanager"*/
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                 "searchreplace wordcount visualblocks visualchars insertdatetime nonbreaking",
                 "table contextmenu directionality emoticons textcolor responsivefilemanager",
                "insertdatetime nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern code"
                ],
                /*toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                toolbar2: "print preview media | forecolor backcolor emoticons",*/
                toolbar1: "styleselect formatselect fontselect fontsizeselect table",
                    toolbar2: "bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify| bullist numlist outdent indent | link unlink | image",
                    toolbar3: "hr removeformat | charmap emoticons | ltr rtl  | visualchars visualblocks nonbreaking | undo redo | cut copy paste | print fullscreen | preview code",

                    menubar: false,
                    //toolbar_items_size: 'small',
                    image_advtab: true,
                    
                    //base_url: "http://localhost/",
                    //指向網址後需改成 external_filemanager_path:"/filemanager/",
                    external_filemanager_path:"<?php echo $filePath;?>/filemanager/",
               filemanager_title:"Filemanager" ,
                    //指向網址後需改成 external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
               external_plugins: { "filemanager" : "<?php echo $filePath;?>/filemanager/plugin.min.js"},

                    style_formats: [        
                            {title: '四季入學-內文標題', inline: 'span', classes: 'green'},
                            {title: '創校歷史-內文標題', block: 'div', classes: 'schoolhistory-title'},
                            {title: '創校歷史-內文清單', block: 'ul', classes: 'schoolhistory-list'},
                            {title: '外界肯定-內文標題', inline: 'span', classes: 'schoolaward-year'},
                            {title: '大事記-內文清單', block: 'ul', classes: 'schoolevent-article-list'},
                            {title: '四季教育學院-內文標題', inline: 'span', classes: 'sed-span'},
                            {title: '招生說明-內文綠色大標題', inline: 'span', classes: 'as-style-1'},
                            {title: '招生說明-內文小標題', inline: 'span', classes: 'as-style-2'},
                            {title: '招生說明-內文紅色註記', inline: 'span', classes: 'red'},
                            {title: '招生說明-內文方框清單', block: 'ul', classes: 'as-list'},
                            {title: '招生說明-內文方框清單標題', block: 'div', classes: 'title'},
                            {title: '招生說明-內文方框清單標題框線', inline: 'span', classes: 'titleBorder'},
                            {title: '招生說明-內文方框清單內文', block: 'div', classes: 'content'},
                            {title: '招生說明-內文圖片', block: 'div', classes: 's-img'}
                            /*,
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}*/
                    ]
            });
        }
		
        initTinyMce();
	});
</script>
<!-- /TinyMCE -->
