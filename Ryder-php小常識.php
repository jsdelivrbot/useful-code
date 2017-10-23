<!--===========================
=            星期幾轉換            =
============================-->
<?php
function get_chinese_weekday($datetime) {
    $weekday  = date('w', strtotime($datetime));
    $weeklist = array('SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT');
    return $weeklist[$weekday];
}
?>

<?= get_chinese_weekday($row_RecNews['d_date']) ?>

<!--================================================
=            header already send 的錯誤            =
=================================================-->

新增一個 .htaccess 開啟下面這個即可
php_flag output_buffering on

<!--============================================
=            判斷字元有沒有在字串中            =
=============================================-->

<?php if (strpos($row_Recmenu['d_data1'], '1') !== false): ?>checked<?php endif ?>

<!--=============================
=            自動補0            =
==============================-->

<!-- 1,2,3 變 01,02,03 -->
<?php str_pad($row_RecWorks['d_sort'], 2, "0", STR_PAD_LEFT) ?>

<!--============================
=            瀘空白            =
=============================-->

<?= preg_replace("/\s/","",trim($row_RecWorks['d_content'])) ?>