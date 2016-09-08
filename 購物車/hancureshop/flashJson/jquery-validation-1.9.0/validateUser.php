<?php require_once('../../Connections/connect2data.php'); ?>
<?php
include('../recordset2json.php');

/* RECEIVE VALUE */
$m_account = '';
if(isset($_POST['m_account'])){
	$m_account = $_POST['m_account'];
}else if(isset($_GET['m_account'])){
	$m_account = $_GET['m_account'];
}
// *** Redirect if username exists  
  $FF_dupKeySQL = "SELECT m_account FROM member_set WHERE m_account='" . $m_account . "'";
  mysql_select_db($database_connect2data, $connect2data);
  $FF_rsKey=mysql_query($FF_dupKeySQL, $connect2data) or die(mysql_error());

if(mysql_num_rows($FF_rsKey) == 0) {
	echo 'true';
}else{
	echo 'false';
}

?>