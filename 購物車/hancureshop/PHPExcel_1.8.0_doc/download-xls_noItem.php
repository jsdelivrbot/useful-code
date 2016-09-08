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
	$fulltxtSQL = " AND (O.client LIKE '%".$fulltxt."%' OR O.cellphone LIKE '%".$fulltxt."%' OR O.email LIKE '%".$fulltxt."%' OR O.address LIKE '%".$fulltxt."%' OR O.r_client LIKE '%".$fulltxt."%' OR O.r_cellphone LIKE '%".$fulltxt."%' OR O.r_email LIKE '%".$fulltxt."%' OR O.r_address LIKE '%".$fulltxt."%' OR O.remitter LIKE '%".$fulltxt."%' OR O.remitter_AC LIKE '%".$fulltxt."%' OR O.remitter_money LIKE '%".$fulltxt."%' OR O.notation LIKE '%".$fulltxt."%' OR O.GrandTotal LIKE '%".$fulltxt."%')";
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

mysql_select_db($database_connect2data, $connect2data);
$query_RecOrder = "SELECT * FROM order_set AS O WHERE O.o_number!='' $numSQL $dateSQL $fulltxtSQL $statusSQL ORDER BY `datetime` DESC";
$RecOrder = mysql_query($query_RecOrder, $connect2data) or die(mysql_error());
$row_RecOrder = mysql_fetch_assoc($RecOrder); 
$totalRows_RecOrder = mysql_num_rows($RecOrder);

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
	   
	   
	    $style = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			)
		);
	
		$objPHPExcel->getDefaultStyle()->applyFromArray($style);
	   //$objPHPExcel->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
	   
	   //$objPHPExcel->getActiveSheet()->getStyle("a2")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
 	   //$objPHPExcel->setActiveSheetIndex(0);
		
       $objPHPExcel->getActiveSheet()->getColumnDimension("a")->setWidth(16);	//訂單編號
       $objPHPExcel->getActiveSheet()->getColumnDimension("b")->setWidth(12);	//訂單日期
       $objPHPExcel->getActiveSheet()->getColumnDimension("c")->setWidth(12);	//客戶
       $objPHPExcel->getActiveSheet()->getColumnDimension("d")->setWidth(12);	//訂單總額
       $objPHPExcel->getActiveSheet()->getColumnDimension("e")->setWidth(12);	//付款方式
       $objPHPExcel->getActiveSheet()->getColumnDimension("f")->setWidth(30);	//會員帳號
       $objPHPExcel->getActiveSheet()->getColumnDimension("g")->setWidth(16);	//訂購人聯絡電話
       $objPHPExcel->getActiveSheet()->getColumnDimension("h")->setWidth(40);	//訂購人地址
       $objPHPExcel->getActiveSheet()->getColumnDimension("i")->setWidth(30);	//訂購人EMAIL
       $objPHPExcel->getActiveSheet()->getColumnDimension("j")->setWidth(15);	//收件人姓名
       $objPHPExcel->getActiveSheet()->getColumnDimension("k")->setWidth(16);	//收件人聯絡電話
       $objPHPExcel->getActiveSheet()->getColumnDimension("l")->setWidth(40);	//收件地址
       $objPHPExcel->getActiveSheet()->getColumnDimension("m")->setWidth(30);	//收件人EMAIL
	   $objPHPExcel->getActiveSheet()->getColumnDimension("n")->setWidth(60);	//收件人EMAIL
	   
	   $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
	   $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
           
       $objPHPExcel->getActiveSheet()->setCellValue('a2', "$k1");
       $objPHPExcel->getActiveSheet()->setCellValue('b2', "$k2");   
       $objPHPExcel->getActiveSheet()->setCellValue('c2', "$k3");
       $objPHPExcel->getActiveSheet()->setCellValue('d2', "$k4");
       $objPHPExcel->getActiveSheet()->setCellValue('e2', "$k5");
       $objPHPExcel->getActiveSheet()->setCellValue('f2', "$k6");
       $objPHPExcel->getActiveSheet()->setCellValue('g2', "$k7");
       $objPHPExcel->getActiveSheet()->setCellValue('h2', "$k8");
       $objPHPExcel->getActiveSheet()->setCellValue('i2', "$k9");
       $objPHPExcel->getActiveSheet()->setCellValue('j2', "$k10");
       $objPHPExcel->getActiveSheet()->setCellValue('k2', "$k11");
       $objPHPExcel->getActiveSheet()->setCellValue('l2', "$k12");
       $objPHPExcel->getActiveSheet()->setCellValue('m2', "$k13"); 
       //$objPHPExcel->getActiveSheet()->setCellValue('n2', "pic"); 



$ii=3;	
$sheet = $objPHPExcel->getActiveSheet();

do{

if (!(strcmp(1, $row_RecOrder['payment']))) {$payment =  "銀行轉帳";}
if (!(strcmp(2, $row_RecOrder['payment']))) {$payment =  "貨到付款";}
$m_account = ($row_RecOrder['m_account']!='') ? $row_RecOrder['m_account'] : '非會員' ;
$address = $row_RecOrder['zipcode'].' '.$row_RecOrder['address'];
$r_address = $row_RecOrder['r_zipcode'].' '.$row_RecOrder['r_address'];

	$objPHPExcel->getActiveSheet()->getRowDimension($ii)->setRowHeight(20);
	
	$sheet->setCellValue('a'.$ii, $row_RecOrder['o_number']);
	$sheet->setCellValue('b'.$ii, sortDate($row_RecOrder['datetime'], '-'));   
	$sheet->setCellValue('c'.$ii, $row_RecOrder['client']);
	
	$sheet->setCellValue('d'.$ii, $row_RecOrder['GrandTotal']);
	$sheet->getStyle('d'.$ii)->getNumberFormat()->setFormatCode('"NT$ "#,##0');
	
	$sheet->setCellValue('e'.$ii, $payment);
	$sheet->setCellValue('f'.$ii, $m_account);
	$sheet->setCellValueExplicit('g'.$ii, (string)$row_RecOrder['cellphone'], PHPExcel_Cell_DataType::TYPE_STRING);
	//$objPHPExcel->getActiveSheet()->setCellValueExplicit('H1', (string)'0919636153',PHPExcel_Cell_DataType::TYPE_STRING); 
	$sheet->setCellValue('h'.$ii, $address);
	$sheet->setCellValue('i'.$ii, $row_RecOrder['email']);
	$sheet->setCellValue('j'.$ii, $row_RecOrder['r_client']);
	$sheet->setCellValueExplicit('k'.$ii, (string)$row_RecOrder['r_cellphone'], PHPExcel_Cell_DataType::TYPE_STRING);
	$sheet->setCellValue('l'.$ii, $r_address);
	$sheet->setCellValue('m'.$ii, $row_RecOrder['r_email']); 
	//$sheet->setCellValue('n'.$ii, '');
	
	
	
	
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

//$path = $_SERVER["DOCUMENT_ROOT"] . 'petitpot/' . $row_RecOrderItem['pic'];
/*$path = $_SERVER["DOCUMENT_ROOT"].'petitpot/'.$row_RecOrderItem['pic'];
if (file_exists($path)) {
				
	echo 'path = '.$path.'<br>';		

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName($row_RecOrderItem['d_name']);
$objDrawing->setDescription($row_RecOrderItem['d_name']);
$objDrawing->setPath($path);
$objDrawing->setHeight(50);
$objDrawing->setCoordinates('N'.$ii);
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
}	*/
	$ii++;
	
} while ($row_RecOrder = mysql_fetch_assoc($RecOrder));



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



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle(date('YmdH').'-HanCure');


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