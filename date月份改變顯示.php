<!-- 數字變英文 JUL-->
<?php
require_once('js/fun_changeStr.php');
 ?>

<?php echo substr($row_Recwork['d_date'],0,4); ?>
<?php echo Month2SortEng(substr($row_Recwork['d_date'],5,2)); ?>
<?php echo substr($row_Recwork['d_date'],8,2); ?>

<!-- 一橫變斜線 2015/07/09 -->
<?php echo str_replace('-', '/', mb_substr($row_Recwork['d_date'],0,10,"UTF-8") ); ?>