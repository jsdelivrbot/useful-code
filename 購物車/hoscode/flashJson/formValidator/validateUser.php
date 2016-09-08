<?php require_once('../../Connections/connect2data.php'); ?>
<?php
include('../recordset2json.php');

/* RECEIVE VALUE */
$validateValue = '';
if(isset($_POST['fieldValue'])){
	$validateValue = $_POST['fieldValue'];
}else if(isset($_GET['fieldValue'])){
	$validateValue = $_GET['fieldValue'];
}
$validateId = '';
if(isset($_POST['fieldId'])){
	$validateId = $_POST['fieldId'];
}else if(isset($_GET['fieldId'])){
	$validateId = $_GET['fieldId'];
}
$validateError = '';
if(isset($_POST['validateError'])){
	$validateError = $_POST['validateError'];
}else if(isset($_GET['validateError'])){
	$validateError = $_GET['validateError'];
}

// *** Redirect if username exists  
  $FF_dupKeyUsernameValue = $validateValue;
  $FF_dupKeySQL = "SELECT m_account FROM member_set WHERE m_account='" . $FF_dupKeyUsernameValue . "'";
  mysql_select_db($database_connect2data, $connect2data);
  $FF_rsKey=mysql_query($FF_dupKeySQL, $connect2data) or die(mysql_error());




	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	//$arrayToJs[1] = $validateError;
if(mysql_num_rows($FF_rsKey) == 0) {
//if($validateValue =="karnius"){		// validate??
	$arrayToJs[1] = true;			// RETURN TRUE
	//echo '{"jsonValidateReturn":'.sd_array2json($arrayToJs).'}';			// RETURN ARRAY WITH success
	echo sd_array2json($arrayToJs);			// RETURN ARRAY WITH success
}else{
	for($x=0;$x<1000000;$x++){
		if($x == 990000){
			$arrayToJs[1] = false;
			//echo '{"jsonValidateReturn":'.sd_array2json($arrayToJs).'}';		// RETURN ARRAY WITH ERROR
			echo sd_array2json($arrayToJs);		// RETURN ARRAY WITH ERROR
		}
	}
	
}

?>