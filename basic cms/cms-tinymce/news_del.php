<?php require_once '../Connections/connect2data.php';?>

<?php
$colname_Recnews = "-1";
if (isset($_GET['d_id'])) {
    $colname_Recnews = $_GET['d_id'];
}

$query_Recnews = "SELECT * FROM data_set WHERE d_id = :d_id";
$Recnews = $conn->prepare($query_Recnews);
$Recnews->bindParam(':d_id', $colname_Recnews, PDO::PARAM_INT);
$Recnews->execute();
$row_Recnews = $Recnews->fetch();
$totalRows = $Recnews->rowCount();

$query_RecImage = "SELECT * FROM file_set WHERE file_d_id = :file_d_id AND file_type = 'image'";
$RecImage = $conn->prepare($query_RecImage);
$RecImage->bindParam(':file_d_id', $colname_Recnews, PDO::PARAM_INT);
$RecImage->execute();
$row_RecImage = $RecImage->fetch();
$totalRows_RecImage = $RecImage->rowCount();

$query_RecCover = "SELECT * FROM file_set WHERE file_d_id = :file_d_id AND file_type = 'newsCover'";
$RecCover = $conn->prepare($query_RecCover);
$RecCover->bindParam(':file_d_id', $colname_Recnews, PDO::PARAM_INT);
$RecCover->execute();
$row_RecCover = $RecCover->fetch();
$totalRows_RecCover = $RecCover->rowCount();

$query_RecFile = "SELECT * FROM file_set WHERE file_d_id = :file_d_id AND file_type = 'file'";
$RecFile = $conn->prepare($query_RecFile);
$RecFile->bindParam(':file_d_id', $colname_Recnews, PDO::PARAM_INT);
$RecFile->execute();
$row_RecFile = $RecFile->fetch();
$totalRows_RecFile = $RecFile->rowCount();

$menu_is = "news";

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
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="30%" class="list_title">刪除</td>
                                    <td width="70%"><span class="no_data">您確定要刪除這筆資料?</span></td>
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
                                            <table width="100%" border="0" cellspacing="3" cellpadding="5">
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
                                                    <td width="532" class="table_data">
                                                        <?php echo $row_Recnews['d_title']; ?>
                                                        <input name="d_id" type="hidden" id="d_id" value="<?php echo $row_Recnews['d_id']; ?>" />
                                                        <input name="delsure" type="hidden" id="delsure" value="1" />
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
                                                    <td class="table_data">
                                                        <?php echo $row_Recnews['d_content']; ?>
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
                                                    <td width="532" class="table_data">
                                                        <?php echo $row_Recnews['d_date']; ?>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <?php if ($totalRows_RecCover > 0) { // Show if recordset not empty ?>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前封面圖片</td>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td>
                                                                    <?php do { ?>
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr>
                                                                            <td width="100" rowspan="2" align="center"><img src="../<?php echo $row_RecCover['file_link2']; ?>" alt="" class="image_frame" /></td>
                                                                            <td align="left" class="table_data">&nbsp;圖片說明：
                                                                                <?php echo $row_RecCover['file_title']; ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" class="table_data">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center">&nbsp;</td>
                                                                            <td align="center">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                    <?php } while ($row_RecCover = $RecCover->fetch()); ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td bgcolor="#e5ecf6" class="table_col_title">
                                                        <p>&nbsp;</p>
                                                    </td>
                                                    <?php } // Show if recordset not empty ?>
                                                </tr>
                                                <tr>
                                                    <?php if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">目前圖片</td>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td>
                                                                    <?php do { ?>
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tr>
                                                                            <td width="100" rowspan="2" align="center"><img src="../<?php echo $row_RecImage['file_link2']; ?>" alt="" class="image_frame" /></td>
                                                                            <td align="left" class="table_data">&nbsp;圖片說明：
                                                                                <?php echo $row_RecImage['file_title']; ?>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" class="table_data">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="center">&nbsp;</td>
                                                                            <td align="center">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                    <?php } while ($row_RecImage = $RecImage->fetch()); ?>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td bgcolor="#e5ecf6" class="table_col_title">
                                                        <p>&nbsp;</p>
                                                    </td>
                                                    <?php } // Show if recordset not empty ?>
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

    $deleteSQL = "DELETE FROM data_set WHERE d_id=:d_id";

    $sth = $conn->prepare($deleteSQL);
    $sth->bindParam(':d_id', $_POST['d_id'], PDO::PARAM_INT);
    $sth->execute();

    $deleteGoTo = "news_list.php?delchangeSort=1";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'] . "&pageNum=" . $_SESSION["ToPage"];
    }
    header(sprintf("Location: %s", $deleteGoTo));
}
?>