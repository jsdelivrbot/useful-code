<?php
require_once('inc/EDcart.php');
if (!isset($_SESSION)) {
  session_start();
}
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart(); 
//echo "item = ".$cart->itemCount;
?>
<?php require_once('Connections/connect2data.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


mysql_select_db($database_connect2data, $connect2data);
$query_RecMember_rule = "SELECT * FROM data_set WHERE d_class1 = 'member_rule' ORDER BY d_date DESC";
$RecMember_rule = mysql_query($query_RecMember_rule, $connect2data) or die(mysql_error());
$row_RecMember_rule = mysql_fetch_assoc($RecMember_rule);


?>
<?php require_once('Connections/session.initialize.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>HanCure 漢速敷</title>

<link rel="shortcut icon" href="img/fav.png" type="image/x-icon">

<?php include('meta.php') ?>


<style type="text/css">
.rule{
  padding: 30px 10px 10px 0;
  text-align: justify;
  text-justify: inter-ideograph;
}

</style>

<?php require_once('ga.php'); ?>
</head>
<body>
<div class="rule">
<?php echo $row_RecMember_rule['d_content']; ?>
</div>
</body>
</html>
