<?php
if(!isset($_SESSION)){
  session_start();
}
//判斷session是否已啟動

header("Content-Type:text/html; charset=utf-8");

if((!empty($_SESSION['check_word'])) && (!empty($_POST['m_checkword']))){
//判斷此兩個變數是否為空

  if($_SESSION['check_word'] == $_POST['m_checkword']){

    $_SESSION['check_word'] = '';
  //比對正確後，清空將check_word值


  // echo '<p>&nbsp;</p><p>&nbsp;</p><a href="./chptcha_index.php">OK輸入正確，將於一秒後跳轉(按此也可返回)</a>';
  // echo '<meta http-equiv="refresh" content="1"; url="captcha_index.php">';
    echo '<script>
    alert("留言已經送到內子宮");
  </script>';

// exit();
}else{
 // echo '<p>&nbsp;</p><p>&nbsp;</p><a href="./chptcha_index.php">Error輸入錯誤，將於一秒後跳轉(按此也可返回)</a>';
 // echo '<meta http-equiv="refresh" content="1"; url="captcha_index.php">';
  echo '<script type="text/javascript">
  alert("留言失敗啦，你三歲小孩阿驗證都可以寫錯？");
</script>';

}

}
?>
