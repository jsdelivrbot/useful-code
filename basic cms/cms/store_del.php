<?php require_once('../Connections/connect2data.php'); ?>

<?php
if (!1) {
    header("Location: store_list.php");
}

$colname_Recstore = "-1";
if (isset($_GET['d_id'])) {
    $colname_Recstore = $_GET['d_id'];
}

$query_Recstore = "SELECT data_set.*, class_set.c_title as c_title FROM data_set LEFT JOIN class_set ON data_set.d_class2 = class_set.c_id WHERE d_id = :d_id";
$Recstore = $conn->prepare($query_Recstore);
$Recstore->bindParam(':d_id', $colname_Recstore, PDO::PARAM_INT);
$Recstore->execute();
$row_Recstore = $Recstore->fetch();
$totalRows_Recstore = $Recstore->rowCount();

$query_RecImage = "SELECT * FROM file_set WHERE file_d_id = :file_d_id AND file_type = 'image'";
$RecImage = $conn->prepare($query_RecImage);
$RecImage->bindParam(':file_d_id', $colname_Recstore, PDO::PARAM_INT);
$RecImage->execute();
$row_RecImage = $RecImage->fetch();
$totalRows_RecImage = $RecImage->rowCount();

$query_RecstoreC = "SELECT * FROM class_set WHERE c_parent = 'storeC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecstoreC = $conn->prepare($query_RecstoreC);
$RecstoreC->execute();
$row_RecstoreC = $RecstoreC->fetch();
$totalRows_RecstoreC = $RecstoreC->rowCount();

$G_selected1 = '';
if (isset($_SESSION['selected_storeC'])) {
    $G_selected1 = $_SESSION['selected_storeC'] = $row_Recstore['d_class2'];
}

$menu_is = "store";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php require_once('cmsTitle.php'); ?></title>

    <?php require_once('script.php'); ?>
    <?php require_once('head.php');?>

    <style>
        .chosen-choices {
            position: relative;
            /*overflow: hidden;*/
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            width: 100%;
            height: auto !important;
            height: 1%;
        }
        .chosen-choices li.search-choice {
            position: relative;
            margin: 3px 5px 3px 0px;
            padding: 3px 5px;
            border: 1px solid #aaa;
            border-radius: 3px;
            background-color: #e4e4e4;
            background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eeeeee));
            background-image: -webkit-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
            background-image: -moz-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
            background-image: -o-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
            background-image: linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
            background-clip: padding-box;
            box-shadow: 0 0 2px white inset, 0 1px 0 rgba(0, 0, 0, 0.05);
            color: #333;
            line-height: 13px;
        }
        .chosen-choices li {
            list-style: none;
        }
    </style>
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
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="30%" class="list_title">刪除</td>
                                    <td width="70%"><span class="no_data">確定刪除以下內容?</span></td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="image/spacer.gif" width="1" height="1"></td>
                                </tr>
                            </table>
                            <form action="" method="POST" enctype="multipart/form-data" name="form1" id="form1">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" cellpadding="5" cellspacing="3">
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">分類</td>
                                                    <td class="table_data">
                                                        <?php
                                                        do {
                                                            if (!(strcmp($row_RecstoreC['c_id'], $row_Recstore['d_class2']))) {
                                                            echo $row_RecstoreC['c_title'];
                                                            }
                                                        } while ($row_RecstoreC = $RecstoreC->fetch());
                                                        $rows = $RecstoreC->rowCount();
                                                        if($rows > 0) {
                                                        $RecstoreC->execute();
                                                        }
                                                        ?>
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">名稱</td>
                                                    <td class="table_data">
                                                        <?php echo $row_Recstore['d_title']; ?>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                                                    <td class="table_data">
                                                        <?php echo $row_Recstore['d_date']; ?>
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input name="submitBtn" type="submit" class="btnType" id="submitBtn" value="送出" />
                                        </td>
                                    </tr>
                                </table>
                                <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_Recstore['d_id']; ?>" />
                                <input name="delsure" type="hidden" id="delsure" value="1" />
                            </form>
                            <table width="100%" height="1" border="0" align="center" cellpadding="0" cellspacing="0" class="buttom_dot_line">
                                <tr>
                                    <td>&nbsp;</td>
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

<?php
if ((isset($_REQUEST['d_id'])) && ($_REQUEST['d_id'] != "") && (isset($_REQUEST['delsure']))) {

    //----------刪除圖片資料到資料庫begin(在主資料前)-----

    $sql = "SELECT * FROM file_set WHERE file_d_id=:file_d_id";

    $stat = $conn->prepare($sql);
    $stat->bindParam(':file_d_id', $_POST['d_id'], PDO::PARAM_INT);
    $stat->execute();

    while ($row = $stat->fetch()) {
        if ((isset($row['file_link1'])) && file_exists("../" . $row['file_link1'])) {
            unlink("../" . $row['file_link1']); //刪除檔案
        }
        if ((isset($row['file_link2'])) && file_exists("../" . $row['file_link2'])) {
            unlink("../" . $row['file_link2']); //刪除檔案
        }
        if ((isset($row['file_link3'])) && file_exists("../" . $row['file_link3'])) {
            unlink("../" . $row['file_link3']); //刪除檔案
        }
        if ((isset($row['file_link4'])) && file_exists("../" . $row['file_link4'])) {
            unlink("../" . $row['file_link4']); //刪除檔案
        }
        if ((isset($row['file_link5'])) && file_exists("../" . $row['file_link5'])) {
            unlink("../" . $row['file_link5']); //刪除檔案
        }
    }

    $deleteSQL = "DELETE FROM file_set WHERE file_d_id=:file_d_id";

    $sth = $conn->prepare($deleteSQL);
    $sth->bindParam(':file_d_id', $_POST['d_id'], PDO::PARAM_INT);
    $sth->execute();

    //----------刪除圖片資料到資料庫end(在主資料前)-----

    $deleteSQL = "DELETE FROM data_set WHERE d_id=:d_id";

    $sth = $conn->prepare($deleteSQL);
    $sth->bindParam(':d_id', $_POST['d_id'], PDO::PARAM_INT);
    $sth->execute();

    $deleteGoTo = "store_list.php?delchangeSort=1&selected1=" . $G_selected1 . "&selected2=" . $G_selected2;
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'] . "&pageNum=" . $_SESSION["ToPage"];
    }
    header(sprintf("Location: %s", $deleteGoTo));
}
?>