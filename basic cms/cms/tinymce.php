<script type="text/javascript" src="tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript">
//var $ = jQuery.noConflict();
$().ready(function() {
    $('textarea.tiny').tinymce({
        // Location of TinyMCE script
        script_url: 'tinymce/js/tinymce/tinymce.min.js',
        language: "zh_TW", // change language here
        menubar: false,
        relative_urls: false,
        remove_script_host: false,
        convert_urls: true,
        content_css : "css/tinymceContent.css",

        plugins: [
            "advlist autolink link lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime nonbreaking",
            "table contextmenu directionality emoticons textcolor",
            "insertdatetime nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern code responsivefilemanager imagetools image media"
        ],

        toolbar1: "styleselect fontselect fontsizeselect",
        toolbar2: "removeformat bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify| link unlink",
        toolbar3: "undo redo | cut copy paste | print fullscreen | preview code | image responsivefilemanager",

        //base_url: "http://localhost/",
        //指向網址後需改成 external_filemanager_path:"/filemanager/",
        external_filemanager_path: "/lionsport/filemanager/",
        filemanager_title: "Filemanager",
        //指向網址後需改成 external_plugins: { "filemanager" : "/filemanager/plugin.min.js"},
        external_plugins: {
            "filemanager": "/lionsport/filemanager/plugin.min.js"
        },

        style_formats: [{
            title: '售票資訊粗體',
            inline: 'strong',
            classes: 'tiny-ticket-strong',
            styles: {
                color: '#d8a10f'
            }
        },{
            title: '賽事票價',
            block: 'span',
            styles: {
                color: '#fff',
                'background-color': '#950f23',
                'border-radius': '10px',
                padding: '1px 33px'
            }
        }]
    });
});
</script>
<!-- /TinyMCE -->
