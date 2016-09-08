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
				$sql= "UPDATE class_set SET c_active='0' WHERE c_id='".$_REQUEST['c_id']."'";
			}
			else
			{
				$sql= "UPDATE class_set SET c_active='1' WHERE c_id='".$_REQUEST['c_id']."'";
			}
		
			//echo $sql;
			//echo $_SESSION["ToPage"];
			mysql_query($sql);
			header("Location:productsC_list.php?pageNum=".$_SESSION["ToPage"]);
		}
		
		
?>