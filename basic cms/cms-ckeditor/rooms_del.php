<?php require_once('../Connections/connect2data.php'); ?>

<?php
$colname_Recrooms = "-1";
if (isset($_GET['d_id'])) {
    $colname_Recrooms = $_GET['d_id'];
}

$query_Recrooms = sprintf("SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND D.d_id = %s", $colname_Recrooms);
$Recrooms = $conn->query($query_Recrooms);
$row_Recrooms = $Recrooms->fetch();
$totalRows_Recrooms = $Recrooms->rowCount();

$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'image'", $colname_Recrooms);
$RecImage = $conn->query($query_RecImage);
$row_RecImage = $RecImage->fetch();
$totalRows_RecImage = $RecImage->rowCount();

$query_RecCover = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'roomsCover'", $colname_Recrooms);
$RecCover = $conn->query($query_RecCover);
$row_RecCover = $RecCover->fetch();
$totalRows_RecCover = $RecCover->rowCount();

$G_selected1 = '';
if (isset($_SESSION['selected_roomsT'])) {
    $G_selected1 = $_SESSION['selected_roomsT'] = $row_Recrooms['d_class2'];
}

$query_RecroomsT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='rooms' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecroomsT = $conn->query($query_RecroomsT);
$row_RecroomsT = $RecroomsT->fetch();
$totalRows_RecroomsT = $RecroomsT->rowCount();

$menu_is = "rooms";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php require_once('cmsTitle.php'); ?></title>

    <?php require_once('script.php'); ?>
    <?php require_once('head.php');?>

    <style>
        .chosen-choices li {
            float: left;
        }
    </style>
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
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類</td>
                                                    <td class="table_data">
                                                        <ul class="chosen-choices">
                                                            <?php
                                                            do {
                                                                $selA = explode(',',$row_Recrooms['d_tag']);
                                                                if (in_array($row_RecroomsT['term_id'], $selA)){
                                                                    echo '<li class="search-choice"><span>'.$row_RecroomsT['name'].'</span></li>';
                                                                }
                                                            } while ($row_RecroomsT = $RecroomsT->fetch());
                                                            $rows = $RecroomsT->rowCount();
                                                            if($rows > 0) {
                                                              $RecroomsT->execute();
                                                            }
                                                            ?>
                                                        </ul>
                                                        <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_Recrooms['d_id']; ?>" />
                                                        <input name="delsure" type="hidden" id="delsure" value="1" />
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">中文名稱</td>
                                                    <td width="532" class="table_data">
                                                        <?php echo $row_Recrooms['d_title']; ?>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">英文名稱</td>
                                                    <td class="table_data">
                                                        <?php echo $row_Recrooms['d_title_en']; ?>
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                                                    <td class="table_data">
                                                        <?php echo $row_Recrooms['d_date']; ?>
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



    $deleteSQL_term = "DELETE FROM term_relationships WHERE object_id=:object_id";
    $sth_term = $conn->prepare($deleteSQL_term);
    $sth_term->bindParam(':object_id', $_REQUEST['d_id'], PDO::PARAM_INT);
    $sth_term->execute();


    $deleteSQL = "DELETE FROM data_set WHERE d_id=:d_id";
    $sth = $conn->prepare($deleteSQL);
    $sth->bindParam(':d_id', $_REQUEST['d_id'], PDO::PARAM_INT);
    $sth->execute();


    $deleteGoTo = "rooms_list.php?delchangeSort=1&selected1=" . $G_selected1 . "&selected2=" . $G_selected2;
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'] . "&pageNum=" . $_SESSION["ToPage"];
    }
    header(sprintf("Location: %s", $deleteGoTo));
}
?>