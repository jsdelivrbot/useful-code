<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
  ob_start();
}
?>
<?php require_once('../Connections/connect2data.php'); ?>
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

//var_dump($_SESSION['MM_Limit']);
?>
<?php
// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  //更新登出log
  $updateSQL = sprintf("UPDATE admin_log SET logout_status=%s, logout_date=NOW(), logout_page=%s WHERE log_id=%s",
                       GetSQLValueString("Logout Success", "text"),
                       GetSQLValueString($_SERVER['PHP_SELF'], "text"),
                       GetSQLValueString($_SESSION['MM_AccountUserLog'], "int"));
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());

  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_AccountUsername'] = NULL;
  $_SESSION['MM_AccountUserGroup'] = NULL;
  $_SESSION['MM_AccountUserLevel'] = NULL;
  $_SESSION['MM_AccountUserType'] = NULL;
  $_SESSION['MM_AccountUserLog'] = NULL;
  $_SESSION['MM_Limit'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  
  unset($_SESSION['MM_AccountUsername']);
  unset($_SESSION['MM_AccountUserGroup']);
  unset($_SESSION['MM_AccountUserLevel']);
  unset($_SESSION['MM_AccountUserType']);
  unset($_SESSION['MM_AccountUserLog']);
  unset($_SESSION['MM_Limit']);
  unset($_SESSION['PrevUrl']);

  session_destroy();
  //session_regenerate_id(true);
  
  $logoutGoTo = "../cms/login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "../cms/login.php";
if (!((isset($_SESSION['MM_AccountUsername'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_AccountUsername'], $_SESSION['MM_AccountUserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);

  //記錄登入資訊
  require_once('../Connections/get_client_ip.php');
  $IP = get_client_ip();
  
  if(isset($_SESSION['MM_AccountUserLog']) && $_SESSION['MM_AccountUserLog']!=""){

    //echo "have MM_AccountUserLog<br>";

    $LogCheck__query=sprintf("SELECT log_id FROM `admin_log` WHERE log_id=%s AND login_ip=%s AND HTTP_USER_AGENT=%s",
      GetSQLValueString($_SESSION['MM_AccountUserLog'], "int"),
      GetSQLValueString($IP, "text"),
      GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"));
    $LogCheck = mysql_query($LogCheck__query, $connect2data) or die(mysql_error());
    $row_LogCheck = mysql_fetch_assoc($LogCheck);
    $loginFoundLog = mysql_num_rows($LogCheck);

    if ($loginFoundLog){
      //更新log
      $updateSQL = sprintf("UPDATE admin_log SET logout_status=%s, logout_date=NOW(), logout_page=%s WHERE log_id=%s",
                       GetSQLValueString("NO AccountUsername", "text"),
                       GetSQLValueString($MM_referrer, "text"),
                       GetSQLValueString($_SESSION['MM_AccountUserLog'], "int"));
      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
    }else{
      //no log id result
      $insertSQL = sprintf("INSERT INTO admin_log (logout_date, login_ip, logout_page, logout_status, HTTP_USER_AGENT) VALUES ( NOW(), %s, %s, %s, %s)",
                    GetSQLValueString($IP, "text"),
                    GetSQLValueString($MM_referrer, "text"),
                    GetSQLValueString("Unusual Access OR Different IP OR Different HTTP_USER_AGENT", "text"),
                    GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
    }

  }else{
    //echo "No MM_AccountUserLog<br>";
    //no log id result
    $insertSQL = sprintf("INSERT INTO admin_log (logout_date, login_ip, logout_page, logout_status, HTTP_USER_AGENT) VALUES ( NOW(), %s, %s, %s, %s)",
                    GetSQLValueString($IP, "text"),
                    GetSQLValueString($MM_referrer, "text"),
                    GetSQLValueString("Unusual Access", "text"),
                    GetSQLValueString($_SERVER['HTTP_USER_AGENT'], "text"));

    mysql_select_db($database_connect2data, $connect2data);
    $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
  }
  
  //echo 'MM_AccountUserLog = '.$_SESSION['MM_AccountUserLog'];
  session_destroy();

  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<link href="../cms/css/work_css.css?0.2" rel="stylesheet" type="text/css" />
<!--<link href="../cms/css/work_css.css" rel="stylesheet" type="text/css" media="print" />-->

<link rel="shortcut icon" href="../images/fav.ico" type="image/x-icon">
<script type="text/javascript" src="js/swapImage.js"></script>