<?php
function checkN($d){
	return ( isset($_REQUEST[$d]) ) ? $_REQUEST[$d] : 1;
}	

function numSum($l, $a, $e, $d){
	if($l==0){
		return 0;
	}else{
		return $l * $a * $e * $d;
	}
}
?>