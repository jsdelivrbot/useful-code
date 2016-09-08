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
	
	function export($myfile){
		$local_file = $myfile;
		$download_file = date(Ymd)."_epaper_orders.csv";
		 
		// set the download rate limit (=> 20,5 kb/s)
		$download_rate = 20.5; 
		if(file_exists($local_file) && is_file($local_file)) {
			// send headers
			header('Cache-control: private');
			header('Content-Type: application/octet-stream'); 
			header('Content-Length: '.filesize($local_file));
			header('Content-Disposition: filename='.$download_file);
		 
			flush();
			
			// open file stream
			$file = fopen($local_file, "r");    
			while(!feof($file)) {
				// send the current file part to the browser
				print fread($file, round($download_rate * 1024));    
				// flush the content to the browser
				flush();
				// sleep one second
				sleep(1);    
			}    
			// close file stream
			fclose($file);
			unlink($myfile);
		}else{
			die('Error: The file '.$local_file.' does not exist!');
		}
	}
	mysql_select_db($database_connect2data, $connect2data);
	$sql = "SELECT * FROM address_book_set WHERE a_epaper=1 ORDER BY a_date DESC, a_id DESC";
	
	$res = mysql_query($sql, $connect2data) or die(mysql_error());
	$csv = "新增日期,名稱,e-mail\r";
	while($row = mysql_fetch_array($res)){
		$dat = $row["a_date"];
		//$name = $row["a_display_name"];
		$eml = $row["a_email"];
		$nameEmail = $row["a_display_name"];
		//$nameEmail = $row["a_display_name"].'<'.$row["a_email"].'>';
		$csv .= " $dat, $nameEmail, $eml\r";
		//$csv .= " $dat, $nameEmail\r";
	}
	
	$tmpfname = tempnam(getcwd(), "TMP");
	$handle = fopen($tmpfname, "w");
	fwrite($handle, $csv);
	fclose($handle);
	export($tmpfname);
	echo($sql);
?>
