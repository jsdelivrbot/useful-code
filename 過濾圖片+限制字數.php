<!-- 這個最簡單好用 -->
<?= mb_substr(preg_replace("/(\s|\&nbsp\;|　|\xc2\xa0)/", "", strip_tags($row_RecProjects['d_content'])), 0, 90, "utf-8"); ?>

<!-- Ryder再進化之用正規式 -->
<?php
preg_match('/.{0,80}/u', trim(strip_tags($row_RecProjects['d_content'])), $d_content);
echo implode($d_content);
echo "...";
?>

<!-- 濾圖 + tag -->
<?= strip_tags(preg_replace('~<img(.*?)>~s','',$row_RecNews['d_content'])) ?>

<!-- filter html tag -->
<?php echo mb_substr(strip_tags($row_Recwork['d_content']), 0, 25, "utf-8"); ?>

<!-- 濾圖 -->
<?php echo mb_substr(preg_replace('~<img(.*?)>~s', '', $row_Recwork['d_content']), 0, 150, "utf-8");?>

<!-- 瀘空白 -->
<?= preg_replace("/\s/", "", trim($row_RecWorks['d_content'])) ?>