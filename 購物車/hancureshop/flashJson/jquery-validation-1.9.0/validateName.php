<?php require_once('../../Connections/connect2data.php'); ?>
<?php
include('../recordset2json.php');

/* RECEIVE VALUE */
$m_name = '';
if(isset($_POST['m_name'])){
	$m_name = $_POST['m_name'];
}else if(isset($_GET['m_name'])){
	$m_name = $_GET['m_name'];
}
// *** Redirect if username exists  
  //$FF_dupKeySQL = "SELECT client FROM order_set WHERE client='" . $m_name . "'";
  $FF_dupKeySQL =  "SELECT client AS Name, SubTotalAll AS SubTotal, SUM( `SubTotalAll` ) AS Total, COUNT( `client` ) AS Times FROM order_set WHERE binary client = '$m_name' GROUP BY Name HAVING Total >=  '1000'";
  mysql_select_db($database_connect2data, $connect2data);
  $FF_rsKey=mysql_query($FF_dupKeySQL, $connect2data) or die(mysql_error());

if(mysql_num_rows($FF_rsKey) > 0) {
	echo 'true';
}else{
	echo 'false';
}

?>