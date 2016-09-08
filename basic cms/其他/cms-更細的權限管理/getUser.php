<?php
if (!isset($_SESSION)) {
	session_start();
}
?>
<?php require_once('primeFactors.php'); ?>
<?php
$colname_RecUser = "-1";
if (isset($_SESSION['MM_AccountUsername'])) {
	$colname_RecUser = $_SESSION['MM_AccountUsername'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecUser = sprintf("SELECT user_id, user_name, user_level, user_limit, user_active FROM `admin` WHERE user_name = %s", GetSQLValueString($colname_RecUser, "text"));
$RecUser = mysql_query($query_RecUser, $connect2data) or die(mysql_error());
$row_RecUser = mysql_fetch_assoc($RecUser);
$totalRows_RecUser = mysql_num_rows($RecUser);

$colname_RecLevelAuthority = "-1";
if (isset($row_RecUser['user_level'])) {
	$colname_RecLevelAuthority = $row_RecUser['user_level'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecLevelAuthority = sprintf("SELECT * FROM a_set WHERE a_id = %s", GetSQLValueString($colname_RecLevelAuthority, "int"));
$RecLevelAuthority = mysql_query($query_RecLevelAuthority, $connect2data) or die(mysql_error());
$row_RecLevelAuthority = mysql_fetch_assoc($RecLevelAuthority);
$totalRows_RecLevelAuthority = mysql_num_rows($RecLevelAuthority);


for($i=1; $i<=16; $i++){



	if($row_RecLevelAuthority['a_'.$i]!=NULL){
		//$_SESSION['MM_Limit']['a'.$i] = array();
		if( !(strcmp(0, $row_RecLevelAuthority['a_'.$i])) ||!(strcmp(3, $row_RecLevelAuthority['a_'.$i])) ){
			$tmpArray = array();
			$tmpArray[] = intval($row_RecLevelAuthority['a_'.$i]);
			$_SESSION['MM_Limit']['a'.$i] = $tmpArray;
		}else{
			$_SESSION['MM_Limit']['a'.$i] = primeFactors($row_RecLevelAuthority['a_'.$i]);
		}

		//$_SESSION['MM_Limit']['a'.$i] = primeFactors($row_RecLevelAuthority['a_'.$i]);
	}
}

//echo $query_RecLevelAuthority.'<br>';

//echo '<br>primeFactors = '.primeFactors('1');
//var_dump(primeFactors('210'));
//unset($_SESSION['MM_Limit']);
?>