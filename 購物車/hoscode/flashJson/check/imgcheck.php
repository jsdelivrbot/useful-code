<?php
//Session_start();
if (!isset($_SESSION)) {
  			session_start();
		}
if($_SESSION["Checknum"] == $_POST['checknum']) {
  //$msg = "您所輸入的驗證碼正確！";
  $msg = 1;
  //header("Location:../membersAddConfirm.php");
} else {
  //$msg = "您所輸入的驗證碼錯誤！請重新輸入。 ";
  $msg = 0;
  //header("Location:../membersAdd.php?msg=".$msg);
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>圖形驗證碼結果</title>
<script type="text/javascript">
<!--

submitF(0);
function submitF(n){
alert("OK");
	if(n==1){
	alert("111111111");
	document.all.form1.action="membersAddConfirm.php"; 
	document.all.form1.submit(); 
	
	}else if(n==0){
	var tmp = document.getElementById('m_name');
	//var tmp = "zzzz";
	var oOldP = document.getElementsByTagName('m_name');
	//alert("oOldP = "+oOldP);
	alert(document.form1);
	//document.all.form1.action="membersAdd.php?msg=".n; 
	//document.getElementById('form1').action="membersAdd.php"; 
	//document.getElementById('form1').submit();  
	//document.all.form1.action="membersAdd.php"; 
	//document.all.form1.submit(); 	
	}
}

//-->
</script>
</head>

<body>
<form action="" method="post" name="form1" id="form1">
  <table width="540" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="166" align="left"><span class="table_data">&nbsp;
            <input name="m_name" type="hidden" id="m_name" value="<?php echo $_POST['m_name']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td align="left" class="table_data2"><span class="table_data">
        <input name="m_account" type="hidden" id="m_account" value="<?php echo $_POST['m_account']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td align="left" class="table_data">&nbsp;
          <input name="m_password" type="hidden" id="m_password" value="<?php echo $_POST['m_password']; ?>" /></td>
    </tr>
    <tr>
      <td align="left"><span class="table_data">&nbsp;
            <input name="m_gender" type="hidden" id="m_gender" value="<?php echo $_POST['m_gender']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td align="left" class="table_data">&nbsp;
          <input name="m_email" type="hidden" id="m_email" value="<?php echo $_POST['m_email']; ?>" /></td>
    </tr>
    <tr>
      <td align="left"><span class="table_data">&nbsp;
            <input name="m_birthyear" type="hidden" id="m_birthyear" value="<?php echo $_POST['m_birthyear']; ?>" />
            <input name="m_birthmonth" type="hidden" id="m_birthmonth" value="<?php echo $_POST['m_birthmonth']; ?>" />
            <input name="m_birthday" type="hidden" id="m_birthday" value="<?php echo $_POST['m_birthday']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td align="left" class="table_data">&nbsp;
          <input name="m_phone" type="hidden" id="m_phone" value="<?php echo $_POST['m_phone']; ?>" /></td>
    </tr>
    <tr>
      <td align="left"><span class="table_data">&nbsp;
            <input name="m_cellphone" type="hidden" id="m_cellphone" value="<?php echo $_POST['m_cellphone']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td align="left"><span class="table_data">&nbsp;
            <input name="m_zip" type="hidden" id="m_zip" value="<?php echo $_POST['m_zip']; ?>" />
            <input name="m_city" type="hidden" id="m_city" value="<?php echo $_POST['m_city']; ?>" />
            <input name="m_canton" type="hidden" id="m_canton" value="<?php echo $_POST['m_canton']; ?>" />
            <input name="m_address" type="hidden" id="m_address" value="<?php echo $_POST['m_address']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td align="left"><span class="table_data">
        <input name="m_epaper" type="hidden" id="m_epaper" value="<?php echo $_POST['m_epaper']; ?>" />
      </span></td>
    </tr>
    <tr>
      <td align="left"><span class="table_data">
        <input name="m_date" type="hidden" id="m_date" value="<?php echo date('Y-m-d H:i:s');?>" />
      </span>
        <input name="m_active" type="hidden" id="m_active" value="1" /></td>
    </tr>
  </table>
</form>
<p>正確的驗證碼是 <?php echo $_SESSION["Checknum"]; ?></p>
<p>您所輸入的是 <?php echo $_POST['checknum']; ?></p>
<p><?php echo "fff=".$msg; ?></p>

</body>
</html>
