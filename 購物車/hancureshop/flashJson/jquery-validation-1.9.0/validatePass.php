<?php require_once('../../Connections/connect2data.php'); ?>
<?php
include('../recordset2json.php');

/* RECEIVE VALUE */
$m_account = '';
if(isset($_POST['m_oldPassword'])){
	$m_oldPassword = $_POST['m_oldPassword'];
}else if(isset($_GET['m_oldPassword'])){
	$m_oldPassword = $_GET['m_oldPassword'];
}

$m_oldPassword  = md5($m_oldPassword );
// *** Redirect if username exists  
  $FF_dupKeySQL = "SELECT m_password FROM member_set WHERE m_password='" . $m_oldPassword . "'";
  mysql_select_db($database_connect2data, $connect2data);
  $FF_rsKey=mysql_query($FF_dupKeySQL, $connect2data) or die(mysql_error());

if(mysql_num_rows($FF_rsKey) == 0) {
	echo 'false';
}else{
	echo 'true';
}

?>