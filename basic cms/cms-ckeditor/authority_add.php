<?php require_once('../Connections/connect2data.php'); ?>

<?php
$menu_is = "authority";

$editFormAction = $_SERVER['PHP_SELF'];

if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$query_RecLevel = "SELECT * FROM a_set ORDER BY a_id ASC";
$RecLevel = $conn->query($query_RecLevel);
$row_RecLevel = $RecLevel->fetch();
$totalRows_RecLevel = $RecLevel->rowCount();

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
                                    <td width="300" class="list_title">新增管理員</td>
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
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">管理員帳號</td>
                                                    <td width="532">
                                                        <input name="user_name" type="text" class="table_data" id="user_name" value="" size="50" />
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">管理員密碼</td>
                                                    <td width="532">
                                                        <input name="user_password" type="password" class="table_data" id="user_password" value="" size="50" />
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">管理種類</td>
                                                    <td width="532">
                                                        <select name="user_level" class="table_data" id="user_level">
                                                            <?php do { ?>
                                                                <option value="<?php echo $row_RecLevel['a_id']?>">
                                                                    <?php echo $row_RecLevel['a_title'] ?>
                                                                </option>
                                                            <?php
                                                            } while ($row_RecLevel = $RecLevel->fetch());
                                                                $rows = $RecLevel->rowCount();
                                                                if($rows > 0) {
                                                                  $RecLevel->execute();
                                                                }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">帳號是否有效</td>
                                                    <td width="532">
                                                        <select name="user_active" class="table_data" id="user_active">
                                                            <option value="1">有效</option>
                                                            <option value="0">無效</option>
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
                                <input type="hidden" name="MM_insert" value="form1" />
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
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

    $insertSQL = "INSERT INTO admin (user_name, user_password, user_level, user_active) VALUES (:user_name, :user_password, :user_level, :user_active)";

    $sth = $conn->prepare($insertSQL);
    $sth->bindParam(':user_name', $_POST['user_name'], PDO::PARAM_STR);
    $sth->bindParam(':user_password', $_POST['user_password'], PDO::PARAM_STR);
    $sth->bindParam(':user_level', $_POST['user_level'], PDO::PARAM_INT);
    $sth->bindParam(':user_active', $_POST['user_active'], PDO::PARAM_INT);
    $sth->execute();

    $insertGoTo = "authority_list.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }

    if ($image_result[0][0] == 1 || $file_type_wrong == 1) {
        echo "<script type=\"text/javascript\">call_alert('" . $insertGoTo . "');</script>";
    } else {
        header(sprintf("Location: %s", $insertGoTo));
    }
}
?>