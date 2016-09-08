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

if(!in_array(3,$_SESSION['MM_Limit']['a10'])){
  header("Location: first.php");
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_RecYears = 15;
$pageNum = 0;
if (isset($_GET['pageNum'])) {
  $pageNum = $_GET['pageNum'];
}
$startRow_RecYears = $pageNum * $maxRows_RecYears;

mysql_select_db($database_connect2data, $connect2data);
$query_RecYears = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='years' ORDER BY term_sort ASC, term_id DESC";
$query_limit_RecYears = sprintf("%s LIMIT %d, %d", $query_RecYears, $startRow_RecYears, $maxRows_RecYears);
$RecYears = mysql_query($query_limit_RecYears, $connect2data) or die(mysql_error());
$row_RecYears = mysql_fetch_assoc($RecYears);

if (isset($_GET['totalRows_RecYears'])) {
  $totalRows_RecYears = $_GET['totalRows_RecYears'];
} else {
  $all_RecYears = mysql_query($query_RecYears);
  $totalRows_RecYears = mysql_num_rows($all_RecYears);
}
$totalPages_RecYears = ceil($totalRows_RecYears/$maxRows_RecYears)-1;
$TotalPage = $totalPages_RecYears;


$queryString_RecYears = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum") == false && 
        stristr($param, "totalRows_RecYears") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_RecYears = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_RecYears = sprintf("&totalRows_RecYears=%d%s", $totalRows_RecYears, $queryString_RecYears);
 $menu_is="otherSet";?>
 <?php 
  $R_pageNum = 0;
 if (isset($_REQUEST["pageNum"])) 
 {
  $R_pageNum_RecHorse = $_REQUEST["pageNum"];
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
    else if ($R_pageNum>$totalPages_RecYears)
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
  if($R_pageNum>$totalPages_RecYears && $R_pageNum!=0)
  {
    header("Location:years_list.php?pageNum=".$totalPages_RecYears);
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
  
  //echo "now_term_id=".$_GET['now_term_id'];
  //echo "change_num=".$_GET['change_num'];
  
  mysql_select_db($database_connect2data, $connect2data);
  $query_RecYears = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='years' ORDER BY term_sort ASC, term_id DESC";
  $RecYears = mysql_query($query_RecYears, $connect2data) or die(mysql_error());
  $row_RecYears = mysql_fetch_assoc($RecYears);
  

  do{
  
    if($row_RecYears['term_sort']==0)
    {}
    else if($row_RecYears['term_id']==$_GET['now_term_id'])
    { 
      echo $sort_num."<br/>";
      
    }else if($sort_num==$_GET['change_num'])
    {
      echo $sort_num."<br/>";
      $sort_num++;
      
      $updateSQL = sprintf("UPDATE terms SET term_sort=%s WHERE term_id=%s",
         GetSQLValueString($sort_num, "int"),
         GetSQLValueString($row_RecYears['term_id'], "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
      
      $sort_num++;
    }
    else
    {
      $updateSQL = sprintf("UPDATE terms SET term_sort=%s WHERE term_id=%s",
         GetSQLValueString($sort_num, "int"),
         GetSQLValueString($row_RecYears['term_id'], "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
      
      echo $sort_num."<br/>";
      echo $row_RecYears['title']."->".$sort_num."<br/>";
      
      $sort_num++;    
    }
    
    
  //echo " ".$row_RecYears['term_sort'];
  }while ($row_RecYears = mysql_fetch_assoc($RecYears));
  
  
      $updateSQL = sprintf("UPDATE terms SET term_sort=%s WHERE term_id=%s",
         GetSQLValueString($_GET['change_num'], "int"),
         GetSQLValueString($_GET['now_term_id'], "int"));

      mysql_select_db($database_connect2data, $connect2data);
      $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  if($G_changeSort==1)
  {
  header("Location:years_list.php?pageNum=".$_GET['pageNum']."&totalRows_RecYears=".$_GET['totalRows_RecYears']);
  }else if($G_delchangeSort==1)
  {
  header("Location:years_list.php?pageNum=".$_GET['pageNum']);
  }
}

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
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<script type="text/javascript">
<!--
function changeSort(pageNum, totalRows_RecYears, now_term_id, change_num) { //v1.0
 //alert(pageNum+"+"+totalPages_RecYears); 
 window.location.href="years_list.php?pageNum="+pageNum+"&totalRows_RecYears="+totalRows_RecYears+"&changeSort=1"+"&now_term_id="+now_term_id+"&change_num="+change_num;
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
          <td width="140" class="list_title">年份列表</td>
          <td width="884"><span class="no_data">
            <?php if ($totalRows_RecYears == 0) { // Show if recordset empty ?>
              <strong>目前資料庫中沒有任何年份</strong>
              <?php } // Show if recordset empty ?>
</span> </td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
      <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php   
  displayPages($pageNum, $queryString_RecYears, $totalPages_RecYears, $totalRows_RecYears, $currentPage);
  ?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecYears > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecYears+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecYears ?> </td>
            <td width="24" align="right">&nbsp;</td>
      </tr>
  </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
  <form action="years_process.php" method="post" name="form1" id="form1">
      <?php if ($totalRows_RecYears > 0) { // Show if recordset not empty ?>
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
          <tr>
          <td width="100" align="center" class="table_title">排序</td>
            <td align="center" class="table_title">中文名稱</td>

            <?php if(0){ ?>
            <td align="center" class="table_title">英文名稱</td>
            <td width="90" align="center" class="table_title">圖片</td>
            <?php } ?>

            <td width="40" align="center" class="table_title">狀態</td>
          <?php if(in_array(5,$_SESSION['MM_Limit']['a10'])){ ?>
            <td width="40" align="center" class="table_title">編輯</td>
            <?php } ?>
            <?php if(in_array(7,$_SESSION['MM_Limit']['a10'])){ ?>
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
    
    $colname_RecImage = "-1";
    if (isset($row_RecYears['term_id'])) {
      $colname_RecImage = $row_RecYears['term_id'];
    }
    mysql_select_db($database_connect2data, $connect2data);
    $query_RecImage = sprintf("SELECT * FROM file_set WHERE file_type='yearsCover' AND file_d_id = %s", GetSQLValueString($colname_RecImage, "int"));
    $RecImage = mysql_query($query_RecImage, $connect2data) or die(mysql_error());
    $row_RecImage = mysql_fetch_assoc($RecImage);
    $totalRows_RecImage = mysql_num_rows($RecImage);
    
    //echo $totalRows_RecImage;
    ?>
            <td align="center" class="table_data" >
            
            <?php
          if(in_array(5,$_SESSION['MM_Limit']['a10'])){
        ?>
           <label>
        <select name="term_sort" id="term_sort" onchange="changeSort('<?php echo $pageNum; ?>','<?php echo $totalRows_RecYears; ?>','<?php echo $row_RecYears['term_id']; ?>',this.options[this.selectedIndex].value)">
          <option value="0" <?php if (!(strcmp(0, $row_RecYears['term_sort']))) {echo "selected=\"selected\"";} ?>>至頂</option>
          <?php
        
          for($j=1;$j<=($totalRows_RecYears);$j++)
          {
            echo "<option value=\"".$j."\" ";
      if (!(strcmp($j, $row_RecYears['term_sort']))) {echo "selected=\"selected\"";}
      echo ">".$j."</option>";
          }
      ?>
        </select>
        </label>
    <?php }else{
      if (!(strcmp(0, $row_RecYears['term_sort']))) {
        echo "至頂";
      }else{
        echo $row_RecYears['term_sort'];
      }
      
    } ?>
            
            
            <?php $_SESSION['totalRows']=$totalRows_RecYears; ?></td>
         <td align="center" class="table_data" >
         
         <?php
          if(in_array(5,$_SESSION['MM_Limit']['a10'])){
        echo '<a href="years_edit.php?term_id='.$row_RecYears['term_id'].'">'.$row_RecYears['name'].'</a>';
      }else{
        echo $row_RecYears['name'];
      }
      ?>
         </td>



    <?php if(0){ ?>
        <td align="center" class="table_data" >
         
         <?php
          if(in_array(5,$_SESSION['MM_Limit']['a10'])){
            echo '<a href="years_edit.php?term_id='.$row_RecYears['term_id'].'">'.$row_RecYears['name_en'].'</a>';
          }else{
            echo $row_RecYears['name_en'];
          }
          ?>
        </td>

        <td align="center"  class="table_data">
          <a name="<?php echo $row_RecYears['term_id']; ?>" id="<?php echo $row_RecYears['term_id']; ?>"></a>
          
          
          <?php
                if(in_array(5,$_SESSION['MM_Limit']['a10'])){
              echo '<a href="years_edit.php?term_id='.$row_RecYears['term_id'].'">';
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
    <?php } ?>
         
        <td align="center"  class="table_data">
      
      <?php
          if(in_array(5,$_SESSION['MM_Limit']['a10'])){
        if($row_RecYears['term_active']){
          echo "<a href='".$row_RecYears['term_active']."' rel='".$row_RecYears['term_id']."' class='activeChT'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
        }else{
          echo "<a href='".$row_RecYears['term_active']."' rel='".$row_RecYears['term_id']."' class='activeChT'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
        }
      }else{
        if($row_RecYears['term_active']){
          echo "<img src=\"image/accept.png\" width=\"16\" height=\"16\"  >";
        }else{
          echo "<img src=\"image/delete.png\" width=\"16\" height=\"16\"  >";
        }
      }
      ?>
      
      
      <?php  //list使用
        /*if($row_RecYears['term_active'])
        {
          echo "<a href='years_process.php?term_id=".$row_RecYears['term_id']."&active=".$row_RecYears['term_active']."'><img src=\"image/accept.png\" width=\"16\" height=\"16\"  ></a>";
        }
        else
        {
          echo "<a href='years_process.php?term_id=".$row_RecYears['term_id']."&active=".$row_RecYears['term_active']."'><img src=\"image/delete.png\" width=\"16\" height=\"16\"  ></a>";
        }*/
        
?></td>

<?php if(in_array(5,$_SESSION['MM_Limit']['a10'])){ ?>
    <td align="center" class="table_data"><a href="years_edit.php?term_id=<?php echo $row_RecYears['term_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
    <?php } ?>
            <?php if(in_array(7,$_SESSION['MM_Limit']['a10'])){ ?>
    <td align="center" class="table_data"><a href="years_del.php?term_id=<?php echo $row_RecYears['term_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>
    <?php } ?>

            <!--<td align="center" class="table_data"><a href="years_edit.php?term_id=<?php echo $row_RecYears['term_id']; ?>"><img src="image/pencil.png" width="16" height="16" /></a></td>
            <td align="center" class="table_data"><a href="years_del.php?term_id=<?php echo $row_RecYears['term_id']; ?>"><img src="image/cross.png" width="16" height="16" /></a></td>-->
          </tr>
          <?php } while ($row_RecYears = mysql_fetch_assoc($RecYears)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <!-------顯示頁選擇與分頁設定開始---------->
            <?php   
  displayPages($pageNum, $queryString_RecYears, $totalPages_RecYears, $totalRows_RecYears, $currentPage);
  ?>
<!-------顯示頁選擇與分頁設定結束---------->
            <td width="110" align="right" class="page_display"><?php if ($totalRows_RecYears > 0) { // Show if recordset not empty ?>
                頁數:<?php echo (($pageNum+1)."/".($totalPages_RecYears+1)); ?>
  <?php } // Show if recordset not empty ?>
</td>
            <td width="151" align="right" class="page_display">所有資料數:<?php echo $totalRows_RecYears ?> </td>
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
mysql_free_result($RecYears);
?>
