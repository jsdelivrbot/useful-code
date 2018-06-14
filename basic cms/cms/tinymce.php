<script type="text/javascript" src="tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript">

$(function () {
    $('textarea.tiny').tinymce({
        script_url: 'tinymce/tinymce.min.js',
        // language: "zh_TW", // change language here
        relative_urls : false,
        menubar: false,
        content_css : "css/customContent.css",
        branding: false,
        skin: 'gray',

        paste_data_images: true,
        images_upload_url: 'upload.php',

        plugins: [
            "advlist autolink link lists charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars insertdatetime nonbreaking",
            "table contextmenu directionality emoticons textcolor",
            "insertdatetime nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern code responsivefilemanager imagetools image media"
        ],

        toolbar1: "fontselect fontsizeselect",
        toolbar2: "removeformat bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify| link unlink",
        toolbar3: "undo redo | cut copy paste | print fullscreen | preview code | image responsivefilemanager",

        // NOTE: 上線要改成 /filemanager/
        external_filemanager_path: "/aqua/filemanager/",
        filemanager_title: "Filemanager",
        // NOTE: 上線要改成 /filemanager/plugin.min.js
        external_plugins: {
            "filemanager": "/aqua/filemanager/plugin.min.js"
        },

        // http://archive.tinymce.com/wiki.php/Configuration3x:style_formats
        // style_formats: []
    });
});
</script>