<?php require_once('../Connections/connect2data.php'); ?>
<?php require_once('../orders_statusA.php'); ?>
<?php require_once('../js/fun_moneyFormat.php'); ?>
<?php require_once('../js/fun_changeStr.php'); ?>
<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

header('Content-Type: text/html; charset=utf-8');

if (isset($_REQUEST['outexcel'])&&($_REQUEST['outexcel']=="1")){

ini_set("gd.jpeg_ignore_warning", 1);
	
$num="";
$numSQL='';
if(isset($_REQUEST['num']) && $_REQUEST['num']!=''){
	$num = $_REQUEST['num'];
	$numSQL = " AND (O.o_number='$num')";		
	//echo "以訂單編號搜尋<br>";
}

$date="";
$dateSQL='';
if(isset($_REQUEST['start']) && isset($_REQUEST['end'])){
	
	$start = $_REQUEST['start'];
	$end = $_REQUEST['end'];
	
	if($start!='' && $end!=''){
		//$dateSQL = " AND (`datetime`>='".$start." 00:00:00' AND `datetime`<='".$end." 23:59:59')";	
		$dateSQL = " AND (`datetime` BETWEEN '".$start." 00:00:00' AND '".$end." 23:59:59')";
	}
	
	//echo "以日期查詢<br>";
}

$fulltxt="";
$fulltxtSQL='';
if(isset($_REQUEST['fulltxt']) && $_REQUEST['fulltxt']!=''){
	$fulltxt = $_REQUEST['fulltxt'];
	$fulltxtSQL = " AND (O.client LIKE '%".$fulltxt."%' OR O.cellphone LIKE '%".$fulltxt."%' OR O.email LIKE '%".$fulltxt."%' OR O.address LIKE '%".$fulltxt."%' OR O.r_client LIKE '%".$fulltxt."%' OR O.r_cellphone LIKE '%".$fulltxt."%' OR O.r_email LIKE '%".$fulltxt."%' OR O.r_address LIKE '%".$fulltxt."%' OR O.remitter LIKE '%".$fulltxt."%' OR O.remitter_AC LIKE '%".$fulltxt."%' OR O.remitter_money LIKE '%".$fulltxt."%' OR O.notation LIKE '%".$fulltxt."%' OR O.GrandTotal LIKE '%".$fulltxt."%' OR OI.d_name LIKE '%".$fulltxt."%')";
	//echo "以文字搜尋<br>";
}

$status="";
$statusSQL='';
if(isset($_REQUEST['status'])){
	$status = $_REQUEST['status'];
	if($status=='-1'){
		$statusSQL='';
	}else{
		$statusSQL = " AND (O.transport_status = '$status')";
		//echo "進度<br>";
	}	
}

/*購買產品*/
$items="-1";
$itemsSQL='';
if(isset($_REQUEST['items'])){
	$items = $_REQUEST['items'];
	if($items!='-1'){
		$itemsSQL = " AND (OI.d_id = '$items' )";
	}
}
/*購買產品*/


mysql_select_db($database_connect2data, $connect2data);
//$query_RecOrder = "SELECT * FROM order_set AS O WHERE O.o_number!='' $numSQL $dateSQL $fulltxtSQL $statusSQL ORDER BY `datetime` DESC";
$query_RecOrder = "SELECT *, SUM(OI.subtotal) as SUBSUM FROM order_set AS O LEFT JOIN order_item AS OI ON O.o_id=OI.o_id WHERE O.o_number!='' $numSQL $dateSQL $fulltxtSQL $statusSQL $itemsSQL GROUP BY O.o_id ORDER BY `datetime` DESC";
$RecOrder = mysql_query($query_RecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecOrder); 
$totalRows_RecOrder = mysql_num_rows($RecOrder);

//echo $query_RecOrder.'<br>';

if($totalRows_RecOrder>0){

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Taipei');

//define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br \>');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A1', '名稱')			  
//             ->setCellValue('B1', '分類')
//             ->setCellValue('C1', '圖片')
//             ->setCellValue('A2', $row_Recaward['d_title'])
//             ->setCellValue('B2', $row_Recaward['d_tag'])
//             ->setCellValue('C2', $row_Recaward['d_id']);

//訂單編號 訂單日期 客戶 訂單總額 付款方式
//设置表头   
       $k1="訂單編號";
       $k2="訂單日期";     
       $k3="客戶";
       $k14="小計";
       $k15="運費";
       $k4="訂單總額";
       $k5="付款方式";
	   
	   $k6="會員帳號";
	   
       $k7="訂購人聯絡電話";
       $k8="訂購人地址";
       $k9="訂購人EMAIL";
	   
       $k10="收件人姓名";
       $k11="收件人聯絡電話";
       $k12="收件地址";
       $k13="收件人EMAIL";
	   
	   $turnover = 0;
	   $grandTurnover = 0;
	   
	    $style = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			),
			'font'  => array(
				'name'  => '新細明體'
			)
		);
	
		$objPHPExcel->getDefaultStyle()->applyFromArray($style);
	   //$objPHPExcel->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	   
	   //$objPHPExcel->getActiveSheet()->getStyle("a2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
 	   //$objPHPExcel->setActiveSheetIndex(0);
		
       $objPHPExcel->getActiveSheet()->getColumnDimension("A")->setWidth(16);	//訂單編號
       $objPHPExcel->getActiveSheet()->getColumnDimension("B")->setWidth(12);	//訂單日期
       $objPHPExcel->getActiveSheet()->getColumnDimension("C")->setWidth(12);	//客戶
       $objPHPExcel->getActiveSheet()->getColumnDimension("D")->setWidth(12);	//訂單小計
       $objPHPExcel->getActiveSheet()->getColumnDimension("E")->setWidth(12);	//運費
       $objPHPExcel->getActiveSheet()->getColumnDimension("F")->setWidth(12);	//訂單總額
       $objPHPExcel->getActiveSheet()->getColumnDimension("G")->setWidth(12);	//付款方式
       $objPHPExcel->getActiveSheet()->getColumnDimension("H")->setWidth(30);	//會員帳號
       $objPHPExcel->getActiveSheet()->getColumnDimension("I")->setWidth(16);	//訂購人聯絡電話
       $objPHPExcel->getActiveSheet()->getColumnDimension("J")->setWidth(40);	//訂購人地址
       $objPHPExcel->getActiveSheet()->getColumnDimension("K")->setWidth(30);	//訂購人EMAIL
       $objPHPExcel->getActiveSheet()->getColumnDimension("L")->setWidth(15);	//收件人姓名
       $objPHPExcel->getActiveSheet()->getColumnDimension("M")->setWidth(16);	//收件人聯絡電話
       $objPHPExcel->getActiveSheet()->getColumnDimension("N")->setWidth(40);	//收件地址
       $objPHPExcel->getActiveSheet()->getColumnDimension("O")->setWidth(30);	//收件人EMAIL
	   //$objPHPExcel->getActiveSheet()->getColumnDimension("P")->setWidth(60);	//收件人EMAIL
	   
	   $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
	   $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
           
       $objPHPExcel->getActiveSheet()->setCellValue('A2', "$k1");
       $objPHPExcel->getActiveSheet()->setCellValue('B2', "$k2");   
       $objPHPExcel->getActiveSheet()->setCellValue('C2', "$k3");
       $objPHPExcel->getActiveSheet()->setCellValue('D2', "$k14");
       $objPHPExcel->getActiveSheet()->setCellValue('E2', "$k15");
       $objPHPExcel->getActiveSheet()->setCellValue('F2', "$k4");
       $objPHPExcel->getActiveSheet()->setCellValue('G2', "$k5");
       $objPHPExcel->getActiveSheet()->setCellValue('H2', "$k6");
       $objPHPExcel->getActiveSheet()->setCellValue('I2', "$k7");
       $objPHPExcel->getActiveSheet()->setCellValue('J2', "$k8");
       $objPHPExcel->getActiveSheet()->setCellValue('K2', "$k9");
       $objPHPExcel->getActiveSheet()->setCellValue('L2', "$k10");
       $objPHPExcel->getActiveSheet()->setCellValue('M2', "$k11");
       $objPHPExcel->getActiveSheet()->setCellValue('N2', "$k12");
       $objPHPExcel->getActiveSheet()->setCellValue('O2', "$k13"); 
       //$objPHPExcel->getActiveSheet()->setCellValue('n2', "pic"); 



$ii=3;	
$sheet = $objPHPExcel->getActiveSheet();

do{

if (!(strcmp(1, $row_RecOrder['payment']))) {$payment =  "ATM 虛擬帳戶匯款";}
if (!(strcmp(2, $row_RecOrder['payment']))) {$payment =  "超商店到店";}
$m_account = ($row_RecOrder['m_account']!='') ? $row_RecOrder['m_account'] : '非會員' ;
$address = $row_RecOrder['zipcode'].' '.$row_RecOrder['address'];
$r_address = $row_RecOrder['r_zipcode'].' '.$row_RecOrder['r_address'];

	$objPHPExcel->getActiveSheet()->getRowDimension($ii)->setRowHeight(20);
	
	$sheet->setCellValue('A'.$ii, $row_RecOrder['o_number']);
	$sheet->setCellValue('B'.$ii, sortDate($row_RecOrder['datetime'], '/'));   
	$sheet->setCellValue('C'.$ii, $row_RecOrder['client']);
	
	//$sheet->setCellValue('D'.$ii, $row_RecOrder['SubTotalAll']);
	$sheet->setCellValue('D'.$ii, $row_RecOrder['SUBSUM']);
	$sheet->getStyle('D'.$ii)->getNumberFormat()->setFormatCode('_-"NT$"* #,##0_ ;_-"NT$"* -#,##0 ;_-"NT$"* "-"_ ;_-@_ ');
	
	//$turnover += (int)$row_RecOrder['SubTotalAll'];
	$turnover += (int)$row_RecOrder['SUBSUM'];
	
	if( $row_RecOrder['tfee'] == 0 ){
		$sheet->setCellValue('E'.$ii, '免運費');
	}else{
		$sheet->setCellValue('E'.$ii, $row_RecOrder['tfee']);
	//$sheet->getStyle('d'.$ii)->getNumberFormat()->setFormatCode('"NT$ "#,##0');
	$sheet->getStyle('E'.$ii)->getNumberFormat()->setFormatCode('_-"NT$"* #,##0_ ;_-"NT$"* -#,##0 ;_-"NT$"* "-"_ ;_-@_ ');
	}
	
	$grandTurnover += (int)$row_RecOrder['GrandTotal'];
	
	$sheet->setCellValue('F'.$ii, $row_RecOrder['GrandTotal']);
	//$sheet->getStyle('d'.$ii)->getNumberFormat()->setFormatCode('"NT$ "#,##0');
	$sheet->getStyle('F'.$ii)->getNumberFormat()->setFormatCode('_-"NT$"* #,##0_ ;_-"NT$"* -#,##0 ;_-"NT$"* "-"_ ;_-@_ ');
	
	$sheet->setCellValue('G'.$ii, $payment);
	$sheet->setCellValue('H'.$ii, $m_account);
	$sheet->setCellValueExplicit('I'.$ii, (string)$row_RecOrder['cellphone'], PHPExcel_Cell_DataType::TYPE_STRING);
	//$objPHPExcel->getActiveSheet()->setCellValueExplicit('H1', (string)'0919636153',PHPExcel_Cell_DataType::TYPE_STRING); 
	$sheet->setCellValue('J'.$ii, $address);
	$sheet->setCellValue('K'.$ii, $row_RecOrder['email']);
	$sheet->setCellValue('L'.$ii, $row_RecOrder['r_client']);
	$sheet->setCellValueExplicit('M'.$ii, (string)$row_RecOrder['r_cellphone'], PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet->setCellValue('N'.$ii, $r_address);
	$sheet->setCellValue('O'.$ii, $row_RecOrder['r_email']); 
	//$sheet->setCellValue('n'.$ii, '');
	
	// Rename worksheet
	$objPHPExcel->getActiveSheet()->setTitle(date('YmdH').'-HanCure');	
	
	
/*
$colname_RecOrderItem = "-1";
if (isset($row_RecOrder['o_id'])) {
  $colname_RecOrderItem = $row_RecOrder['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrderItem = "SELECT * FROM order_item WHERE o_id = '".$colname_RecOrderItem."' ORDER BY oi_id ASC";
$RecOrderItem = mysql_query($query_RecOrderItem, $connect2data) or die(mysql_error());
$row_RecOrderItem = mysql_fetch_assoc($RecOrderItem);
$totalRows_RecOrderItem = mysql_num_rows($RecOrderItem);*/

/*$gdImage = imagecreatefromjpeg('../'.$row_RecOrderItem['pic']);
// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('Sample image');
$objDrawing->setDescription('Sample image');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(150);
$objDrawing->setCoordinates('n'.$ii);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());*/




//$gdImage = imagecreatefromjpeg('../'.$row_RecOrderItem['pic']);
// Add a drawing to the worksheetecho date('H:i:s') . " Add a drawing to the worksheet\n";
//$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();

//echo date('H:i:s') , " Add a drawing to the worksheet" , EOL;





$colname_RecOrderItem = "-1";
if (isset($row_RecOrder['o_id'])) {
  $colname_RecOrderItem = $row_RecOrder['o_id'];
}
mysql_select_db($database_connect2data, $connect2data);
$query_RecOrderItem = "SELECT * FROM order_item WHERE o_id = ".$colname_RecOrderItem." ORDER BY oi_id ASC";
$RecOrderItem = mysql_query($query_RecOrderItem, $connect2data) or die(mysql_error());
$row_RecOrderItem = mysql_fetch_assoc($RecOrderItem);
$totalRows_RecOrderItem = mysql_num_rows($RecOrderItem);

	// Add new sheet
    $objWorkSheet = $objPHPExcel->createSheet($ii-1); //Setting index when creating
	
	// Rename sheet
    $objWorkSheet->setTitle('訂單編號 '.$row_RecOrder['o_number']);
	
	$objWorkSheet->getColumnDimension("A")->setWidth(30);
	$objWorkSheet->getColumnDimension("B")->setWidth(12);
	$objWorkSheet->getColumnDimension("D")->setWidth(12);
	$objWorkSheet->getColumnDimension("E")->setWidth(17);
	
    //Write cells
    $objWorkSheet->setCellValue('A1', '商品清單')
    ->setCellValue('A2', '商品名稱')
   	->setCellValue('B2', '售價')
    ->setCellValue('C2', '數量')
    ->setCellValue('D2', '小計');
    /*->setCellValue('E2', '商品圖片')
	->setCellValue('B1', 'ID')
    ->setCellValue('C1', $row_RecOrder['o_id']);*/
	$objWorkSheet->getRowDimension(1)->setRowHeight(20);
	$objWorkSheet->getRowDimension(2)->setRowHeight(20);
    
		$j = 3;	
    
	do{		
		$objWorkSheet->setCellValue('A'.$j, $row_RecOrderItem['d_name']);		
		$objWorkSheet->setCellValue('B'.$j, $row_RecOrderItem['d_price1']);
		$objWorkSheet->getStyle('B'.$j)->getNumberFormat()->setFormatCode('_-"NT$"* #,##0_ ;_-"NT$"* -#,##0 ;_-"NT$"* "-"_ ;_-@_ ');
		$objWorkSheet->setCellValue('C'.$j, $row_RecOrderItem['qty']);
		$objWorkSheet->setCellValue('D'.$j, $row_RecOrderItem['subtotal']);
		$objWorkSheet->getStyle('D'.$j)->getNumberFormat()->setFormatCode('_-"NT$"* #,##0_ ;_-"NT$"* -#,##0 ;_-"NT$"* "-"_ ;_-@_ ');
		
		$objWorkSheet->getRowDimension($j)->setRowHeight(20);
	/*	$objWorkSheet->getRowDimension($j)->setRowHeight(66);
		//$path = $_SERVER["DOCUMENT_ROOT"] . 'petitpot/' . $row_RecOrderItem['pic'];
		
$path = $_SERVER['DOCUMENT_ROOT'].'/www/'.$row_RecOrderItem['pic'];

if (file_exists($path)) {
	
}else{
	$path = $_SERVER['DOCUMENT_ROOT'].'/'.$row_RecOrderItem['pic'];
}
if (file_exists($path)) {
	
}else{
	$path = '/'.$row_RecOrderItem['pic'];
}
if (file_exists($path)) {
	
}else{
	$path = '../'.$row_RecOrderItem['pic'];
}
if (file_exists($path)) {
	
}else{
	$path = dirname(dirname(__FILE__)).'/'.$row_RecOrderItem['pic'];
}


if (file_exists($path)) {
				
	//echo 'path = '.$path.'<br>';		

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName($row_RecOrderItem['d_name']);
$objDrawing->setDescription($row_RecOrderItem['d_name']);
$objDrawing->setPath($path);
$objDrawing->setHeight(80);
$objDrawing->setOffsetX(4);     // setOffsetX works properly
$objDrawing->setOffsetY(4);		//setOffsetY has no effect
$objDrawing->setCoordinates('E'.$j);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
}else{
	$objWorkSheet->setCellValue('E'.$j, $path);
}*/
		
		$j++;
		
	} while ($row_RecOrderItem = mysql_fetch_assoc($RecOrderItem));


	$ii++;
	
} while ($row_RecOrder = mysql_fetch_assoc($RecOrder));
$rows = mysql_num_rows($RecOrder);
if($rows > 0) {
  mysql_data_seek($RecOrder, 0);
  $row_RecOrder = mysql_fetch_assoc($RecOrder);
}

$ii = $ii+2;

$sheet->setCellValue('D'.$ii, $turnover);
$sheet->getStyle('D'.$ii)->getNumberFormat()->setFormatCode('_-"NT$"* #,##0_ ;_-"NT$"* -#,##0 ;_-"NT$"* "-"_ ;_-@_ ');

$sheet->setCellValue('F'.$ii, $grandTurnover);
$sheet->getStyle('F'.$ii)->getNumberFormat()->setFormatCode('_-"NT$"* #,##0_ ;_-"NT$"* -#,##0 ;_-"NT$"* "-"_ ;_-@_ ');
	
       //tomorrow
       /*$date1 = str_replace('-', '/', $_POST['to']);
       $tomorrow = date('Y-m-d',strtotime($date1 . "+1 days"));
       //读取数据库内容 
       $sql = "SELECT d_date ,d_class2 ,d_title ,d_data1 ,d_data2 ,d_data3 ,d_data17 ,d_decade ,d_data4 ,d_data5 ,d_data6 ,d_data7 ,d_data8 FROM data_set 
       WHERE d_class1 = 'contactUs' 
       AND  (d_date >=  '".$_POST['from']."'
              AND d_date <=  '".$tomorrow."'
              )
       ORDER BY d_date DESC"; 
       mysql_set_charset('utf8');//这里要注意，我搞不懂utf8跟utf-8的区别，因此出现乱码，浪费了好多时间 
       $result = mysql_query($sql); 
       
       $ii=3; 
       $sheet = $objPHPExcel->getActiveSheet(); 
              while($row = mysql_fetch_array($result, MYSQL_NUM)) { 
                            
                            $sheet->setCellValue('a'.$ii, "$row[0]");
                            $sheet->setCellValue('b'.$ii, "$row[1]");   
                            $sheet->setCellValue('c'.$ii, "$row[2]");
                            $sheet->setCellValue('d'.$ii, "$row[3]");
                            $sheet->setCellValue('e'.$ii, "$row[4]");
                            $sheet->setCellValue('f'.$ii, "$row[5]");
                            $sheet->setCellValue('g'.$ii, "$row[6]");
                            $sheet->setCellValue('h'.$ii, "$row[7]");
                            $sheet->setCellValue('i'.$ii, "$row[8]");
                            $sheet->setCellValue('j'.$ii, "$row[9]");
                            $sheet->setCellValue('k'.$ii, "$row[10]");
                            $sheet->setCellValue('l'.$ii, "$row[11]");
                            $sheet->setCellValue('m'.$ii, "$row[12]");    
                            $ii++;  
              }*/
			  



// Miscellaneous glyphs, UTF-8
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A4', 'Miscellaneous glyphs')
//             ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

/*echo date('H:i:s') , " Write to Excel5 format" , EOL;
$callStartTime = microtime(true);*/






// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.date('YmdH').'-HanCure.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: '.gmdate('D, d M Y H:i:s').' GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');


/*
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Echo memory peak usage
echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

// Echo done
echo date('H:i:s') , " Done writing files" , EOL;
echo 'Files have been created in ' , getcwd() , EOL;*/






exit;

}else{
	echo '<script type="text/javascript">
			alert("搜尋不到符合的資料，所以不會匯出表單");
			window.location.href = "../cms/orders_list.php";
		 </script>';
	//header("Location:orders_list.php");
}

}