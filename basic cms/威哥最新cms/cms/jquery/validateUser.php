<?php require_once('../../Connections/connect2data.php'); ?>
<?php
//include('../recordset2json.php');

/* RECEIVE VALUE */
$user_account = '-1';
if(isset($_REQUEST['user_account'])){
	$user_account = $_REQUEST['user_account'];
}


// *** Redirect if username exists  
  $FF_dupKeySQL = "SELECT user_account FROM `admin` WHERE user_account='" . $user_account . "'";
  
  $FF_rsKey = mysql_query($FF_dupKeySQL, $connect2data) or die(mysql_error($connect2data));

  //$FF_rsKey = mysql_query($connect2data, $FF_dupKeySQL) or die(mysql_error($connect2data));

  $totalRows = mysql_num_rows($FF_rsKey);

  //echo $FF_dupKeySQL;

if($totalRows == 0) {
	echo 'true';
}else{
	echo 'false';
}

?>