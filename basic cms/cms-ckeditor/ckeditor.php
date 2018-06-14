<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
    $(function () {
        CKEDITOR.replace( $("textarea.tiny")[0], {
            filebrowserBrowseUrl : '../filemanager/dialog.php?type=2&editor=ckeditor&fldr=&akey=<?= md5('ryderawesome') ?>',
            filebrowserUploadUrl: 'upload.php?type=Files',
            filebrowserImageUploadUrl: 'upload.php?type=Images'
        } );
    });
</script>