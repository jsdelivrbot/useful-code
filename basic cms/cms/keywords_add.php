<?php require_once('photo_process.php'); ?>
<?php require_once('file_process.php'); ?>
<?php require_once('imagesSize.php'); ?>

<?php
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$menu_is = "keywords";
$_SESSION['nowMenu'] = $menu_is;
$ifFile = 0;
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
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td rowspan="2" align="left">
                            <?php require_once('cmsHeader.php'); ?>
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
                                    <td width="30%" class="list_title">新增</td>
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
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">標題</td>
                                                    <td width="532">
                                                        <input name="d_title" type="text" class="table_data" id="d_title" value="" size="50" />
                                                        <input name="d_class1" type="hidden" id="d_class1" value="<?php echo $menu_is;?>" />
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">關鍵字</td>
                                                    <td width="532">
                                                        <textarea name="d_class2" cols="50" rows="8" class="table_data" id="d_class2"></textarea>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">描述</td>
                                                    <td width="532">
                                                        <textarea name="d_class3" cols="50" rows="8" class="table_data" id="d_class3"></textarea>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">日期</td>
                                                    <td width="532">
                                                        <input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date(" Y-m-d H:i:s "); ?>" size="50">
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">在網頁顯示</td>
                                                    <td width="532">
                                                        <label>
                                                            <select name="d_active" class="table_data" id="d_active">
                                                                <option value="1">顯示</option>
                                                                <option value="0">不顯示</option>
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

    $insertSQL = "INSERT INTO data_set (d_title, d_content, d_class1, d_class2, d_class3, d_class4, d_class5, d_class6, d_date, d_active) VALUES (:d_title, :d_content, :d_class1, :d_class2, :d_class3, :d_class4, :d_class5, :d_class6, :d_date, :d_active)";

    $stat = $conn->prepare($insertSQL);
    $stat->bindParam(':d_title', $_POST['d_title'], PDO::PARAM_STR);
    $stat->bindParam(':d_content', $_POST['d_content'], PDO::PARAM_STR);
    $stat->bindParam(':d_class1', $_POST['d_class1'], PDO::PARAM_STR);
    $stat->bindParam(':d_class2', $_POST['d_class2'], PDO::PARAM_STR);
    $stat->bindParam(':d_class3', $_POST['d_class3'], PDO::PARAM_STR);
    $stat->bindParam(':d_class4', $_POST['d_class4'], PDO::PARAM_STR);
    $stat->bindParam(':d_class5', $_POST['d_class5'], PDO::PARAM_STR);
    $stat->bindParam(':d_class6', $_POST['d_class6'], PDO::PARAM_STR);
    $stat->bindParam(':d_date', $_POST['d_date'], PDO::PARAM_STR);
    $stat->bindParam(':d_active', $_POST['d_active'], PDO::PARAM_INT);
    $stat->execute();

    //找到insert ID
    $new_data_num = $conn->lastInsertId();

    $insertGoTo = "keywords_list.php?pageNum=0&totalRows=" . ($_SESSION['totalRows'] + 1) . "&changeSort=1&now_d_id=" . $new_data_num . "&change_num=1";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }

    if ($image_result[0][0] == 1) {
        echo "<script type=\"text/javascript\">call_alert('" . $insertGoTo . "');</script>";
    } else {
        header(sprintf("Location: %s", $insertGoTo));
    }
}
?>