<?php
if (!isset($_SESSION)) {
  session_start();
}
ob_start();
?>
<?php require_once('../Connections/connect2data.php'); ?>
<?php
//fetch.php
if(isset($_POST["action"]))
{


 $output = '';
 if($_POST["action"] == "select1")
 {

  mysql_select_db($database_connect2data, $connect2data);
  $query_RecArticleSubT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleSubT' AND TT.parent='".$_POST["query"]."' ORDER BY term_sort ASC, term_id DESC";
  $RecArticleSubT = mysql_query($query_RecArticleSubT, $connect2data) or die(mysql_error());
  $row_RecArticleSubT = mysql_fetch_assoc($RecArticleSubT);
  $totalRows_RecArticleSubT = mysql_num_rows($RecArticleSubT);

  if($totalRows_RecArticleSubT>0){

    //$output .= '<option value="">Select State</option>';
    /*while($row = mysql_fetch_array($RecArticleSubT))
    {
     $output .= '<option value="'.$row["term_id"].'">'.$row["name"].' '.$row["name_en"].'</option>';
    }*/
    $output .= '<option value="-1">請選擇子分類</option>';
    do{

      $output .= '<option value="'.$row_RecArticleSubT["term_id"].'">'.$row_RecArticleSubT["name"].' '.$row_RecArticleSubT["name_en"].'</option>';
    } while ($row_RecArticleSubT = mysql_fetch_assoc($RecArticleSubT));

  }else{
    $output .= '<option value="-1">目前沒有子分類</option>';
  }
 

  /*$query = "SELECT state FROM country_state_city WHERE country = '".$_POST["query"]."' GROUP BY state";
  $result = mysqli_query($connect, $query);*/
  
 }


  if($_POST["action"] == "d_class2")
 {

  mysql_select_db($database_connect2data, $connect2data);
  $query_RecArticleSubT = "SELECT * FROM terms AS T NATURAL JOIN term_taxonomy AS TT WHERE TT.taxonomy='articleSubT' AND TT.parent='".$_POST["query"]."' ORDER BY term_sort ASC, term_id DESC";
  $RecArticleSubT = mysql_query($query_RecArticleSubT, $connect2data) or die(mysql_error());
  $row_RecArticleSubT = mysql_fetch_assoc($RecArticleSubT);
  $totalRows_RecArticleSubT = mysql_num_rows($RecArticleSubT);

  if($totalRows_RecArticleSubT>0){

    //$output .= '<option value="">Select State</option>';
    /*while($row = mysql_fetch_array($RecArticleSubT))
    {
     $output .= '<option value="'.$row["term_id"].'">'.$row["name"].' '.$row["name_en"].'</option>';
    }*/
    //$output .= '<option value="-1">請選擇子分類</option>';
    do{

      $output .= '<option value="'.$row_RecArticleSubT["term_id"].'">'.$row_RecArticleSubT["name"].' '.$row_RecArticleSubT["name_en"].'</option>';
    } while ($row_RecArticleSubT = mysql_fetch_assoc($RecArticleSubT));

  }else{
    $output .= '<option value="-1">目前沒有子分類</option>';
  }
 

  /*$query = "SELECT state FROM country_state_city WHERE country = '".$_POST["query"]."' GROUP BY state";
  $result = mysqli_query($connect, $query);*/
  
 }

/* if($_POST["action"] == "state")
 {
  $query = "SELECT city FROM country_state_city WHERE state = '".$_POST["query"]."'";
  $result = mysqli_query($connect, $query);
  $output .= '<option value="">Select City</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["city"].'">'.$row["city"].'</option>';
  }
 }*/

 echo $output;
}
?>