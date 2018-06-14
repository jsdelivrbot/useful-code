<?php require_once('../Connections/connect2data.php'); ?>

<?php
$menu_is = "keywords";

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Reckeywords = 10;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
    $pageNum = $_GET['pageNum'];
}
$startRow_Reckeywords = $pageNum * $maxRows_Reckeywords;

$query_Reckeywords = "SELECT * FROM data_set WHERE d_class1 = '$menu_is' ORDER BY d_sort ASC, d_date DESC";
$query_limit_Reckeywords = sprintf("%s LIMIT %d, %d", $query_Reckeywords, $startRow_Reckeywords, $maxRows_Reckeywords);
$Reckeywords = $conn->query($query_limit_Reckeywords);
$row_Reckeywords = $Reckeywords->fetch();

if (isset($_GET['totalRows'])) {
    $totalRows = $_GET['totalRows'];
} else {
    $all_Reckeywords = $conn->query($query_Reckeywords);
    $totalRows = $all_Reckeywords->rowCount();
}
$totalPages = ceil($totalRows / $maxRows_Reckeywords) - 1;
$_SESSION['totalRows'] = $totalRows;
$TotalPage = $totalPages;

$queryString = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum") == false &&
            stristr($param, "totalRows") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString = sprintf("&totalRows=%d%s", $totalRows, $queryString);

// ====================================================================

$R_pageNum = 0;
if (isset($_REQUEST["pageNum"])) {
    $R_pageNum = $_REQUEST["pageNum"];
}
if (!isset($R_pageNum)) {
    $_SESSION["ToPage"] = 0;
}
//若指定分頁數小於1則預設顯示第一頁
else if ($R_pageNum < 0) {
    $_SESSION["ToPage"] = 0;
}
//若指定指定的分頁超過總分頁數則顯示最後一頁
else if ($R_pageNum > $totalPages) {
    $_SESSION["ToPage"] = $TotalPage;
} else {
    $_SESSION["ToPage"] = $R_pageNum;
}

//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
if ($R_pageNum > $totalPages && $R_pageNum != 0) {
    header("Location:keywords_list.php?pageNum=" . $totalPages);
}

//修改排序
$G_changeSort = 0;
$G_delchangeSort = 0;
if (isset($_GET['changeSort'])) {
    $G_changeSort = $_GET['changeSort'];
}
if (isset($_GET['delchangeSort'])) {
    $G_delchangeSort = $_GET['delchangeSort'];
}
if ($G_changeSort == 1 || $G_delchangeSort == 1) {

    $sort_num = 1;

    $query_Reckeywords = "SELECT * FROM data_set WHERE d_class1 = 'keywords' ORDER BY d_sort ASC, d_date DESC";
    $Reckeywords = $conn->query($query_Reckeywords);
    $row_Reckeywords = $Reckeywords->fetch();

    do {
        if ($row_Reckeywords['d_sort'] == 0) {} else if ($row_Reckeywords['d_id'] == $_GET['now_d_id']) {
            echo '<pre>'; print_r($sort_num); echo '</pre>';

        } else if ($sort_num == $_GET['change_num']) {
            echo '<pre>'; print_r($sort_num); echo '</pre>';
            $sort_num++;

            $updateSQL = "UPDATE data_set SET d_sort=:d_sort WHERE d_id=:d_id";

            $stat = $conn->prepare($updateSQL);
            $stat->bindParam(':d_sort', $sort_num, PDO::PARAM_INT);
            $stat->bindParam(':d_id', $row_Reckeywords['d_id'], PDO::PARAM_INT);
            $stat->execute();

            $sort_num++;
        } else {
            $updateSQL = "UPDATE data_set SET d_sort=:d_sort WHERE d_id=:d_id";

            $stat = $conn->prepare($updateSQL);
            $stat->bindParam(':d_sort', $sort_num, PDO::PARAM_INT);
            $stat->bindParam(':d_id', $row_Reckeywords['d_id'], PDO::PARAM_INT);
            $stat->execute();

            echo '<pre>'; print_r($sort_num); echo '</pre>';

            $sort_num++;
        }
    } while ($row_Reckeywords = $Reckeywords->fetch());

    $updateSQL = "UPDATE data_set SET d_sort=:d_sort WHERE d_id=:d_id";

    $stat = $conn->prepare($updateSQL);
    $stat->bindParam(':d_sort', $_GET['change_num'], PDO::PARAM_INT);
    $stat->bindParam(':d_id', $_GET['now_d_id'], PDO::PARAM_INT);
    $stat->execute();

    if ($G_changeSort == 1) {
        header("Location:keywords_list.php?pageNum=" . $_GET['pageNum'] . "&totalRows=" . $_GET['totalRows']);
    } else if ($G_delchangeSort == 1) {
        header("Location:keywords_list.php?pageNum=" . $_GET['pageNum']);
    }
}

require_once('display_page.php');

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php require_once('cmsTitle.php'); ?></title>
    <?php require_once('script.php'); ?>
    <?php require_once('head.php');?>
</head>
<body>
    <table width="1280" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <?php require_once('cmsHeader.php'); ?>
                <?php require_once('top.php'); ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left">
                            <!-- InstanceBeginEditable name="編輯區域" -->
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="30%" class="list_title">列表</td>
                                    <td><span class="no_data">
                                    <?php if ($totalRows == 0) { // Show if recordset empty ?>
                                    <strong>抱歉!找不到任何資料~</strong>
                                    <?php } // Show if recordset empty ?>
                                    </span></td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
                                <tr>
                                    <td width="739" align="right" class="page_display">
                                        <!-------顯示頁選擇與分頁設定開始---------->
                                        <?php displayPages($pageNum, $queryString, $totalPages, $totalRows, $currentPage); ?>
                                        <!-------顯示頁選擇與分頁設定結束---------->
                                        <td width="110" align="right" class="page_display">
                                            <?php if ($totalRows > 0) { // Show if recordset not empty ?> 頁數:
                                            <?php echo (($pageNum+1)."/".($totalPages+1)); ?>
                                            <?php } // Show if recordset not empty ?>
                                        </td>
                                        <td width="151" align="right" class="page_display">所有資料數: <?php echo $totalRows ?> </td>
                                        <td width="24" align="right">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="image/spacer.gif" width="1" height="1" /></td>
                                </tr>
                            </table>
                            <form action="keywords_process.php" method="post" name="form1" id="form1">
                                <?php if ($totalRows > 0) { // Show if recordset not empty ?>
                                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
                                    <tr>
                                        <td width="142" align="center" class="table_title">日期</td>
                                        <td width="74" align="center" class="table_title">排序</td>
                                        <td width="470" align="center" class="table_title">標題</td>
                                        <!-- <td width="140" align="center" class="table_title">圖片</td> -->
                                        <td width="60" align="center" class="table_title">在網頁顯示</td>
                                        <td width="30" align="center" class="table_title">編輯</td>
                                        <td width="30" align="center" class="table_title">刪除</td>
                                    </tr>
                                    <?php
                                    $i=0;
                                    do {
                                        $i++;
                                        $colname_RecImage = "-1";
                                        if (isset($row_Reckeywords['d_id'])) {
                                          $colname_RecImage = $row_Reckeywords['d_id'];
                                        }
                                        $query_RecImage = "SELECT * FROM file_set WHERE file_type='keywordsCover' AND file_d_id = :file_d_id";
                                        $RecImage = $conn->prepare($query_RecImage);
                                        $RecImage->bindParam(':file_d_id', $colname_RecImage, PDO::PARAM_STR);
                                        $RecImage->execute();
                                        $row_RecImage = $RecImage->fetch();
                                        $totalRows_RecImage = $RecImage->rowCount();
                                    ?>
                                    <tr <?php if ($i%2==0): ?>bgcolor='#E4E4E4'
                                        <?php endif ?>>
                                        <td align="center" class="table_data">
                                            <a href="keywords_edit.php?d_id=<?php echo $row_Reckeywords['d_id']; ?>">
                                                <?php echo $row_Reckeywords['d_date']; ?>
                                            </a>
                                        </td>
                                        <td align="center" class="table_data">
                                            <select name="d_sort" id="d_sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows; ?>','<?php echo $row_Reckeywords['d_id']; ?>',this.options[this.selectedIndex].value)">
                                                <option value="0" <?php if (!(strcmp(0, $row_Reckeywords[ 'd_sort']))) {echo "selected"; } ?>>至頂</option>
                                                <?php
                                                for($j=1;$j<=($totalRows);$j++) {
                                                    echo "<option value=\"".$j."\" ";
                                                    if (!(strcmp($j, $row_Reckeywords['d_sort']))) {echo "selected=\"selected\"";}
                                                    echo ">".$j."</option>";
                                                }
                                                $_SESSION['totalRows']=$totalRows;
                                                ?>
                                            </select>
                                        </td>
                                        <td align="center" class="table_data">
                                            <a href="keywords_edit.php?d_id=<?php echo $row_Reckeywords['d_id']; ?>">
                                                <?php echo $row_Reckeywords['d_title']; ?>
                                            </a>
                                        </td>
                                        <!-- <td align="center" class="table_data"><a href="keywords_edit.php?d_id=<?php echo $row_Reckeywords['d_id']; ?>"><img src="<?php if($totalRows_RecImage==0){echo "image/default_image_s.jpg";}else{echo "../".$row_RecImage['file_link2'];} ?>" alt="" class="image_frame" /></a></td> -->
                                        <td align="center" class="table_data">
                                            <?php  //list使用
                                            if($row_Reckeywords['d_active']) {
                                                echo "<a href='".$row_Reckeywords['d_active']."' rel='".$row_Reckeywords['d_id']."' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
                                            } else {
                                                echo "<a href='".$row_Reckeywords['d_active']."' rel='".$row_Reckeywords['d_id']."' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
                                            }
                                            ?>
                                        </td>
                                        <td align="center" class="table_data"><a href="keywords_edit.php?d_id=<?php echo $row_Reckeywords['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
                                        <td align="center" class="table_data"><a href="keywords_del.php?d_id=<?php echo $row_Reckeywords['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
                                    </tr>
                                    <?php } while ($row_Reckeywords = $Reckeywords->fetch()); ?>
                                </table>
                                <?php } // Show if recordset not empty ?>
                            </form>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
                                <tr>
                                    <td width="739" align="right" class="page_display">
                                    <!-------顯示頁選擇與分頁設定開始---------->
                                    <?php displayPages($pageNum, $queryString, $totalPages, $totalRows, $currentPage); ?>
                                    <!-------顯示頁選擇與分頁設定結束---------->
                                    <td width="110" align="right" class="page_display">
                                        <?php if ($totalRows > 0) { // Show if recordset not empty ?> 頁數:
                                        <?php echo (($pageNum+1)."/".($totalPages+1)); ?>
                                        <?php } // Show if recordset not empty ?>
                                    </td>
                                    <td width="151" align="right" class="page_display">所有資料數:
                                        <?php echo $totalRows ?> </td>
                                    <td width="24" align="right">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<script type="text/javascript">
    function changeSort(pageNum, totalRows, now_d_id, change_num) { //v1.0
        //alert(pageNum+"+"+totalPages);
        window.location.href = "keywords_list.php?pageNum=" + pageNum + "&totalRows=" + totalRows + "&changeSort=1" + "&now_d_id=" + now_d_id + "&change_num=" + change_num;
    }
</script>