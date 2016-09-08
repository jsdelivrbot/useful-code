<?php require_once('../../Connections/connect2data.php'); ?>
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

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


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


//设置表头   
       $k1="日期";
       $k2="預約方式";     
       $k3="姓名";
       $k4="電話";
       $k5="地址";
       $k6="Email";
       $k7="婚期";
       $k8="預約來店品嘗日期";
       $k9="預約喜餅訂購盒數";
       $k10="預約需求盒型-浪漫唯美";
       $k11="預約需求盒型-經典復古";
       $k12="預約需求盒型-時髦俏皮";
       $k13="請問您如何知道Ooh La Love";
       
       $objPHPExcel->getActiveSheet()->getColumnDimension("a")->setWidth(20);
       $objPHPExcel->getActiveSheet()->getColumnDimension("b")->setWidth(15);
       $objPHPExcel->getActiveSheet()->getColumnDimension("d")->setWidth(12);
       $objPHPExcel->getActiveSheet()->getColumnDimension("e")->setWidth(50);
       $objPHPExcel->getActiveSheet()->getColumnDimension("f")->setWidth(35);
       $objPHPExcel->getActiveSheet()->getColumnDimension("g")->setWidth(14);
       $objPHPExcel->getActiveSheet()->getColumnDimension("h")->setWidth(20);
       $objPHPExcel->getActiveSheet()->getColumnDimension("i")->setWidth(20);
       $objPHPExcel->getActiveSheet()->getColumnDimension("j")->setWidth(26);
       $objPHPExcel->getActiveSheet()->getColumnDimension("k")->setWidth(26);
       $objPHPExcel->getActiveSheet()->getColumnDimension("l")->setWidth(26);
       $objPHPExcel->getActiveSheet()->getColumnDimension("m")->setWidth(38);


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
       //读取数据库内容 
       $sql = "SELECT d_date ,d_class2 ,d_title ,d_data1 ,d_data2 ,d_data3 ,d_data17 ,d_decade ,d_data4 ,d_data5 ,d_data6 ,d_data7 ,d_data8 FROM data_set WHERE d_class1 = 'contactUs' ORDER BY d_date DESC"; 
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
              } 



// Miscellaneous glyphs, UTF-8
// $objPHPExcel->setActiveSheetIndex(0)
//             ->setCellValue('A4', 'Miscellaneous glyphs')
//             ->setCellValue('A5', 'éàèùâêîôûëïüÿäöüç');

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
