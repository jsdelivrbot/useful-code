<!--==============================
=            兩天相差            =
===============================-->
<?php
$today = date("Y-m-d H:i:s");

function daysBetween($start, $end) {
    $date = floor((strtotime($end) - strtotime($start)) / 86400);
    return "相差天數：" . $date . "天<br/><br/>";

    // $hour = floor((strtotime($enddate) - strtotime($startdate)) % 86400 / 3600);
    // return "相差小時數：" . $hour . "小時<br/><br/>";

    // $minute = floor((strtotime($enddate) - strtotime($startdate)) % 86400 / 60);
    // return "相差分鐘數：" . $minute . "分鐘<br/><br/>";

    // $second = floor((strtotime($enddate) - strtotime($startdate)) % 86400 % 60);
    // return "相差秒數：" . $second . "秒";
}
?>

<!--================================
=            星期幾轉換            =
=================================-->
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