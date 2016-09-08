<?php
function removeSpecialChar($V){

	//$clearV = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($V))))));

	//$clearV = $V;

	$clearV = clear_str($V);

	$clearV = str_replace('SELECT', '', strtoupper($clearV));
	$clearV = str_replace('FROM', '', strtoupper($clearV));
	$clearV = str_replace('WHERE', '', strtoupper($clearV));
	$clearV = str_replace('INSERT', '', strtoupper($clearV));
	$clearV = str_replace('INTO', '', strtoupper($clearV));
	$clearV = str_replace('UPDATE', '', strtoupper($clearV));
	$clearV = str_replace('DELETE', '', strtoupper($clearV));
	$clearV = str_replace('LIMIT', '', strtoupper($clearV));
	$clearV = str_replace('AND', '', strtoupper($clearV));
	$clearV = str_replace('OR', '', strtoupper($clearV));
	//$clearV = str_replace('<', '', strtoupper($clearV));
	//$clearV = str_replace('>', '', strtoupper($clearV));
	$clearV = str_replace('=', '', strtoupper($clearV));
	$clearV = str_replace('`', '', strtoupper($clearV));
	$clearV = str_replace('PG_SLEEP', '', strtoupper($clearV));
	$clearV = str_replace('SLEEP', '', strtoupper($clearV));
	$clearV = str_replace('WAITFOR', '', strtoupper($clearV));
	$clearV = str_replace('DELAY', '', strtoupper($clearV));
	$clearV = str_replace('UNLINK', '', strtoupper($clearV));

	return $clearV;
}

function clear_str($V){
	return str_replace(array("'", '"', '<', '>'), array('&#39;', '&quot;', '&lt;', '&gt;'), stripslashes($V));
}


function checkV($d){
	return (isset($_REQUEST[$d])) ? $_REQUEST[$d] : NULL;
}
?>