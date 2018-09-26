<!--===============================================================
=            php replace html tag (內頁用lazyload時可用)           =
================================================================-->
https://github.com/dneustadt/html-tag-replace

composer require dneustadt/html-tag-replace

<?php
$replacer = new \HtmlTagReplace\HtmlTagReplace($row['d_content']);

$newcontact = $replacer->replaceTag(
        'img',
        'img',
        false,
        ['src' => 'data-src'],
        'class="lazy"'
    )->compress()->getMarkup();
?>

<?= $newcontact ?>


<!-- if you need -->
<script>
    $(function () {
        $(".detail-content p img").each(function () {
            $(this).unwrap().wrap("<div class='lazywrap'>");
        })
    })
</script>


<!--================================
=            php object            =
=================================-->
https://blog.longwin.com.tw/2016/04/php-stdclass-object-json-2016/

<?php
while ($row_RecIndexVegas = mysql_fetch_assoc($RecIndexVegas)) {
    $r = new stdClass();
    $r->src = $row_RecIndexVegas['file_link1'];
    $response[] = $r;
}
?>


<!--==========================================
=            ajax objects回傳json            =
===========================================-->
<?php
require_once 'Connections/connect2data.php';
mysql_select_db($database_connect2data, $connect2data);

$query_RecShop = sprintf("SELECT * FROM store
    WHERE s_active='1'
    ORDER BY s_date DESC");
$RecShop = mysql_query($query_RecShop, $connect2data) or die(mysql_error());
// $row_RecShop = mysql_fetch_assoc($RecShop);
$totalRows_RecShop = mysql_num_rows($RecShop);

$query_RecCity = sprintf("SELECT * FROM city
    WHERE parent_id='0'
    ORDER BY ID ASC");
$RecCity = mysql_query($query_RecCity, $connect2data) or die(mysql_error());
// $row_RecCity = mysql_fetch_assoc($RecCity);
$totalRows_RecCity = mysql_num_rows($RecCity);

$query_RecArea = sprintf("SELECT * FROM city
    WHERE parent_id!='0'
    ORDER BY ID ASC");
$RecArea = mysql_query($query_RecArea, $connect2data) or die(mysql_error());
// $row_RecArea = mysql_fetch_assoc($RecArea);
$totalRows_RecArea = mysql_num_rows($RecArea);

$query_RecType = sprintf("SELECT * FROM store_type
    WHERE s_active='1'
    ORDER BY s_type_sort ASC");
$RecType = mysql_query($query_RecType, $connect2data) or die(mysql_error());
// $row_RecType = mysql_fetch_assoc($RecType);
$totalRows_RecType = mysql_num_rows($RecType);

$citys = array();
$areas = array();
$types = array();
$shops = array();

while($row_RecCity = mysql_fetch_assoc($RecCity)) {
    $citys[] = $row_RecCity;
}
while($row_RecArea = mysql_fetch_assoc($RecArea)) {
    $areas[] = $row_RecArea;
}
while($row_RecType = mysql_fetch_assoc($RecType)) {
    $types[] = $row_RecType;
}
while($row_RecShop = mysql_fetch_assoc($RecShop)) {
    $shops[] = $row_RecShop;
}

echo json_encode(array(
    'citys' => $citys,
    'areas' => $areas,
    'types' => $types,
    'shops' => $shops
));
?>


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


<!--==================================
=            mysql to pdo            =
===================================-->
mysql_select_db
mysql_query
mysql_fetch_assoc
mysql_num_rows
mysql_data_seek

-------------------------------------------------------
(?s)if \(!function_exists\("GetSQLValueString"\)\).+return.*\$theValue;\s+}\s+}
-------------------------------------------------------
mysql_select_db\(\$database_connect2data, \$connect2data\);
-------------------------------------------------------
(.+) = mysql_query\((.+), \$connect2data\) or die\(mysql_error\(\)\);

$1 = $conn->query($2);
-------------------------------------------------------
while.*\([$](.+) = mysql_fetch_assoc\([$](\w+)\)\);

while (\$$1 = \$$2->fetch());
-------------------------------------------------------
(.+) = mysql_fetch_assoc\((.+)\);

$1 = $2->fetch();
-------------------------------------------------------
(.+) = mysql_num_rows\((.+)\);

$1 = $2->rowCount();