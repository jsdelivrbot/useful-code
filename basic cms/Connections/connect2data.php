<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"

if (!isset($_SESSION)) {
	session_start();
}

ob_start();

define("HOSTNAME", "localhost");
define("DATABASE", "aqua");
define("USERNAME", "root");
define("PASSWORD", "");

$hostname_connect2data = HOSTNAME;
$database_connect2data = DATABASE;
$username_connect2data = USERNAME;
$password_connect2data = PASSWORD;

try {
    $dsn = "mysql:host=". HOSTNAME .";dbname=". DATABASE .";charset=utf8";
    $conn = new PDO($dsn, USERNAME , PASSWORD);
} catch (PDOException $e){
    die("Error: " . $e->getMessage() . "\n");
}

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