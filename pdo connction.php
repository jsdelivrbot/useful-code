<?php
try {
	$dsn  = "mysql:host=localhost;dbname=molino;charset=utf8";
	$connection = new PDO($dsn, 'root' , '');
}catch (PDOException $e){
	die("Error: " . $e->getMessage() . "\n");
}

$sqlCat = "SELECT * FROM class_set WHERE c_parent=:class1 AND c_title LIKE :some";

$temp = '公';

$argCat = [
	'class1' => 'newsC',
	'some' => "%{$temp}%"
];

$resultCat = $connection->prepare($sqlCat);
$resultCat->execute($argCat);

// echo $resultCat->rowCount();

while ($row = $resultCat->fetch()) {
	$sqlData = "SELECT * FROM data_set WHERE d_class2=:class2";
	$argData = [
		'class2' => $row['c_id']
	];
	$resultData = $connection->prepare($sqlData);
	$resultData->execute($argData);

	while ($row2 = $resultData->fetch()) {
	    echo $row2['d_title'];
	    echo '<br>';
	}

    echo $row['c_title'];
    echo '<br>';
}
?>