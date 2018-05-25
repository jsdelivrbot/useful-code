<?php require_once('../Connections/connect2data.php'); ?>

<?php
$colname_RecAuthorityC = "-1";
if (isset($_GET['a_id'])) {
    $colname_RecAuthorityC = $_GET['a_id'];
}

$query_RecAuthorityC = "SELECT * FROM a_set WHERE a_id = :a_id";
$RecAuthorityC = $conn->prepare($query_RecAuthorityC);
$RecAuthorityC->bindParam(':a_id', $colname_RecAuthorityC, PDO::PARAM_STR);
$RecAuthorityC->execute();
$row_RecAuthorityC = $RecAuthorityC->fetch();
$totalRows_RecAuthorityC = $RecAuthorityC->rowCount();

if ($row_RecAuthorityC['a_id'] == 1) {
    header("Location: authorityC_list.php");
}

$menu_is = "authority";

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
                                    <td width="300" class="list_title">刪除權限種類</td>
                                    <td width="724">
                                        <?php if ($totalRows_RecAuthorityC == 0) { // Show if recordset empty ?>
                                        <span class="no_data">抱歉!找不到任何資料~</span>
                                        <?php } // Show if recordset empty ?>
                                    </td>
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
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">種類名稱</td>
                                                    <td width="532" class="table_data">
                                                        <?php echo $row_RecAuthorityC['a_title']; ?>
                                                        <input name="a_id" type="hidden" id="a_id" value="<?php echo $row_RecAuthorityC['a_id']; ?>" />
                                                        <input name="delsure" type="hidden" id="delsure" value="1" />
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
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
if ((isset($_REQUEST['a_id'])) && ($_REQUEST['a_id'] != "") && (isset($_REQUEST['delsure']))) {

    $deleteSQL = "DELETE FROM a_set WHERE a_id=:a_id";

    $sth = $conn->prepare($deleteSQL);
    $sth->bindParam(':a_id', $_REQUEST['a_id'], PDO::PARAM_INT);
    $sth->execute();

    $deleteGoTo = "authorityC_list.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'] . "&pageNum_RecAuthorityC=" . $_SESSION["ToPage"];
    }
    header(sprintf("Location: %s", $deleteGoTo));
}
?>