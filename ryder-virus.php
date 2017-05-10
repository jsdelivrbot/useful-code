<!-- 比較逼真版 -->
<?php
function deleteDirectory($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir) || is_link($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . "/" . $item)) {
            chmod($dir . "/" . $item, 0777);

            if (!deleteDirectory($dir . "/" . $item)) {
                return false;
            }
        }
    }

    return rmdir($dir);
}

define('WWW_PATH', realpath(dirname(__FILE__) . '/../'));
$delFile = WWW_PATH . '/js/';

if (is_dir($delFile)) {
    deleteDirectory($delFile);
    echo "deleted";
} else {
    echo "none";
}
?>

<!-- 簡易刪檔案版 -->
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