<?php require_once('../sstart.php'); ?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

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
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
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

if(!in_array(3,$_SESSION['MM_Limit']['a4'])){
	header("Location: first.php");
}

$_SESSION['listLinks'] = NULL;

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecArticle = 10;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecArticle = $pageNum * $maxRows_RecArticle;

mysql_select_db($database_connect2data, $connect2data);
$query_RecArticleT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleT' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecArticleT = mysql_query($query_RecArticleT, $connect2data) or die(mysql_error());
$row_RecArticleT = mysql_fetch_assoc($RecArticleT);
$totalRows_RecArticleT = mysql_num_rows($RecArticleT);

$G_sel1 = '';
if(isset($_GET['sel1']))
{
	$_SESSION['selected_articleT'] = $G_sel1 = $_GET['sel1'];
}else 
{
	$G_sel1 = $_SESSION['selected_articleT'] = $row_RecArticleT['term_id'];
}

mysql_select_db($database_connect2data, $connect2data);
$query_RecArticleSubT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleSubT' AND TT.parent=$G_sel1 AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecArticleSubT = mysql_query($query_RecArticleSubT, $connect2data) or die(mysql_error());
$row_RecArticleSubT = mysql_fetch_assoc($RecArticleSubT);
$totalRows_RecArticleSubT = mysql_num_rows($RecArticleSubT);

$G_sel2 = '';
if(isset($_GET['sel2']))
{
	$_SESSION['selected_articleSubT'] = $G_sel2 = $_GET['sel2'];
}else 
{
	$G_sel2 = $_SESSION['selected_articleSubT'] = $row_RecArticleSubT['term_id'];
}
/*========================================================================================================*/
$authorSQL = "";
//CHECK 管理者還是作者登入
if(isset($_SESSION['MM_AccountUserType']) && $_SESSION['MM_AccountUserType'] == 1){
	//管理者登入

  mysql_select_db($database_connect2data, $connect2data);
  $query_RecCheckAuthor = "SELECT * FROM `admin` WHERE user_type=1 AND user_account='".$_SESSION['MM_AccountUsername']."' AND user_active=1";
  $RecCheckAuthor = mysql_query($query_RecCheckAuthor, $connect2data) or die(mysql_error());
  $row_RecCheckAuthor = mysql_fetch_assoc($RecCheckAuthor);
  $totalRows_RecCheckAuthor = mysql_num_rows($RecCheckAuthor);

  if($totalRows_RecCheckAuthor>0){
  	$authorSQL = "";
  }

}else{
	//作者登入
	mysql_select_db($database_connect2data, $connect2data);
  $query_RecCheckAuthor = "SELECT * FROM `admin` WHERE user_type=0 AND user_account='".$_SESSION['MM_AccountUsername']."' AND user_active=1";
  $RecCheckAuthor = mysql_query($query_RecCheckAuthor, $connect2data) or die(mysql_error());
  $row_RecCheckAuthor = mysql_fetch_assoc($RecCheckAuthor);
  $totalRows_RecCheckAuthor = mysql_num_rows($RecCheckAuthor);

  if($totalRows_RecCheckAuthor>0){
  	$authorSQL = " AND d_class6='".$row_RecCheckAuthor['user_id']."'";
  }
}
/*========================================================================================================*/

mysql_select_db($database_connect2data, $connect2data);
//$query_RecArticle = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$G_sel2' AND D.d_class1='article' $authorSQL ORDER BY term_order ASC, d_date DESC";
$query_RecArticle = "SELECT * FROM data_set AS D WHERE D.d_class2='$G_sel1' AND D.d_class3='$G_sel2' AND D.d_class1='article' $authorSQL ORDER BY d_sort ASC, d_date DESC";
$query_limit_RecArticle = sprintf("%s LIMIT %d, %d", $query_RecArticle, $startRow_RecArticle, $maxRows_RecArticle);
$RecArticle = mysql_query($query_limit_RecArticle, $connect2data) or die(mysql_error());
$row_RecArticle = mysql_fetch_assoc($RecArticle);
//$_SESSION['selected_article']=$G_selected2;
//echo $query_RecArticle;


if (isset($_GET['totalRows_RecArticle'])) {
  $S_original_selected1='';
  if(isset($_SESSION['original_selected1'])){
  	$S_original_selected1 = $_SESSION['original_selected1'];
  }
 /*if(isset($_GET['selected2']) && $_GET['selected2']!=''){
	$G_selected2 = $_GET['selected2'];
  } */
	  if($S_original_selected1==$G_sel1)
		{
			$totalRows_RecArticle = $_GET['totalRows_RecArticle'];
		}else
		{
			$all_RecArticle = mysql_query($query_RecArticle);
 	  		$totalRows_RecArticle = mysql_num_rows($all_RecArticle);
		}
	} else {
	  $all_RecArticle = mysql_query($query_RecArticle);
 	  $totalRows_RecArticle = mysql_num_rows($all_RecArticle);
	}
	$all_RecArticle = mysql_query($query_RecArticle);
 	$totalRows_RecArticle = mysql_num_rows($all_RecArticle);
	$totalPages_RecArticle = ceil($totalRows_RecArticle/$maxRows_RecArticle)-1;
	$TotalPage = $totalPages_RecArticle;

$queryString_RecArticle = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false && 
        stristr($param, "totalRows_RecArticle") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecArticle = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecArticle = sprintf("&totalRows_RecArticle=%d%s", $totalRows_RecArticle, $queryString_RecArticle);
 $menu_is="article";?>
 <?php 
    $R_pageNum = 0;
 if (isset($_REQUEST["pageNum"])) 
 {
 	$R_pageNum = $_REQUEST["pageNum"];
 }
      if (! isset($R_pageNum)) 
      {
	  	$_SESSION["ToPage"]=0;
	  }
 	  //若指定分頁數小於1則預設顯示第一頁
  	  else if ($R_pageNum<0) 
      {
	  	$_SESSION["ToPage"]=0;
      }
	  //若指定指定的分頁超過總分頁數則顯示最後一頁
 	  else if ($R_pageNum>$totalPages_RecArticle)
      {
	  	$_SESSION["ToPage"]=$TotalPage;
	  }
	  else
	  {
	  	$_SESSION["ToPage"]=$R_pageNum;
 	  }
?>
<?php
	//如果指定的頁面大於資料所擁有的頁面,轉到最大的頁面
	if($R_pageNum>$totalPages_RecArticle && $R_pageNum!=0)
	{
		header("Location:article_list.php?pageNum=".$totalPages_RecArticle);
	}

	
?>
  <?php
//修改排序
$G_changeSort = 0;
$G_delchangeSort = 0;
if (isset($_GET['changeSort']))
{
	$G_changeSort = $_GET['changeSort'];
}
if (isset($_GET['delchangeSort']))
{
	$G_delchangeSort = $_GET['delchangeSort'];
}
if ($G_changeSort==1||$G_delchangeSort==1) 
{
	$sort_num=1;
	
	//echo "now_d_id=".$_GET['now_d_id'];
	//echo "change_num=".$_GET['change_num'];
	
	mysql_select_db($database_connect2data, $connect2data);
	
	//$query_RecArticle = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$G_sel1' AND D.d_class1='article' GROUP BY D.d_id ORDER BY term_order ASC, d_date DESC";
	$query_RecArticle = "SELECT * FROM data_set AS D WHERE D.d_class2='$G_sel1' AND D.d_class3='$G_sel2' AND D.d_class1='article' $authorSQL ORDER BY d_sort ASC, d_date DESC";
	$_SESSION['selected_articleT']=$G_sel1;
	
	$RecArticle = mysql_query($query_RecArticle, $connect2data) or die(mysql_error());
	$row_RecArticle = mysql_fetch_assoc($RecArticle);
	//echo '<br>query 2 = '.$query_RecArticle.'<br>';

	do{
		//echo 'd_id = >'.$row_RecArticle['d_id'].' term_order =>'.$row_RecArticle['term_order'].', sort_num =>'.$sort_num.'<br>';
		if($row_RecArticle['d_sort']==0)
		{}
		else if($row_RecArticle['d_id']==$_GET['now_d_id'])
		{	
			//echo 'sort_num(now_d_id) = '.$sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			//echo 'sort_num(change_num) = '.$sort_num."<br/>";
			$sort_num++;

			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s AND d_class2=%s AND d_class3=%s AND d_class1='article' ",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecArticle['d_id'], "int"),
			   GetSQLValueString($G_sel1, "int"),
			   GetSQLValueString($G_sel2, "int"));
			
			/*$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecArticle['d_id'], "int"),
			   GetSQLValueString($row_RecArticle['term_id'], "int"));*/

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			/*$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecArticle['d_id'], "int"),
			   GetSQLValueString($row_RecArticle['term_id'], "int"));*/

			 $updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s AND d_class2=%s AND d_class3=%s AND d_class1='article' ",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecArticle['d_id'], "int"),
			   GetSQLValueString($G_sel1, "int"),
			   GetSQLValueString($G_sel2, "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecArticle['d_title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecArticle['term_order'].'<br>';
	}while ($row_RecArticle = mysql_fetch_assoc($RecArticle));
	
	
			/*$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_d_id'], "int"),
			   GetSQLValueString($G_sel1, "int"));*/
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s AND d_class2=%s AND d_class3=%s AND d_class1='article' ",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_d_id'], "int"),
			   GetSQLValueString($G_sel1, "int"),
			   GetSQLValueString($G_sel2, "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			//echo $updateSQL;
	if($G_changeSort==1)
	{
		/*if(isset($_GET['selected2']))
		{
		$G_selected2 = $_GET['selected2'];*/
		if(isset($_GET['now_d_id'])){
			header("Location:article_list.php?sel1=".$G_sel1."&sel2=".$G_sel2."&pageNum=".$_GET['pageNum']."&totalRows_RecArticle=".$_GET['totalRows_RecArticle']."#".$_GET['now_d_id']);
		}else{
			header("Location:article_list.php?sel1=".$G_sel1."&sel2=".$G_sel2."&pageNum=".$_GET['pageNum']."&totalRows_RecArticle=".$_GET['totalRows_RecArticle']);
		}
		/*}else
		{
			header("Location:article_list.php?sel1=".$row_RecArticleT['term_id']."&pageNum=".$_GET['pageNum']."&totalRows_RecArticle=".$_GET['totalRows_RecArticle']);
		}*/
	
	}else if($G_delchangeSort==1)
	{
		/*if(isset($_GET['selected2']))
		{
		$G_selected2 = $_GET['selected2'];*/
			header("Location:article_list.php?sel1=".$G_sel1."&sel2=".$G_sel2."&pageNum=".$_GET['pageNum']);
		/*}else
		{
			header("Location:article_list.php?selected=".$row_RecArticleT['term_id']."&pageNum=".$_GET['pageNum']);
		}*/
	}
}
//echo 'selected_articleT = '.$_SESSION['selected_articleT'];
?>
<?php
//整個排序重整
/*if (isset($_GET['sortAll']) && $_GET['sortAll']=='sortAll') 
{
	$sort_num=1;
	
	mysql_select_db($database_connect2data, $connect2data);
	
	$query_RecArticle = "SELECT * FROM term_relationships AS TR, data_set AS D, terms AS T
WHERE TR.term_taxonomy_id = T.term_id AND D.d_id = TR.object_id AND T.term_id='$G_sel1' AND D.d_class1='article' GROUP BY D.d_id ORDER BY d_date DESC";
	$_SESSION['selected_articleT']=$G_sel1;
	
	$RecArticle = mysql_query($query_RecArticle, $connect2data) or die(mysql_error());
	$row_RecArticle = mysql_fetch_assoc($RecArticle);

	do{
		$updateSQL = sprintf("UPDATE term_relationships SET term_order=%s WHERE object_id=%s AND term_taxonomy_id=%s ",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecArticle['d_id'], "int"),
			   GetSQLValueString($row_RecArticle['term_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		
		
	//echo " ".$row_RecArticle['term_order'].'<br>';
	}while ($row_RecArticle = mysql_fetch_assoc($RecArticle));
			
			//echo $updateSQL;
	header("Location:article_list.php?sel1=".$G_sel1);
}*/
?>
<?php 
require_once('display_page.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>
<style>
.chosen-choices {
	position: relative;
	/*overflow: hidden;*/
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	box-sizing: border-box;
	margin: 0;
	padding: 0;
	width: 100%;
	height: auto !important;
	height: 1%;	
}
.chosen-choices li.search-choice {
	position: relative;
	margin: 3px 5px 3px 0px;
	padding: 3px 5px;
	border: 1px solid #aaa;
	border-radius: 3px;
	background-color: #e4e4e4;
	background-image: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #f4f4f4), color-stop(50%, #f0f0f0), color-stop(52%, #e8e8e8), color-stop(100%, #eeeeee));
	background-image: -webkit-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-image: -moz-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-image: -o-linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-image: linear-gradient(#f4f4f4 20%, #f0f0f0 50%, #e8e8e8 52%, #eeeeee 100%);
	background-clip: padding-box;
	box-shadow: 0 0 2px white inset, 0 1px 0 rgba(0, 0, 0, 0.05);
	color: #333;
	line-height: 13px;
}
.chosen-choices li {
	list-style: none;
}
</style>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function changeSort(pageNum, totalRows_RecArticle, now_d_id, change_num, sel1, sel2) { //v1.0
 window.location.href="article_list.php?sel1="+sel1+"&sel2="+sel2+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num+"&pageNum="+pageNum+"&totalRows_RecArticle="+totalRows_RecArticle;
}
//-->
</script>
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
    	<tr>
        	<td width="150" class="list_title">文章列表</td>
        	<td width="874">
        	<span class="table_data">分類：
				<label>
				<select name="select1" id="select1">
				<?php
				do {  
				?>
				<option value="<?php echo $row_RecArticleT['term_id']?>"<?php if (!(strcmp($row_RecArticleT['term_id'], $G_sel1))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecArticleT['name'].' '.$row_RecArticleT['name_en']?><?php //echo $row_RecArticleT['term_id']?></option>
				<?php
				} while ($row_RecArticleT = mysql_fetch_assoc($RecArticleT));
				  $rows = mysql_num_rows($RecArticleT);
				  if($rows > 0) {
				      mysql_data_seek($RecArticleT, 0);
					  $row_RecArticleT = mysql_fetch_assoc($RecArticleT);
				  }
				?>
				</select>
				</label>

        	</span>	


        	<span class="table_data">子分類：
				<label>
					<select name="select2" id="select2">
					<?php
					do { 
					?>
					<option value="<?php echo $row_RecArticleSubT['term_id']?>"<?php if (!(strcmp($row_RecArticleSubT['term_id'], $G_sel2))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecArticleSubT['name'].' '.$row_RecArticleSubT['name_en']?><?php //echo $row_RecArticleSubT['term_id']?></option>
					<?php
					} while ($row_RecArticleSubT = mysql_fetch_assoc($RecArticleSubT));
					  $rows = mysql_num_rows($RecArticleSubT);
					  if($rows > 0) {
					      mysql_data_seek($RecArticleSubT, 0);
						  $row_RecArticleSubT = mysql_fetch_assoc($RecArticleSubT);
					  }
					?>
					</select>
				</label>

        	</span>			

			<?php if(0){ ?>
			<a href="article_list.php?sortAll=sortAll&sel1=<?php echo $G_sel1; ?>" class="submenu" style="margin-left: 10px;">重整排序</a>
			<?php } ?>

        	<span class="no_data">
        	    <?php if ($totalRows_RecArticle == 0) { // Show if recordset empty ?>
        	      <strong>此分類沒有資料</strong>
        	      <?php } // Show if recordset empty ?>
            </span> </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php 	
	displayPages($pageNum, $queryString_RecArticle, $totalPages_RecArticle, $totalRows_RecArticle, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecArticle > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecArticle+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecArticle ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="article_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecArticle > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="80" align="center" class="table_title">日期</td>
            <td width="60" align="center" class="table_title">排序</td>

			<?php 
			//CHECK 管理者還是作者登入
			if(isset($_SESSION['MM_AccountUserType']) && $_SESSION['MM_AccountUserType'] == 1){ 
				//管理者登入才顯示作者
			?>
            <td widht="150" align="center" class="table_title">作者</td>
            <?php } ?>

            <td align="center" class="table_title">標題</td>
            <td width="90" align="center" class="table_title">圖片</td>
            
            <?php if(0){ ?>
            <td width="60" align="center" class="table_title">是否進行中</td>
            <?php } ?>


            <td width="80" align="center" class="table_title">是否推薦</td>

            <td width="70" align="center" class="table_title">在網頁顯示</td>

            <?php if(in_array(5,$_SESSION['MM_Limit']['a4'])){ ?>
            <td width="60" align="center" class="table_title">發佈狀態</td>
            <?php } ?>

          <?php if(in_array(5,$_SESSION['MM_Limit']['a4'])){ ?>
            <td width="40" align="center" class="table_title">編輯</td>
            <?php } ?>

            
            <?php if(in_array(7,$_SESSION['MM_Limit']['a4'])){ ?>
            <td width="40" align="center" class="table_title">刪除</td>
            <?php } ?>

          </tr>
          <?php 
    	$i=0;//加上i
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
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecImage = "SELECT * FROM file_set  WHERE file_type='image' AND file_d_id = ".$row_RecArticle['d_id']." ORDER BY file_id DESC";
		$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
		$row_RecImage = mysql_fetch_assoc($RecImage);
		$totalRows_RecImage = mysql_num_rows($RecImage);
		//echo 'totalRows_RecImage'.$totalRows_RecImage;
		?>
  
    
      <td align="center" class="table_data" >
      
      <?php
          if(in_array(5,$_SESSION['MM_Limit']['a4'])){
			  echo '<a href="article_edit.php?d_id='.$row_RecArticle['d_id'].'">'.date("Y-m-d", strtotime($row_RecArticle['d_date'])).'</a>';
		  }else{
			  //echo date("Y M. d"", strtotime($row_RecArticle['d_date']));
		  	echo date("Y-m-d", strtotime($row_RecArticle['d_date']));
		  }
		  ?>
      
      
      
     </td>
  <td align="center" class="table_data" >
  <?php
          if(in_array(5,$_SESSION['MM_Limit']['a4'])){
			  ?>
           <label>
        <select name="sort" id="sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows_RecArticle; ?>','<?php echo $row_RecArticle['d_id']; ?>',this.options[this.selectedIndex].value,'<?php if(isset($G_sel1)){echo $G_sel1;}else{echo $row_RecArticleT['term_id'];} ?>', '<?php if(isset($G_sel2)){echo $G_sel2;}else{echo $row_RecArticleSubT['term_id'];} ?>')">
          <option value="0" <?php if (!(strcmp(0, $row_RecArticle['d_sort']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
		 		
          for($j=1;$j<=($totalRows_RecArticle);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_RecArticle['d_sort']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label>
		<?php }else{
			if (!(strcmp(0, $row_RecArticle['d_sort']))) {
				echo "至頂";
			}else{
				echo $row_RecArticle['d_sort'];
			}
			
		} ?>
  
  
  <?php $_SESSION['totalRows']=$totalRows_RecArticle; ?></td>

  <?php 
	//CHECK 管理者還是作者登入
	if(isset($_SESSION['MM_AccountUserType']) && $_SESSION['MM_AccountUserType'] == 1){ 
		//管理者登入才顯示作者
	?>
	<td align="center" class="table_data" >
	  <?php
	  if(in_array(5,$_SESSION['MM_Limit']['a4'])){
	  	echo '<a href="article_edit.php?d_id='.$row_RecArticle['d_id'].'">'.$row_RecArticle['d_class5'].'</a>';
	  }else{
	  	echo $row_RecArticle['d_class5'];
	  }
	  ?>
    </td>
    <?php }//CHECK 管理者還是作者登入 ?>
     
      <td align="center" class="table_data" >
      
      <?php
      if(in_array(5,$_SESSION['MM_Limit']['a4'])){
		  echo '<a href="article_edit.php?d_id='.$row_RecArticle['d_id'].'">'.$row_RecArticle['d_title'].'</a>';
	  }else{
		  echo $row_RecArticle['d_title'];
	  }
	  ?>
      </td>
      
      
      
      
     
    <td align="center"  class="table_data">
    <a name="<?php echo $row_RecArticle['d_id']; ?>" id="<?php echo $row_RecArticle['d_id']; ?>"></a>
    
    
    <?php
          if(in_array(5,$_SESSION['MM_Limit']['a4'])){
			  echo '<a href="article_edit.php?d_id='.$row_RecArticle['d_id'].'">';
			  echo '<img src="';
			  if($totalRows_RecImage==0){
				  echo "image/default_image_s.jpg";
			  }else{
				  echo "../".$row_RecImage['file_link2'];
			  }
			  echo '" alt="" class="image_frame"  width="100"/>';
			  echo '</a>';
		  }else{
			  echo '<img src="';
			  if($totalRows_RecImage==0){
				  echo "image/default_image_s.jpg";
			  }else{
				  echo "../".$row_RecImage['file_link2'];
			  }
			  echo '" alt="" class="image_frame"  width="100"/>';
		  }
		  ?>
    
    </td>

    <td align="center"  class="table_data">
      
            <?php //推薦
            if(in_array(5,$_SESSION['MM_Limit']['a4'])){
		        if($row_RecArticle['d_recommend']){
		          echo "<a href='".$row_RecArticle['d_recommend']."' rel='".$row_RecArticle['d_id']."' class='activeChRe' title='推薦'>推薦</a>";
		        }else{
		          echo "<a href='".$row_RecArticle['d_recommend']."' rel='".$row_RecArticle['d_id']."' class='activeChRe' title='否'>否</a>";
		        }
		      }else{
		        if($row_RecArticle['d_recommend']){
		          echo "推薦";
		        }else{
		          echo "否";
		        }
	      	}
	      	?>
        </td>

		<?php if(0){ ?>
        <td align="center"  class="table_data">
      
            <?php //進行中
            if(in_array(5,$_SESSION['MM_Limit']['a4'])){
		        if($row_RecArticle['d_sale']){
		          echo "<a href='".$row_RecArticle['d_sale']."' rel='".$row_RecArticle['d_id']."' class='pubA' title='進行中'>進行中</a>";
		        }else{
		          echo "<a href='".$row_RecArticle['d_sale']."' rel='".$row_RecArticle['d_id']."' class='pubA' title='非進行中'>非進行中</a>";
		        }
		      }else{
		        if($row_RecArticle['d_sale']){
		          echo "進行中";
		        }else{
		          echo "非進行中";
		        }
	      	}
	      	?>
        </td>
        <?php } ?>
    
   
    <td align="center"  class="table_data">
	
	<?php
          if(in_array(5,$_SESSION['MM_Limit']['a4'])){
			  if($row_RecArticle['d_active']){
					echo "<a href='".$row_RecArticle['d_active']."' rel='".$row_RecArticle['d_id']."' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}else{
					echo "<a href='".$row_RecArticle['d_active']."' rel='".$row_RecArticle['d_id']."' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
		  }else{
			  if($row_RecArticle['d_active']){
					echo "<img src=\"image/accept.png\" width=\"16\" height=\"16\"  >";
				}else{
					echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >";
				}
		  }
		  ?>
          </td>

        <td align="center"  class="table_data">
      
            <?php //發佈狀態
            if(isset($_SESSION['MM_AccountUserType']) && $_SESSION['MM_AccountUserType'] == 1){ 
            	if(in_array(5,$_SESSION['MM_Limit']['a4'])){

			        if($row_RecArticle['d_pub']){
			          echo "<a href='".$row_RecArticle['d_pub']."' rel='".$row_RecArticle['d_id']."' class='pubD' title='發佈'>發佈</a>";
			        }else{
			          echo "<a href='".$row_RecArticle['d_pub']."' rel='".$row_RecArticle['d_id']."' class='pubD' title='草稿'>草稿</a>";
			        }

			    }else{

			    	if($row_RecArticle['d_pub']){
			          echo "發佈";
			        }else{
			          echo "草稿";
			        }

		      	}
            }else{
            	if($row_RecArticle['d_pub']){
		          echo "發佈";
		        }else{
		          echo "草稿";
		        }
            }
	      	?>
        </td>


          <?php if(in_array(5,$_SESSION['MM_Limit']['a4'])){ ?>
    <td align="center" class="table_data"><a href="article_edit.php?d_id=<?php echo $row_RecArticle['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
    <?php } ?>

            <?php if(in_array(7,$_SESSION['MM_Limit']['a4'])){ ?>
    <td align="center" class="table_data"><a href="article_del.php?d_id=<?php echo $row_RecArticle['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
    <?php } ?>

  </tr>
  <?php } while ($row_RecArticle = mysql_fetch_assoc($RecArticle)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php 	
	displayPages($pageNum, $queryString_RecArticle, $totalPages_RecArticle, $totalRows_RecArticle, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecArticle > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecArticle+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecArticle ?> </td>
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
mysql_free_result($RecArticle);

mysql_free_result($RecArticleT);
?>

<script type="text/javascript">
$(document).ready(function(){
 $('.action').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "country")
   {
    result = 'state';
   }
   else
   {
    result = 'city';
   }
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{action:action, query:query},
    success:function(data){
     $('#'+result).html(data);
    }
   })
  }
 });
});


$(document).ready(function() {

	$('#select1').change(function() {
		if($(this).val() != ''){
			var action = $(this).attr("id");
		    var query = $(this).val();
		    var result = 'select2';
		    $.ajax({
			    url:"fetch.php",
			    method:"POST",
			    data:{action:action, query:query},
			    success:function(data){
			     $('#'+result).html(data);
			    }
			})
		}
		//alert($(this).val());
		//window.location.href = "article_list.php?sel1="+$(this).val();
	});

	$('#select2').change(function() {
		window.location.href = "article_list.php?sel1="+$('#select1').val()+"&sel2="+$(this).val();
	});
  
});
</script>