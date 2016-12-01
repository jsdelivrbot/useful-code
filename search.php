<?php
$query_RecWorks="SELECT * FROM client";

if ($_POST['name']=='' && $_POST['phone']=='' && $_POST['address']=='' && $_POST['company']=='' && $_POST['fruit']=='') {
	header('Location: client_search.php');
}else{
	$query_RecWorks.=" WHERE 1=1 ";
};

$search_array=[
	'name'=>$_POST['name'],
	'phone'=>$_POST['phone'],
	'address'=>$_POST['address'],
	'company'=>$_POST['company'],
	'fruit'=>$_POST['fruit']
];

foreach ($search_array as $key => $value) {
	if ($value!='') {
		$query_RecWorks.=" AND ";

		if ($key=='name') {
			$query_RecWorks.="nickname like '%".$_POST['name']."%' OR name like '%".$_POST['name']."%'";
		}else if($key=='fruit'){
			$query_RecWorks.="ask_fruit like '%".$_POST['fruit']."%' OR book_fruit like '%".$_POST['fruit']."%'";
		}else{
			$query_RecWorks.=$key." like '%".$value."%'";
		}
	}
}

$RecWorks = mysql_query($query_RecWorks, $connect2data) or die(mysql_error());
// $row_RecWorks = mysql_fetch_assoc($RecWorks);
$totalRows_RecWorks = mysql_num_rows($RecWorks);
?>