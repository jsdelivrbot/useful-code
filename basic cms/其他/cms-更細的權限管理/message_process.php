<?php require_once('../Connections/connect2data.php'); ?>
<?php
		if (!isset($_SESSION)) {
  			session_start();
		}
		//echo $_REQUEST[faq_id];
		//echo $_REQUEST[active];
		if (isset($_REQUEST[active]))
		{
		
			if($_REQUEST[active]==1)
			{
				$sql= "UPDATE fwukeh_data_set SET d_active='0' WHERE d_id='".$_REQUEST[d_id]."'";
			}
			else
			{
				$sql= "UPDATE fwukeh_data_set SET d_active='1' WHERE d_id='".$_REQUEST[d_id]."'";
			}
		
			//echo $sql;
			//echo $_SESSION["ToPage"];
			mysql_select_db($database_connect2data, $connect2data);
			mysql_query($sql) or die("µLªk°e¥X" . mysql_error( ));
			header("Location:message_list.php?pageNum_RecFaq=".$_SESSION["ToPage"]);
		}
		
		
?>