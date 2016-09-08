<?php
require_once('Connections/connect2data.php');

$colname_Recwork = "";
if (isset($_GET['d_data1'])) {
  $colname_Recwork = "AND d_data1 LIKE '%" .$_GET['d_data1'] ."%'";
}

$query_Recsearch="SELECT * FROM data_set
WHERE d_class1='blog' ".$colname_Recwork."
ORDER BY d_date ASC";

//==========================================================

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ($_POST["MM_insert"] == "form1") {

  $insertGoTo = "blog.php?d_data1=".$_POST["blog-input"];
  // if (isset($_SERVER['QUERY_STRING'])) {
  //   $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
  //   $insertGoTo .= $_SERVER['QUERY_STRING'];
  // }
  header(sprintf("Location: %s", $insertGoTo));
}
//==========================================================


 ?>


 <form action="<?php echo $editFormAction; ?>" method="post" name="form1">
  <input type="text" size="10" id="blog-input" name="blog-input" placeholder="搜尋">
  <input type="hidden" name="MM_insert" value="form1" />
  <input name="submit" id="submit" type="submit" value="搜尋">
 </form>