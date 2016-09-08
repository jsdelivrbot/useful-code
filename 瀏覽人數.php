<!-- 利用session累加的，就是可開開關關刷人數的意思 -->
<?php
/*ob_start();	*/
//unset($_SESSION['Counter']);
//session_start(); 								//啟動Session的使用
if(!isset($_SESSION['Counter'])){ 				//檢查Session值是否存在
	//$userIP=$_SERVER['REMOTE_ADDR']; 			//收集瀏覽者的IP

	mysql_select_db($database_connect2data, $connect2data);
	$query_RecTotal = "SELECT visitors_times AS T FROM webcount";
	$RecTotal = mysql_query($query_RecTotal, $connect2data) or die(mysql_error());
	$row_RecTotal = mysql_fetch_assoc($RecTotal);
	$totalRows_RecTotal = mysql_num_rows($RecTotal);

	$updateSql = "UPDATE webcount SET visitors_times=".(intval($row_RecTotal["T"])+1)." WHERE count_id='1' ";

	mysql_select_db($database_connect2data, $connect2data);
  	$Result1 = mysql_query($updateSql, $connect2data) or die(mysql_error());


	//mysql_query($updateSql,$connect2data); 	//執行webcount資料庫的新增
	$_SESSION['Counter'] = 1;  					//設定Session值
}
//unset($_SESSION['Counter']);
/*$compareToday_RecToday = date("Y-m-d");

$compareThisMonth_RecThisMonth = date("Y-m");

$compareThisYear_RecThisYear = date("Y");*/

mysql_select_db($database_connect2data, $connect2data);
$query_RecTotal = "SELECT visitors_times AS T FROM webcount";
$RecTotal = mysql_query($query_RecTotal, $connect2data) or die(mysql_error());
$row_RecTotal = mysql_fetch_assoc($RecTotal);
$totalRows_RecTotal = mysql_num_rows($RecTotal);

echo $row_RecTotal["T"];
?>