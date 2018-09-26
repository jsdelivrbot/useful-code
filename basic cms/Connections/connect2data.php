<?php

if (!isset($_SESSION)) {
	session_start();
}

ob_start();


// 後台懶得改成用class的方式
define("HOSTNAME", "localhost");
define("DATABASE", "mounts");
define("USERNAME", "root");
define("PASSWORD", "");

try {
    $dsn = "mysql:host=". HOSTNAME .";dbname=". DATABASE .";charset=utf8";
    $conn = new PDO($dsn, USERNAME , PASSWORD);
} catch (PDOException $e){
    die("Error: " . $e->getMessage() . "\n");
}


// 前台用包好的class比較方便 (可能吧....)
require(__DIR__ . "/PDO.class.php");
$DB = new Db(HOSTNAME, DATABASE, USERNAME, PASSWORD);


// 後台有些地方會用到
$selfPage = basename($_SERVER['PHP_SELF']);

function checkV($d) {
    return (isset($_REQUEST[$d])) ? $_REQUEST[$d] : NULL;
}

function moneyFormat($data, $n = 0) {
    $data1 = number_format(substr($data, 0, strrpos($data, ".") == 0 ? strlen($data) : strrpos($data, ".")));
    $data2 = substr(strrchr($data, "."), 1);
    if ($data2 == 0) {
        $data3 = "";
    } else {
        if (strlen($data2) > $n) {
            $data3 = substr($data2, 0, $n);
        } else {
            $data3 = $data2;
        }

        $data3 = "." . $data3;
    }
    return $data1;
}

?>