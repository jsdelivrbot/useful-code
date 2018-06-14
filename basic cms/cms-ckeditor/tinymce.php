<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace( 'd_content', {
            filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=<?= md5('ryderawesome') ?>',
            filebrowserUploadUrl : '/upload.php',
            // filebrowserImageBrowseUrl : 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='
        } );
    });
</script>