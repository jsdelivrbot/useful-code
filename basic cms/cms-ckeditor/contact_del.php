<?php require_once('../Connections/connect2data.php'); ?>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecData = "-1";
if (isset($_GET['d_id'])) {
    $colname_RecData = $_GET['d_id'];
}

$query_RecData = "SELECT * FROM data_set WHERE d_id = :d_id";
$RecData = $conn->prepare($query_RecData);
$RecData->bindParam(':d_id', $colname_RecData, PDO::PARAM_INT);
$RecData->execute();
$row_RecData = $RecData->fetch();
$totalRows_RecData = $RecData->rowCount();

$menu_is = "contact";

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
                                    <td width="30%" class="list_title">刪除聯絡我們</td>
                                    <td width="70%"><span class="no_data">您確定要刪除這筆資料?</span></td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="image/spacer.gif" width="1" height="1"></td>
                                </tr>
                            </table>
                            <form action="<?= $editFormAction ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td class="table_outline">
                                            <table border="0" align="center" cellpadding="5" cellspacing="1">
                                                <tr>
                                                    <td width="100%" align="left" class="table_data">客戶資訊：</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" cellspacing="3" cellpadding="5">
                                                <tr>
                                                    <td width="23%" align="center" class="table_title">姓名</td>
                                                    <td width="78%" bgcolor="#E4E4E4" class="table_data">
                                                        <?php echo (isset($row_RecData['d_data1'])) ? $row_RecData['d_data1'] : '無'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" class="table_title">電話</td>
                                                    <td class="table_data">
                                                        <?php echo (isset($row_RecData['d_data2'])) ? $row_RecData['d_data2'] : '無'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" class="table_title">信箱</td>
                                                    <td bgcolor="#E4E4E4" class="table_data">
                                                        <?php echo (isset($row_RecData['d_data3'])) ? $row_RecData['d_data3'] : '無'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" class="table_title">主旨</td>
                                                    <td class="table_data">
                                                        <?php echo (isset($row_RecData['d_title'])) ? $row_RecData['d_title'] : '無'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" class="table_title">訊息</td>
                                                    <td bgcolor="#E4E4E4" class="table_data">
                                                        <?php echo (isset($row_RecData['d_content'])) ? nl2br($row_RecData['d_content']) : '無'; ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" class="table_title">諮詢時間</td>
                                                    <td class="table_data">
                                                        <?php echo $row_RecData['d_date']; ?>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="table_data">
                                            <input name="delsure" type="hidden" id="delsure" value="1" />
                                        </span></td>
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

    $deleteSQL = "DELETE FROM data_set WHERE d_id=:d_id";

    $sth = $conn->prepare($deleteSQL);
    $sth->bindParam(':d_id', $_REQUEST['d_id'], PDO::PARAM_INT);
    $sth->execute();

    $deleteGoTo = "contact_list.php?delchangeSort=1";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'] . "&pageNum=" . $_SESSION["ToPage"];
    }
    header(sprintf("Location: %s", $deleteGoTo));
}
?>