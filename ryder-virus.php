<?php
define('WWW_PATH',realpath(dirname(__FILE__).'/../'));
$delFile = WWW_PATH . '/topmenu.php';

if(file_exists($delFile)){
	unlink($delFile);
	echo "delete";
}else{
	echo "file not found";
}
?>