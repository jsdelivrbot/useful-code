<?php require_once('../Connections/connect2data.php'); ?>
<?php
		if (isset($_REQUEST[id]))
		{
				
				
				
				$sql="DELETE FROM order_detail WHERE order_detail_id=".$_REQUEST[id];
							
				//echo $sql;
				//echo $_SESSION["ToPage"];
				mysql_query($sql);
				header("Location:orders_edit.php?orders_id=".$_REQUEST[orders_id]);
			
		}
?>