<!-- Ryder再進化之用正規式 -->
<?php
preg_match('/.{0,80}/u', trim(strip_tags($row_RecProjects['d_content'])), $d_content);
echo implode($d_content);
echo "...";
?>

<!-- Ryder最新完整版 (濾html tag 濾&nbsp;+空白+全形空白)-->
<?php echo mb_substr(preg_replace("/(&#?[a-z0-9]+;)|(\s+)|(\x{00A0})/u","",strip_tags($row_Recwork['d_content'])) ,0,150,"utf-8"); ?>

<!-- filter html tag -->
<?php echo mb_substr(strip_tags($row_Recwork['d_content']) ,0,25,"utf-8"); ?>


<!-- 濾圖 -->
<?php echo mb_substr(preg_replace('~<img(.*?)>~s','',$row_Recwork['d_content']),0,150,"utf-8");?>