<?php
if (!isset($_SESSION)) {
	session_start();
}
ob_start();
?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
	{
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

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
			$theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

if(!in_array(3,$_SESSION['MM_Limit']['a5'])){
	header("Location: first.php");
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecMember = 10;
$pageNum_RecMember = 0;
if (isset($_GET['pageNum_RecMember'])) {
	$pageNum_RecMember = $_GET['pageNum_RecMember'];
}
$startRow_RecMember = $pageNum_RecMember * $maxRows_RecMember;

mysql_select_db($database_connect2data, $connect2data);


/*$input1="";
if(isset($_POST['input1'])){
	$input1 = $_POST['input1'];
}*/

	//$input1 = urldecode($_POST["input1"]);
if(isset($_GET["input1"])){
	$input1 = $_GET["input1"];
}else{
	$input1 = '';
}
$input1x = (!empty($input1))?" AND m_class2='$input1'":"";

if(isset($_GET["input2"])){
	$input2 = $_GET["input2"];
}else{
	$input2 = '';
}
$input2x = (!empty($input2))?" AND m_class3='$input2'":"";

if(isset($_GET["input3"])){
	$input3 = urldecode($_GET["input3"]);
}else{
	$input3 = '';
}
$input3x = (!empty($input3)) ? "WHERE M.m_name LIKE '%".$input3."%'" : "";


if(($input1!="") || ($input2!="") || ($input3!=""))
{
	//$query_RecMember = "SELECT * FROM member_set WHERE member_set.m_name LIKE '%".$input1."%' AND m_level=2 ORDER BY `m_date` DESC";
	//$query_RecMember = "SELECT M.*, C2.c_title AS C2T, C3.c_title AS C3T FROM member_set AS M LEFT JOIN class_set AS C2 ON C2.c_parent='careersC' AND C2.c_active='1' AND M.m_class2=C2.c_id LEFT JOIN class_set AS C3 ON C3.c_parent='jobTitleC' AND C3.c_active='1' AND M.m_class3=C3.c_id WHERE M.m_level=2".$input1x.$input2x.$input3x." ORDER BY M.m_id DESC, M.m_class2 ASC, M.m_class3 ASC";
	$query_RecMember = "SELECT M.*, C2.c_title AS C2T, C3.c_title AS C3T FROM member_set AS M LEFT JOIN class_set AS C2 ON C2.c_parent='careersC' AND C2.c_active='1' AND M.m_class2=C2.c_id LEFT JOIN class_set AS C3 ON C3.c_parent='jobTitleC' AND C3.c_active='1' AND M.m_class3=C3.c_id ".$input3x." ORDER BY M.m_id DESC, M.m_class2 ASC, M.m_class3 ASC";
	//echo "會員姓名<br>";
}else if($input1=="")
{
	//$query_RecMember = "SELECT * FROM member_set WHERE m_level=2 ORDER BY m_id DESC";
	//$query_RecMember = "SELECT M.*, C2.c_title AS C2T, C3.c_title AS C3T FROM member_set AS M LEFT JOIN class_set AS C2 ON C2.c_parent='careersC' AND C2.c_active='1' AND M.m_class2=C2.c_id LEFT JOIN class_set AS C3 ON C3.c_parent='jobTitleC' AND C3.c_active='1' AND M.m_class3=C3.c_id WHERE M.m_level=2 ORDER BY M.m_id DESC, M.m_class2 ASC, M.m_class3 ASC";
	$query_RecMember = "SELECT M.*, C2.c_title AS C2T, C3.c_title AS C3T FROM member_set AS M LEFT JOIN class_set AS C2 ON C2.c_parent='careersC' AND C2.c_active='1' AND M.m_class2=C2.c_id LEFT JOIN class_set AS C3 ON C3.c_parent='jobTitleC' AND C3.c_active='1' AND M.m_class3=C3.c_id ORDER BY M.m_id DESC, M.m_class2 ASC, M.m_class3 ASC";
	//echo "all<br>";
}
//echo $query_RecMember.'<br>';
$query_limit_RecMember = sprintf("%s LIMIT %d, %d", $query_RecMember, $startRow_RecMember, $maxRows_RecMember);
$RecMember = mysql_query($query_limit_RecMember, $connect2data) or die(mysql_error());
$row_RecMember = mysql_fetch_assoc($RecMember);

mysql_select_db($database_connect2data, $connect2data);
$query_RecClass2 = "SELECT * FROM class_set WHERE c_parent = 'careersC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecClass2 = mysql_query($query_RecClass2, $connect2data) or die(mysql_error());
$row_RecClass2 = mysql_fetch_assoc($RecClass2);
$totalRows_RecClass2 = mysql_num_rows($RecClass2);

mysql_select_db($database_connect2data, $connect2data);
$query_RecClass3 = "SELECT * FROM class_set WHERE c_parent = 'jobTitleC' AND c_active='1' ORDER BY c_sort ASC, c_id DESC";
$RecClass3 = mysql_query($query_RecClass3, $connect2data) or die(mysql_error());
$row_RecClass3 = mysql_fetch_assoc($RecClass3);
$totalRows_RecClass3 = mysql_num_rows($RecClass3);



if (isset($_GET['totalRows_RecMember'])) {
	$totalRows_RecMember = $_GET['totalRows_RecMember'];
} else {
	$all_RecMember = mysql_query($query_RecMember);
	$totalRows_RecMember = mysql_num_rows($all_RecMember);
}
$totalPages_RecMember = ceil($totalRows_RecMember/$maxRows_RecMember)-1;
$TotalPage = $totalPages_RecMember;


$queryString_RecMember = "";
if (!empty($_SERVER['QUERY_STRING'])) {
	$params = explode("&", $_SERVER['QUERY_STRING']);
	$newParams = array();
	foreach ($params as $param) {
		if (stristr($param, "pageNum_RecMember") == false &&
			stristr($param, "totalRows_RecMember") == false) {
			array_push($newParams, $param);
	}
}
if (count($newParams) != 0) {
	$queryString_RecMember = "&" . htmlentities(implode("&", $newParams));
}
}
$queryString_RecMember = sprintf("&totalRows_RecMember=%d%s", $totalRows_RecMember, $queryString_RecMember);
$menu_is="member";?>
<?php
$R_pageNum_RecMember = 0;
if (isset($_REQUEST["pageNum_RecMember"]))
{
	$R_pageNum_RecMember = $_REQUEST["pageNum_RecMember"];
}
if (! isset($R_pageNum_RecMember))
{
	$_SESSION["ToPage"]=0;
}
 	  //若指定分頁數小於1則預設顯示第一頁
else if ($R_pageNum_RecMember<0)
{
	$_SESSION["ToPage"]=0;
}
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
else if ($R_pageNum_RecMember>$totalPages_RecMember)
{
	$_SESSION["ToPage"]=$TotalPage;
}
else
{
	$_SESSION["ToPage"]=$R_pageNum_RecMember;
}
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
if($R_pageNum_RecMember>$totalPages_RecMember && $R_pageNum_RecMember!=0)
{
	header("Location:member_list.php?pageNum_RecMember=".$totalPages_RecMember);
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php require_once('cmsTitle.php'); ?></title>
	<?php require_once('script.php'); ?>
	<!-- InstanceBeginEditable name="doctitle" -->
	<title>無標題文件</title>
	<!-- InstanceEndEditable -->
	<!-- InstanceBeginEditable name="head" -->

	<!-- InstanceEndEditable -->
	<?php require_once('head.php');?>
	<?php require_once('web_count.php');?>
</head>
<body>
	<table width="1280" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td rowspan="2" align="left">
						<?php require_once('cmsHeader.php');?>
					</td>
					<td width="100" align="right" valign="middle">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td colspan="5" align="left"><span class="color_white"><a href="<?php echo $logoutAction ?>">&nbsp;&nbsp;<img src="image/logout.gif" width="48" height="16" /></a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td align="left" class="color_white">&nbsp;</td>
								<td>&nbsp;</td>
								<td align="left" class="color_white">&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan="5" align="left" class="table_data">&nbsp;&nbsp;<a href="../index.php" target="_blank">觀看首頁</a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<?php require_once('top.php'); ?>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left"><!-- InstanceBeginEditable name="編輯區域" -->
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr valign="top">
								<td width="120" class="list_title">會員管理</td>
								<td width="904" valign="top"><form id="form2" name="form2" method="get" action="member_list.php">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr valign="baseline">
											<td width="1%"></td>
											<td width="99%" align="left" class="table_data">
												<span class="no_data">

													<?php if ($totalRows_RecMember == 0) { // Show if recordset empty ?>
													<?php if( ($input1=='') && ($input2=='') && ($input3=='') ){?>
													<strong>目前資料庫中沒有任何會員</strong>
													<?php }else{ ?>
													<strong>沒有符合搜尋條件的任何會員</strong>
													<?php }?>
													<?php } // Show if recordset empty ?>
												</span>
												<?php if(0){ ?>
												<label>門市部門：
													<select name="input1" id="input1">
														<option value=""<?php if ($input1=="") {echo "selected=\"selected\"";} ?>>所有部門</option>
														<?php
														do {
															?>
															<option value="<?php echo $row_RecClass2['c_id']?>"<?php if (!(strcmp($row_RecClass2['c_id'], $input1))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecClass2['c_title']?></option>

															<?php
														} while ($row_RecClass2 = mysql_fetch_assoc($RecClass2));
														$rows = mysql_num_rows($RecClass2);
														if($rows > 0) {
															mysql_data_seek($RecClass2, 0);
															$row_RecClass2 = mysql_fetch_assoc($RecClass2);
														}
														?>
													</select></label>
													<label>工作職稱：<select name="input2" id="input2">
														<option value=""<?php if ($input2=="") {echo "selected=\"selected\"";} ?>>所有職稱</option>
														<?php
														do {
															?>
															<option value="<?php echo $row_RecClass3['c_id']?>"<?php if (!(strcmp($row_RecClass3['c_id'], $input2))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecClass3['c_title']?></option>
															<?php
														} while ($row_RecClass3 = mysql_fetch_assoc($RecClass3));
														$rows = mysql_num_rows($RecClass3);
														if($rows > 0) {
															mysql_data_seek($RecClass3, 0);
															$row_RecClass3 = mysql_fetch_assoc($RecClass3);
														}
														?>
													</select></label>
													<?php } ?>

													<label>會員姓名搜尋：
														<input name="input3" type="text" id="input3" size="10" />

														<button type="submit" class="no_board" id='searchButton'><img src="image/go1.gif" name="Image54" width="25" height="15" border="0" id="Image54" /></button>
													</label></td>
												</tr>
											</table>
										</form></td>
									</tr>
								</table>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
									<tr>
										<td width="739" align="right" class="page_display">
											<!-------顯示頁選擇與分頁設定開始---------->
											<table border="0">
												<tr>
													<td><?php if ($pageNum_RecMember > 0) { // Show if not first page ?>
														<a href="<?php printf("%s?pageNum_RecMember=%d%s", $currentPage, max(0, $pageNum_RecMember - 1), $queryString_RecMember); ?>"><</a>
														<?php } // Show if not first page ?>
													</td>

													<td>
														<?php
			//echo $totalRows_RecMember;//所有筆數
			//echo $totalPages_RecMember;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecMember;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecMember;//以字串顯示所有的筆數,如&totalRows_RecMember=11
														if($totalPages_RecMember<10)
														{
															if($totalRows_RecMember == 0)
															{
					//如果沒有任何資料，不顯示|符號
															}
															else
															{
																echo " | ";
															}

															for ($i=1; $i<=$totalPages_RecMember+1; $i++)
															{
				  //如果非正在顯示的分頁則建立頁碼連結
																if ($i != $pageNum_RecMember+1 )
																{

																	echo "<a href=";
																	printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
																	echo ">" . $i . "</a> | " ;
																}
				  //如果是正在顯示的方頁則單純顯示頁碼
																else
																{
																	echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
																}
															}
														}
			else//$totalPages_RecMember>10
			{
				$morePage_num=$totalPages_RecMember-$pageNum_RecMember;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecMember<3)
					{
						if($totalRows_RecMember == 0)
						{
							//如果沒有任何資料，不顯示|符號
						}
						else
						{
							echo " | ";
						}

						for ($i=1; $i<=10; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
							if ($i != $pageNum_RecMember+1 )
							{

								echo "<a href=";
								printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
								echo ">" . $i . "</a> | " ;
							}
						  //如果是正在顯示的方頁則單純顯示頁碼
							else
							{
								echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
							}
						}

						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, $totalPages_RecMember, $queryString_RecMember);
						echo ">..." .($totalPages_RecMember+1). "</a> | " ;
					}
					else//$pageNum_RecMember>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, 0, $queryString_RecMember);
						echo ">" . 1 . "...</a> | " ;

						for ($i=$pageNum_RecMember-1; $i<=$pageNum_RecMember+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
							if ($i != $pageNum_RecMember+1 )
							{

								echo "<a href=";
								printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
								echo ">" . $i . "</a> | " ;
							}
						  //如果是正在顯示的方頁則單純顯示頁碼
							else
							{
								echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
							}
						}

						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, $totalPages_RecMember, $queryString_RecMember);
						echo ">..." .($totalPages_RecMember+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
					$beforePage_num=9-$morePage_num;
					$beforePage=$pageNum_RecMember-$beforePage_num;

						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";

					echo "<a href=";
					printf("%s?pageNum_RecMember=%d%s", $currentPage, 0, $queryString_RecMember);
					echo ">" . 1 . "...</a> | " ;

					for ($i=$beforePage+1; $i<=$totalPages_RecMember+1; $i++)
					{
						  //如果非正在顯示的分頁則建立頁碼連結
						if ($i != $pageNum_RecMember+1 )
						{

							echo "<a href=";
							printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
							echo ">" . $i . "</a> | " ;
						}
						  //如果是正在顯示的方頁則單純顯示頁碼
						else
						{
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						}
					}
				}

			}

			?>
		</td>

		<td><?php if ($pageNum_RecMember < $totalPages_RecMember) { // Show if not last page ?>
			<a href="<?php printf("%s?pageNum_RecMember=%d%s", $currentPage, min($totalPages_RecMember, $pageNum_RecMember + 1), $queryString_RecMember); ?>">></a>
			<?php } // Show if not last page ?>
		</td>
		<?php ?>



	</tr>
</table>
<!-------顯示頁選擇與分頁設定結束---------->
</td>
<td width="110" align="right" class="page_display"><?php if ($totalRows_RecMember > 0) { // Show if recordset not empty ?>
	頁數:<?php echo (($pageNum_RecMember+1)."/".($totalPages_RecMember+1)); ?>
	<?php } // Show if recordset not empty ?>
</td>
<td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecMember ?> </td>
<td width="24" align="right">&nbsp;</td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="image/spacer.gif" width="1" height="1" /></td>
	</tr>
</table>
<form action="member_process.php" method="post" name="form1" id="form1">
	<?php if ($totalRows_RecMember > 0) { // Show if recordset not empty ?>
	<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
		<tr>
			<td align="center" class="table_title">會員姓名</td>
			<td width="40" align="center" class="table_title">狀態</td>
			<?php if(in_array(5,$_SESSION['MM_Limit']['a5'])){ ?>
			<td width="40" align="center" class="table_title">編輯</td>
			<?php } ?>
			<?php if(in_array(7,$_SESSION['MM_Limit']['a5'])){ ?>
			<td width="40" align="center" class="table_title">刪除</td>
			<?php } ?>
		</tr>
		<?php
		$i=0;
		do {
			if ($i%2==0)
			{
				$i=$i+1;
				echo "<tr>";}
				else
				{
					$i=$i+1;
					echo "<tr bgcolor='#E4E4E4'>";}
					?>
					<?php

					$colname_RecImage = "-1";
					if (isset($row_RecMember['m_id'])) {
						$colname_RecImage = $row_RecMember['m_id'];
					}
					mysql_select_db($database_connect2data, $connect2data);
					$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_type='image' AND file_d_id = %s", GetSQLValueString($colname_RecImage, "int"));
					$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
					$row_RecImage = mysql_fetch_assoc($RecImage);
					$totalRows_RecImage = mysql_num_rows($RecImage);

		//echo $totalRows_RecImage;
					?>
					<td align="center" class="table_data" >
						<?php
						if(in_array(5,$_SESSION['MM_Limit']['a5'])){
							echo '<a href="member_edit.php?m_id='.$row_RecMember['m_id'].'">'.$row_RecMember['m_name'].'</a>';
						}else{
							echo $row_RecMember['m_name'];
						}
						?>

						<!--<a href="member_edit.php?m_id=<?php echo $row_RecMember['m_id']; ?>"><?php echo $row_RecMember['m_name']; ?></a>-->

					</td>

					<td align="center"  class="table_data">

						<?php
						if(in_array(5,$_SESSION['MM_Limit']['a5'])){
							if($row_RecMember['m_active']){
								echo "<a href='".$row_RecMember['m_active']."' rel='".$row_RecMember['m_id']."' class='activeChM'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
							}else{
								echo "<a href='".$row_RecMember['m_active']."' rel='".$row_RecMember['m_id']."' class='activeChM'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
							}
						}else{
							if($row_RecMember['m_active']){
								echo "<img src=\"image/accept.png\" width=\"16\" height=\"16\"  >";
							}else{
								echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >";
							}
						}
						?>

		  <?php  //list使用
				/*if($row_RecMember['m_active']=="1")
				{
					echo "<a href='".$row_RecMember['m_active']."' rel='".$row_RecMember['m_id']."' class='activeChM'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}
				else if($row_RecMember['m_active']=="0")
				{
					echo "<a href='".$row_RecMember['m_active']."' rel='".$row_RecMember['m_id']."' class='activeChM'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}else
				{
					echo "未驗證";
				}*/

				?></td>

				<?php if(in_array(5,$_SESSION['MM_Limit']['a5'])){ ?>
				<td align="center" class="table_data"><a href="member_edit.php?m_id=<?php echo $row_RecMember['m_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
				<?php } ?>
				<?php if(in_array(7,$_SESSION['MM_Limit']['a5'])){ ?>
				<td align="center" class="table_data"><a href="member_del.php?m_id=<?php echo $row_RecMember['m_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
				<?php } ?>

          <!--<td align="center" class="table_data"><a href="member_edit.php?m_id=<?php echo $row_RecMember['m_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
          <td align="center" class="table_data"><a href="member_del.php?m_id=<?php echo $row_RecMember['m_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>-->
      </tr><?php } while ($row_RecMember = mysql_fetch_assoc($RecMember)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
</form>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
	<tr>
		<td width="739" align="right" class="page_display">
			<!-------顯示頁選擇與分頁設定開始---------->
			<table border="0">
				<tr>
					<td><?php if ($pageNum_RecMember > 0) { // Show if not first page ?>
						<a href="<?php printf("%s?pageNum_RecMember=%d%s", $currentPage, max(0, $pageNum_RecMember - 1), $queryString_RecMember); ?>"><</a>
						<?php } // Show if not first page ?>
					</td>

					<td>
						<?php
			//echo $totalRows_RecMember;//所有筆數
			//echo $totalPages_RecMember;//最後分頁的頁數,由0開始的陣列
			//echo $pageNum_RecMember;//現在顯示的頁面,由0開始的陣列
			//echo $currentPage;//現在的目錄路徑
			//echo $queryString_RecMember;//以字串顯示所有的筆數,如&totalRows_RecMember=11
						if($totalPages_RecMember<10)
						{
							if($totalRows_RecMember == 0)
							{
					//如果沒有任何資料，不顯示|符號
							}
							else
							{
								echo " | ";
							}

							for ($i=1; $i<=$totalPages_RecMember+1; $i++)
							{
				  //如果非正在顯示的分頁則建立頁碼連結
								if ($i != $pageNum_RecMember+1 )
								{

									echo "<a href=";
									printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
									echo ">" . $i . "</a> | " ;
								}
				  //如果是正在顯示的方頁則單純顯示頁碼
								else
								{
									echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
								}
							}
						}
			else//$totalPages_RecMember>10
			{
				$morePage_num=$totalPages_RecMember-$pageNum_RecMember;//此頁面之後總共有多少
				if($morePage_num>7)
				{
					if($pageNum_RecMember<3)
					{
						if($totalRows_RecMember == 0)
						{
							//如果沒有任何資料，不顯示|符號
						}
						else
						{
							echo " | ";
						}

						for ($i=1; $i<=10; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
							if ($i != $pageNum_RecMember+1 )
							{

								echo "<a href=";
								printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
								echo ">" . $i . "</a> | " ;
							}
						  //如果是正在顯示的方頁則單純顯示頁碼
							else
							{
								echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
							}
						}

						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, $totalPages_RecMember, $queryString_RecMember);
						echo ">..." .($totalPages_RecMember+1). "</a> | " ;
					}
					else//$pageNum_RecMember>=3
					{
						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, 0, $queryString_RecMember);
						echo ">" . 1 . "...</a> | " ;

						for ($i=$pageNum_RecMember-1; $i<=$pageNum_RecMember+8; $i++)
						{
						  //如果非正在顯示的分頁則建立頁碼連結
							if ($i != $pageNum_RecMember+1 )
							{

								echo "<a href=";
								printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
								echo ">" . $i . "</a> | " ;
							}
						  //如果是正在顯示的方頁則單純顯示頁碼
							else
							{
								echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
							}
						}

						echo "<a href=";
						printf("%s?pageNum_RecMember=%d%s", $currentPage, $totalPages_RecMember, $queryString_RecMember);
						echo ">..." .($totalPages_RecMember+1). "</a> | " ;
					}
				}
				else//$morePage_num<=7
				{
					$beforePage_num=9-$morePage_num;
					$beforePage=$pageNum_RecMember-$beforePage_num;

						//echo "<br>beforePage_num=".$beforePage_num."<br>";
						//echo "beforePage=".$beforePage."<br>";

					echo "<a href=";
					printf("%s?pageNum_RecMember=%d%s", $currentPage, 0, $queryString_RecMember);
					echo ">" . 1 . "...</a> | " ;

					for ($i=$beforePage+1; $i<=$totalPages_RecMember+1; $i++)
					{
						  //如果非正在顯示的分頁則建立頁碼連結
						if ($i != $pageNum_RecMember+1 )
						{

							echo "<a href=";
							printf("%s?pageNum_RecMember=%d%s", $currentPage, $i-1, $queryString_RecMember);
							echo ">" . $i . "</a> | " ;
						}
						  //如果是正在顯示的方頁則單純顯示頁碼
						else
						{
							echo "<font style=\"text-decoration: underline;\">".$i ."</font>"." | " ;
						}
					}
				}

			}


			?>
		</td>

		<td><?php if ($pageNum_RecMember < $totalPages_RecMember) { // Show if not last page ?>
			<a href="<?php printf("%s?pageNum_RecMember=%d%s", $currentPage, min($totalPages_RecMember, $pageNum_RecMember + 1), $queryString_RecMember); ?>">></a>
			<?php } // Show if not last page ?>
		</td>
		<?php ?>



	</tr>
</table>
<!-------顯示頁選擇與分頁設定結束---------->
</td>
<td width="110" align="right" class="page_display"><?php if ($totalRows_RecMember > 0) { // Show if recordset not empty ?>
	頁數:<?php echo (($pageNum_RecMember+1)."/".($totalPages_RecMember+1)); ?>
	<?php } // Show if recordset not empty ?>
</td>
<td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecMember ?> </td>
<td width="24" align="right">&nbsp;</td>
</tr>
</table>
<!-- InstanceEndEditable --></td>
</tr>
</table></td>
</tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecMember);
?>
