<!-- 另一個 DBI -->
https://github.com/jpfuentes2/php-activerecord

<!-- 比較 PDO bindParam 和 bindValue 的不同 -->
http://ps.hsuweni.idv.tw/?p=5006

<!-- 常用type -->
http://php.net/manual/zh/pdo.constants.php

<!-- 指定變數型態 -->
<?php
// PDO::PARAM_BOOL
// PDO::PARAM_NULL
// PDO::PARAM_INT
// PDO::PARAM_STR

$sth = $conn->prepare($sql);

$name = '王小明';
$mail = 'aaa@gmail.com';
$home = '台南縣新化區中正路1號';
$message = '第 1 筆資料';

$sth->bindParam(':name', $name, PDO::PARAM_STR);
$sth->bindParam(':mail', $mail, PDO::PARAM_STR);
$sth->bindParam(':home', $home, PDO::PARAM_STR);
$sth->bindParam(':message', $message, PDO::PARAM_STR);
$sth->execute();
?>

<!-- connection -->
<?php
if (!isset($_SESSION)) {
	session_start();
}

ob_start();

ini_set('date.timezone', 'Asia/Taipei');

define("HOSTNAME", "localhost");
define("DATABASE", "aqua");
define("USERNAME", "root");
define("PASSWORD", "");

try {
	$dsn = "mysql:host=". HOSTNAME .";dbname=". DATABASE .";charset=utf8";
	$conn = new PDO($dsn, USERNAME , PASSWORD);
} catch (PDOException $e){
	die("Error: " . $e->getMessage() . "\n");
}
?>

<!-- 基本用法 -->
<?php
$sqlCat = "SELECT * FROM class_set WHERE c_parent=:class1 AND c_title LIKE :some";

$temp = '公';

$argCat = [
	'class1' => 'newsC',
	'some' => "%{$temp}%"
];

$sthCat = $conn->prepare($sqlCat);
$sthCat->execute($argCat);

// totalRows
echo $sthCat->rowCount();

while ($row = $sthCat->fetch()) {
	$sqlData = "SELECT * FROM data_set WHERE d_class2=:class2";
	$argData = [
		'class2' => $row['c_id']
	];
	$sthData = $conn->prepare($sqlData);
	$sthData->execute($argData);

	while ($row2 = $sthData->fetch()) {
	    echo $row2['d_title'];
	    echo '<br>';
	}

    echo $row['c_title'];
    echo '<br>';
}

// 這樣應該也可以
foreach ($sthCat as $row_RecWorks){}
foreach ($sthCat->fetchAll(PDO::FETCH_ASSOC) as $row_RecWorks){}

// bindParam 一定要用變數 如果沒有可在裡面宣告
$sth->bindParam(':file_type', $type = 'image', PDO::PARAM_STR);

//找到insert ID
$new_data_num = $conn->lastInsertId();

// insert sql
$insertSQL = "INSERT INTO data_set (d_title, d_content, d_class1, d_class2, d_class3, d_class4, d_class5, d_class6, d_date, d_active) VALUES (:d_title, :d_content, :d_class1, :d_class2, :d_class3, :d_class4, :d_class5, :d_class6, :d_date, :d_active)";

$sth = $conn->prepare($insertSQL);
$sth->bindParam(':d_title', $_POST['d_title'], PDO::PARAM_STR);
$sth->bindParam(':d_content', $_POST['d_content'], PDO::PARAM_STR);
$sth->bindParam(':d_class1', $_POST['d_class1'], PDO::PARAM_STR);
$sth->bindParam(':d_class2', $_POST['d_class2'], PDO::PARAM_STR);
$sth->bindParam(':d_class3', $_POST['d_class3'], PDO::PARAM_STR);
$sth->bindParam(':d_class4', $_POST['d_class4'], PDO::PARAM_STR);
$sth->bindParam(':d_class5', $_POST['d_class5'], PDO::PARAM_STR);
$sth->bindParam(':d_class6', $_POST['d_class6'], PDO::PARAM_STR);
$sth->bindParam(':d_date', $_POST['d_date'], PDO::PARAM_STR);
$sth->bindParam(':d_active', $_POST['d_active'], PDO::PARAM_INT);
$sth->execute();

// update sql
$updateSQL = "UPDATE data_set SET d_title=:d_title, d_content=:d_content, d_class2=:d_class2, d_class3=:d_class3, d_class4=:d_class4, d_class5=:d_class5, d_class6=:d_class6, d_date=:d_date, d_active=:d_active WHERE d_id=:d_id";

$sth = $conn->prepare($updateSQL);
$sth->bindParam(':d_title', $_POST['d_title'], PDO::PARAM_STR);
$sth->bindParam(':d_content', $_POST['d_content'], PDO::PARAM_STR);
$sth->bindParam(':d_class2', $_POST['d_class2'], PDO::PARAM_STR);
$sth->bindParam(':d_class3', $_POST['d_class3'], PDO::PARAM_STR);
$sth->bindParam(':d_class4', $_POST['d_class4'], PDO::PARAM_STR);
$sth->bindParam(':d_class5', $_POST['d_class5'], PDO::PARAM_STR);
$sth->bindParam(':d_class6', $_POST['d_class6'], PDO::PARAM_STR);
$sth->bindParam(':d_date', $_POST['d_date'], PDO::PARAM_STR);
$sth->bindParam(':d_active', $_POST['d_active'], PDO::PARAM_INT);
$sth->bindParam(':d_id', $_POST['d_id'], PDO::PARAM_INT);
$sth->execute();

// delete sql
$deleteSQL = "DELETE FROM file_set WHERE file_d_id=:file_d_id";

$sth = $conn->prepare($deleteSQL);
$sth->bindParam(':file_d_id', $_POST['d_id'], PDO::PARAM_INT);
$sth->execute();
?>

<!-- 基本用法 -->
<?php
require_once 'Connections/connect2data.php';

$banner = $conn->query("SELECT * FROM data_set, file_set WHERE d_class1='banner' AND d_title='news' AND d_id=file_d_id AND file_type='bannerCover' AND d_active=1 ORDER BY d_sort ASC")->fetch();

$ryder_cat = (isset($_GET['c'])) ? $_GET['c'] : 0;

$sql = "SELECT * FROM data_set, file_set, class_set WHERE d_class1='news' AND (d_class2 = :d_class2 || :d_class2 = 0) AND d_id=file_d_id AND file_type='newsCover' AND d_class2=c_id AND c_parent='newsC' AND d_active=1 ORDER BY d_sort ASC";
$work = $conn->prepare($sql);
$work->bindParam(':d_class2', $ryder_cat, PDO::PARAM_INT);
$work->execute();
?>


<!-- if you use pdo class -->
https://github.com/lincanbin/PHP-PDO-MySQL-Class

<?php
$work = $DB->query("SELECT * FROM data_set WHERE d_class1=? AND d_active=1", ['products']);

// detail 只load一筆
$row = $DB->row("SELECT * FROM data_set WHERE d_id=? AND d_active=1", [$id]);

$DB->lastInsertId();
$DB->querycount;
?>