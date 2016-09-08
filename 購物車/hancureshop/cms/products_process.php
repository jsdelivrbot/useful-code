<?php require_once('../Connections/connect2data.php'); ?>
<?php
		if (!isset($_SESSION)) {
  			session_start();
		}
		//echo $_REQUEST[teacherHome_id];
		//echo $_REQUEST[active];
		mysql_select_db($database_connect2data, $connect2data);
		
		if (isset($_REQUEST['active']))
		{
		
			if($_REQUEST['active']==1)
			{
				$sql= "UPDATE data_set SET d_active='0' WHERE d_id='".$_REQUEST['d_id']."'";
			}
			else
			{
				$sql= "UPDATE data_set SET d_active='1' WHERE d_id='".$_REQUEST['d_id']."'";
			}
			
			//echo $sql;
			//echo $_SESSION["ToPage"];
			mysql_query($sql);
		}elseif (isset($_REQUEST['d_new_product']))
		{
		
			if($_REQUEST['d_new_product']==1)
			{
				$sql= "UPDATE data_set SET d_new_product='0' WHERE d_id='".$_REQUEST['d_id']."'";
			}
			else
			{
				$sql= "UPDATE data_set SET d_new_product='1' WHERE d_id='".$_REQUEST['d_id']."'";
			}
		
			//echo $sql;
			//echo $_SESSION["ToPage"];
			mysql_query($sql);
		}elseif (isset($_REQUEST['d_sale']))
		{
		
			if($_REQUEST['d_sale']==1)
			{
				$sql= "UPDATE data_set SET d_sale='0' WHERE d_id='".$_REQUEST['d_id']."'";
			}
			else
			{
				$sql= "UPDATE data_set SET d_sale='1' WHERE d_id='".$_REQUEST['d_id']."'";
			}
		
			//echo $sql;
			//echo $_SESSION["ToPage"];
			mysql_query($sql);
		}
			header("Location:products_list.php?pageNum=".$_SESSION["ToPage"]."&selected=".$_SESSION['selected_products']);
		
		
?>