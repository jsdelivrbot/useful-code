<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('photo_process.php'); ?>
<?php require_once('file_process.php'); ?>
<?php require_once('imagesSize.php'); ?>

<?php
if (!1) {
    header("Location: store_list.php");
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$G_selected1 = '';
if (isset($_SESSION['selected_storeC'])) {
    $G_selected1 = $_SESSION['selected_storeC'];
}

$query_RecstoreC = "SELECT * FROM class_set WHERE c_parent = 'storeC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecstoreC = $conn->query($query_RecstoreC);
$row_RecstoreC = $RecstoreC->fetch();
$totalRows_RecstoreC = $RecstoreC->rowCount();

$query_RecstoreY = "SELECT * FROM class_set WHERE c_parent = 'storeY' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecstoreY = $conn->query($query_RecstoreY);
$row_RecstoreY = $RecstoreY->fetch();
$totalRows_RecstoreY = $RecstoreY->rowCount();

$menu_is = "store";
$_SESSION['nowMenu'] = $menu_is;
$ifFile = 1;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php require_once('cmsTitle.php'); ?></title>

    <link rel="stylesheet" href="jquery/chosen_v1.8.5/chosen.css">

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
                                            <table width="100%" border="0" cellpadding="5" cellspacing="3">
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">分類</td>
                                                    <td>
                                                        <select name="d_class2" id="d_class2" class="chosen-select">
                                                            <?php do { ?>
                                                            <option value="<?php echo $row_RecstoreC['c_id']?>" <?php if (!(strcmp($row_RecstoreC[ 'c_id'], $G_selected1))) {echo "selected";} ?>>
                                                                <?php echo $row_RecstoreC['c_title']?>
                                                            </option>
                                                            <?php
                                                            } while ($row_RecstoreC = $RecstoreC->fetch());
                                                            $rows = $RecstoreC->rowCount();
                                                            if($rows > 0) {
                                                                $RecstoreC->execute();
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">名稱</td>
                                                    <td>
                                                        <input name="d_title" type="text" class="table_data" id="d_title" size="80" />
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">地址</td>
                                                    <td>
                                                        <input name="d_class3" type="text" class="table_data" id="d_class3" size="80" />
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">電話</td>
                                                    <td>
                                                        <input name="d_class4" type="text" class="table_data" id="d_class4" size="80" />
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">營業時間</td>
                                                    <td>
                                                        <input name="d_class5" type="text" class="table_data" id="d_class5" size="80" />
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">經緯度</td>
                                                    <td>
                                                        <input name="d_class6" type="text" class="table_data" id="d_class6" size="80" />
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">是否提供</td>
                                                    <td class="table_data">
                                                        <div class="perm" id="perm_1">
                                                            <label for="perm_coffee">
                                                                <input name="perm_coffee" type="checkbox" id="perm_coffee" value="1"> 咖啡
                                                            </label>
                                                            <label for="perm_brand">
                                                                <input name="perm_brand" type="checkbox" id="perm_brand" value="1"> 麵包
                                                            </label>
                                                            <label for="perm_wifi">
                                                                <input name="perm_wifi" type="checkbox" id="perm_wifi" value="1"> wifi
                                                            </label>
                                                            <label for="perm_resturant">
                                                                <input name="perm_resturant" type="checkbox" id="perm_resturant" value="1"> 餐廳
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <!-- <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">內容</td>
                                                    <td><textarea name="d_content" cols="100" rows="20" class="table_data tiny" id="d_content"></textarea></td>
                                                    <td bgcolor="#e5ecf6" class="table_col_title"><p class="red_letter">*小斷行請按Shift+Enter。<br />
                                                    輸入區域的右下角可以調整輸入空間的大小。</p></td>
                                                </tr> -->
                                                <tr>
                                                    <td width="200" align="center" bgcolor="#e5ecf6" class="table_col_title">時間</td>
                                                    <td>
                                                        <input name="d_date" type="text" class="table_data" id="d_date" value="<?php echo date(" Y-m-d H:i:s "); ?>" size="50" />
                                                    </td>
                                                    <td width="250" bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">狀態</td>
                                                    <td>
                                                        <label>
                                                            <select name="d_active" class="table_data" id="d_active">
                                                                <option value="1">公佈</option>
                                                                <option value="0">不公佈</option>
                                                            </select>
                                                        </label>
                                                    </td>
                                                    <td bgcolor="#e5ecf6">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">
                                                        <p>上傳封面圖片</p>
                                                    </td>
                                                    <td>
                                                        <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data">
                                                            <tr>
                                                                <td> <span class="table_data">選擇圖片：</span>
                                                                    <input name="imageCover[]" type="file" class="table_data" id="imageCover1" />
                                                                    <br>
                                                                    <span class="table_data">圖片說明：</span>
                                                                    <input name="imageCover_title[]" type="text" class="table_data" id="imageCover_title1"> </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td bgcolor="#e5ecf6" class="table_col_title">
                                                        <p class="red_letter">*
                                                            <?php echo $imagesSize['storeCover']['note'];?>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">
                                                        <p>上傳圖片</p>
                                                    </td>
                                                    <td>
                                                        <table width="100%" border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable">
                                                            <tr>
                                                                <td> <span class="table_data">選擇圖片：</span>
                                                                    <input name="image[]" type="file" class="table_data" id="image1" />
                                                                    <br>
                                                                    <span class="table_data">圖片說明：</span>
                                                                    <input name="image_title[]" type="text" class="table_data" id="image_title1"> </td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%" border="0" cellspacing="5" cellpadding="2">
                                                            <tr>
                                                                <td height="28">
                                                                    <table border="0" cellspacing="2" cellpadding="2">
                                                                        <tr>
                                                                            <td><a href="javascript:addField()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                                                            <td><a href="javascript:addField()" class="table_data">新增圖片</a></td>
                                                                            <td class="red_letter">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td bgcolor="#e5ecf6" class="table_col_title">
                                                        <p class="red_letter">*
                                                            <?php echo $imagesSize[$_SESSION['nowMenu']]['note'];?>
                                                        </p>
                                                    </td>
                                                </tr>
                                                <?php if($ifFile){ ?>
                                                <tr>
                                                    <td align="center" bgcolor="#e5ecf6" class="table_col_title">
                                                        <p>上傳檔案</p>
                                                    </td>
                                                    <td>
                                                        <table border="0" cellpadding="2" cellspacing="2" bordercolor="#CCCCCC" class="data" id="pTable2">
                                                            <tr>
                                                                <td> <span class="table_data">選擇檔案：</span>
                                                                    <input name="upfile[]" type="file" class="table_data" id="upfile1" />
                                                                    <br>
                                                                    <span class="table_data">檔案說明：</span>
                                                                    <input name="upfile_title[]" type="text" class="table_data" id="upfile_title1"> </td>
                                                            </tr>
                                                        </table>
                                                        <table width="100%" border="0" cellspacing="5" cellpadding="2">
                                                            <tr>
                                                                <td>
                                                                    <table border="0" cellspacing="2" cellpadding="2">
                                                                        <tr>
                                                                            <td width="16"><a href="javascript:addField2()"><img src="image/add.png" width="16" height="16" border="0"></a></td>
                                                                            <td width="48"><a href="javascript:addField2()" class="table_data">新增檔案</a></td>
                                                                            <td width="390" class="red_letter">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td bgcolor="#e5ecf6" class="table_col_title">
                                                        <p><span class="red_letter">*上傳之檔案請勿超過2M。</span></p>
                                                    </td>
                                                </tr>
                                                <?php } ?>
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

<script src="jquery/chosen_v1.8.5/chosen.jquery.js"></script>

<script type="text/javascript">
    $(".chosen-select").chosen({
        disable_search_threshold: 6,
        no_results_text: "找不到資料。 目前輸入的是:",
        placeholder_text_single: "尚未新增分類",
        width: "auto"
    });

    function call_alert(link_url) {
        alert("上傳得檔案中，有的不是圖片!");
        window.location = link_url;
    }

    function addField() {
        var pTable = document.getElementById('pTable');
        var lastRow = pTable.rows.length;
        var myField = document.getElementById('image' + lastRow);
        if (myField.value) {
            var aTr = pTable.insertRow(lastRow);
            var newRow = lastRow + 1;
            var newImg = 'img' + (newRow);
            var aTd1 = aTr.insertCell(0);
            aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="image[]" type="file" class="table_data" id="image' + newRow + '"><br><span class="table_data">圖片說明： </span><input name="image_title[]" type="text" class="table_data" id="image_title' + newRow + '">';
        } else {
            alert("尚有未選取之圖片欄位!!");
        }
    }

    function addField2() {
        var pTable2 = document.getElementById('pTable2');
        var lastRow = pTable2.rows.length;
        var myField = document.getElementById('upfile' + lastRow);
        if (myField.value) {
            var aTr = pTable2.insertRow(lastRow);
            var newRow = lastRow + 1;
            var newFile = 'file' + (newRow);
            var aTd1 = aTr.insertCell(0);
            aTd1.innerHTML = '<span class="table_data">選擇檔案： </span><input name="upfile[]" type="file" class="table_data" id="upfile' + newRow + '"><br><span class="table_data">檔案說明： </span><input name="upfile_title[]" type="text" class="table_data" id="upfile_title' + newRow + '">';
        } else {
            alert("尚有未選取之檔案欄位!!");
        }
    }

    function addFieldIndex() {
        var pTable = document.getElementById('pTableIndex');
        var lastRow = pTable.rows.length;
        var myField = document.getElementById('indexImage' + lastRow);
        if (myField.value) {
            var aTr = pTable.insertRow(lastRow);
            var newRow = lastRow + 1;
            var newImg = 'img' + (newRow);
            var aTd1 = aTr.insertCell(0);
            aTd1.innerHTML = '<span class="table_data">選擇圖片： </span><input name="indexImage[]" type="file" class="table_data" id="indexImage' + newRow + '"><br><span class="table_data">圖片說明： </span><input name="indexImage_title[]" type="text" class="table_data" id="indexImage_title' + newRow + '">';
        } else {
            alert("尚有未選取之圖片欄位!!");
        }
    }
</script>

<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {

    $insertSQL = "INSERT INTO data_set (d_title, d_content, d_class1, d_class2, d_class3, d_class4, d_class5, d_class6, d_data1, d_data2, d_data3, d_data4, d_date, d_active) VALUES (:d_title, :d_content, :d_class1, :d_class2, :d_class3, :d_class4, :d_class5, :d_class6, :d_data1, :d_data2, :d_data3, :d_data4, :d_date, :d_active)";

    $stat = $conn->prepare($insertSQL);
    $stat->bindParam(':d_title', $_POST['d_title'], PDO::PARAM_STR);
    $stat->bindParam(':d_content', $_POST['d_content'], PDO::PARAM_STR);
    $stat->bindParam(':d_class1', $class1 = 'store', PDO::PARAM_STR);
    $stat->bindParam(':d_class2', $_POST['d_class2'], PDO::PARAM_STR);
    $stat->bindParam(':d_class3', $_POST['d_class3'], PDO::PARAM_STR);
    $stat->bindParam(':d_class4', $_POST['d_class4'], PDO::PARAM_STR);
    $stat->bindParam(':d_class5', $_POST['d_class5'], PDO::PARAM_STR);
    $stat->bindParam(':d_class6', $_POST['d_class6'], PDO::PARAM_STR);
    $stat->bindParam(':d_data1', $_POST['perm_coffee'], PDO::PARAM_INT);
    $stat->bindParam(':d_data2', $_POST['perm_brand'], PDO::PARAM_INT);
    $stat->bindParam(':d_data3', $_POST['perm_wifi'], PDO::PARAM_INT);
    $stat->bindParam(':d_data4', $_POST['perm_resturant'], PDO::PARAM_INT);
    $stat->bindParam(':d_date', $_POST['d_date'], PDO::PARAM_STR);
    $stat->bindParam(':d_active', $_POST['d_active'], PDO::PARAM_INT);
    $stat->execute();

    //----------插入圖片資料到資料庫begin(須放入插入主資料後)----------

    //找到insert ID
    $new_data_num = $conn->lastInsertId();

    //一般附圖
    $image_result = image_process($conn, $_FILES['image'], $_REQUEST['image_title'], $menu_is, "add", $imagesSize[$_SESSION['nowMenu']]['IW'], $imagesSize[$_SESSION['nowMenu']]['IH']);

    for ($j = 1; $j < count($image_result); $j++) {
        $insertSQL = "INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (:file_name, :file_link1, :file_link2, :file_link3, :file_type, :file_d_id, :file_title, :file_show_type)";

        $stat = $conn->prepare($insertSQL);
        $stat->bindParam(':file_name', $image_result[$j][0], PDO::PARAM_STR);
        $stat->bindParam(':file_link1', $image_result[$j][1], PDO::PARAM_STR);
        $stat->bindParam(':file_link2', $image_result[$j][2], PDO::PARAM_STR);
        $stat->bindParam(':file_link3', $image_result[$j][3], PDO::PARAM_STR);
        $stat->bindParam(':file_type', $type = 'image', PDO::PARAM_STR);
        $stat->bindParam(':file_d_id', $new_data_num, PDO::PARAM_INT);
        $stat->bindParam(':file_title', $image_result[$j][4], PDO::PARAM_STR);
        $stat->bindParam(':file_show_type', $image_result[$j][5], PDO::PARAM_INT);
        $stat->execute();

        $_SESSION["change_image"] = 1;
    }

    // Cover
    $image_result = image_process($conn, $_FILES['imageCover'], $_REQUEST['imageCover_title'], $menu_is, "add", $imagesSize['storeCover']['IW'], $imagesSize['storeCover']['IH']);

    for ($j = 1; $j < count($image_result); $j++) {
        $insertSQL = "INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_type, file_d_id, file_title, file_show_type) VALUES (:file_name, :file_link1, :file_link2, :file_link3, :file_type, :file_d_id, :file_title, :file_show_type)";

        $stat = $conn->prepare($insertSQL);
        $stat->bindParam(':file_name', $image_result[$j][0], PDO::PARAM_STR);
        $stat->bindParam(':file_link1', $image_result[$j][1], PDO::PARAM_STR);
        $stat->bindParam(':file_link2', $image_result[$j][2], PDO::PARAM_STR);
        $stat->bindParam(':file_link3', $image_result[$j][3], PDO::PARAM_STR);
        $stat->bindParam(':file_type', $type = 'storeCover', PDO::PARAM_STR);
        $stat->bindParam(':file_d_id', $new_data_num, PDO::PARAM_INT);
        $stat->bindParam(':file_title', $image_result[$j][4], PDO::PARAM_STR);
        $stat->bindParam(':file_show_type', $image_result[$j][5], PDO::PARAM_INT);
        $stat->execute();

        $_SESSION["change_image"] = 1;
    }
    //----------插入圖片資料到資料庫end----------

    //----------插入檔案資料到資料庫begin(須放入插入主資料後)----------
    if ($ifFile) {
        $file_result = file_process($conn, "storeFile", "add");

        for ($j = 0; $j < count($file_result); $j++) {
            $insertSQL = "INSERT INTO file_set (file_name, file_link1, file_type, file_d_id, file_title) VALUES (:file_name, :file_link1, :file_type, :file_d_id, :file_title)";

            $stat = $conn->prepare($insertSQL);
            $stat->bindParam(':file_name', $file_result[$j][0], PDO::PARAM_STR);
            $stat->bindParam(':file_link1', $file_result[$j][1], PDO::PARAM_STR);
            $stat->bindParam(':file_type', $type = 'file', PDO::PARAM_STR);
            $stat->bindParam(':file_d_id', $new_data_num, PDO::PARAM_STR);
            $stat->bindParam(':file_title', $file_result[$j][2], PDO::PARAM_STR);
            $stat->execute();
        }
    }
    //----------插入檔案資料到資料庫end----------

    $_SESSION['original_selected'] = $_SESSION['selected_storeC'];
    $insertGoTo = "store_list.php?selected1=" . $_POST['d_class2'] . "&pageNum=0&totalRows=" . ($_SESSION['totalRows'] + 1) . "&changeSort=1&now_d_id=" . $new_data_num . "&change_num=1";

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