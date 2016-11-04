<?php

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

?>

<!-- form必加 enctype="multipart/form-data" -->
<form action="client_process.php" method="POST" enctype="multipart/form-data">

</form>