<?php require_once('../Connections/connect2data.php'); ?>

<?php
$menu_is = "rooms";

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recrooms = 20;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
    $pageNum = $_GET['pageNum'];
}
$startRow_Recrooms = $pageNum * $maxRows_Recrooms;

$query_RecroomsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='rooms' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecroomsT = $conn->query($query_RecroomsT);
$row_RecroomsT = $RecroomsT->fetch();
$totalRows_RecroomsT = $RecroomsT->rowCount();

$G_selected1 = '';
$SDSQL = '';
if (isset($_GET['selected1']) && $_GET['selected1'] != '') {

    if ($_GET['selected1'] != 0) {
        $_SESSION['selected_roomsT'] = $G_selected1 = $_GET['selected1'];
        $SDSQL = " AND term_id='$G_selected1'";
    } else {
        $_SESSION['selected_roomsT'] = $G_selected1 = $_GET['selected1'];
        $SDSQL = '';
    }

}

$query_Recrooms = "SELECT * FROM term_relationships, data_set, terms WHERE term_taxonomy_id = term_id AND d_class1 = 'rooms' AND d_id = object_id $SDSQL ORDER BY term_order ASC, d_date DESC";
$query_limit_Recrooms = sprintf("%s LIMIT %d, %d", $query_Recrooms, $startRow_Recrooms, $maxRows_Recrooms);
$Recrooms = $conn->query($query_limit_Recrooms);
$row_Recrooms = $Recrooms->fetch();

//$_SESSION['selected_rooms']=$G_selected2;
//echo $query_Recrooms;

if (isset($_GET['totalRows_Recrooms'])) {
    $S_original_selected = '';
    if (isset($_SESSION['original_selected'])) {
        $S_original_selected = $_SESSION['original_selected'];
    }
    /*if(isset($_GET['selected2']) && $_GET['selected2']!=''){
    $G_selected2 = $_GET['selected2'];
    } */
    if ($S_original_selected == $G_selected1) {
        $totalRows_Recrooms = $_GET['totalRows_Recrooms'];
    } else {
        $all_Recrooms = $conn->query($query_Recrooms);
        $totalRows_Recrooms = $all_Recrooms->rowCount();
    }
} else {
    $all_Recrooms = $conn->query($query_Recrooms);
    $totalRows_Recrooms = $all_Recrooms->rowCount();
}

$all_Recrooms = $conn->query($query_Recrooms);
$totalRows_Recrooms = $all_Recrooms->rowCount();
$totalPages_Recrooms = ceil($totalRows_Recrooms / $maxRows_Recrooms) - 1;
$TotalPage = $totalPages_Recrooms;

$queryString_Recrooms = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum") == false &&
            stristr($param, "totalRows_Recrooms") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_Recrooms = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_Recrooms = sprintf("&totalRows_Recrooms=%d%s", $totalRows_Recrooms, $queryString_Recrooms);

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
else if ($R_pageNum > $totalPages_Recrooms) {
    $_SESSION["ToPage"] = $TotalPage;
} else {
    $_SESSION["ToPage"] = $R_pageNum;
}
//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
if ($R_pageNum > $totalPages_Recrooms && $R_pageNum != 0) {
    header("Location:rooms_list.php?pageNum=" . $totalPages_Recrooms);
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

    //echo "now_d_id=".$_GET['now_d_id'];
    //echo "change_num=".$_GET['change_num'];

    $query_Recrooms = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$G_selected1' ORDER BY term_order ASC, d_date DESC";
    $_SESSION['selected_roomsT'] = $G_selected1;

    $Recrooms = $conn->query($query_Recrooms);
    $row_Recrooms = $Recrooms->fetch();

    do {
        if ($row_Recrooms['term_order'] == 0) {} else if ($row_Recrooms['d_id'] == $_GET['now_d_id']) {
            //echo 'sort_num(now_d_id) = '.$sort_num."<br/>";

        } else if ($sort_num == $_GET['change_num']) {
            //echo 'sort_num(change_num) = '.$sort_num."<br/>";
            $sort_num++;

            $updateSQL = "UPDATE term_relationships SET term_order=:term_order WHERE term_order=:term_order AND term_taxonomy_id=:term_taxonomy_id";

            $stat = $conn->prepare($updateSQL);
            $stat->bindParam(':term_order', $sort_num, PDO::PARAM_INT);
            $stat->bindParam(':term_order', $row_Recrooms['d_id'], PDO::PARAM_INT);
            $stat->bindParam(':term_taxonomy_id', $row_Recrooms['term_id'], PDO::PARAM_INT);
            $stat->execute();

            $sort_num++;
        } else {
            $updateSQL = "UPDATE term_relationships SET term_order=:term_order WHERE object_id=:object_id AND term_taxonomy_id=:term_taxonomy_id";

            $stat = $conn->prepare($updateSQL);
            $stat->bindParam(':term_order', $sort_num, PDO::PARAM_INT);
            $stat->bindParam(':term_order', $row_Recrooms['d_id'], PDO::PARAM_INT);
            $stat->bindParam(':term_taxonomy_id', $row_Recrooms['term_id'], PDO::PARAM_INT);
            $stat->execute();


            // echo $sort_num . "<br/>";
            // echo $row_Recrooms['d_title'] . "->" . $sort_num . "<br/>";

            $sort_num++;
        }

        //echo " ".$row_Recrooms['term_order'].'<br>';
    } while ($row_Recrooms = $Recrooms->fetch());


    $updateSQL = "UPDATE term_relationships SET term_order=:term_order WHERE object_id=:object_id AND term_taxonomy_id=:term_taxonomy_id";

    $stat = $conn->prepare($updateSQL);
    $stat->bindParam(':term_order', $_GET['change_num'], PDO::PARAM_INT);
    $stat->bindParam(':object_id', $_GET['now_d_id'], PDO::PARAM_INT);
    $stat->bindParam(':term_taxonomy_id', $G_selected1, PDO::PARAM_INT);
    $stat->execute();


    if ($G_changeSort == 1) {
        if (isset($_GET['now_d_id'])) {
            header("Location:rooms_list.php?selected1=" . $G_selected1 . "&pageNum=" . $_GET['pageNum'] . "&totalRows_Recrooms=" . $_GET['totalRows_Recrooms'] . "#" . $_GET['now_d_id']);
        } else {
            header("Location:rooms_list.php?selected1=" . $G_selected1 . "&pageNum=" . $_GET['pageNum'] . "&totalRows_Recrooms=" . $_GET['totalRows_Recrooms']);
        }
    } else if ($G_delchangeSort == 1) {
        header("Location:rooms_list.php?selected1=" . $G_selected1 . "&pageNum=" . $_GET['pageNum']);
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
	            <?php require_once 'cmsHeader.php';?>
	            <?php require_once 'top.php';?>
	            <table width="100%" border="0" cellspacing="0" cellpadding="0">
	                <tr>
	                    <td align="left">
	                        <!-- InstanceBeginEditable name="編輯區域" -->
	                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
	                            <tr>
	                                <td width="150" class="list_title">列表</td>
	                                <td width="874" class="table_data">分類：
										<select name="select1" id="select1" class="chosen-select">
											<option value="0" <?php if (!(strcmp(0, $G_selected1))) {echo "selected=\"selected\"";}?>>ALL</option>

											<?php do { ?>
											<option value="<?php echo $row_RecroomsT['term_id'] ?>"<?php if (!(strcmp($row_RecroomsT['term_id'], $G_selected1))) {echo "selected=\"selected\"";}?>><?php echo $row_RecroomsT['name'] ?><?php //echo $row_RecroomsT['term_id']?></option>
											<?php
											} while ($row_RecroomsT = $RecroomsT->fetch());
											$rows = $RecroomsT->rowCount();
											if ($rows > 0) {
											    $RecroomsT->execute();
											}
											?>
										</select>
							            <span class="no_data">
							                <?php if ($totalRows_Recrooms == 0) { // Show if recordset empty ?>
							                	<strong>此分類沒有資料</strong>
							                <?php } // Show if recordset empty ?>
							            </span>
							        </td>
	                            </tr>
	                        </table>

	                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
	                            <tr>
	                                <td width="739" align="right" class="page_display">
	                                    <!-------顯示頁選擇與分頁設定開始---------->
	                                    <?php displayPages($pageNum, $queryString_Recrooms, $totalPages_Recrooms, $totalRows_Recrooms, $currentPage); ?>
                                        <!-------顯示頁選擇與分頁設定結束---------->
                                        <td width="110" align="right" class="page_display">
                                            <?php if ($totalRows_Recrooms > 0) { // Show if recordset not empty ?> 頁數:
                                            <?php echo (($pageNum + 1) . "/" . ($totalPages_Recrooms + 1)); ?>
                                            <?php } // Show if recordset not empty ?>
                                        </td>
                                        <td width="151" align="right" class="page_display">所有資料數: <?php echo $totalRows_Recrooms ?> </td>
                                        <td width="24" align="right">&nbsp;</td>
                                    </td>
	                            </tr>
	                        </table>

	                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
	                            <tr>
	                                <td><img src="image/spacer.gif" width="1" height="1" /></td>
	                            </tr>
	                        </table>

	                        <form action="rooms_process.php" method="post" name="form1" id="form1">
	                            <?php if ($totalRows_Recrooms > 0) { // Show if recordset not empty ?>
	                            <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
	                                <tr>
	                                    <td width="140" align="center" class="table_title">新增日期</td>
	                                    <td width="60" align="center" class="table_title">排序</td>
	                                    <td align="center" class="table_title">名稱</td>
	                                    <td width="160" align="center" class="table_title">分類標籤</td>
	                                    <td width="90" align="center" class="table_title">圖片</td>
	                                    <td width="40" align="center" class="table_title">狀態</td>
	                                    <td width="40" align="center" class="table_title">編輯</td>
	                                    <td width="40" align="center" class="table_title">刪除</td>
	                                </tr>

	                                <?php
	                                $i=0;
	                                do {
	                                    $i++;
	                                    $colname_RecImage = "-1";
	                                    if (isset($row_Recnews['d_id'])) {
	                                      $colname_RecImage = $row_Recnews['d_id'];
	                                    }
	                                    $query_RecImage = "SELECT * FROM file_set  WHERE file_type='roomsCover' AND file_d_id = " . $row_Recrooms['d_id'];
	                                    $RecImage = $conn->query($query_RecImage);
	                                    $row_RecImage = $RecImage->fetch();
	                                    $totalRows_RecImage = $RecImage->rowCount();
	                                ?>
	                                <tr <?php if ($i%2==0): ?>bgcolor='#E4E4E4'<?php endif ?>>
                                        <td align="center" class="table_data">
                                            </a>
                                            <a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>">
                                                <?php echo $row_Recrooms['d_date']; ?>
                                            </a>
                                        </td>
                                        <td align="center" class="table_data">
                                            <label>
                                                <select name="sort" id="sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows_Recrooms; ?>','<?php echo $row_Recrooms['d_id']; ?>',this.options[this.selectedIndex].value,'<?php if (isset($G_selected1)) {echo $G_selected1;} else {echo $row_RecroomsT['term_id'];}?>')">
                                                    <option value="0" <?php if (!(strcmp(0, $row_Recrooms[ 'term_order']))) {echo "selected";} ?>>至頂</option>
                                                    <?php
											        for ($j = 1; $j <= ($totalRows_Recrooms); $j++) {
											            echo "<option value=\"" . $j . "\" ";
											            if (!(strcmp($j, $row_Recrooms['term_order']))) {echo "selected=\"selected\"";}
											            echo ">" . $j . "</option>";
											        }
											        ?>
                                                </select>
                                            </label>
                                            <?php $_SESSION['totalRows'] = $totalRows_Recrooms;?>
                                        </td>
                                        <td align="center" class="table_data">
                                            <a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>">
                                                <?php echo $row_Recrooms['d_title']; ?>
                                            </a>
                                        </td>
                                        <td align="center" class="table_data">
                                            <a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>">
                                                <ul class="chosen-choices">
                                                    <?php
													do {
											            $selA = explode(',', $row_Recrooms['d_tag']);
											            if (in_array($row_RecroomsT['term_id'], $selA)) {
											                echo '<li class="search-choice"><span>' . $row_RecroomsT['name'] . '</span></li>';
											            }

											        } while ($row_RecroomsT = $RecroomsT->fetch());
											        $RecroomsT->rowCount();
											        if ($rows > 0) {
                                                        $RecroomsT->execute();
											        }
											        ?>
                                                </ul>
                                            </a>
                                        </td>
                                        <td align="center" class="table_data">
                                            <a name="<?php echo $row_Recrooms['d_id']; ?>" id="<?php echo $row_Recrooms['d_id']; ?>">
											<a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>#imageEdit"><img src="<?php if ($totalRows_RecImage == 0) {echo "image/default_image_s.jpg";} else {echo "../" . $row_RecImage['file_link2'] . '?' . (mt_rand(1, 100000) / 100000);}?>" alt="" class="image_frame" /></a>
										</td>
                                        <td align="center" class="table_data">
                                            <?php //list使用
									        if ($row_Recrooms['d_active']) {
									            echo "<a href='" . $row_Recrooms['d_active'] . "' rel='" . $row_Recrooms['d_id'] . "' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
									        } else {
									            echo "<a href='" . $row_Recrooms['d_active'] . "' rel='" . $row_Recrooms['d_id'] . "' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
									        }
								        	?>
								        </td>
                                        <td align="center" class="table_data"><a href="rooms_edit.php?d_id=<?php echo $row_Recrooms['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
                                        <td align="center" class="table_data"><a href="rooms_del.php?d_id=<?php echo $row_Recrooms['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
                					</tr>
				                	<?php } while ($row_Recrooms = $Recrooms->fetch());?>
				                </table>
	                			<?php } // Show if recordset not empty ?>
	                		</form>
			                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
			                    <tr>
			                        <td width="739" align="right" class="page_display">
			                            <!-------顯示頁選擇與分頁設定開始---------->
			                            <?php displayPages($pageNum, $queryString_Recrooms, $totalPages_Recrooms, $totalRows_Recrooms, $currentPage); ?>
		                                <!-------顯示頁選擇與分頁設定結束---------->
		                                <td width="110" align="right" class="page_display">
		                                    <?php if ($totalRows_Recrooms > 0) { // Show if recordset not empty ?> 頁數:
		                                    <?php echo (($pageNum + 1) . "/" . ($totalPages_Recrooms + 1)); ?>
		                                    <?php } // Show if recordset not empty ?>
		                                </td>
		                                <td width="151" align="right" class="page_display">所有資料數:
		                                    <?php echo $totalRows_Recrooms ?> </td>
		                                <td width="24" align="right">&nbsp;</td>
		                            </td>
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

	function changeSort(pageNum, totalRows_Recrooms, now_d_id, change_num, selected1) { //v1.0
	 window.location.href="rooms_list.php?selected1="+selected1+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num+"&pageNum="+pageNum+"&totalRows_Recrooms="+totalRows_Recrooms;
	}

	$(document).ready(function() {
		$('#select1').change(function() {
			window.location.href = "rooms_list.php?selected1="+$(this).val();
		});
	});
</script>