<?php 
require_once('../Connections/connect2data.php');

if (!isset($_SESSION)) {
	session_start();
}
if (isset($_REQUEST['pub']))
{
	$act = ($_REQUEST['pub']==1) ? '0' : '1' ;
	
	$sql= "UPDATE data_set SET d_pub='".$act."' WHERE d_id='".$_REQUEST['d_id']."'";
	
	mysql_select_db($database_connect2data, $connect2data);
	mysql_query($sql) or die("無法送出" . mysql_error( ));
	//header("Location:".$_SESSION['nowPage']."?pageNum=".$_SESSION["ToPage"]."#n".$_REQUEST['d_id']);
	echo $act;
		
}
?>