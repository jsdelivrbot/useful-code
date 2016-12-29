<!-- 轉json -->
<?php
$query_RecWorks = sprintf("SELECT * FROM ask
  ORDER BY ask_date DESC", $_SESSION['client_id']);
$RecWorks = mysql_query($query_RecWorks, $connect2data) or die(mysql_error());
// $row_RecWorks = mysql_fetch_assoc($RecWorks);
$totalRows_RecWorks = mysql_num_rows($RecWorks);

$emparray = array();
while($row = mysql_fetch_assoc($RecWorks)) {
    $emparray[] = $row;
}

echo json_encode($emparray, JSON_UNESCAPED_UNICODE);
?>

<!-- 依序列出資料 -->
<?php
while ($row = mysql_fetch_assoc($next)) {
    echo "<pre>";
    print_r($row);
}
?>

<!-- 另外存一個陣列 -->
<?php
$i = 0;
$d_id = array();
$file_link1 = array();
$file_link3 = array();
$d_date = array();
$d_title = array();
while ($row = mysql_fetch_array($RecProjects)) {
    // $d_id[i]=$row['d_id'];
    // echo $d_id[i];
    // echo "<BR>";
    array_push($d_id, $row['d_id']);
    array_push($file_link3, $row['file_link3']);
    array_push($file_link1, $row['file_link1']);
    array_push($d_date, $row['d_date']);
    array_push($d_title, $row['d_title']);
    $i = $i + 1;
}
?>

<!-- 取出第三筆的內容 -->
<?php echo mysql_result($result, 2); ?>

<!-- 取得最後一次的id 用mysql_insert_id() -->
<?php
$insertSQL_client = sprintf("INSERT INTO client (address_id, name, phone, address, client_created_date, client_date) VALUES (%s, %s, %s, %s, NOW(), NOW())",
      GetSQLValueString(mysql_insert_id(), "int"),
      GetSQLValueString($_POST['name'], "text"),
      GetSQLValueString($_POST['phone'], "text"),
      GetSQLValueString($_POST['address'], "text"));
?>

<!-- mysql_fetch_array   mysql_fetch_assoc   mysql_fetch_row 分別 -->
<?php
mysql_fetch_array();
從資料集取得的陣列，索引值可以是"數字"，也可以是"字串"，如下：;
$a = $row[0];
或;
$a = $row["a"];

mysql_fetch_assoc();
從資料集取得的陣列，索引值只能是"字串"，如下：;
$a = $row["a"];

mysql_fetch_row();
從資料集取得的陣列，索引值只能是"數字"，如下：;
$a = $row[0]
;?>


<!-- 取得下一筆資料 -->
<?php
$data = array();
for ($i = 0; $i < $totalRows_fornext; $i++) {
//依資料數做for
    $data[$i] = mysql_result($Recnext, $i);
    //把d_id存進新陣列
    if ($colname_nextD == $data[$i]) {
        //比對現在的d_id
        // echo $i;
        $newid = $i + 1;
        //+1取下一筆id       -1取上一筆   排序不需改變
    }
}
$next_id = $data[$newid];
//echo $next_id;

// 最後一筆就傳第一筆的id
if ($newid == $totalRows_Recget_next) {
    $next_id = $row_Recget_next['d_id'];
} else {
    $next_id = $data[$newid];
}
?>


<!-- 將指針指回第一筆 -->
<?php mysql_data_seek($RecWork, 0); ?>


<!-- foreach用法 -->
<?php
$cat=explode(",", $row_RecWork['d_tag']);

foreach ($cat as $value) {
    $query_Reccat =sprintf("SELECT * FROM terms
      WHERE term_id='".$value."'");
    $Reccat = mysql_query($query_Reccat, $connect2data) or die(mysql_error());
    $row_Reccat = mysql_fetch_assoc($Reccat);
}


$ryder_d_class3=explode(",",$row_Recwork['d_class3']);

while (list($key) = each($ryder_d_class3)) {
    $query_RecWriter_1 =sprintf("SELECT * FROM class_set
      WHERE c_id='".$ryder_d_class3[$key]."'");
    $RecWriter_1 = mysql_query($query_RecWriter_1, $connect2data) or die(mysql_error());
    $row_RecWriter_1 = mysql_fetch_assoc($RecWriter_1);
}
?>


<!-- like -->
<?php
$colname_Recclass = "";
if (isset($_GET['class'])) {
  $colname_Recclass = "d_class".$_GET['class']." like '%".$_GET['cat']."%' AND";
}
?>


<!-- left join (可用在不一定有圖片的時候)-->
<?php
$query_RecNews = sprintf("SELECT * FROM class_set, data_set LEFT JOIN file_set
  ON d_id=file_d_id
  WHERE d_class1='news' AND d_class2=c_id AND d_active='1'
  ORDER BY d_sort ASC");
$RecNews = mysql_query($query_RecNews, $connect2data) or die(mysql_error());
// $row_RecNews = mysql_fetch_assoc($RecNews);
$totalRows_RecNews = mysql_num_rows($RecNews);
?>


<?php
require_once 'Connections/connect2data.php';
// require_once('paginator.class.php');
// require_once('js/fun_changeStr.php');
mysql_select_db($database_connect2data, $connect2data);

$colname_Reccat = "";
if (isset($_GET['cat'])) {
    $colname_Reccat = "TR.term_taxonomy_id =" . $_GET['cat'] . " AND";
}

// sprintf帶字串參數用法(用%s)
$query_RecWorks = sprintf("SELECT * FROM data_set, file_set
  WHERE %s d_class1='works' AND d_id=file_d_id AND file_type='image' AND d_active='1'
  ORDER BY d_sort ASC", $colname_Reccat);

$ryder_cat = (isset($_GET['cat'])) ? $_GET['cat'] : 0;
$ryder_url = (isset($_GET['cat'])) ? "&cat=".$_GET['cat'] : '';

$colname_Recworks = "-1";
if (isset($_GET['d_id'])) {
    $colname_Recworks = $_GET['d_id'];
}

$query_RecWorks = sprintf("SELECT * FROM data_set
  WHERE d_id= '".$colname_Recworks."'
  ORDER BY d_sort ASC");
$RecWorks = mysql_query($query_RecWorks, $connect2data) or die(mysql_error());
$row_RecWorks = mysql_fetch_assoc($RecWorks);
$totalRows_RecWorks = mysql_num_rows($RecWorks);
?>