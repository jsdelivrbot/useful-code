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

$targetSend = "-1";
if (isset($_POST['targetSend'])) {
  $targetSend = $_POST['targetSend'];
}
$e_email = "-1";
if (isset($_POST['e_email'])) {
  $e_email = $_POST['e_email'];
}
$targetMember = "-1";
if (isset($_POST['targetMember'])) {
  $targetMember = $_POST['targetMember'];
}
//echo "targetSend = ".$targetSend."</br>";
////echo "e_email = ".$e_email."</br>";

$colname_RecEpaper = "-1";
if (isset($_POST['e_id'])) {
  $colname_RecEpaper = $_POST['e_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecEpaper = sprintf("SELECT * FROM epaper_set WHERE e_id = %s", GetSQLValueString($colname_RecEpaper, "int"));
$RecEpaper = mysql_query($query_RecEpaper, $connect2data) or die(mysql_error());
$row_RecEpaper = mysql_fetch_assoc($RecEpaper);
$totalRows_RecEpaper = mysql_num_rows($RecEpaper);

$colname_RecEpaperMail = "-1";
if (isset($_POST['m_birthmonth'])) {
  $colname_RecEpaperMail = $_POST['m_birthmonth'];
}
//echo "month = ".$colname_RecEpaperMail;
mysql_select_db($database_connect2data, $connect2data);
if($colname_RecEpaperMail=="-1" || $colname_RecEpaperMail==""){
	$query_RecEpaperMail = sprintf("SELECT * FROM address_book_set WHERE a_status = 1 AND a_epaper = 1 ORDER BY a_id ASC");
}else{
	$query_RecEpaperMail = sprintf("SELECT * FROM address_book_set WHERE a_birthmonth = %s AND a_status = 1 AND a_epaper = 1 ORDER BY a_id ASC", GetSQLValueString($colname_RecEpaperMail, "text"));
}
$RecEpaperMail = mysql_query($query_RecEpaperMail, $connect2data) or die(mysql_error());
$row_RecEpaperMail = mysql_fetch_assoc($RecEpaperMail);
$totalRows_RecEpaperMail = mysql_num_rows($RecEpaperMail);


$menu_is="epaper";
require_once("../PHPMailer/class.phpmailer.php"); //匯入PHPMailer類別      

?>


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
        	<td width="165" class="list_title">寄送電子報</td>
        	<td width="859">&nbsp;</td>
        </tr>
    </table>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
    	<tr>
            <td width="739" align="right" class="page_display">
              <?php if(($targetSend==1) && ($totalRows_RecEpaperMail > 0)){ ?> <span class="no_data"><?php echo $totalRows_RecEpaperMail; ?> </span> 筆<?php } ?>
<td width="110" align="right" class="page_display">&nbsp;</td>
            <td width="151" align="right" class="page_display">&nbsp;</td>
            <td width="24" align="right">&nbsp;</td>
     	</tr>
	</table>
    <table width="800" border="0" cellspacing="0" cellpadding="0">
        <tr>
        	<td><img src="image/spacer.gif" width="1" height="1" /></td>
        </tr>
    </table>
	<form action="epaper_process.php" method="post" name="form1" id="form1">
      <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
        <tr>
          <td width="239" align="center" class="table_title">姓名</td>
          <td align="center" class="table_title">信箱</td>
          <td width="380" align="center" class="table_title">寄信狀態</td>
          </tr>
          <?php $image = ''; ?>
          <?php //if ($totalRows_RecImage > 0) { // Show if recordset not empty ?>
          <?php //do { ?>
          <?php  //$image = $image."<img src=\"http://www.butter-a-lee.com.tw/".$row_RecImage['file_link1']."\" /></br>"; ?>
          <?php  //$image = $image."<img src=\"../".$row_RecImage['file_link2']."\" /></br>"; ?>
            <?php //} while ($row_RecImage = mysql_fetch_assoc($RecImage)); ?>
<?php //} // Show if recordset not empty ?>
        <?php if (($targetSend == 1) && ($totalRows_RecEpaperMail > 0)) { // Show if recordset not empty ?>
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
//echo $totalRows_RecImage;
		?>
        
    <td align="center" class="table_data" ><?php echo $row_RecEpaperMail['a_display_name']; ?></td>
      <td align="center" class="table_data" ><?php echo $row_RecEpaperMail['a_email']; ?></td>
    <td align="center"  class="table_data">

<?php //echo $image;
/*
$mailtype='Content-Type:text/html;charset=big5';
$mailFrom='大樂購物中心電子報 <yenping@prez.com.tw>';
$mailFrom = mb_convert_encoding ($mailFrom, "BIG5", "UTF-8");
$mailTo=$row_RecEpaperMail['a_subtitle'];
//$mailTo='william <williams188@msn.com>';
$mailCC='';
$mailBCC='williams <williams188@msn.com>';
$mailSubject=$row_RecEpaper['d_title'];
$mailSubject = mb_convert_encoding ($mailSubject, "BIG5", "UTF-8");
$mailContent =  $row_RecEpaper['d_content'];
//echo $mailContent;
//$mailContent=str_replace("img src=\"/upload_image/","img src=\"http://www.ufbeauty.url.tw/fwukeh/upload_image/",$mailContent);
$mailContent = mb_convert_encoding ($mailContent, "BIG5", "UTF-8");

$maildata = "From:$mailFrom\r\n";
if ($mailCC != '') {
$maildata .= "CC:$mailCC\r\n";
}
if ($mailBCC != '') {
$maildata .= "BCC:$mailBCC\r\n";
}
$maildata .= "$mailtype";

$mailSend = mail($mailTo,$mailSubject,$mailContent,$maildata);
//echo "mailSend = ".$mailSend."<br/>";

if($mailSend==1){
   mysql_select_db($database_connect2data, $connect2data);
  $updateSQL = sprintf("UPDATE epaper_set SET e_class2=%s WHERE e_id=%s",
                       GetSQLValueString(((int)$row_RecEpaper['e_class2']+1), "text"),
                       GetSQLValueString($_REQUEST['e_id'], "int"));
  //echo $updateSQL;
  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  
  echo "已寄送";
}else{
	echo "寄送失敗";
}    
*/ 
$phpmailer= new PHPMailer(); //建立新物件  
$phpmailer->SetLanguage('zh', '../PHPMailer/language/');     
$phpmailer->IsSMTP(); //設定使用SMTP方式寄
//$phpmailer->SMTPAuth = true; //設定SMTP需要驗證        
//$phpmailer->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線   
//$phpmailer->Host = "smtp.gmail.com"; //Gamil的SMTP主機        
//$phpmailer->Port = 465;  //Gamil的SMTP主機的SMTP埠位為465埠。        
//$phpmailer->CharSet = "big5"; //設定郵件編碼信  
$phpmailer->ContentType="text/html";
$phpmailer->CharSet="utf-8";          
      
//$phpmailer->Username = "*********"; //設定驗證帳號        
//$phpmailer->Password = "*********"; //設定驗證密碼        
      
$phpmailer->From = "yenping@prez.com.tw"; //設定寄件者信箱        
$phpmailer->FromName = "大樂購物中心電子報"; //設定寄件者姓名        
$adF = "yenping@prez.com.tw";
$adFN = "大樂購物中心電子報";
$phpmailer->AddReplyTo( $adF , $adFN );
$phpmailer->SetFrom( $adF , $adFN );

$phpmailer->Subject = $row_RecEpaper['e_title']; //設定郵件標題        
$phpmailer->Body = $row_RecEpaper['e_content']; //設定郵件內容        
$phpmailer->IsHTML(true); //設定郵件內容為HTML

$add = $row_RecEpaperMail['a_email'];
$addN = $row_RecEpaperMail['a_display_name'];
$phpmailer->AddAddress( $add , $addN ); 
//$phpmailer->AddBCC('williams188@msn.com', 'williams'); //設定收件者郵件及名稱        
      
if(!$phpmailer->Send()) {        
	echo "<br/>Mailer Error: " . $phpmailer->ErrorInfo;        
} else {        
	echo "寄送成功";   
	mysql_select_db($database_connect2data, $connect2data);
  	$updateSQL = sprintf("UPDATE epaper_set SET e_class2=%s WHERE e_id=%s",
                       GetSQLValueString(((int)$row_RecEpaper['e_class2']+1), "text"),
                       GetSQLValueString($_REQUEST['e_id'], "int"));
  	//echo $updateSQL;
 	 mysql_select_db($database_connect2data, $connect2data);
  	$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());     
}  
////寄送MAIL結束//////


?></td>
  </tr> 
        <?php } while ($row_RecEpaperMail = mysql_fetch_assoc($RecEpaperMail)); ?>
  <?php }// Show if recordset not empty ?>
  
  <?php if ($targetSend == 0) { // Show if recordset not empty ?>
  <tr>
      <td align="center" class="table_data" >測試人員</td>
      <td align="center" class="table_data" ><?php echo $e_email; ?></td>
      <td align="center"  class="table_data">
<?php 
//echo $image;
/*$mailtype='Content-Type:text/html;charset=big5';
$mailFrom='大樂購物中心電子報 <yenping@prez.com.tw>';
$mailFrom = mb_convert_encoding ($mailFrom, "BIG5", "UTF-8");
$mailTo=$e_email;
$mailTo='williams188@msn.com';
echo $mailTo.'<br>';
$mailCC='';
$mailBCC='williams <williams188@msn.com>';
$mailSubject=$row_RecEpaper['e_title'];
$mailSubject = mb_convert_encoding ($mailSubject, "BIG5", "UTF-8");
$mailContent =  $row_RecEpaper['e_content'];
//echo $mailContent;
//$mailContent=str_replace("img src=\"/upload_image/","img src=\"http://www.ufbeauty.url.tw/fwukeh/upload_image/",$mailContent);
$mailContent = mb_convert_encoding ($mailContent, "BIG5", "UTF-8");

$maildata = "From:$mailFrom\r\n";
if ($mailCC != '') {
$maildata .= "CC:$mailCC\r\n";
}
if ($mailBCC != '') {
$maildata .= "BCC:$mailBCC\r\n";
}
$maildata .= "$mailtype";

//mail($mailTo,$mailSubject,$mailContent,$maildata);

$mailSend = mail($mailTo,$mailSubject,$mailContent,$maildata);
if($mailSend){
	echo "已寄送";
}else{
	echo "寄送失敗";
}
//echo "<br>".$mailContent;
//echo "mailSend = ".$mailSend."<br/>";
if($mailSend==1){
   mysql_select_db($database_connect2data, $connect2data);
  $updateSQL = sprintf("UPDATE epaper_set SET e_class2=%s WHERE e_id=%s",
                       GetSQLValueString(((int)$row_RecEpaper['e_class2']+1), "text"),
                       GetSQLValueString($_REQUEST['e_id'], "int"));
  //echo $updateSQL;
  mysql_select_db($database_connect2data, $connect2data);
  $Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());
  }
*/
/*require_once("../PHPMailer/class.phpmailer.php"); //匯入PHPMailer類別  */ 
$phpmailer= new PHPMailer(); //建立新物件  
$phpmailer->SetLanguage('zh', '../PHPMailer/language/');  
$phpmailer->IsSMTP(); //設定使用SMTP方式寄
//$phpmailer->SMTPAuth = true; //設定SMTP需要驗證        
//$phpmailer->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線   
//$phpmailer->Host = "smtp.gmail.com"; //Gamil的SMTP主機        
//$phpmailer->Port = 465;  //Gamil的SMTP主機的SMTP埠位為465埠。        
//$phpmailer->CharSet = "big5"; //設定郵件編碼信  
$phpmailer->ContentType="text/html";
$phpmailer->CharSet="utf-8";        
$phpmailer->IsHTML(true); //設定郵件內容為HTML                
      
//$phpmailer->Username = "*********"; //設定驗證帳號        
//$phpmailer->Password = "*********"; //設定驗證密碼        
      
$phpmailer->From = "yenping@prez.com.tw"; //設定寄件者信箱        
$phpmailer->FromName = "大樂購物中心電子報"; //設定寄件者姓名
$adF = "yenping@prez.com.tw";
$adFN = "大樂購物中心電子報";
$phpmailer->AddReplyTo( $adF , $adFN );
$phpmailer->SetFrom( $adF , $adFN );
   
$phpmailer->Subject = $row_RecEpaper['e_title']; //設定郵件標題        
$phpmailer->Body = $row_RecEpaper['e_content']; //設定郵件內容  
//$phpmailer->AddAddress($e_email); 
$add = $e_email;
$addN = "測試人員";
$phpmailer->AddAddress( $add , $addN ); 
//$phpmailer->AddBCC('williams188@msn.com'); //設定收件者郵件及名稱        
      
if(!$phpmailer->Send()) {        
	echo "<br/>Mailer Error: " . $phpmailer->ErrorInfo;        
} else {        
	echo "寄送成功";   
	mysql_select_db($database_connect2data, $connect2data);
  	$updateSQL = sprintf("UPDATE epaper_set SET e_class2=%s WHERE e_id=%s",
                       GetSQLValueString(((int)$row_RecEpaper['e_class2']+1), "text"),
                       GetSQLValueString($_REQUEST['e_id'], "int"));
  	//echo $updateSQL;
  	mysql_select_db($database_connect2data, $connect2data);
  	$Result1 = mysql_query($updateSQL, $connect2data) or die(mysql_error());    
}   
	  ?>
      </td>
    </tr>  
  <?php } // Show if recordset not empty ?>
  
      </table>
      <?php if(($totalRows_RecEpaperMail == 0) && ($targetSend == 1)){ ?>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="center" class="table_data">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" class="table_data">沒有<span class="no_data"><?php echo $colname_RecEpaperMail; ?>月份</span> 會員資料</td>
        </tr>
        <tr>
          <td align="center" class="table_data">&nbsp;</td>
        </tr>
      </table>
      <?php }?>
	</form>
    <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#E1E1E1" class="list_title_table">
        <tr>
            <td width="739" align="right" class="page_display">
            <td width="110" align="right" class="page_display">&nbsp;</td>
            <td width="151" align="right" class="page_display">&nbsp;</td>
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
mysql_free_result($RecEpaper);
if($targetSend==1){
mysql_free_result($RecEpaperMail);
}
?>