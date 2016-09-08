<?php require_once('../Connections/connect2data.php'); ?>
<?php
		if (!isset($_SESSION)) {
  			session_start();
		}
		//echo $_REQUEST[epaper_id];
		//echo $_REQUEST[active];
		if (isset($_REQUEST[active]))
		{
		
			if($_REQUEST[active]==1)
			{
				$sql= "UPDATE epaper_set SET e_active='0' WHERE e_id='".$_REQUEST[e_id]."'";
			}
			else
			{
				$sql= "UPDATE epaper_set SET e_active='1' WHERE e_id='".$_REQUEST[e_id]."'";
			}
		
			//echo $sql;
			//echo $_SESSION["ToPage"];
			mysql_select_db($database_connect2data, $connect2data);
			mysql_query($sql) or die("無法送出" . mysql_error( ));
			header("Location:epaper_list.php?pageNum_RecEpaper=".$_SESSION["ToPage"]);
		}
		
		
?>