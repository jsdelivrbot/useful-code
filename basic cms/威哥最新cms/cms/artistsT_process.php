<?php require_once('../Connections/connect2data.php'); ?>
<?php
		if (!isset($_SESSION)) {
  			session_start();
		}
		//echo $_REQUEST[projectC_id];
		//echo $_REQUEST[active];
		if (isset($_REQUEST['active']))
		{
		
			if($_REQUEST['active']==1)
			{
				$sql= "UPDATE terms SET term_active='0' WHERE term_id='".$_REQUEST['term_id']."'";
			}
			else
			{
				$sql= "UPDATE terms SET term_active='1' WHERE term_id='".$_REQUEST['term_id']."'";
			}
		
			//echo $sql;
			//echo $_SESSION["ToPage"];
			mysql_query($sql);
			header("Location:artistsT_list.php?pageNum=".$_SESSION["ToPage"]);
		}
		
		
?>