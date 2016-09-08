<?php require_once('../Connections/connect2data.php'); ?>
<?php
		if (!isset($_SESSION)) {
  			session_start();
		}
		//echo $_REQUEST[m_id];
		//echo $_REQUEST[m_active];
		
		if($_REQUEST['active']==1)
		{
			$sql= "UPDATE member_set SET m_active='0' WHERE m_id='".$_REQUEST['m_id']."'";
		}
		else
		{
			$sql= "UPDATE member_set SET m_active='1' WHERE m_id='".$_REQUEST['m_id']."'";
		}
		
		//echo $sql;
		//echo $_SESSION["ToPage"];
			mysql_select_db($database_connect2data, $connect2data);
			mysql_query($sql) or die("無法送出" . mysql_error( ));
		header("Location:member_list.php?pageNum_RecMember=".$_SESSION["ToPage"]);
?>
