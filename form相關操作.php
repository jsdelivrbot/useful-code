<!--============================
=            檢查是否空值            =
=============================-->
<form action="search.php" method="GET" id="footerForm" onSubmit="return(check_empty(this))">

<script>
  window.check_empty = function (e) {
    var _t = $(e).find(":text").val()
    if (_t == '') {
        alert('請輸入關鍵字')
        return false;
    }else{
        return true;
    }
  }
</script>


<!--==================================
=            form二度確認            =
===================================-->
<form action="client_process.php" method="POST" enctype="multipart/form-data" onSubmit="return(confirm('確認要送出本表單嗎？'))">


<!--=====================================
=            form action自己            =
======================================-->
<?php
//==========================================================

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
    $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")  &&  $go_post==true ) {
    $insertSQL = sprintf("INSERT INTO guestbook (g_name ,g_email ,g_private , g_title, g_content, g_date) VALUES (%s, %s, %s, %s, %s, %s)",
        GetSQLValueString($_POST['name'], "text"),
        GetSQLValueString($_POST['email'], "text"),
        GetSQLValueString($_POST['private'], "int"),
        GetSQLValueString($_POST['topic'], "text"),
        GetSQLValueString($_POST['content'], "text"),
        GetSQLValueString($_POST['date'], "date"));

    mysql_select_db($database_connectPrince, $connectPrince);
    $Result1 = mysql_query($insertSQL, $connectPrince) or die(mysql_error());

    $insertGoTo = "message.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

//==========================================================
?>

<form action="<?php echo $editFormAction; ?>" method="post" name="form1">
    <input type="text" size="10" id="blog-input" name="blog-input" placeholder="搜尋">
    <input type="hidden" name="MM_insert" value="form1" />
    <input name="submit" type="submit" value="GO">
</form>