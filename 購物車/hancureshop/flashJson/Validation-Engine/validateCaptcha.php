<?php
if (!isset($_SESSION)) {
	session_start();
}
ob_start();
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

	/* RETURN VALUE */
	$arrayToJs = array();
	$arrayToJs[0] = $validateId;
	//$arrayToJs[1] = $validateError;
if((isset($_SESSION["Checknum"])) && (isset($validateValue)) && ($_SESSION["Checknum"] == $validateValue)) {
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