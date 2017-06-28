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
                    external_filemanager_path:"<?php echo $nowFile; ?>/filemanager/",
               filemanager_title:"Filemanager" ,
                    //指向網址後需改成 external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
               external_plugins: { "filemanager" : "<?php echo $nowFile; ?>/filemanager/plugin.min.js"},

                    style_formats: [        
                            {title: '產品規格使用', block: 'p', classes: 'notep'},
                            {title: '產品備註使用', block: 'p', classes: 'notep2'}/*,
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}*/
                    ]
            });

            var tinymceNoP = $('textarea.tinyNoP').tinymce({
                // Location of TinyMCE script
                script_url : 'tinymce/js/tinymce/tinymce.min.js',
                language : "zh_TW", // change language here
                theme: "modern",
                content_css : "css/tinymceContent.css",    // resolved to http://domain.mine/tinymceContent.css

                force_br_newlines : true,
                force_p_newlines : false,
                forced_root_block : '', // Needed for 3.x
                  relative_urls : false,
                  remove_script_host : false,
                  convert_urls : true,

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
                    external_filemanager_path:"<?php echo $nowFile; ?>/filemanager/",
               filemanager_title:"Filemanager" ,
                    //指向網址後需改成 external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
               external_plugins: { "filemanager" : "<?php echo $nowFile; ?>/filemanager/plugin.min.js"},

                    style_formats: [        
                            {title: '產品規格使用', block: 'p', classes: 'notep'},
                            {title: '產品備註使用', block: 'p', classes: 'notep2'}/*,
                            {title: 'Bold text', inline: 'b'},
                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                            {title: 'Table styles'},
                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}*/
                    ]
            });

            var tinymceImg = $('textarea.tinyImg').tinymce({
                // Location of TinyMCE script
                script_url : 'tinymce/js/tinymce/tinymce.min.js',
                language : "zh_TW", // change language here
                theme: "modern",
                content_css : "css/tinymceContent.css",    // resolved to http://domain.mine/tinymceContent.css

                force_br_newlines : true,
                force_p_newlines : false,
                forced_root_block : '', // Needed for 3.x
                  relative_urls : false,
                  remove_script_host : false,
                  convert_urls : true,

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
                toolbar1: "image | preview code",
                /*toolbar1: "styleselect formatselect fontselect fontsizeselect table",
                    toolbar2: "bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify| bullist numlist outdent indent | link unlink | image",
                    toolbar3: "hr removeformat | charmap emoticons | ltr rtl  | visualchars visualblocks nonbreaking | undo redo | cut copy paste | print fullscreen | preview code",*/

                    menubar: false,
                    //toolbar_items_size: 'small',
                    image_advtab: true,
                    
                    //base_url: "http://localhost/",
                    //指向網址後需改成 external_filemanager_path:"/filemanager/",
                    external_filemanager_path:"<?php echo $nowFile; ?>/filemanager/",
               filemanager_title:"Filemanager" ,
                    //指向網址後需改成 external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
               external_plugins: { "filemanager" : "<?php echo $nowFile; ?>/filemanager/plugin.min.js"},

                    style_formats: [        
                            {title: '產品規格使用', block: 'p', classes: 'notep'},
                            {title: '產品備註使用', block: 'p', classes: 'notep2'}/*,
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
