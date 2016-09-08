<?php 
require_once('EDcart.php');
if (!isset($_SESSION)) {
	session_start();
}
ob_start();
//session_start();
?>
<?php require("db.php"); ?>
<?php //require_once('../Connections/connect2data.php'); ?>
<?php //require("addtocart.php"); ?>
<?php

$cart =& $_SESSION['edCart'];
//$firephp->info($_SESSION['edCart'], '_SESSIONcart-fucntions');
//$firephp->info($cart, 'cart-fucntions');
//echo 'isObject = '.is_object($cart).'<br>';
//echo "item1 = ".$cart->itemCount.'<br>';
//$cart =& $_SESSION['edCart']; 
if(!is_object($cart)){
	$cart = new edCart();
	//echo 'new edCart<br>';
}else{
	//echo 'old edCart<br>';	
}
//echo "item2 = ".$cart->itemCount;
/*require_once('EDcart.php');
if (!isset($_SESSION)) {
	session_start();
}
$cart =& $_SESSION['edCart'];
if(!is_object($cart)) $cart = new edCart(); */
//echo "item = ".$cart->itemCount . "<br>";
//執行購物車動作
//echo "item = ".$cart->itemCount;
//session_start();
$sessionID = $_COOKIE['PHPSESSID'];

$arr = array();
$action = '';
$m_id = '';

if((isset($_POST['action']) && $_POST['action'] != '') || (isset($_GET['action']) && $_GET['action'] != '')) {
	if( (isset($_GET['action']) && $_GET['action'] != '') || (isset($_POST['action']) && $_POST['action'] == '') )
	{
		$action 	= (isset($_GET['action'])) ? $_GET['action'] : '';
		$productID	= (isset($_GET['productID'])) ? $_GET['productID'] : '';
		$m_id		= (isset($_GET['m_id'])) ? $_GET['m_id'] : -1 ;
		$qty		= (isset($_GET['qty'])) ? $_GET['qty'] : 1 ;
		$freight	= (isset($_GET['freight'])) ? $_GET['freight'] : 0 ;
		$noJavaScript = 1;
	} else {
		$action 	= (isset($_POST['action'])) ? $_POST['action'] : '';
		$productID	= (isset($_POST['productID'])) ? $_POST['productID'] : '';
		$m_id		= (isset($_POST['m_id'])) ? $_POST['m_id'] : -1 ; 
		$qty		= (isset($_POST['qty'])) ? $_POST['qty'] : 1 ; 
		$freight	= (isset($_POST['freight'])) ? $_POST['freight'] : 0 ;
		$noJavaScript = 0;
	}
	$freight = 150;
}
//echo '_POST = '.$_POST['action'].'<br>';
//echo '_GET = '.$_GET['action'];

switch($action){
//case "Add":
case "addToBasket":
	//$cart->add_item($_GET['prono'],1,$_GET['price'],$_GET['footnote'],$_GET['name'],$_GET['pic'],$_GET['temp'],$_GET['space'],$_GET['times'],$_GET['bread']);
	addItem($productID, $cart, $sessionID, $m_id, $noJavaScript, $qty);
	break;
case "deleteFromBasket":
	//$cart->del_item($productID);
	deleteItem($productID, $cart, $sessionID, $noJavaScript);
	break;
case "Empty":
	//$cart->empty_cart();
	deleteBasket($cart);
	break;
case "Update":
	//updateItem($cart);
	updateToBasket($productID, $cart, $sessionID, $noJavaScript, $qty);
	break;
case "UpdateFreight":
	//updateItem($cart);
	UpdateFreightToBasket($cart, $freight);
	break;
}
/*
if ($action == "addToBasket"){

	$productInBasket 	= 0;
	$productTotalPrice	= 0;

	//$query  = "SELECT * FROM products WHERE productID = " . $productID;
	$query  = "SELECT D.*, DE.* FROM data_set AS D LEFT JOIN data_exten_set AS DE ON D.d_id = DE.de_d_id WHERE D.d_class5 = 'products' AND d_id = " . $productID;
	//echo "query = $query <br>";
	mysql_select_db($dbname, $conn);
	$result = mysql_query($query, $conn) or die(mysql_error());
	//$result = mysql_query($query);
	//echo "query2 = $query <br>";
	$row = mysql_fetch_array( $result );
	
	//echo "query3 = $query <br>";

	//$productPrice 		= $row['productPrice'];	
	//$productName		= $row['productName'];	
	$productName	= $row['d_title'];	
	$qty			= 1;
	$serial_num		= $row['d_sn'];
	$price_status	= $row['de_price_status'];
	$price1 		= $row['de_dir_price'];	
	$price2 		= $row['de_coll_price_1'];	
	$discount		= $row['de_discount'];
	$discount_num	= $row['de_discount_num'];
	$freight		= $row['de_freight'];
	$weight			= $row['d_weight'];
	
	//$cart->add_item($row_p['d_id'], 1, $row_p['d_title'], $row_p['d_sn'], $row_p['de_price_status'], $row_p['de_dir_price'], $row_p['de_coll_price_1'], $row_p['de_discount'], $row_p['de_discount_num'], $row_p['de_freight'], $row_pImage['file_link3'], $row_p['d_weight']);
	

	$query = "INSERT INTO m_baskets (productID, name, qty, serial_num, price_status, price1, price2, discount, discount_num, freight, weight, basketSession) VALUES ('$productID', '$productName', '$qty', '$serial_num', '$price_status', '$price1', '$price2', '$discount', '$discount_num', '$freight', '$weight', '$sessionID')";
	mysql_query($query) or die('Error, insert query failed');	

	$query  = "SELECT * FROM m_baskets WHERE productID = " . $productID . " AND basketSession = '" . $sessionID . "'";
	$result = mysql_query($query) or die(mysql_error());;
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		$totalItems 	= $totalItems + 1;
		$productTotalPrice 	= $productTotalPrice + $row['price1'];
	}
	
	if ($noJavaScript == 1) {
		header("Location: ../../../orders-list.php");
	} else {
		$resp = '<li id="productID_' . $productID . '"><a href="inc/functions.php?action=deleteFromBasket&productID=' . $productID . '" onClick="return false;"><img src="inc//delete.png" id="deleteProductID_' . $productID . '"></a> ' . $productName . '(' . $totalItems . '<input name="qty[]" type="text" id="quanity" value="'.$totalItems.'" size="3"/> items) - $' . $productTotalPrice . '</li>';
		
		$arr['res'] = $resp;
		$arr['subAllTotal'] = $cart->total;
		echo (json_encode($arr));
		//return $arr;
	}

}
*/

/*if ($action == "deleteFromBasket"){
	
	$query = "DELETE FROM m_baskets WHERE productID = " . $productID . " AND basketSession = '" . $sessionID . "'";
	mysql_query($query) or die('Error, delete query failed');
		
	if ($noJavaScript == 1) {
		header("Location: ../../../orders-add.php");
	}	
}*/

function UpdateFreightToBasket($cart, $freight){
	
	if (!isset($_SESSION)) {
		session_start();
	}
	
	if($freight==0){
		$cart->grandTotal = $cart->total;
		//echo "離島地區，運費另計&nbsp;";
		echo '0';
	}else{
		
		if($cart->total < $cart->freightRating){
			$cart->grandTotal = $cart->total + $cart->freightCosts;
			echo '1';
		}else{
			$cart->grandTotal = $cart->total;
			echo '2';
		}
		
		//echo ($cart->grandTotal - $cart->total)." 元&nbsp;";
		
	}
}

function deleteBasket($cart){
	
	if (!isset($_SESSION)) {
		session_start();
	}
	$sessionID = $_COOKIE['PHPSESSID'];
	
	$query = "DELETE FROM m_baskets WHERE basketSession != '" . $sessionID . "'";
	
	echo 'deleteBasket query = '.$query.'<br>';
	
	mysql_query($query) or die('Error, delect basket failed');
	
	$cart->empty_cart();
	
	$_SESSION['edCart'] =& $cart;
	
	//unset($_SESSION['edCart']);
	
	
	//header("Location:".$_SERVER['HTTP_REFERER']);
	//echo 'sessionID = '.$sessionID;

}

function deleteItem($productID, $cart, $sessionID, $noJavaScript){

	$cart->del_item($productID);
	
	$userIP = $cart->item_userIP;
	
	$query = "DELETE FROM m_baskets WHERE productID = " . $productID . " AND basketSession = '" . $sessionID . "' AND mb_ip = '".$userIP."'";
	echo 'function deletItem = '.$query.'<br>';
	//mysql_query($query) or die('Error, delete query failed!');
	mysql_query($query) or die(mysql_error());
	
	if ($noJavaScript == 1) {
		//header("Location: ../../../orders-add.php");
	}else{
		$arr['res'] 		= '';
		$arr['subAllTotal'] = $cart->total;
		//$arr['deliverfee'] 	= $cart->deliverfee;
		$arr['grandTotal'] 	= $cart->grandTotal;
		
		include('../flashJson/recordset2json.php');
		echo sd_array2json($arr);
		//echo (json_encode($arr));
	}
	/*$firephp = FirePHP::getInstance(true);
	$firephp->info($cart, 'cart2-functions-deleteItem');
	$firephp->info($_SESSION['edCart'], '_SESSIONcart2-fucntions-deleteItem');*/
	$_SESSION['edCart'] =& $cart;
	/*$firephp->info($_SESSION['edCart'], '_SESSIONcart3-fucntions-deleteItem');*/
	
	header("Location:../order_list.php#List");
	exit();
}

function updateItem($cart){
	for($startNO=0; $startNO < $cart->itemCount; $startNO++){
		
		$qty = $_GET['qty'][$startNO];
		$productID = $_GET['itemid'][$startNO];
		
		if($qty<=0){
			deleteItem($productID, $cart, $sessionID, $noJavaScript);	
		}else{
			$cart->edit_item($_GET['itemid'][$startNO], $_GET['qty'][$startNO]);
			$memberStasus = ( (isset($_SESSION['MM_UserAccount'])) && ($_SESSION['MM_UserAccount']!='') ) ? TRUE : FALSE ;			
			$productTotalPrice = $cart->_subtotal($cart->itemQtys[$productID], $cart->itemPrice1[$productID], $cart->itemPrice2[$productID], $cart->itemPrice3[$productID], $cart->itemOnSale[$productID], $cart->itemPrice4[$productID], $memberStasus, $productID);
		}
		
	}
	header("Location:../order_list.php#List");
	//exit();
}

function updateToBasket($productIDA, $cart, $sessionID, $noJavaScript, $qtyA){
	require_once('../Connections/connect2data.php');
	//updateItem($cart);	
	$productTotalPrice	= 0;
	
	$memberStasus = ( (isset($_SESSION['MM_UserAccount'])) && ($_SESSION['MM_UserAccount']!='') ) ? TRUE : FALSE ;		
	for($startNO=0; $startNO < $cart->itemCount; $startNO++){
		
		$qty = $qtyA[$startNO];
		$productID = $productIDA[$startNO];
	
	if($qty<=0){
		//header('Location: products_list.php');
		deleteItem($productID, $cart, $sessionID, $noJavaScript);	
	}else{
			$cart->edit_item($productID, $qty);
				
			$productTotalPrice = $cart->_subtotal($cart->itemQtys[$productID], $cart->itemPrice1[$productID], $cart->itemPrice2[$productID], $cart->itemPrice3[$productID], $cart->itemOnSale[$productID], $cart->itemPrice4[$productID], $memberStasus, $productID);
		}
		//echo "d_id = ".$row_p['d_id']."<br>";
		//mysql_select_db($dbname, $conn);		
		
		//$cart->add_item($productID, $qty, $productName, $serial_num, $price_status, $price1, $price2, $discount, $discount_num, $freight, $file_link3, $weight, $sessionID);
		
		//$productName	= $cart->itemName[$productID];
		//$totalItems 	= $cart->itemQtys[$productID];
		
		//$productTotalPrice 	= $cart->itemQtys[$productID];
		//$productTotalPrice = $cart->_subtotal($cart->itemQtys[$productID], $cart->itemstatus[$productID], $cart->itemprice1[$productID], $cart->itemprice2[$productID], $cart->itemdiscount[$productID], $cart->itemnum[$productID]);	
		
	//echo "noJavaScript = ".$noJavaScript;
		/*if ($noJavaScript == 1) {
			//header("Location: ../../../orders-add.php");
		} else {
			$resp = '<li id="productID_' . $productID . '"><a href="inc/functions.php?action=deleteFromBasket&productID=' . $productID . '" onClick="return false;"><img src="inc//delete.png" id="deleteProductID_' . $productID . '"></a> ' . $productName . '( <input name="qty[]" type="text" id="quanity_' . $productID . '" value="'.$totalItems.'" size="3"/> 件 -  ) - $' . $productTotalPrice . ' <input name="pid[]" type="hidden" id="pid_' . $productID . '" value="'.$productID.'" size="1"/> </li>';
		
			$arr['res'] 			= $resp;
			$arr['subAllTotal'] 	= $cart->total;
			//$arr['deliverfee'] 		= $cart->deliverfee;
			$arr['grandTotal'] 		= $cart->grandTotal;
			//$arr['directTotal'] 	= $cart->directTotal;
			//$arr['collectiveTotal'] = $cart->collectiveTotal;
			$arr['itemCount'] 		= $cart->itemCount;
			
			echo (json_encode($arr));
		}*/
		
	}	
	
	/*$firephp = FirePHP::getInstance(true);
	$firephp->info($cart, 'cart2-functions-update');
	$firephp->info($_SESSION['edCart'], '_SESSIONcart2-fucntions-update');*/
	$_SESSION['edCart'] =& $cart;
	//$firephp->info($_SESSION['edCart'], '_SESSIONcart3-fucntions-update');
	header("Location:../order_list.php#List");
	//exit();
}

function addItem($productID, $cart, $sessionID, $m_id, $noJavaScript, $qty){
	require_once('../Connections/connect2data.php');
	$productInBasket 	= 0;
	$productTotalPrice	= 0;
	//echo "ID = ".$productID."<br>";
	//$query  = "SELECT * FROM products WHERE productID = " . $productID;
	//$query  = "SELECT D.*, DE.* FROM data_set AS D LEFT JOIN data_exten_set AS DE ON D.d_id = DE.de_d_id WHERE D.d_class5 = 'products' AND d_id = " . $productID;
	$query  = "SELECT D.* FROM data_set AS D WHERE D.d_class1 = 'products' AND D.d_id = " . $productID;
	//echo "query = $query <br>";
	//mysql_select_db($dbname, $conn);
	mysql_select_db($database_connect2data, $connect2data);
	$result = mysql_query($query, $connect2data) or die(mysql_error());
	//$result = mysql_query($query);
	//echo "query2 = $query <br>";
	$row = mysql_fetch_array( $result );
	//echo mysql_num_rows($result);
	if(mysql_num_rows($result)==0){
		//header('Location: products_list.php');		
	}else{
		//echo "d_id = ".$row_p['d_id']."<br>";
		//mysql_select_db($dbname, $conn);
		mysql_select_db($database_connect2data, $connect2data);
		//$sql_pImage = "SELECT file_link3 FROM file_set WHERE file_type='image' AND file_d_id = ".$row['d_id']." ORDER BY file_id DESC";
		$sql_pImage = "SELECT file_link2, file_link3 FROM file_set WHERE file_type='image' AND file_d_id = ".$row['d_id']." ORDER BY file_id DESC";
		//echo "sql_pImage = $sql_pImage <br>";
		$result_pImage = mysql_query($sql_pImage, $connect2data) or die(mysql_error());
		$row_pImage = mysql_fetch_assoc($result_pImage);
		//echo mysql_num_rows($result_pImage);
		//產品資訊
		//$qty			= 1;							//數量
		$qty			= $qty;							//數量
		$qtyLimit		= $row['d_price2'];				//可買數量
		$class			= 1;							//產品分類
		$productName	= $row['d_title'];				//產品名稱
		//$serial_num		= $row['d_class3'];				//產品編號
		$serial_num		= NULL;				//產品編號
		//$price_status	= $row['de_price_status'];
		//$dir_price 		= $row['de_dir_price'];	
		$d_price1 		= $row['d_price1'];				//市價
		$d_price2 		= NULL;							//折扣價
		$d_price3 		= NULL;							//會員折扣價
		$d_sale			= $row['d_sale'];				//是否為特價品
		//$d_price4 		= $row['d_price4'];				//特價
		$d_price4 		= NULL;				//特價
		$d_new_product 	= $row['d_new_product'];		//是否為新品
		
		//$freight_costs	= 100;							//運費
		//$freight_rating	= 2000;							//運費等級
		
		$file_link2		= $row_pImage['file_link2'];
		$file_link3		= $row_pImage['file_link3'];
		
		//$cart->add_item($productID, $qty, $productName, $serial_num, $price_status, $price1, $price2, $discount, $discount_num, $freight, $file_link3, $weight, $sessionID);
		//$cart->add_item($productID, $qty, $qtyLimit, $class, $productName, $serial_num, $d_price1, $d_price2, $d_price3, $d_sale, $d_price4, $d_new_product, $file_link3, $sessionID);
		$cart->add_item($productID, $qty, $qtyLimit, $class, $productName, $serial_num, $d_price1, $d_price2, $d_price3, $d_sale, $d_price4, $d_new_product, $file_link3, $file_link2, $sessionID);
		//echo $subAllTotal = $cart->total;
		//$arr( 'subAllTotal' => $cart->total);
		//$subAllTotal 	= $cart->total;
		///////////////////////////////////////////////////////////////////////////////////////////////////////	

		/*$query = "INSERT INTO m_baskets (productID, name, qty, serial_num, price_status, price1, price2, discount, discount_num, freight, weight, subtotal, basketSession) VALUES ('$productID', '$productName', '$qty', '$serial_num', '$price_status', '$price1', '$price2', '$discount', '$discount_num', '$freight', '$weight', '$subAllTotal', '$sessionID')";
		mysql_query($query) or die('Error, insert query failed');	

		$query  = "SELECT * FROM m_baskets WHERE productID = " . $productID . " AND basketSession = '" . $sessionID . "'";
		$result = mysql_query($query) or die(mysql_error());;
		
		while($row = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$totalItems 	= $totalItems + 1;
			$productTotalPrice 	= $productTotalPrice + $row['price1'];
		}*/
		$totalItems 	= $cart->itemQtys[$productID];
		//$productTotalPrice 	= $cart->itemQtys[$productID];
		//$productTotalPrice = $cart->_subtotal($cart->itemQtys[$productID], $cart->itemstatus[$productID], $cart->itemprice1[$productID], $cart->itemprice2[$productID], $cart->itemdiscount[$productID], $cart->itemnum[$productID]);
		$memberStasus = ( (isset($_SESSION['MM_UserAccount'])) && ($_SESSION['MM_UserAccount']!='') ) ? TRUE : FALSE ;
		$productTotalPrice = $cart->_subtotal($cart->itemQtys[$productID], $cart->itemPrice1[$productID], $cart->itemPrice2[$productID], $cart->itemPrice3[$productID], $cart->itemOnSale[$productID], $cart->itemPrice4[$productID], $memberStasus, $productID);	
	//echo "noJavaScript = ".$noJavaScript;
		if ($noJavaScript == 1) {
			//header("Location: ../../../orders-add.php");
		} else {
			//$resp = '<li id="productID_' . $productID . '"><a href="inc/functions.php?action=deleteFromBasket&productID=' . $productID . '" onClick="return false;"><img src="inc//delete.png" id="deleteProductID_' . $productID . '"></a> ' . $productName . '( <input name="qty[]" type="text" id="quanity_' . $productID . '" value="'.$totalItems.'" size="3"/> 件 -  ) - $' . $productTotalPrice . ' <input name="pid[]" type="hidden" id="pid_' . $productID . '" value="'.$productID.'" size="1"/> </li>';
		
			//$arr['res'] 		= $resp;
			$arr['subAllTotal'] = $cart->total;
			$arr['freightCosts'] 	= $cart->freightCosts;
			$arr['grandTotal'] 	= $cart->grandTotal;
			//$arr['directTotal'] 	= $cart->directTotal;
			//$arr['collectiveTotal'] = $cart->collectiveTotal;
			$arr['itemCount'] = $cart->itemCount;
			
			include('../flashJson/recordset2json.php');
			echo sd_array2json($arr);
			//echo (json_encode($arr));
			//echo 'weightTotal = '.$cart->weightTotal."<br>";
		//return $arr;
		}
		
		
		///////////////////////////////////////////////////////////////////////////////////////////////////////
		//$arr['subAllTotal'] = $cart->total;
		
	}	

	
	
	/*$firephp = FirePHP::getInstance(true);
	$firephp->info($cart, 'cart2-functions');
	$firephp->info($_SESSION['edCart'], '_SESSIONcart2-fucntions');*/
	$_SESSION['edCart'] =& $cart;
	//$firephp->info($_SESSION['edCart'], '_SESSIONcart3-fucntions');
	//$firephp->info($_SESSION['check'], '_SESSION_check-functions');
	//header("Location:../order_list.php");
	//exit();
}

/*function updateItem($cart){
	for($startNO=0;$startNO < $_GET['itemCount'];$startNO++){
		$cart->edit_item($_GET['itemid'][$startNO],$_GET['qty'][$startNO]);
	}
}*/

///////////////////////////////////////////////////////////////////////////////////////////////////////

function getBasket(){
	
	session_start();
	$sessionID = $_COOKIE['PHPSESSID'];
	//echo "sessionID = ".$sessionID."<br>";
	//echo "productID = ".$productID."<br>";
	$query  = "SELECT * FROM m_baskets WHERE basketSession = '" . $sessionID . "' GROUP BY productID ORDER By basketID DESC";
	$result = mysql_query($query);
	//echo $query;
	
	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
		//echo "productID = ".$row['productID']."<br>";
		//$query2  = "SELECT * FROM products WHERE productID = " . $row['productID'];
		$query2  = "SELECT D.*, DE.* FROM data_set AS D LEFT JOIN data_exten_set AS DE ON D.d_id = DE.de_d_id WHERE D.d_class5 = 'products' AND d_id = " . $row['productID'];
		$result2 = mysql_query($query2);
		$row2 = mysql_fetch_array( $result2 );
		
		$productID	 		= $row2['d_id'];
		$price1 		= $row2['de_dir_price'];	
		$productName		= $row2['d_title'];	
		//echo "productID2 = ".$productID."<br>";
	
		$query2  = "SELECT COUNT(*) AS totalItems FROM m_baskets WHERE basketSession = '" . $sessionID . "' AND productID = " . $productID;
		//echo "query2 = ".$query2."<br>";
		$result2 = mysql_query($query2) or die(mysql_error());
		$row2 = mysql_fetch_array( $result2 );
		$totalItems = $row2['totalItems'];
		//echo "totalItems = ".$totalItems."<br>";
		
		//$basketText = $basketText . '<li id="productID_' . $productID . '"><a href=inc/functions.php?action=deleteFromBasket&productID=' . $productID . ' onClick="return false;"><img src="inc//delete.png" id="deleteProductID_' . $productID . '"></a> ' . $productName . '(' . $totalItems . ' items) - $' . ($totalItems * $price1) . '</li>';
		$basketText = $basketText . '<li id="productID_' . $productID . '"><a href=inc/functions.php?action=deleteFromBasket&productID=' . $productID . ' onClick="return false;"><img src="inc//delete.png" id="deleteProductID_' . $productID . '"></a> ' . $productName . ' ( <input name="qty[]" type="text" id="quanity" value="'.$totalItems.'" size="3"/> 件 -   ) - $' . ($totalItems * $price1) . '</li>';
		
	}
	echo $basketText;
		
	//$arr['res'] = $basketText;
	//$arr['subAllTotal'] = $cart->total;
	//echo (json_encode($arr));
	
}
	
//header("Location:../order_list.php");
?>