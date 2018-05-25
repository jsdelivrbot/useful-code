<?php require_once('../Connections/connect2data.php'); ?>

<?php
$menu_is = "store";

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recstore = 20;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
    $pageNum = $_GET['pageNum'];
}
$startRow_Recstore = $pageNum * $maxRows_Recstore;

$query_RecstoreC = "SELECT * FROM class_set WHERE c_parent = 'storeC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecstoreC = $conn->query($query_RecstoreC);
$row_RecstoreC = $RecstoreC->fetch();
$totalRowsC = $RecstoreC->rowCount();

$G_selected1 = '';
if (isset($_GET['selected1'])) {
    $_SESSION['selected_storeC'] = $G_selected1 = $_GET['selected1'];
} else {
    $G_selected1 = $_SESSION['selected_storeC'] = $row_RecstoreC['c_id'];
}

$query_Recstore = "SELECT data_set.*, class_set.c_title as c_title FROM data_set LEFT JOIN class_set ON data_set.d_class2 =class_set.c_id WHERE d_class1 = 'store' AND d_class2='" . $G_selected1 . "' ORDER BY d_sort ASC, d_date DESC";
$query_limit_Recstore = sprintf("%s LIMIT %d, %d", $query_Recstore, $startRow_Recstore, $maxRows_Recstore);
$Recstore = $conn->query($query_limit_Recstore);
$row_Recstore = $Recstore->fetch();
//$_SESSION['selected_store']=$G_selected2;
//echo $query_Recstore;

$S_original_selected = '';
if (isset($_SESSION['original_selected'])) {
    $S_original_selected = $_SESSION['original_selected'];
}
$all_Recstore = $conn->query($query_Recstore);
$totalRows = $all_Recstore->rowCount();

$all_Recstore = $conn->query($query_Recstore);
$totalRows = $all_Recstore->rowCount();
$totalPages_Recstore = ceil($totalRows / $maxRows_Recstore) - 1;
$TotalPage = $totalPages_Recstore;

$queryString_Recstore = "";
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
        $queryString_Recstore = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_Recstore = sprintf("&totalRows=%d%s", $totalRows, $queryString_Recstore);

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
else if ($R_pageNum > $totalPages_Recstore) {
    $_SESSION["ToPage"] = $TotalPage;
} else {
    $_SESSION["ToPage"] = $R_pageNum;
}

//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
if ($R_pageNum > $totalPages_Recstore && $R_pageNum != 0) {
    header("Location:store_list.php?pageNum=" . $totalPages_Recstore);
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

    $query_Recstore = "SELECT data_set.*, class_set.c_title as c_title FROM data_set LEFT JOIN class_set ON data_set.d_class2 =class_set.c_id WHERE d_class1 = 'store' AND d_class2='" . $G_selected1 . "' ORDER BY d_sort ASC, d_date DESC";
    $_SESSION['selected_storeC'] = $G_selected1;

    $Recstore = $conn->query($query_Recstore);
    $row_Recstore = $Recstore->fetch();

    do {
        if ($row_Recstore['d_sort'] == 0) {} else if ($row_Recstore['d_id'] == $_GET['now_d_id']) {
            //echo 'sort_num(now_d_id) = '.$sort_num."<br/>";

        } else if ($sort_num == $_GET['change_num']) {
            //echo 'sort_num(change_num) = '.$sort_num."<br/>";
            $sort_num++;

            $updateSQL = "UPDATE data_set SET d_sort=:d_sort WHERE d_id=:d_id";

            $stat = $conn->prepare($updateSQL);
            $stat->bindParam(':d_sort', $sort_num, PDO::PARAM_INT);
            $stat->bindParam(':d_id', $row_Recstore['d_id'], PDO::PARAM_INT);
            $stat->execute();

            $sort_num++;
        } else {
            $updateSQL = "UPDATE data_set SET d_sort=:d_sort WHERE d_id=:d_id";

            $stat = $conn->prepare($updateSQL);
            $stat->bindParam(':d_sort', $sort_num, PDO::PARAM_INT);
            $stat->bindParam(':d_id', $row_Recstore['d_id'], PDO::PARAM_INT);
            $stat->execute();

            // echo $sort_num . "<br/>";
            // echo $row_Recstore['d_title'] . "->" . $sort_num . "<br/>";

            $sort_num++;
        }
    } while ($row_Recstore = $Recstore->fetch());

    $updateSQL = "UPDATE data_set SET d_sort=:d_sort WHERE d_id=:d_id";

    $stat = $conn->prepare($updateSQL);
    $stat->bindParam(':d_sort', $_GET['change_num'], PDO::PARAM_INT);
    $stat->bindParam(':d_id', $_GET['now_d_id'], PDO::PARAM_INT);
    $stat->execute();

    if ($G_changeSort == 1) {
        if (isset($_GET['now_d_id'])) {
            header("Location:store_list.php?selected1=" . $G_selected1 . "&pageNum=" . $_GET['pageNum'] . "&totalRows=" . $_GET['totalRows'] . "#" . $_GET['now_d_id']);
        } else {
            header("Location:store_list.php?selected1=" . $G_selected1 . "&pageNum=" . $_GET['pageNum'] . "&totalRows=" . $_GET['totalRows']);
        }
    } else if ($G_delchangeSort == 1) {
        header("Location:store_list.php?selected1=" . $G_selected1 . "&pageNum=" . $_GET['pageNum']);
    }
}

require_once 'display_page.php';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php require_once('cmsTitle.php'); ?></title>

    <link rel="stylesheet" href="jquery/chosen_v1.8.5/chosen.css">

    <style>
        .chosen-container{
            position: relative;
            top: -3px;
        }
    </style>

    <?php require_once('script.php'); ?>
    <?php require_once('head.php');?>
</head>
<body>
    <table width="1280" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td rowspan="2" align="left">
                            <?php require_once('cmsHeader.php');?>
                        </td>
                        <td width="100" align="right" valign="middle">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="5" align="left"><span class="color_white"><a href="<?php echo $logoutAction ?>">&nbsp;&nbsp;<img src="image/logout.gif" width="48" height="16" /></a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td align="left" class="color_white">&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td align="left" class="color_white">&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="5" align="left" class="table_data">&nbsp;&nbsp;<a href="../index.php" target="_blank">觀看首頁</a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <?php require_once('top.php'); ?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="left">
                            <!-- InstanceBeginEditable name="編輯區域" -->
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="150" class="list_title">列表</td>
                                    <td width="874"><span class="table_data">分類：
                                        <select name="select1" id="select1" class="chosen-select">
                                            <?php do {?>
                                                <option value="<?php echo $row_RecstoreC['c_id']?>"<?php if (!(strcmp($row_RecstoreC['c_id'], $G_selected1))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecstoreC['c_title']?><?php //echo $row_RecstoreC['c_id']?></option>
                                                <?php
                                            } while ($row_RecstoreC = $RecstoreC->fetch());
                                            $rows = $RecstoreC->rowCount();
                                            if($rows > 0) {
                                                $RecstoreC->execute();
                                            }
                                            ?>
                                        </select>
                                        </span><span class="no_data">
                                        <?php if ($totalRows == 0) { // Show if recordset empty ?>
                                        <strong>此分類沒有資料</strong>
                                        <?php } // Show if recordset empty ?>
                                    </span></td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
                                <tr>
                                    <td width="739" align="right" class="page_display">
                                        <!-------顯示頁選擇與分頁設定開始---------->
                                        <?php displayPages($pageNum, $queryString_Recstore, $totalPages_Recstore, $totalRows, $currentPage); ?>
                                        <!-------顯示頁選擇與分頁設定結束---------->
                                    </td>
                                    <td width="110" align="right" class="page_display">
                                        <?php if ($totalRows > 0) { // Show if recordset not empty ?> 頁數:
                                        <?php echo (($pageNum+1)."/".($totalPages_Recstore+1)); ?>
                                        <?php } // Show if recordset not empty ?>
                                    </td>
                                    <td width="151" align="right" class="page_display">所有資料數:
                                        <?php echo $totalRows ?> </td>
                                    <td width="24" align="right">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="image/spacer.gif" width="1" height="1" /></td>
                                </tr>
                            </table>
                            <form action="store_process.php" method="post" name="form1" id="form1">
                                <?php if ($totalRows > 0) { // Show if recordset not empty ?>
                                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
                                    <tr>
                                        <td width="150" align="center" class="table_title">新增日期</td>
                                        <td width="60" align="center" class="table_title">排序</td>
                                        <td align="center" class="table_title">標題</td>
                                        <td width="90" align="center" class="table_title">圖片</td>
                                        <td width="40" align="center" class="table_title">狀態</td>
                                        <?php if(1){ ?>
                                        <td width="40" align="center" class="table_title">編輯</td>
                                        <?php } ?>
                                        <?php if(1){ ?>
                                        <td width="40" align="center" class="table_title">刪除</td>
                                        <?php } ?>
                                    </tr>
                                    <?php
                                    $i=0;
                                    do {
                                        $i++;
                                        $colname_RecImage = "-1";
                                        if (isset($row_Recnews['d_id'])) {
                                          $colname_RecImage = $row_Recnews['d_id'];
                                        }
                                        $query_RecImage = "SELECT * FROM file_set  WHERE file_type='storeCover' AND file_d_id = ".$row_Recstore['d_id'];
                                        $RecImage = $conn->query($query_RecImage);
                                        $row_RecImage = $RecImage->fetch();
                                        $totalRows_RecImage = $RecImage->rowCount();
                                    ?>
                                    <tr <?php if ($i%2==0): ?>bgcolor='#E4E4E4'<?php endif ?>>
                                        <td align="center" class="table_data">
                                            <?php
                                            if(1){
                                                echo '<a href="store_edit.php?d_id='.$row_Recstore['d_id'].'">'.$row_Recstore['d_date'].'</a>';
                                            }else{
                                                echo $row_Recstore['d_date'];
                                            }
                                            ?>
                                        </td>
                                        <td align="center" class="table_data">
                                            <select name="d_sort" id="d_sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows; ?>','<?php echo $row_Recstore['d_id']; ?>',this.options[this.selectedIndex].value,<?= $G_selected1 ?>)">
                                                <option value="0" <?php if (!(strcmp(0, $row_Recstore[ 'd_sort']))) {echo "selected";} ?>>至頂</option>
                                                <?php
                                                for($j=1;$j<=($totalRows);$j++) {
                                                    echo "<option value=\"".$j."\" ";
                                                    if (!(strcmp($j, $row_Recstore['d_sort']))) {echo "selected=\"selected\"";}
                                                    echo ">".$j."</option>";
                                                }
                                                ?>
                                            </select>
                                            <?php $_SESSION['totalRows']=$totalRows; ?>
                                        </td>
                                        <td align="center" class="table_data">
                                            <a href="store_edit.php?d_id=<?php echo $row_Recstore['d_id']; ?>">
                                                <?php echo $row_Recstore['d_title']; ?>
                                            </a>
                                        </td>
                                        <td align="center" class="table_data"><a href="store_edit.php?d_id=<?php echo $row_Recstore['d_id']; ?>">
                                            <?php if ($totalRows_RecImage==0): ?>
                                                <img src="image/default_image_s.jpg">
                                            <?php else: ?>
                                                <img src="../<?= $row_RecImage['file_link2'] ?>">
                                            <?php endif ?>
                                        </a></td>
                                        <td align="center" class="table_data">
                                            <?php  //list使用
                                            if($row_Recstore['d_active']) {
                                                echo "<a href='".$row_Recstore['d_active']."' rel='".$row_Recstore['d_id']."' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
                                            } else {
                                                echo "<a href='".$row_Recstore['d_active']."' rel='".$row_Recstore['d_id']."' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
                                            }
                                            ?>
                                        </td>
                                        <td align="center" class="table_data"><a href="store_edit.php?d_id=<?php echo $row_Recstore['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
                                        <td align="center" class="table_data"><a href="store_del.php?d_id=<?php echo $row_Recstore['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
                                    </tr>
                                    <?php } while ($row_Recstore = $Recstore->fetch()); ?>
                                </table>
                                <?php } // Show if recordset not empty ?>
                            </form>
                            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
                                <tr>
                                    <td width="739" align="right" class="page_display">
                                        <!-------顯示頁選擇與分頁設定開始---------->
                                        <?php displayPages($pageNum, $queryString_Recstore, $totalPages_Recstore, $totalRows, $currentPage); ?>
                                        <!-------顯示頁選擇與分頁設定結束---------->
                                    </td>
                                    <td width="110" align="right" class="page_display">
                                        <?php if ($totalRows > 0) { // Show if recordset not empty ?> 頁數:
                                        <?php echo (($pageNum+1)."/".($totalPages_Recstore+1)); ?>
                                        <?php } // Show if recordset not empty ?>
                                    </td>
                                    <td width="151" align="right" class="page_display">所有資料數:
                                        <?php echo $totalRows ?> </td>
                                    <td width="24" align="right">&nbsp;</td>
                                </tr>
                            </table>
                            <!-- InstanceEndEditable -->
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

<script src="jquery/chosen_v1.8.5/chosen.jquery.js"></script>

<script type="text/javascript">
    $(".chosen-select").chosen({
        disable_search_threshold: 6,
        no_results_text: "找不到資料。 目前輸入的是:",
        placeholder_text_single: "尚未新增分類",
        width: "auto"
    });

	function changeSort(pageNum, totalRows, now_d_id, change_num, selected1) {
	    window.location.href = "store_list.php?selected1=" + selected1 + "&changeSort=1" + "&now_d_id=" + now_d_id + "&change_num=" + change_num + "&pageNum=" + pageNum + "&totalRows=" + totalRows;
	}

	$(document).ready(function() {
		$('#select1').change(function() {
			window.location.href = "store_list.php?selected1="+$(this).val();
		});
	});
</script>