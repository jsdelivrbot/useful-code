<?php require_once('../Connections/connect2data.php'); ?>

<?php

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$menu_is="rooms";

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
                                    <td width="30%" class="list_title">新增分類</td>
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
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">分類名稱</td>
                                                    <td>
                                                        <input name="name" type="text" class="table_data" id="name" size="50">
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
                                                    <td width="532">
                                                        <label>
                                                            <select name="term_active" class="table_data" id="term_active">
                                                                <option value="1">公佈</option>
                                                                <option value="0">不公佈</option>
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

    $slug = urlencode($_POST['name']);

    $insertSQL = "INSERT INTO terms (name, slug, term_active) VALUES (:name, :slug, :term_active)";

    $sth = $conn->prepare($insertSQL);
    $sth->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $sth->bindParam(':slug', $slug, PDO::PARAM_STR);
    $sth->bindParam(':term_active', $_POST['term_active'], PDO::PARAM_INT);
    $sth->execute();


    //找到insert ID
    $new_data_num = $conn->lastInsertId();
    echo '<pre>'; print_r($new_data_num); echo '</pre>';


    $taxonomy_insertSQL = "INSERT INTO term_taxonomy (term_id, taxonomy) VALUES (:term_id, :taxonomy)";

    $taxonomy_sth = $conn->prepare($taxonomy_insertSQL);
    $taxonomy_sth->bindParam(':term_id', $new_data_num, PDO::PARAM_INT);
    $taxonomy_sth->bindParam(':taxonomy', $insertTemp = 'rooms', PDO::PARAM_STR);
    $taxonomy_sth->execute();


    $insertGoTo = "roomsT_list.php?pageNum=0&totalRows_RecroomsT=" . ($_SESSION['totalRows'] + 1) . "&changeSort=1&now_term_id=" . $new_data_num . "&change_num=1";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }

    header(sprintf("Location: %s", $insertGoTo));
}
?>