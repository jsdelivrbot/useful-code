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

if(!in_array(3,$_SESSION['MM_Limit']['a9'])){
	header("Location: first.php");
}

$_SESSION['listLinks'] = NULL;

$menu_is="gallery";

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecGallery = 50;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecGallery = $pageNum * $maxRows_RecGallery;

mysql_select_db($database_connect2data, $connect2data);
$query_RecYears = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='years' AND T.term_active='1' ORDER BY term_sort ASC, term_id DESC";
$RecYears = mysql_query($query_RecYears, $connect2data) or die(mysql_error());
$row_RecYears = mysql_fetch_assoc($RecYears);
$totalRows_RecYears = mysql_num_rows($RecYears);

$G_sel = '';
if(isset($_GET['sel']))
{
  $_SESSION['selected_year'] = $G_sel = $_GET['sel'];
}else 
{
  $G_sel = $_SESSION['selected_year'] = $row_RecYears['term_id'];
}
mysql_select_db($database_connect2data, $connect2data);
//$query_RecGallery = "SELECT * FROM data_set WHERE d_class1 = 'gallery' ORDER BY d_sort ASC, d_date DESC";
$query_RecGallery = "SELECT * FROM data_set AS D LEFT JOIN terms AS T ON T.term_id=D.d_class2 WHERE T.term_id='$G_sel' AND D.d_class1='gallery' AND D.d_active='1' ORDER BY d_sort ASC, d_date DESC";
//echo $query_RecGallery;
$query_limit_RecGallery = sprintf("%s LIMIT %d, %d", $query_RecGallery, $startRow_RecGallery, $maxRows_RecGallery);
$RecGallery = mysql_query($query_limit_RecGallery, $connect2data) or die(mysql_error());
$row_RecGallery = mysql_fetch_assoc($RecGallery);

/*if (isset($_GET['totalRows'])) {
  $totalRows = $_GET['totalRows'];
} else {
  $all_RecGallery = mysql_query($query_RecGallery);
  $totalRows = mysql_num_rows($all_RecGallery);
}*/
/*$S_original_selected='';
if(isset($_SESSION['original_selected'])){
  $S_original_selected = $_SESSION['original_selected'];
}*/

$all_RecGallery = mysql_query($query_RecGallery);
$totalRows = mysql_num_rows($all_RecGallery);
$totalPages = ceil($totalRows/$maxRows_RecGallery)-1;
$_SESSION['totalRows'] = $totalRows;
$TotalPage = $totalPages;

$queryString = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false && 
        stristr($param, "totalRows") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString = sprintf("&totalRows=%d%s", $totalRows, $queryString);
?>
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
 	  else if ($R_pageNum>$totalPages)
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
	if($R_pageNum>$totalPages && $R_pageNum!=0)
	{
		header("Location:gallery_list.php?pageNum=".$totalPages);
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
	//$query_RecGallery = "SELECT * FROM data_set WHERE d_class1 = 'gallery' ORDER BY d_sort ASC, d_date DESC";
  $query_RecGallery = "SELECT * FROM data_set AS D LEFT JOIN terms AS T ON T.term_id=D.d_class2 WHERE T.term_id='$G_sel' AND D.d_class1='gallery' AND D.d_active='1' ORDER BY d_sort ASC, d_date DESC";
	$RecGallery = mysql_query($query_RecGallery, $connect2data) or die(mysql_error());
	$row_RecGallery = mysql_fetch_assoc($RecGallery);
	

	do{
	
		if($row_RecGallery['d_sort']==0)
		{}
		else if($row_RecGallery['d_id']==$_GET['now_d_id'])
		{	
			echo $sort_num."<br/>";
			
		}else if($sort_num==$_GET['change_num'])
		{
			echo $sort_num."<br/>";
			$sort_num++;
			
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecGallery['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			$sort_num++;
		}
		else
		{
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($sort_num, "int"),
			   GetSQLValueString($row_RecGallery['d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
			
			echo $sort_num."<br/>";
			echo $row_RecGallery['d_title']."->".$sort_num."<br/>";
			
			$sort_num++;		
		}
		
		
	//echo " ".$row_RecGallery['d_sort'];
	}while ($row_RecGallery = mysql_fetch_assoc($RecGallery));
	
	
			$updateSQL = sprintf("UPDATE data_set SET d_sort=%s WHERE d_id=%s",
			   GetSQLValueString($_GET['change_num'], "int"),
			   GetSQLValueString($_GET['now_d_id'], "int"));

			mysql_select_db($database_connect2data, $connect2data);
			$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
	if($G_changeSort==1)
	{
	header("Location:gallery_list.php?sel=".$G_sel."&pageNum=".$_GET['pageNum']."&totalRows=".$_GET['totalRows']);
	}else if($G_delchangeSort==1)
	{
	header("Location:gallery_list.php?sel=".$G_sel."&pageNum=".$_GET['pageNum']);
	}
}
$_SESSION['totalRows']=$totalRows;
?>
<?php require_once('display_page.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/template.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php require_once('cmsTitle.php'); ?></title>
<?php require_once('script.php'); ?>
<!-- InstanceBeginEditable name="doctitle" -->
<title>無標題文件</title>
<script type="text/javascript">
<!--
function changeSort(pageNum, totalRows, now_d_id, change_num, sel) { //v1.0
 //alert(pageNum+"+"+totalPages); 
 window.location.href="gallery_list.php?sel="+<?php echo $G_sel;?>+"&pageNum="+pageNum+"&totalRows="+totalRows+"&changeSort=1"+"&now_d_id="+now_d_id+"&change_num="+change_num;
}
//-->
</script>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
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
        	<td width="150" class="list_title">美術館列表</td>
        	<td>
          <span class="table_data">年份：
<label>
<select name="select1" id="select1">
<?php
do {  
?>
<option value="<?php echo $row_RecYears['term_id']?>"<?php if (!(strcmp($row_RecYears['term_id'], $G_sel))) {echo "selected=\"selected\"";} ?>><?php echo $row_RecYears['name']?><?php //echo $row_RecYears['term_id']?></option>
<?php
} while ($row_RecYears = mysql_fetch_assoc($RecYears));
  $rows = mysql_num_rows($RecYears);
  if($rows > 0) {
      mysql_data_seek($RecYears, 0);
    $row_RecYears = mysql_fetch_assoc($RecYears);
  }
?>
</select>
</label>

          </span><span class="no_data">
              <?php if ($totalRows == 0) { // Show if recordset empty ?>
                <strong>此分類沒有資料</strong>
                <?php } // Show if recordset empty ?>
            </span>
</span> </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
    <!-------顯示頁選擇與分頁設定開始---------->
    <?php 	
	displayPages($pageNum, $queryString, $totalPages, $totalRows, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows ?> </td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="gallery_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
            <td width="142" align="center" class="table_title">日期</td>
            
            <td width="74" align="center" class="table_title">排序</td>
            
            <td align="center" class="table_title">標題</td>
            <td width="140" align="center" class="table_title">圖片</td>

            
            <td width="60" align="center" class="table_title">在網頁顯示</td>

            <?php if(in_array(5,$_SESSION['MM_Limit']['a9'])){ ?>
            <td width="60" align="center" class="table_title">發佈狀態</td>
            <?php } ?>

            <?php if(in_array(5,$_SESSION['MM_Limit']['a9'])){ ?>
            <td width="30" align="center" class="table_title">編輯</td>
            <?php } ?>

            <?php if(in_array(7,$_SESSION['MM_Limit']['a9'])){ ?>
            <td width="30" align="center" class="table_title">刪除</td>
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
		
		$colname_RecImage = "-1";
		if (isset($row_RecGallery['d_id'])) {
		  $colname_RecImage = $row_RecGallery['d_id'];
		}
		mysql_select_db($database_connect2data, $connect2data);
		$query_RecImage = sprintf("SELECT * FROM file_set WHERE file_type='imageCover' AND file_d_id = %s", GetSQLValueString($colname_RecImage, "int"));
		$RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
		$row_RecImage = mysql_fetch_assoc($RecImage);
		$totalRows_RecImage = mysql_num_rows($RecImage);
		
		//echo $totalRows_RecImage;
		?>
          <td align="center" class="table_data" >
          
          <?php
          if(in_array(5,$_SESSION['MM_Limit']['a9'])){
			  echo '<a href="gallery_edit.php?d_id='.$row_RecGallery['d_id'].'">'.$row_RecGallery['d_date'].'</a>';
		  }else{
			  echo $row_RecGallery['d_date'];
		  }
		  ?>
          
          </td>

          
          <td align="center" class="table_data" >
           <?php
          if(in_array(5,$_SESSION['MM_Limit']['a9'])){
			  ?>
           <label>
        <select name="d_sort" id="d_sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows; ?>','<?php echo $row_RecGallery['d_id']; ?>',this.options[this.selectedIndex].value), '<?php echo $G_sel;?>'">
          <option value="0" <?php if (!(strcmp(0, $row_RecGallery['d_sort']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
		 		
          for($j=1;$j<=($totalRows);$j++)
          {
          	echo "<option value=\"".$j."\" ";
			if (!(strcmp($j, $row_RecGallery['d_sort']))) {echo "selected=\"selected\"";}
			echo ">".$j."</option>";
          }
		  ?>
        </select>
        </label>
		<?php }else{
			if (!(strcmp(0, $row_RecGallery['d_sort']))) {
				echo "至頂";
			}else{
				echo $row_RecGallery['d_sort'];
			}
			
		} ?>
		
		</td>

        <td align="center" class="table_data" >
        
        <?php
          if(in_array(5,$_SESSION['MM_Limit']['a9'])){
			  echo '<a href="gallery_edit.php?d_id='.$row_RecGallery['d_id'].'">'.$row_RecGallery['d_title'].'</a>';
		  }else{
			  echo $row_RecGallery['d_title'];
		  }
		  ?>
        
        
        </td>
        
            <td align="center"  class="table_data">
            
            <?php
          if(in_array(5,$_SESSION['MM_Limit']['a9'])){
			  echo '<a href="gallery_edit.php?d_id='.$row_RecGallery['d_id'].'">';
			  echo '<img src="';
			  if($totalRows_RecImage==0){
				  echo "image/default_image_s.jpg";
			  }else{
				  echo "../".$row_RecImage['file_link2'];
			  }
			  echo '" alt="" class="image_frame" />';
			  echo '</a>';
		  }else{
			  echo '<img src="';
			  if($totalRows_RecImage==0){
				  echo "image/default_image_s.jpg";
			  }else{
				  echo "../".$row_RecImage['file_link2'];
			  }
			  echo '" alt="" class="image_frame" />';
		  }
		  ?>
            
            
            </td>


            <td align="center"  class="table_data">
			
            <?php
          if(in_array(5,$_SESSION['MM_Limit']['a9'])){
			  if($row_RecGallery['d_active']){
					echo "<a href='".$row_RecGallery['d_active']."' rel='".$row_RecGallery['d_id']."' class='activeCh'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
				}else{
					echo "<a href='".$row_RecGallery['d_active']."' rel='".$row_RecGallery['d_id']."' class='activeCh'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
				}
		  }else{
			  if($row_RecGallery['d_active']){
					echo "<img src=\"image/accept.png\" width=\"16\" height=\"16\"  >";
				}else{
					echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >";
				}
		  }
		  ?>
          </td>


        <td align="center"  class="table_data">
      
            <?php //發佈狀態
          if(in_array(5,$_SESSION['MM_Limit']['a9'])){
        if($row_RecGallery['d_pub']){
          //echo "<a href='".$row_RecGallery['d_pub']."' rel='".$row_RecGallery['d_id']."' class='pubD' title='發佈'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
          echo "<a href='".$row_RecGallery['d_pub']."' rel='".$row_RecGallery['d_id']."' class='pubD' title='發佈'>發佈</a>";
        }else{
          //echo "<a href='".$row_RecGallery['d_pub']."' rel='".$row_RecGallery['d_id']."' class='pubD' title='草稿'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";

          echo "<a href='".$row_RecGallery['d_pub']."' rel='".$row_RecGallery['d_id']."' class='pubD' title='草稿'>草稿</a>";
        }
      }else{
        if($row_RecGallery['d_pub']){
          echo "發佈";
        }else{
          echo "草稿";
        }
      }
      ?>
          </td>

          <?php if(in_array(5,$_SESSION['MM_Limit']['a9'])){ ?>
            <td align="center" class="table_data"><a href="gallery_edit.php?d_id=<?php echo $row_RecGallery['d_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
            <?php } ?>

            
            <?php if(in_array(7,$_SESSION['MM_Limit']['a9'])){ ?>
            <td align="center" class="table_data"><a href="gallery_del.php?d_id=<?php echo $row_RecGallery['d_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
            <?php } ?>

          </tr>
          <?php } while ($row_RecGallery = mysql_fetch_assoc($RecGallery)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
    <?php 	
	displayPages($pageNum, $queryString, $totalPages, $totalRows, $currentPage);
	?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows ?> </td>
            <td width="24" align="right">&nbsp;</td>
        </tr>
    </table>
	<!-- InstanceEndEditable --></td>
  </tr>
</table></td>
  </tr>
</table>
<script type="text/javascript">
$(document).ready(function() {
  $('#select1').change(function() {
    //alert($(this).val());
    window.location.href = "gallery_list.php?sel="+$(this).val();
  });
  
});
</script>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($RecGallery);
?>
