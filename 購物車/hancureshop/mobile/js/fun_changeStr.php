<?php 

function changeStr( $chageS ){

	return "《".substr($chageS,0,4)."/".substr($chageS,5,2)."/".substr($chageS,8,2)."》";

}

function sortDate( $chageS, $Symbol='/' ){

	//return "【".substr($chageS,0,4)."/".substr($chageS,5,2)."/".substr($chageS,8,2)."】";
	return substr($chageS,0,4)."$Symbol".substr($chageS,5,2)."$Symbol".substr($chageS,8,2);

}

function sortDateDote( $chageS, $Symbol='.' ){

	//return "【".substr($chageS,0,4)."/".substr($chageS,5,2)."/".substr($chageS,8,2)."】";
	return substr($chageS,0,4)."$Symbol".substr($chageS,5,2)."$Symbol".substr($chageS,8,2);

}
function sortDateTW( $chageS ){

	//return "【".substr($chageS,0,4)."/".substr($chageS,5,2)."/".substr($chageS,8,2)."】";
	return substr($chageS,0,4)." ".substr($chageS,5,2)."月".substr($chageS,8,2)."日";

}

function ResponseDate( $chageS ){

	//return "【".substr($chageS,0,4)."/".substr($chageS,5,2)."/".substr($chageS,8,2)."】";
	return substr($chageS,0,4)."-".substr($chageS,4,2)."-".substr($chageS,6,2).' '.substr($chageS,8,2).':'.substr($chageS,10,2).':'.substr($chageS,12,2);

}

function ResponseYear( $chageS ){
	return substr($chageS,0,4);
}
function ResponseMonth( $chageS ){
	return Month2SortEng(substr($chageS,5,2));
}
function ResponseDay( $chageS ){
	return substr($chageS,8,2);
}
function Month2SortEng($m){
	//["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
	$sortName = "JAN";
	switch ($m){
		case "01":
			$sortName = "JAN ";
			break;
			
		case "02":
			$sortName = "FEB ";
			break;
			
		case "03":
			$sortName = "MAR ";
			break;
			
		case "04":
			$sortName = "APR ";
			break;
			
		case "05":
			$sortName = "MAY ";
			break;
			
		case "06":
			$sortName = "JUN ";
			break;
			
		case "07":
			$sortName = "JUL ";
			break;
			
		case "08":
			$sortName = "AUG ";
			break;
			
		case "09":
			$sortName = "SEP ";
			break;
			
		case "10":
			$sortName = "OCT ";
			break;
			
		case "11":
			$sortName = "NOV ";
			break;
			
		case "12":
			$sortName = "DEC";
			break;
		
		default:
		  $sortName = "JAN";
		}
		
		return $sortName;
}

function strWhitespace( $str ){

$str = trim($str);
$str = preg_replace('/\s(?=\s)/', '', $str);
$str = preg_replace('/[\n\r\t]/', '', $str);
$str = str_replace('&nbsp;', '', $str);
$str = str_replace('  ', '', $str);
$str = str_replace(' ', '', $str);
$str = str_replace('　', '', $str);
return $str;

}

function strWhitespace_nospace( $str ){

$str = trim($str);
$str = preg_replace('/\s(?=\s)/', '', $str);
$str = preg_replace('/[\n\r\t]/', '', $str);
/*$str = str_replace('&nbsp;', '', $str);
$str = str_replace('  ', '', $str);
$str = str_replace(' ', '', $str);
$str = str_replace('　', '', $str);*/
return $str;

}

function cutstr_html($string, $sublen)    
 {
  $string = strip_tags($string);
  $string = preg_replace ('/\n/is', '', $string);
  $string = preg_replace ('/ |　/is', '', $string);
  $string = preg_replace ('/&nbsp;/is', '', $string);
  
  preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $t_string);   
  if(count($t_string[0]) - 0 > $sublen) $string = join('', array_slice($t_string[0], 0, $sublen))."…";   
  else $string = join('', array_slice($t_string[0], 0, $sublen));
  
  return $string;
 }
 
function countStr($str) {
	$str = strip_tags($str,"");
	$str = strWhitespace( $str );
	return strlen($str);
}
//擷取字串前幾個字並避免截掉半個中文字，$strlen要擷取的字串長度(以英文字母數計算，中文字需算二個字數)
//此處直接傳入從資料庫讀出之UTF-8編碼字串
function CuttingStr($str, $strlen) {

$str = strip_tags($str,"");
//$str = strWhitespace( $str );
$str = strWhitespace_nospace( $str );



if(strlen($str)<$strlen){

return $str;


}else{


//把' '先轉成空白
$str = str_replace(' ', ' ', $str);

$output_str_len = 0; //累計要輸出的擷取字串長度
$output_str = ''; //要輸出的擷取字串

//逐一讀出原始字串每一個字元
for($i=0; $i<=$strlen; $i++){
//擷取字數已達到要擷取的字串長度，跳出回圈
	if($output_str_len >= $strlen){
	break;
	}

//取得目前字元的ASCII碼
$str_bit = ord(substr($str, $i, 1));

if($str_bit < 128) {
//ASCII碼小於 128 為英文或數字字符
$output_str_len += 1; //累計要輸出的擷取字串長度，英文字母算一個字數
$output_str .= substr($str, $i, 1); //要輸出的擷取字串

}elseif($str_bit > 191 && $str_bit < 224) {
//第一字節為落於192~223的utf8的中文字(表示該中文為由2個字節所組成utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 2); //要輸出的擷取字串
$i++;

}elseif($str_bit > 223 && $str_bit < 240) {
//第一字節為落於223~239的utf8的中文字(表示該中文為由3個字節所組成的utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 3); //要輸出的擷取字串
$i+=2;

}elseif($str_bit > 239 && $str_bit < 248) {
//第一字節為落於240~247的utf8的中文字(表示該中文為由4個字節所組成的utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 4); //要輸出的擷取字串
$i+=3;
}
}

//$str .= $str."...";
$output_str = $output_str."...";

//要輸出的擷取字串為空白時，輸出原始字串
return ($output_str == '') ? $str : $output_str;

}
}

//擷取字串前幾個字並避免截掉半個中文字，$strlen要擷取的字串長度(以英文字母數計算，中文字需算二個字數)
//此處直接傳入從資料庫讀出之UTF-8編碼字串
function CuttingStr_more($str, $strlen) {

$str = strip_tags($str,"");
$str = strWhitespace( $str );



if(strlen($str)<$strlen){

return $str;


}else{


//把' '先轉成空白
$str = str_replace(' ', ' ', $str);

$output_str_len = 0; //累計要輸出的擷取字串長度
$output_str = ''; //要輸出的擷取字串

//逐一讀出原始字串每一個字元
for($i=0; $i<=$strlen; $i++){
//擷取字數已達到要擷取的字串長度，跳出回圈
	if($output_str_len >= $strlen){
	break;
	}

//取得目前字元的ASCII碼
$str_bit = ord(substr($str, $i, 1));

if($str_bit < 128) {
//ASCII碼小於 128 為英文或數字字符
$output_str_len += 1; //累計要輸出的擷取字串長度，英文字母算一個字數
$output_str .= substr($str, $i, 1); //要輸出的擷取字串

}elseif($str_bit > 191 && $str_bit < 224) {
//第一字節為落於192~223的utf8的中文字(表示該中文為由2個字節所組成utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 2); //要輸出的擷取字串
$i++;

}elseif($str_bit > 223 && $str_bit < 240) {
//第一字節為落於223~239的utf8的中文字(表示該中文為由3個字節所組成的utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 3); //要輸出的擷取字串
$i+=2;

}elseif($str_bit > 239 && $str_bit < 248) {
//第一字節為落於240~247的utf8的中文字(表示該中文為由4個字節所組成的utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 4); //要輸出的擷取字串
$i+=3;
}
}

//$str .= $str."...";
$output_str = $output_str."......<span class=\"more_d\">More Detail</span>";

//要輸出的擷取字串為空白時，輸出原始字串
return ($output_str == '') ? $str : $output_str;

}
}

function searchReplace($content,$keyword){
	if($keyword!=""){
		$change = ereg_replace ( $keyword, '<span class="search_txt">'.$keyword.'</span>', $content);
  		return $change;
	}else{
		return $content;
	}
	 
}

//擷取字串前幾個字並避免截掉半個中文字，$strlen要擷取的字串長度(以英文字母數計算，中文字需算二個字數)
//此處直接傳入從資料庫讀出之UTF-8編碼字串
function CuttingStr_more_en($str, $strlen) {

$str = strip_tags($str,"");
$str = strWhitespace_nospace( $str );



if(strlen($str)<$strlen){

return $str;


}else{


//把' '先轉成空白
$str = str_replace(' ', ' ', $str);

$output_str_len = 0; //累計要輸出的擷取字串長度
$output_str = ''; //要輸出的擷取字串

//逐一讀出原始字串每一個字元
for($i=0; $i<=$strlen; $i++){
//擷取字數已達到要擷取的字串長度，跳出回圈
	if($output_str_len >= $strlen){
	break;
	}

//取得目前字元的ASCII碼
$str_bit = ord(substr($str, $i, 1));

if($str_bit < 128) {
//ASCII碼小於 128 為英文或數字字符
$output_str_len += 1; //累計要輸出的擷取字串長度，英文字母算一個字數
$output_str .= substr($str, $i, 1); //要輸出的擷取字串

}elseif($str_bit > 191 && $str_bit < 224) {
//第一字節為落於192~223的utf8的中文字(表示該中文為由2個字節所組成utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 2); //要輸出的擷取字串
$i++;

}elseif($str_bit > 223 && $str_bit < 240) {
//第一字節為落於223~239的utf8的中文字(表示該中文為由3個字節所組成的utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 3); //要輸出的擷取字串
$i+=2;

}elseif($str_bit > 239 && $str_bit < 248) {
//第一字節為落於240~247的utf8的中文字(表示該中文為由4個字節所組成的utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 4); //要輸出的擷取字串
$i+=3;
}
}

//$str .= $str."...";
$output_str = $output_str."......<span class=\"more_d\">More Detail</span>";

//要輸出的擷取字串為空白時，輸出原始字串
return ($output_str == '') ? $str : $output_str;

}
}

function CuttingStr_en($str, $strlen) {

$str = strip_tags($str,"");
$str = strWhitespace_nospace( $str );



if(strlen($str)<$strlen){

return $str;


}else{


//把' '先轉成空白
$str = str_replace(' ', ' ', $str);

$output_str_len = 0; //累計要輸出的擷取字串長度
$output_str = ''; //要輸出的擷取字串

//逐一讀出原始字串每一個字元
for($i=0; $i<=$strlen; $i++){
//擷取字數已達到要擷取的字串長度，跳出回圈
	if($output_str_len >= $strlen){
	break;
	}

//取得目前字元的ASCII碼
$str_bit = ord(substr($str, $i, 1));

if($str_bit < 128) {
//ASCII碼小於 128 為英文或數字字符
$output_str_len += 1; //累計要輸出的擷取字串長度，英文字母算一個字數
$output_str .= substr($str, $i, 1); //要輸出的擷取字串

}elseif($str_bit > 191 && $str_bit < 224) {
//第一字節為落於192~223的utf8的中文字(表示該中文為由2個字節所組成utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 2); //要輸出的擷取字串
$i++;

}elseif($str_bit > 223 && $str_bit < 240) {
//第一字節為落於223~239的utf8的中文字(表示該中文為由3個字節所組成的utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 3); //要輸出的擷取字串
$i+=2;

}elseif($str_bit > 239 && $str_bit < 248) {
//第一字節為落於240~247的utf8的中文字(表示該中文為由4個字節所組成的utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 4); //要輸出的擷取字串
$i+=3;
}
}

//$str .= $str."...";
$output_str = $output_str."...";

//要輸出的擷取字串為空白時，輸出原始字串
return ($output_str == '') ? $str : $output_str;

}
}


//裁切字串
function cut_content($a,$b){
    $a = strip_tags($a); //去除HTML標籤
    $sub_content = mb_substr($a, 0, $b, 'UTF-8'); //擷取子字串
    echo $sub_content;  //顯示處理後的摘要文字
    //顯示 "......"
    if (strlen($a) > strlen($sub_content)) echo "...";
}
function left_string($s,$m,$symbol)
{
   $n=strlen($s);
   $c=0;
   $s2='';
   for($i=0;$i<$n;$i++)
   {
      $t=ord(substr($s,$i,1));   
      if($t>=128)
      {
        $s1=substr($s,$i,3);
        $i=$i+2;
      }
      else
        $s1=substr($s,$i,1);
      
       $c=$c+1;
       if($c<=$m)
         $s2=$s2.$s1;
       else
         $i=$n+1;
   }
   if($i>$n)
      $s2=$s2."$symbol";
   return $s2;
}


////不限字數/////////////////////////
//擷取字串前幾個字並避免截掉半個中文字，$strlen要擷取的字串長度(以英文字母數計算，中文字需算二個字數)
//此處直接傳入從資料庫讀出之UTF-8編碼字串
function CuttingStrNo($str) {

$str = strip_tags($str,"");
$str = strWhitespace( $str );


//把' '先轉成空白
$str = str_replace(' ', ' ', $str);

$output_str_len = 0; //累計要輸出的擷取字串長度
$output_str = ''; //要輸出的擷取字串
$strlen = strlen($str);

//逐一讀出原始字串每一個字元
for($i=0; $i<=$strlen; $i++){
//擷取字數已達到要擷取的字串長度，跳出回圈
	if($output_str_len >= $strlen){
	break;
	}

//取得目前字元的ASCII碼
$str_bit = ord(substr($str, $i, 1));

if($str_bit < 128) {
//ASCII碼小於 128 為英文或數字字符
$output_str_len += 1; //累計要輸出的擷取字串長度，英文字母算一個字數
$output_str .= substr($str, $i, 1); //要輸出的擷取字串

}elseif($str_bit > 191 && $str_bit < 224) {
//第一字節為落於192~223的utf8的中文字(表示該中文為由2個字節所組成utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 2); //要輸出的擷取字串
$i++;

}elseif($str_bit > 223 && $str_bit < 240) {
//第一字節為落於223~239的utf8的中文字(表示該中文為由3個字節所組成的utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 3); //要輸出的擷取字串
$i+=2;

}elseif($str_bit > 239 && $str_bit < 248) {
//第一字節為落於240~247的utf8的中文字(表示該中文為由4個字節所組成的utf8中文字)
$output_str_len += 2; //累計要輸出的擷取字串長度，中文字需算二個字數
$output_str .= substr($str, $i, 4); //要輸出的擷取字串
$i+=3;
}
}

//$str .= $str."...";
//$output_str = $output_str."...";

//要輸出的擷取字串為空白時，輸出原始字串
return ($output_str == '') ? $str : $output_str;


}
?>
