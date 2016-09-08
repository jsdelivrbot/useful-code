<?php
require_once('db.php');
class edCart {
	var $total = 0; //計算海運商品價錢
	var $deliverfee = 0; //修改，運費
	var $profee = 0; //修改，手續費
	var $grandtotal = 0; //加上了運費後的總合費用
	var $itemcount = 0;
	var $totalAll = 0;	//計算未加運費總和
	var $weightTotal = 0;	//計算重量總和
	var $item_sessionID = '';
	
	var $items = array();	
	var $itemqtys = array();		//數量
	var $itemname = array();		//產品名稱
	var $itemsn = array();			//產品sn
	var $itemstatus = array();		//價格狀態顯示
	var $itemprice1 = array();		//直購價
	var $itemprice2 = array();		//集購價
	var $itemdiscount = array();	//集購價折扣
	var $itemnum = array();			//集購價級數
	var $itemfreight = array();		//運費	
	var $itempic = array();			//產品圖片
	var $itemd_weight = array();	//產品重量
	
	//var $itemcode = array();
	//var $itemsize = array();
	//var $itempreserve = array();//運費 2為冷凍 1為冷藏 0為常溫用來比對狀態，再修改$deliverV值
	//var $itemtemp = array(); 	//運送方式
	//var $itemspace = array();	//空間比例
	//var $itemtimes = array(); 	//免運費倍數
	//var $itembread = array(); 	//是否為餐包

	function cart() {} // 宣告函數

	function get_contents(){ // 取得購物車內容
		$items = array();
		foreach($this->items as $tmp_item){
		    $item = FALSE;
			
			$item['id'] = $tmp_item;
			$item['qty'] = $this->itemqtys[$tmp_item];
			$item['name'] = $this->itemname[$tmp_item];
			$item['sn'] = $this->itemsn[$tmp_item];
			$item['status'] = $this->itemstatus[$tmp_item];
			$item['price1'] = $this->itemprice1[$tmp_item];
			$item['price2'] = $this->itemprice2[$tmp_item];
			$item['discount'] = $this->itemdiscount[$tmp_item];
			$item['num'] = $this->itemnum[$tmp_item];
			$item['freight'] = $this->itemfreight[$tmp_item];
			$item['pic'] = $this->itempic[$tmp_item];
			$item['weight'] = $this->itemweight[$tmp_item];
				//echo "name = ".$item['name'];
			//$item['subtotal'] = $item['qty'] * $item['price1'];
			$item['subtotal'] = $this->_subtotal($item['qty'], $item['status'], $item['price1'], $item['price2'], $item['discount'], $item['num']);			
			
			$items[] = $item;
		}
		return $items;
	} 

	//id, 數量, 產品名, sn, 價格狀態顯示, 直購價, 集購價, 集購價折扣, 集購價級數, 運費, 產品圖
	function add_item($itemid, $qty=1, $name=FALSE, $sn=FALSE, $status=FALSE, $price1=FALSE, $price2=FALSE, $discount=FALSE, $num=FALSE, $freight=FALSE, $pic=FALSE, $weight=FALSE, $sessionID=FALSE){ // 新增至購物車
		//if(!$price1){
			//$price1 = ed_get_price($itemid,$qty);
		//}
		//if(!$name){
			//$name = ed_get_name($itemid);
		//}
		$this->item_sessionID = $sessionID;
		
		if(isset($this->itemqtys[$itemid]) && $this->itemqtys[$itemid] > 0){ 
		
			$this->itemqtys[$itemid] = $qty + $this->itemqtys[$itemid];
			$this->_update_total();
			
		} else {
			$this->items[]					=	$itemid;
			$this->itemqtys[$itemid] 		=	$qty;
			$this->itemname[$itemid]		=	$name;
			$this->itemsn[$itemid]			=	$sn;
			$this->itemstatus[$itemid]		=	$status;			
			$this->itemprice1[$itemid]		=	$price1;
			$this->itemprice2[$itemid]		=	$price2;			
			$this->itemdiscount[$itemid]	=	$discount;			
			$this->itemnum[$itemid]			=	$num;
			$this->itemfreight[$itemid]		=	$freight;			
			$this->itempic[$itemid]			=	$pic;
			$this->itemweight[$itemid]		=	$weight;
			
			/*$this->itemtemp[$itemid] = $temp;	
			$this->itemspace[$itemid] = $space;			
			$this->itemtimes[$itemid] = $times;
			$this->itembread[$itemid] = $bread;	*/
			$selectSQL = "SELECT * FROM baskets WHERE productID='$itemid' AND basketSession='$sessionID'";
			$Rec = mysql_query($selectSQL) or die('Error, select query failed');
			$totalRows = mysql_num_rows($Rec);
			
			if($totalRows>0){
				//$query = "UPDATE baskets SET qty='$qty' WHERE productID='$itemid' AND basketSession='$sessionID'";
				$query = "DELETE FROM baskets WHERE productID = '$itemid' AND basketSession = '$sessionID'";
				mysql_query($query) or die('Error, delete query failed');
			}
			//mysql_select_db($dbname, $conn);
			$query = "INSERT INTO baskets (productID, name, qty, serial_num, price_status, price1, price2, discount, discount_num, freight, weight, basketSession) VALUES ('$itemid', '$name', '$qty', '$sn', '$status', '$price1', '$price2', '$discount', '$num', '$freight', '$weight', '$sessionID')";
			mysql_query($query) or die('Error, insert query failed');
			//mysql_query($query, $conn) or die(mysql_error());
		}
		$this->_update_total();
	} 


	function edit_item($itemid,$qty){ // 更新購物車數量
		if($qty < 1) {
			$this->del_item($itemid);
		} else {
			if($qty > 10000){
				$this->itemqtys[$itemid] = 10000;
			}else{
				$this->itemqtys[$itemid] = $qty;
			}
			
		}
		$this->_update_total();
	} 


	function del_item($itemid){ // 移除購物車
		$ti = array();
		
		$this->itemqtys[$itemid] = 0;
		foreach($this->items as $item){
			if($item != $itemid){
				$ti[] = $item;
			}
		}
		$this->items = $ti;
		$this->_update_total();
	} 


	function empty_cart(){ // 清空購物車
	
		$this->total = 0;				//商品價錢
		$this->deliverfee = 0;			//修改，運費
		$this->profee = 0;				//修改，手續費
		$this->grandtotal = 0;			//加上了運費後的總合費用
		$this->itemcount = 0;
		$this->totalAll = 0;			//計算未加運費總和
		
		$this->items = array();
		$this->itemqtys = array();		//數量
		$this->itemname = array();		//產品名稱
		$this->itemsn = array();		//產品sn
		$this->itemstatus = array();	//價格狀態顯示
		$this->itemprice1 = array();	//直購價
		$this->itemprice2 = array();	//集購價
		$this->itemdiscount = array();	//集購價折扣
		$this->itemnum = array();		//集購價級數
		$this->itemfreight = array();	//運費	
		$this->itempic = array();		//產品圖片
		$this->itemd_weight = array();	//產品重量
		
	}

	function _update_total(){ // 更新購物車的內容
		$this->itemcount = 0;
		$this->total = 0;
		$this->grandtotal = 0;
		$this->weightTotal = 0;
		$this->deliverfee = 0;
		
		if(sizeof($this->items > 0)){
			foreach($this->items as $item) {
				$tmpSubTotal = 0;
				$tmpSubTotal = $this->_subtotal($this->itemqtys[$item], $this->itemstatus[$item], $this->itemprice1[$item], $this->itemprice2[$item], $this->itemdiscount[$item], $this->itemnum[$item]);			
				/*echo "itemqtys = ".$this->itemqtys[$item]."<br>";
				echo "itemstatus = ".$this->itemstatus[$item]."<br>";
				echo "itemprice1 = ".$this->itemprice1[$item]."<br>";
				echo "itemprice2 = ".$this->itemprice2[$item]."<br>";
				echo "itemdiscount = ".$this->itemdiscount[$item]."<br>";
				echo "itemnum = ".$this->itemnum[$item]."<br>";*/
				//$this->total = $this->total + ($this->itemprice1[$item] * $this->itemqtys[$item]);
				$this->total += $tmpSubTotal;
				
				if($this->itemfreight[$item]==0){
					$this->weightTotal += ($this->itemweight[$item] * $this->itemqtys[$item]);		//計算運費需自付產品總重量
				}				
				
				$this->itemcount++;				
				
				
				$updateSQL = "UPDATE baskets SET qty='".$this->itemqtys[$item]."' , subtotal='$tmpSubTotal' WHERE productID='$item' AND basketSession='".$this->item_sessionID."'";
				//echo "updateSQL = ".$updateSQL;
			//mysql_select_db($dbname, $conn);
				mysql_query($updateSQL) or die('Error, UPDATE query failed');	
			}
		}
		//運費計算
		//echo "this->weightTotal = ".$this->weightTotal."<br>";
		//echo "this->deliverfee = ".$this->deliverfee."<br>";
		if($this->weightTotal!=0){
			$this->deliverfee = $this->weightTotal * 5 + 300;		//運費公式:	運費 = 重量 X 5 + 300
		}
		//echo "deliverfee = ".$this->deliverfee;
		//$deliverfee 運費，$profee手續費		
		$this->grandtotal = $this->total + $this->deliverfee + $this->profee;//計算最後總計
	} 
	
	function _subtotal($qty, $status, $price1, $price2, $discount, $num){ // 計算各項產品數量的價錢
		$tmpSubTotal = 0;
		if($status==1){			//直購價,價錢*數量直接回傳
			$tmpSubTotal = $qty * $price1;
			return $tmpSubTotal;
		}elseif($status==0){	//集購價,算出數量折扣等級,再依等級算出該項產品總價
			/*echo "tmpS = $tmpS <br>";
			echo "qty = $qty <br>";
			echo "num = $num <br>";*/
			if($num!=0){
				$rem = floor($qty / $num);		//餘數 = 總數 / 級數
				if($rem>=3){		//最多3個折扣等級
					$rem = 3;
				}
			}else{
				$rem = 0;
			}
			
			$tmpSubTotal = ($price2 - ( $price2 * ($discount * $rem )/100 )) * $qty;	//總價 = 價錢 - ( 價錢 X ( 折扣數 X 餘數 ))
			return $tmpSubTotal;			
		}		
	} 
	
	
}
?>