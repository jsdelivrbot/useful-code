<?php require_once('../Connections/connect2data.php'); ?>
<?php
		if (!isset($_SESSION)) {
  			session_start();
		}
		//echo $_REQUEST[address_book_set_id];
		//echo $_REQUEST[active];
		if (isset($_REQUEST[active]))
		{
		
			if($_REQUEST[active]==1)
			{
				$sql= "UPDATE address_book_set SET a_status='0' WHERE a_id='".$_REQUEST[a_id]."'";
			}
			else
			{
				$sql= "UPDATE address_book_set SET a_status='1' WHERE a_id='".$_REQUEST[a_id]."'";
			}
		
			//echo $sql;
			//echo $_SESSION["ToPage"];
			mysql_select_db($database_connect2data, $connect2data);
			mysql_query($sql) or die("無法送出" . mysql_error( ));
			header("Location:epaperClient_list.php?pageNum_RecEpaper_client=".$_SESSION["ToPage"]);
		}
		
		
?>