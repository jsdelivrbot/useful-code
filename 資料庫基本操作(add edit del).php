<?php

require_once 'connect2data.php';
mysql_select_db($database_connect2data, $connect2data);


if ($_POST['type']=='add'){
	$dirname = 'client_photo';

	//檢查目錄是否存在，沒有就創一個
	if (!is_dir($dirname)) {
		mkdir($dirname, 0777); //給最大權限 777
	}

	if (!$_FILES["photo"]["error"]) {
		$uploadfile = $dirname.'/'.basename($_FILES['photo']['name']);
		move_uploaded_file($_FILES['photo']['tmp_name'], iconv("utf-8", "big5", $uploadfile));
	}else{
		$uploadfile=null;
	}

	$insertSQL = sprintf("INSERT INTO client (nickname, name, phone, address, company, photo_link, client_date) VALUES (%s, %s, %s, %s, %s, %s, NOW())",
	                     GetSQLValueString($_POST['nickname'], "text"),
	                     GetSQLValueString($_POST['name'], "text"),
	                     GetSQLValueString($_POST['phone'], "text"),
	                     GetSQLValueString($_POST['address'], "text"),
	                     GetSQLValueString($_POST['company'], "text"),
	                     GetSQLValueString($uploadfile, "text"));
	$Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
	$message="新增";
}

if ($_POST['type']=='edit'){
	//刪除圖片
	unlink($_POST['src']);

	$dirname = 'client_photo';
	if (!$_FILES["photo"]["error"]) {
		$uploadfile = $dirname.'/'.basename($_FILES['photo']['name']);
		move_uploaded_file($_FILES['photo']['tmp_name'], iconv("utf-8", "big5", $uploadfile));
	}else{
		$uploadfile=null;
	}

	$updateSQL = sprintf("UPDATE client SET nickname=%s, name=%s, phone=%s, address=%s, company=%s, photo_link=%s, client_date=NOW() WHERE client_id=%s",
	                     GetSQLValueString($_POST['nickname'], "text"),
	                     GetSQLValueString($_POST['name'], "text"),
	                     GetSQLValueString($_POST['phone'], "text"),
	                     GetSQLValueString($_POST['address'], "text"),
	                     GetSQLValueString($_POST['company'], "text"),
	                     GetSQLValueString($uploadfile, "text"),
	                     GetSQLValueString($_POST['client_id'], "int"));

	$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	$message="修改";
}

if ($_POST['type']=='del'){
	//刪除圖片
	unlink($_POST['src']);

	$deleteSQL1 = sprintf("DELETE FROM client WHERE client_id='%s'",
 					     GetSQLValueString($_POST['client_id'], "int"));

	$deleteSQL2 = sprintf("DELETE FROM address WHERE address_client_id='%s'",
 					     GetSQLValueString($_POST['client_id'], "int"));

    $Result1 = mysql_query($deleteSQL1, $connect2data) or die(mysql_error());
    $Result2 = mysql_query($deleteSQL2, $connect2data) or die(mysql_error());
	$message="刪除";
}

if ($Result1) {
	header('Location: client_success.php?say='.$message);
}else{
	echo "請重新操作";
}

?>