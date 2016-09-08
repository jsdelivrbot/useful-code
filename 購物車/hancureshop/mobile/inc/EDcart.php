<?php
//require_once('FirePHPCore/lib/FirePHPCore/FirePHP.class.php4');
//$firephp = FirePHP::getInstance(true);

class edCart {
	
	var $total 				= 0; 	//計算商品價錢	
	var $grandTotal 		= 0; 	//加上了運費後的總合費用
	var $itemCount 			= 0;	//產品種類
	var $AllItemCount 		= 0;	//所有產品數量
	var $totalAll 			= 0;	//計算未加運費總和	
	var $item_sessionID 	= '';	//sessionID
	var $item_userIP	 	= '';	//userIP
	var $freightCosts 		= 100; 	//修改，運費
	var	$freightRating		= 12;	//運費等級
	
	var $items 				= array();	
	var $itemQtys 			= array();	//數量
	var $itemQtysLimit		= array();	//數量限制
	var $itemClass			= array();	//產品類別
	var $itemName 			= array();	//產品名稱
	var $itemSn 			= array();	//產品sn
	//var $itemPriceStatus	= array();	//產品價位狀態
	
	var $itemPrice1 		= array();	//市價
	var $itemPrice2			= array();	//折扣價
	var $itemPrice3			= array();	//會員折扣價
	var $itemOnSale			= array();	//是否為特價品	
	var $itemPrice4			= array();	//特價
	var $itemNewProduct		= array();	//是否為新品
	var $itemPic 			= array();	//產品圖片
	var $itemPic2 			= array();	//產品圖片(小)
	
	//const $firephp = FirePHP::getInstance(true);
	//var $firephp;
	//var $itemfreight 		= array();	//運費設定
	//var $item_delivery_fee 	= array();	//運費

	function cart() {} // 宣告函數
	
	/*function __toString(){
		return "";
	}*/

	function get_contents(){ // 取得購物車內容
		$items = array();
		foreach($this->items as $tmp_item){
		    $item = FALSE;
			
			$item['id'] 		= $tmp_item;
			$item['qty'] 		= $this->itemQtys[$tmp_item];
			$item['qtyLimit'] 	= $this->itemQtysLimit[$tmp_item];
			$item['class'] 		= $this->itemClass[$tmp_item];
			$item['name'] 		= $this->itemName[$tmp_item];
			$item['sn'] 		= $this->itemSn[$tmp_item];
			//$item['priceStatus']= $this->itemPriceStatus[$tmp_item];
			
			$item['d_price1']	= $this->itemPrice1[$tmp_item];
			$item['d_price2']	= $this->itemPrice2[$tmp_item];
			$item['d_price3']	= $this->itemPrice3[$tmp_item];
			$item['d_sale']		= $this->itemOnSale[$tmp_item];
			$item['d_price4']	= $this->itemPrice4[$tmp_item];
			$item['pic']		= $this->itemPic[$tmp_item];
			$item['pic2']		= $this->itemPic2[$tmp_item];
			$item['d_new_p']	= $this->itemNewProduct[$tmp_item];
			
			//$item['freight'] = $this->itemfreight[$tmp_item];
			//$item['delivery_fee'] = $this->item_delivery_fee[$tmp_item];
			
				//echo "name = ".$item['name'];
			//$item['subtotal'] = $item['qty'] * $item['dir_price'];
			//$item['subtotal'] = $this->_subtotal($item['qty'], $item['status'], $item['dir_price'], $item['price2'], $item['discount'], $item['num']);
			$memberStasus = ( (isset($_SESSION['MM_UserAccount'])) && ($_SESSION['MM_UserAccount']!='') ) ? TRUE : FALSE ;
			$item['subtotal'] = $this->_subtotal($item['qty'], $item['d_price1'], $item['d_price2'], $item['d_price3'], $item['d_sale'], $item['d_price4'], $memberStasus, $tmp_item);
			
			$items[] = $item;
		}
		return $items;
	} 

	//id, 數量, 產品名, sn, 價格狀態顯示, 直購價, 集購價, 集購價折扣, 集購價級數, 運費, 產品圖
	//function add_item($itemid, $qty=1, $name=FALSE, $sn=FALSE, $status=FALSE, $dir_price=FALSE, $price2=FALSE, $discount=FALSE, $num=FALSE, $freight=FALSE, $pic=FALSE, $weight=FALSE, $sessionID=FALSE){ // 新增至購物車
	function add_item($itemid, $qty=1, $qtyLimit=10, $class=FALSE, $name=FALSE, $sn=FALSE, $d_price1=FALSE, $d_price2=FALSE, $d_price3=FALSE, $d_sale=FALSE, $d_price4=FALSE, $d_new_p=FALSE, $pic=FALSE, $pic2=FALSE, $sessionID=FALSE){
		//if(!$dir_price){
			//$dir_price = ed_get_price($itemid,$qty);
		//}
		//if(!$name){
			//$name = ed_get_name($itemid);
		//}
		//$this->firephp  = FirePHP::getInstance(true);
		
		$sessionID = $_COOKIE['PHPSESSID'];
		$userIP = getRealIpAddr();
		
		$this->item_sessionID = $sessionID;
		$this->item_userIP = $userIP;
		
		//$firephp->log($this->item_sessionID, 'item_sessionID');
		//$firephp->info($this->item_sessionID);
		
		//echo '<br>itemid = '.$itemid.'<br>';
		//echo '<br>qty = '.$qty.'<br>';
		//echo '<br>qtyLimit = '.$qtyLimit.'<br>';
		
		/*if($qty>$qtyLimit){
			$qty = $qtyLimit;	
		}
		echo '<br>qty2 = '.$qty.'<br>';*/
		
		//echo 'EDcart freightCosts => '.$this->freightCosts;
		
		if(isset($this->itemQtys[$itemid]) && $this->itemQtys[$itemid] > 0){ 
		
			//echo "<br>have item<br>";
			
			//echo "<br> first qty = ".$this->itemQtys[$itemid].'<br>';
		
			if(($qty + $this->itemQtys[$itemid])>$this->itemQtysLimit[$itemid]){
				$this->itemQtys[$itemid] = $this->itemQtysLimit[$itemid];
			}else{
				$this->itemQtys[$itemid] = $qty + $this->itemQtys[$itemid];
			}
			
			//echo "<br> 2 qty = ".$this->itemQtys[$itemid].'<br>';
			
			$this->_update_total();
			
		} else {
			
			//echo "<br>no item<br>";
			
			if($qty>$qtyLimit){
				$qty = $qtyLimit;
			}
			$this->items[]						=	$itemid;
			$this->itemQtys[$itemid] 			=	$qty;
			$this->itemQtysLimit[$itemid]		=	$qtyLimit;
			$this->itemClass[$itemid]			=	$class;
			$this->itemName[$itemid]			=	$name;
			$this->itemSn[$itemid]				=	$sn;
			
			$this->itemPrice1[$itemid]		=	$d_price1;
			$this->itemPrice2[$itemid]		=	$d_price2;
			$this->itemPrice3[$itemid]		=	$d_price3;
			$this->itemOnSale[$itemid]		=	$d_sale;
			$this->itemPrice4[$itemid]		=	$d_price4;
			
			$this->itemNewProduct[$itemid]	=	$d_new_p;
			
			$this->itemPic[$itemid]			=	$pic;
			$this->itemPic2[$itemid]		=	$pic2;
			
			
			/*$this->itemtemp[$itemid] = $temp;	
			$this->itemspace[$itemid] = $space;			
			$this->itemtimes[$itemid] = $times;
			$this->itembread[$itemid] = $bread;	*/
			require('db.php');
			$selectSQL = "SELECT * FROM m_baskets WHERE productID=".$itemid." AND basketSession='".$sessionID."' AND mb_ip='".$userIP."'";
			//echo 'selectSQL = '.$selectSQL.'<br>';
			$Rec = mysql_query($selectSQL) or die('Error, select query failed');
			$totalRows = mysql_num_rows($Rec);
			
			if($totalRows>0){
				//$query = "UPDATE m_baskets SET qty='$qty' WHERE productID='$itemid' AND basketSession='$sessionID'";
				$query = "DELETE FROM m_baskets WHERE productID=".$itemid." AND basketSession='".$sessionID."' AND mb_ip='".$userIP."'";
				mysql_query($query) or die('Error, delete query failed');
			}
			//mysql_select_db($dbname, $conn);
			$query = "INSERT INTO m_baskets (productID, class, productName, qty, qtyLimit, serial_num, d_price1, d_price2, d_price3, d_sale, d_new_product, file_link2, file_link3, basketSession, mb_ip, mb_time) VALUES ('$itemid', '$class', '$name', '$qty', '$qtyLimit', '$sn', '$d_price1', '$d_price2', '$d_price3', '$d_sale', '$d_new_p', '$pic2', '$pic', '$sessionID', '$userIP', NOW() )";
			//echo 'query = '.$query;
			mysql_query($query) or die('Error, insert query failed');
			//mysql_query($query, $conn) or die(mysql_error());
		}
		$this->_update_total();
		
		//$this->firephp->log($itemid, 'itemid');
		//$firephp->log($itemid, 'itemid');
		//$firephp->info($itemid, 'itemid');
	} 


	function edit_item($itemid,$qty){ // 更新購物車數量
		if($qty < 1) {
			$this->del_item($itemid);
		} else {
			if($qty > $this->itemQtysLimit[$itemid]){
				$this->itemQtys[$itemid] = $this->itemQtysLimit[$itemid];
			}else{
				$this->itemQtys[$itemid] = $qty;
			}
			
		}
		$this->_update_total();
	} 


	function del_item($itemid){ // 移除購物車
		$ti = array();
		
		$this->itemQtys[$itemid] = 0;
		foreach($this->items as $item){
			if($item != $itemid){
				$ti[] = $item;
			}
		}
		$this->items = $ti;
		$this->_update_total();
	} 


	function empty_cart(){ // 清空購物車
	
		$this->total				= 0;		//商品價錢
		$this->grandTotal			= 0;		//加上了運費後的總合費用
		$this->itemCount			= 0;
		$this->AllItemCount			= 0;		//所有數量清空
		$this->totalAll				= 0;		//計算未加運費總和
		
		$this->items				= array();
		$this->itemQtys				= array();	//數量
		$this->itemClass			= array();	//產品類別
		$this->itemName				= array();	//產品名稱
		$this->itemSn				= array();	//產品sn
		//$this->itemPriceStatus		= array();	//產品價位狀態
		
		$this->itemPrice1			= array();	//市價
		$this->itemPrice2			= array();	//折扣價
		$this->itemPrice3			= array();	//會員折扣價
		$this->itemOnSale			= array();	//是否為特價品
		$this->itemPrice4			= array();	//產品圖片
		
		$this->itemNewProduct		= array();	//是否為新品
		$this->itemPic				= array();	//產品圖片
		$this->itemPic2				= array();	//產品圖片(小)
		
		require('db.php');
		$sessionID = $_COOKIE['PHPSESSID'];
	
		//$query = "DELETE FROM m_baskets WHERE basketSession != '" . $sessionID . "'";
		$query = "DELETE FROM m_baskets WHERE basketSession = '" . $sessionID . "'";
		//echo '<br>edcart query = '.$query.'<br>';
		mysql_query($query) or die('Error, delect basket failed');
		
	}

	function _update_total(){ // 更新購物車的內容
	
		//抓免運費設定
		require('db.php');
		$selectSQL = "SELECT * FROM data_set WHERE d_class1='freight'";
		//echo 'selectSQL = '.$selectSQL.'<br>';
		$Rec = mysql_query($selectSQL) or die('Error, select freight failed');
		$row = mysql_fetch_assoc($Rec);
		$totalRows = mysql_num_rows($Rec);
	
		if($totalRows>0){
			$this->freightRating = $row['d_price1'];
		}
		
	
		$this->itemCount	= 0;
		$this->AllItemCount	= 0;
		$this->total		= 0;
		$this->grandTotal	= 0;
		$this->totalAll		= 0;
		
		if(sizeof($this->items > 0)){
			foreach($this->items as $item) {
				$tmpSubTotal = 0;
				//$tmpSubTotal = $this->_subtotal($this->itemQtys[$item], $this->itemstatus[$item], $this->itemdir_price[$item], $this->itemprice2[$item], $this->itemdiscount[$item], $this->itemnum[$item]);
				
				$memberStasus = ( (isset($_SESSION['MM_UserAccount'])) && ($_SESSION['MM_UserAccount']!='') ) ? TRUE : FALSE ;
				$tmpSubTotal = $this->_subtotal(
											$this->itemQtys[$item], 
											$this->itemPrice1[$item], 
											$this->itemPrice2[$item], 
											$this->itemPrice3[$item], 
											$this->itemOnSale[$item], 
											$this->itemPrice4[$item],
											$memberStasus,
											$item
											);	
				
				//echo '<br>$tmpSubTotal = '.$tmpSubTotal.'<br>';
				
				$this->total += $tmpSubTotal;
				
				$this->itemCount++;	
				
				$this->AllItemCount += 	$this->itemQtys[$item];	
				
				require('db.php');
				$updateSQL = "UPDATE m_baskets SET qty='".$this->itemQtys[$item]."' , subtotal='$tmpSubTotal', mb_time=NOW() WHERE productID='$item' AND basketSession='".$this->item_sessionID."' AND mb_ip='".$this->item_userIP."'";
				//echo "updateSQL = ".$updateSQL;
			//mysql_select_db($dbname, $conn);
				mysql_query($updateSQL) or die('Error, UPDATE query failed');	
			}
		}
		//運費計算
		
		/*if($this->total < $this->freightRating){//運費總計			
			$this->grandTotal = $this->total + $this->freightCosts;//計算最後總計	
		}else{
			$this->grandTotal = $this->total;//計算最後總計
		}	*/
		if($this->AllItemCount < $this->freightRating){//運費總計			
			$this->grandTotal = $this->total + $this->freightCosts;//計算最後總計	
		}else{
			$this->grandTotal = $this->total;//計算最後總計
		}
		
		
	} 
	
	//function _subtotal($qty, $status, $dir_price, $price2, $discount, $num){ // 計算各項產品數量的價錢
	function _subtotal( $qty, $d_price1, $d_price2, $d_price3, $d_sale, $d_price4, $memberStasus, $itemid ){ // 計算各項產品數量的價錢
		$tmpSubTotal = 0;
		
		/*if($d_sale==1){			//特價,價錢*數量直接回傳
			$tmpSubTotal = $qty * $d_price4;
			$this->itemPriceStatus[$itemid] = '特價品';
			return $tmpSubTotal;				
		}else{
			if($memberStasus){			//會員折扣價,價錢*數量直接回傳
				$tmpSubTotal = $qty * (round( $d_price1 * ($d_price3 /10) ));
				$this->itemPriceStatus[$itemid] = '會員折扣價';
				return $tmpSubTotal;
			}else{	//市價,算出數量折扣等級,再依等級算出該項產品總價
				$tmpSubTotal = $qty * (round( $d_price1 * ($d_price2 /10) ));	
				$this->itemPriceStatus[$itemid] = '市價';		
				return $tmpSubTotal;			
			}
		}*/
		$tmpSubTotal = $qty *  $d_price1;	
		//$this->itemPriceStatus[$itemid] = '市價';		
		return $tmpSubTotal;
			
	} 
	
	function _deliveryFee($freight, $freight_costs, $assembly_costs, $qty){
		/*var $tmpdeliveryFee = 0;
		if($freight==0){
			$tmpdeliveryFee = ($freightCosts * $qty) + $assembly_costs ;
		}
		return $tmpdeliveryFee;*/
		return ($freight==0) ? ($freightCosts * $qty) + $assembly_costs : 0 ;
	}
	
	
}

// Start a new session in case it hasn't already been started on the including page
//@session_start();
if (!isset($_SESSION)) {
	session_start();
}

// Initialize edCart after session start
//echo 'ED isObject = '.is_object($cart).'<br>';
//echo "ED item1 = ".$cart->itemCount.'<br>';
//$cart =& $_SESSION['edCart']; 
$cart =& $_SESSION['edCart']; 
if(!is_object($cart)) $cart = new edCart();
//echo "ED item2 = ".$cart->itemCount.'<br>';

/*$cart =& $_SESSION['edCart'];
if(!is_object($cart)) {
	$cart = $_SESSION['edCart'] = new edCart();
}*/

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>