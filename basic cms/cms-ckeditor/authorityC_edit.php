<?php require_once('../Connections/connect2data.php'); ?>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

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
                                    <td width="300" class="list_title">修改權限種類</td>
                                    <td width="724">&nbsp;</td>
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
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">種類名稱</td>
                                                    <td width="532">
                                                        <input name="a_title" type="text" class="table_data" id="a_title" value="<?php echo $row_RecAuthorityC['a_title']; ?>" size="50" />
                                                        <input name="a_id" type="hidden" id="a_id" value="<?php echo $row_RecAuthorityC['a_id']; ?>" />
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">權限管理</td>
                                                    <td width="532">
                                                        <select name="a_1" class="table_data" id="a_1" title="<?php echo $row_RecAuthorityC['a_1']; ?>">
                                                            <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC[ 'a_1']))) {echo "selected";} ?>>允許</option>
                                                            <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC[ 'a_1']))) {echo "selected";} ?>>不允許</option>
                                                        </select>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">news</td>
                                                    <td>
                                                        <select name="a_2" class="table_data" id="a_2" title="<?php echo $row_RecAuthorityC['a_1']; ?>">
                                                            <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC[ 'a_2']))) {echo "selected";} ?>>允許</option>
                                                            <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC[ 'a_2']))) {echo "selected";} ?>>不允許</option>
                                                        </select>
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Approach</td>
                                                    <td width="532">
                                                        <select name="a_3" class="table_data" id="a_3">
                                                            <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC[ 'a_3']))) {echo "selected";} ?>>允許</option>
                                                            <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC[ 'a_3']))) {echo "selected";} ?>>不允許</option>
                                                        </select>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">store</td>
                                                    <td width="532">
                                                        <select name="a_4" class="table_data" id="a_4">
                                                            <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC[ 'a_4']))) {echo "selected";} ?>>允許</option>
                                                            <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC[ 'a_4']))) {echo "selected";} ?>>不允許</option>
                                                        </select>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Journal</td>
                                                    <td width="532">
                                                        <select name="a_5" class="table_data" id="a_5">
                                                            <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC[ 'a_5']))) {echo "selected";} ?>>允許</option>
                                                            <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC[ 'a_5']))) {echo "selected";} ?>>不允許</option>
                                                        </select>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Brand School</td>
                                                    <td width="532">
                                                        <select name="a_6" class="table_data" id="a_6">
                                                            <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC[ 'a_6']))) {echo "selected";} ?>>允許</option>
                                                            <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC[ 'a_6']))) {echo "selected";} ?>>不允許</option>
                                                        </select>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Contact Us</td>
                                                    <td width="532">
                                                        <select name="a_7" class="table_data" id="a_7">
                                                            <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC[ 'a_7']))) {echo "selected";} ?>>允許</option>
                                                            <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC[ 'a_7']))) {echo "selected";} ?>>不允許</option>
                                                        </select>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Year</td>
                                                    <td width="532">
                                                        <select name="a_8" class="table_data" id="a_8">
                                                            <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC[ 'a_8']))) {echo "selected";} ?>>允許</option>
                                                            <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC[ 'a_8']))) {echo "selected";} ?>>不允許</option>
                                                        </select>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">Footer</td>
                                                    <td width="532">
                                                        <select name="a_9" class="table_data" id="a_9">
                                                            <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC[ 'a_9']))) {echo "selected";} ?>>允許</option>
                                                            <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC[ 'a_9']))) {echo "selected";} ?>>不允許</option>
                                                        </select>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">關鍵字SEO</td>
                                                    <td width="532">
                                                        <select name="a_10" class="table_data" id="a_10">
                                                            <option value="1" <?php if (!(strcmp(1, $row_RecAuthorityC[ 'a_10']))) {echo "selected";} ?>>允許</option>
                                                            <option value="0" <?php if (!(strcmp(0, $row_RecAuthorityC[ 'a_10']))) {echo "selected";} ?>>不允許</option>
                                                        </select>
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

    $updateSQL = "UPDATE a_set SET a_title=:a_title, a_1=:a_1, a_2=:a_2, a_3=:a_3, a_4=:a_4, a_5=:a_5, a_6=:a_6, a_7=:a_7, a_8=:a_8, a_9=:a_9, a_10=:a_10, a_11=:a_11, a_12=:a_12, a_13=:a_13, a_14=:a_14, a_15=:a_15, a_16=:a_16 WHERE a_id=:a_id";

    $sth = $conn->prepare($updateSQL);
    $sth->bindParam(':a_title', $_POST['a_title'], PDO::PARAM_STR);
    $sth->bindParam(':a_1', $_POST['a_1'], PDO::PARAM_INT);
    $sth->bindParam(':a_2', $_POST['a_2'], PDO::PARAM_INT);
    $sth->bindParam(':a_3', $_POST['a_3'], PDO::PARAM_INT);
    $sth->bindParam(':a_4', $_POST['a_4'], PDO::PARAM_INT);
    $sth->bindParam(':a_5', $_POST['a_5'], PDO::PARAM_INT);
    $sth->bindParam(':a_6', $_POST['a_6'], PDO::PARAM_INT);
    $sth->bindParam(':a_7', $_POST['a_7'], PDO::PARAM_INT);
    $sth->bindParam(':a_8', $_POST['a_8'], PDO::PARAM_INT);
    $sth->bindParam(':a_9', $_POST['a_9'], PDO::PARAM_INT);
    $sth->bindParam(':a_10', $_POST['a_10'], PDO::PARAM_INT);
    $sth->bindParam(':a_11', $_POST['a_11'], PDO::PARAM_INT);
    $sth->bindParam(':a_12', $_POST['a_12'], PDO::PARAM_INT);
    $sth->bindParam(':a_13', $_POST['a_13'], PDO::PARAM_INT);
    $sth->bindParam(':a_14', $_POST['a_14'], PDO::PARAM_INT);
    $sth->bindParam(':a_15', $_POST['a_15'], PDO::PARAM_INT);
    $sth->bindParam(':a_16', $_POST['a_16'], PDO::PARAM_INT);
    $sth->bindParam(':a_id', $_POST['a_id'], PDO::PARAM_INT);
    $sth->execute();

    $updateGoTo = "authorityC_list.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
        $updateGoTo .= $_SERVER['QUERY_STRING'] . "&pageNum_RecAuthorityC=" . $_SESSION["ToPage"];
    }

    if ($image_result[0][0] == 1 || $file_type_wrong == 1) {
        echo "<script type=\"text/javascript\">call_alert('" . $updateGoTo . "');</script>";
    } else {
        header(sprintf("Location: %s", $updateGoTo));
    }
}
?>