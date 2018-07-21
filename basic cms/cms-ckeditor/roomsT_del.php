<?php require_once('../Connections/connect2data.php'); ?>

<?php
$colname_RecroomsT = "-1";
if (isset($_GET['term_id'])) {
    $colname_RecroomsT = $_GET['term_id'];
}

$query_RecroomsT = "SELECT * FROM terms WHERE term_id = :term_id";
$RecroomsT = $conn->prepare($query_RecroomsT);
$RecroomsT->bindParam(':term_id', $colname_RecroomsT, PDO::PARAM_INT);
$RecroomsT->execute();
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
                                    <td width="30%" class="list_title">刪除分類</td>
                                    <td width="70%"><span class="no_data">確定刪除以下分類?</span></td>
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
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類名稱</td>
                                                    <td class="table_data">
                                                        <?php echo $row_RecroomsT['name']; ?>
                                                        <input name="term_id" type="hidden" id="term_id" value="<?php echo $row_RecroomsT['term_id']; ?>" />
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
if ((isset($_REQUEST['term_id'])) && ($_REQUEST['term_id'] != "") && (isset($_REQUEST['delsure']))) {

    $deleteSQL = "DELETE FROM terms WHERE term_id=:term_id";

    $sth = $conn->prepare($deleteSQL);
    $sth->bindParam(':term_id', $_REQUEST['term_id'], PDO::PARAM_INT);
    $sth->execute();


    $deleteSQL_taxonomy = "DELETE FROM term_taxonomy WHERE term_id=:term_id";

    $sth_taxonomy = $conn->prepare($deleteSQL_taxonomy);
    $sth_taxonomy->bindParam(':term_id', $_REQUEST['term_id'], PDO::PARAM_INT);
    $sth_taxonomy->execute();


    $deleteGoTo = "roomsT_list.php?delchangeSort=1";

    if (isset($_SERVER['QUERY_STRING'])) {
        $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
        $deleteGoTo .= $_SERVER['QUERY_STRING'] . "&pageNum=" . $_SESSION["ToPage"];
    }
    header(sprintf("Location: %s", $deleteGoTo));
}
?>