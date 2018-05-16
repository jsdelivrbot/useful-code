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

$stat = $conn->prepare($sql);

$name = '王小明';
$mail = 'aaa@gmail.com';
$home = '台南縣新化區中正路1號';
$message = '第 1 筆資料';

$stat->bindParam(':name', $name, PDO::PARAM_STR);
$stat->bindParam(':mail', $mail, PDO::PARAM_STR);
$stat->bindParam(':home', $home, PDO::PARAM_STR);
$stat->bindParam(':message', $message, PDO::PARAM_STR);
$stat->execute();
?>

<!-- 基本用法 -->
<?php
try {
	$dsn = "mysql:host=localhost;dbname=molino;charset=utf8";
	$conn = new PDO($dsn, 'root' , '');
}catch (PDOException $e){
	die("Error: " . $e->getMessage() . "\n");
}

$sqlCat = "SELECT * FROM class_set WHERE c_parent=:class1 AND c_title LIKE :some";

$temp = '公';

$argCat = [
	'class1' => 'newsC',
	'some' => "%{$temp}%"
];

$statCat = $conn->prepare($sqlCat);
$statCat->execute($argCat);

// echo $statCat->rowCount();

while ($row = $statCat->fetch()) {
	$sqlData = "SELECT * FROM data_set WHERE d_class2=:class2";
	$argData = [
		'class2' => $row['c_id']
	];
	$statData = $conn->prepare($sqlData);
	$statData->execute($argData);

	while ($row2 = $statData->fetch()) {
	    echo $row2['d_title'];
	    echo '<br>';
	}

    echo $row['c_title'];
    echo '<br>';
}

// 這樣應該也可以
foreach ($statCat as $row_RecWorks){}
foreach ($statCat->fetchAll(PDO::FETCH_ASSOC) as $row_RecWorks){}
?>