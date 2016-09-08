<?php
/*//initialize the session
if (!isset($_SESSION)) {
	session_start();
	}
ob_start();*/

// ** Logout the current user. **
$logOutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logOutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_UserAccount'] = NULL;
  $_SESSION['MM_UserMemberGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_UserAccount']);
  unset($_SESSION['MM_UserMemberGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "member_login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>