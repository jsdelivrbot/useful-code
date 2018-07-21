<?php require_once('../Connections/connect2data.php'); ?>

<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$colname_RecroomsT = "-1";
if (isset($_GET['term_id'])) {
  $colname_RecroomsT = $_GET['term_id'];
}

$query_RecroomsT = sprintf("SELECT * FROM terms WHERE term_id = %s", $colname_RecroomsT);
$RecroomsT = $conn->query($query_RecroomsT);
$row_RecroomsT = $RecroomsT->fetch();
$totalRows_RecroomsT = $RecroomsT->rowCount();

$query_RecIndexImage = sprintf("SELECT * FROM file_set WHERE file_d_id = %s AND file_type = 'roomsTCover'", $colname_RecroomsT);
$RecIndexImage = $conn->query($query_RecIndexImage);
$row_RecIndexImage = $RecIndexImage->fetch();
$totalRows_RecIndexImage = $RecIndexImage->rowCount();

$menu_is="rooms";
$_SESSION['nowMenu']= "farmerterm";
$_SESSION['nowPage']=$selfPage;

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
                                    <td width="30%" class="list_title">修改分類</td>
                                    <td width="70%">&nbsp;</td>
                                </tr>
                            </table>
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><img src="image/spacer.gif" width="1" height="1"></td>
                                </tr>
                            </table>
                            <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" cellspacing="3" cellpadding="5">
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td>
                                                                    <table width="100%" border="0" cellspacing="3" cellpadding="5">
                                                                        <tr>
                                                                            <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類名稱</td>
                                                                            <td>
                                                                                <input name="name" type="text" class="table_data" id="name" value="<?php echo $row_RecroomsT['name']; ?>" size="50" />
                                                                                <input name="term_id" type="hidden" id="term_id" value="<?php echo $row_RecroomsT['term_id']; ?>" />
                                                                            </td>
                                                                            <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
                                                                            <td>
                                                                                <label>
                                                                                    <select name="term_active" class="table_data" id="term_active">
                                                                                        <option value="0" <?php if (!(strcmp(0, $row_RecroomsT[ 'term_active']))) {echo "selected";} ?>>不公佈</option>
                                                                                        <option value="1" <?php if (!(strcmp(1, $row_RecroomsT[ 'term_active']))) {echo "selected";} ?>>公佈</option>
                                                                                    </select>
                                                                                </label>
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
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <input type="hidden" name="MM_update" value="form1" />
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
if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

    $slug = urlencode($_POST['name']);

    $updateSQL = "UPDATE terms SET name=:name, slug=:slug, term_active=:term_active WHERE term_id=:term_id";

    $sth = $conn->prepare($updateSQL);
    $sth->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $sth->bindParam(':slug', $slug, PDO::PARAM_STR);
    $sth->bindParam(':term_active', $_POST['term_active'], PDO::PARAM_INT);
    $sth->bindParam(':term_id', $_POST['term_id'], PDO::PARAM_INT);
    $sth->execute();


    $updateGoTo = "roomsT_list.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
        $updateGoTo .= $_SERVER['QUERY_STRING'] . "&pageNum=" . $_SESSION["ToPage"];
    }
    header(sprintf("Location: %s", $updateGoTo));
}
?>