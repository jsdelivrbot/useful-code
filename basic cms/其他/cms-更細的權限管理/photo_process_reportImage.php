<?php
 require_once('../Connections/connect2data.php');
 	
function reportImageProcess($file_name, $deal_type, $image_width, $image_height, $imageLink){
	//echo count($_FILES[image][name]);//上傳物件數量
	//echo count($_REQUEST[image_title]);//上傳物件的說明之數量
	
		$all_image_name = array();//建立回傳的資料陣列
		$no_image=0;
	
		//******如果是插入記錄的上傳圖片begin*******/
		if($deal_type=="add")
		{
			$sql_max_pic= "Select MAX(file_id) From file_set";//找到圖片id的最大值，來當作下一個圖片的名稱
			//echo $sql_max_pic;
			$result_max_pic=mysql_query($sql_max_pic);
			
			if($row_max_pic = mysql_fetch_array($result_max_pic))
			{	
			
				$new_pic_num=$row_max_pic[0]+1;
		
				//echo $row_max_pic[0];
			}
			else
			{
				$new_pic_num=1;
				
			}
			//echo $new_pic_num;
			
			
		}
		//******如果是插入記錄的上傳圖片end*******/
		
		//******如果是更新記錄的上傳圖片begin*******/
		if($deal_type=="edit")
		{
			
			if(isset($_POST['file_id'])){
				$new_pic_num=$_POST['file_id'];
			}else{
				$sql_max_pic= "Select MAX(file_id) From file_set";//找到圖片id的最大值，來當作下一個圖片的名稱
				//echo $sql_max_pic;
				$result_max_pic=mysql_query($sql_max_pic);
				
				if($row_max_pic = mysql_fetch_array($result_max_pic))
				{	
				
					$new_pic_num=$row_max_pic[0]+1;
			
					//echo $row_max_pic[0];
				}
				else
				{
					$new_pic_num=1;
					
				}
			}
			
				
			//echo $new_pic_num;
			
			
		}
		//******如果是更新記錄的上傳圖片end*******/
	$j=0;		
	//for($j=0;$j<count($_FILES[image][name]);$j++)
	//{
		//$tmp_name=$_FILES[image][name][$j];
		$tmp_name = "videos.jpg";
		$videoLink = "../upload_image/$tmp_name";
		
		//original image 
		//$img = "http://www.site.com/blah.gif"; 

		//directory to copy to (must be CHMOD to 777) 
		//$copydir = "/home/user/public_html/directory/"; 

		//$data = file_get_contents($imageLink); 
		//$file = fopen($videoLink, "w+"); 
		//fputs($file, $data);  
		//fclose($file);
		
		/*if(function_exists('curl_init')){
			echo "have curl_init fun<br>";
		}else{
			echo "non curl_init fun<br>";
		}
		getimagesize($imageLink);*/

//遠端連線COPY IMAGE FILE

/*$url = "http://other-site/image.png";
$dir = "/my/local/dir/";
$lfile = fopen($dir . basename($url), "w");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1)');
curl_setopt($ch, CURLOPT_FILE, $lfile);

fclose($lfile);
curl_close($ch);*/


//Initialize the Curl session 
$ch = curl_init(); 
//Set curl to return the data instead of printing it to the browser. 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
//Set the URL 
curl_setopt($ch, CURLOPT_URL, $imageLink); 
//Execute the fetch 
$data = curl_exec($ch); 
//Close the connection 
curl_close($ch);
//$data now contains the contents of $URL
$file = fopen($videoLink, "w+"); 
fputs($file, $data);  
fclose($file);
		
//$ch = curl_init(); 
//$fp = fopen($videoLink, "w"); 
/*curl_setopt($ch, CURLOPT_FILE, $fp); 
$options = array( 
CURLOPT_URL => $imageLink, 
CURLOPT_HEADER => false 
); 
curl_setopt_array($ch, $options); */

//curl_setopt($ch, CURLOPT_FILE, $fp);
//curl_setopt($ch, CURLOPT_HEADER, false);
//
//curl_exec($ch); 
//curl_close($ch); 
//fclose($fp); 
		
		
		//copy($imageLink, $videoLink);
		//if($tmp_name!='')//如果有上傳檔案
		//echo "file_exists = ".file_exists($videoLink)."<br>";
		if(file_exists($videoLink))
		{
		
			//******產生相對應的資料夾begin*******//
				$image_path="upload_image";
				check_path($image_path);//如果沒有資料夾，產生資料夾
				
				
				$image_path.="/".$file_name;
				//echo "image_path = ".$image_path."<br>";
				check_path($image_path);//如果沒有資料夾，產生資料夾
										
			//******產生相對應的資料夾end*******//

		
			//echo  $_FILES[image][name][$j]."<br>";
			//$image_type=strtolower(end(explode(".", $_FILES[image][name][$j])));//將檔案已"."分開，放到陣列呼叫array最後一個資料,為檔案副檔名
			$image_type=strtolower(end(explode(".", $tmp_name)));//將檔案已"."分開，放到陣列呼叫array最後一個資料,為檔案副檔名
			//echo $image_type."<br>";//
			
			
			
			//確定檔案是圖片檔案
			if($image_type=="jpg" || $image_type=="gif" || $image_type=="bmp" || $image_type=="png" || $image_type=="tif")
			{
						
			            $photo_name=$new_pic_num+$j;//將新id轉成檔案名，已上傳的數量來增加
						//echo $photo_name."<br>";
						
						/*-------從檔案暫存區複製到指定的資料夾，並縮圖begin--------*/
						//$_FILES[image][name][$j]=str_replace(" ","",$_FILES[image][name][$j]);//將檔案名內有空白的除掉
						$tmp_name=str_replace(" ","",$tmp_name);//將檔案名內有空白的除掉
						
						//$size=getimagesize($_FILES[image][tmp_name][$j]);
						$size=getimagesize($videoLink);
						//echo $size[0];//寬
						//echo $size[1];//長
						$orginal_width=$size[0];//寬
						$orginal_height=$size[1];//長
						
						if($image_width==0)//如果是0使用圖片原來的尺寸:注意、注意
						{
							$image_width=$orginal_width;
							$image_height=$orginal_height;
						}
						
						$image_path_new = "../".$image_path;
						$this_path1=$image_path."/".$file_name."_".$photo_name.".".$image_type;
						$this_image_path1 = "../".$this_path1;
						//echo $this_path1."<br>";
								
						//if(($orginal_width/$orginal_height)>($image_width/$image_height))//如果大於比例，以分子為主(在此為不改變圖片比例)
						/*if(($orginal_width/$orginal_height)>($image_width/$image_height))//如果大於比例，以分子為主(在此為不改變圖片比例)
						{
							$exec_str="convert -resize 9999x".$image_height." ".$_FILES[image][tmp_name][$j]." ../".$this_path1;
							reportImagesResize($this_path1,$image_path,$destW,$destH);
						
						}else//如果小於比例，以分母為主
						{
							$exec_str="convert -resize ".$image_width."x9999 ".$_FILES[image][tmp_name][$j]." ../".$this_path1;
							reportImagesResize($src,$src,$destW,$destH);
						}*/
						//exec($exec_str);
						//複製暫存檔
						//copy($_FILES['image']['tmp_name'][$j] , $this_image_path1 );
						copy($videoLink , $this_image_path1 );
						if($orginal_width>$image_width){
							reportImagesResize($this_image_path1,$this_image_path1,$image_width,$image_height);
							/*echo "orginal_width = ".$orginal_width;"<br>";
							echo "orginal_height = ".$orginal_height;"<br>";
							echo "image_width = ".$image_width;"<br>";
							echo "image_height = ".$image_height;"<br>";*/
						}else{
							reportImagesResize($this_image_path1,$this_image_path1,$orginal_width,$orginal_height);
						}
						/*$exec_str="convert ../".$this_path1." -quality 100% -gravity center -crop ".$image_width."x".$image_height."+0+0 +repage ../".$this_path1;//切圖
						exec($exec_str);*/
						
						
						//縮中圖
						$this_path2=$image_path."/m_".$file_name."_".$photo_name.".".$image_type;
						$this_image_path2 = "../".$this_path2;
						//copy($_FILES['image']['tmp_name'][$j] , $this_image_path2 );
						copy($videoLink , $this_image_path2 );
						//echo $this_path;
						//$exec_str="convert -resize 130x130 ".$_FILES[image][tmp_name][$j]." ../".$this_path2;
						
						$destW = 188;
						$destH = 145;
						reportImagesResize_4($this_image_path2,$this_image_path2,$destW,$destH);
						
						
						//縮小圖
						$this_path3=$image_path."/s_".$file_name."_".$photo_name.".".$image_type;
						$this_image_path3 = "../".$this_path3;
						//copy($_FILES['image']['tmp_name'][$j] , $this_image_path2 );
						copy($videoLink , $this_image_path3 );
						//echo $this_path;
						//$exec_str="convert -resize 130x130 ".$_FILES[image][tmp_name][$j]." ../".$this_path2;						
						$destW = 84;
						$destH = 66;
						reportImagesResize_4($this_image_path3,$this_image_path3,$destW,$destH);
						
						/*$exec_str="convert -resize 130x88 ".$_FILES[image][tmp_name][$j]." ../".$this_path2;
						exec($exec_str);
						$exec_str="convert ../".$this_path2." -quality 80% -gravity center -crop 130x88+0+0 +repage ../".$this_path2;//切圖
						//$exec_str="convert ../".$this_path1." -quality 80% -gravity center -crop ".$image_width."x".$image_height."+0+0 +repage ../".$this_path1;//切圖
						exec($exec_str);*/
						/*-------從檔案暫存區複製到指定的資料夾，並縮圖end--------*/
						
						//echo $_FILES[image][name][$j].":name<br>";
						//echo $_REQUEST[image_title][$j].":title<br>";
						$db_file_name=$file_name."_".$photo_name.".".$image_type;//儲存到資料庫的檔案名稱
						
						$all_image_name[1][0]=$db_file_name;//儲存檔案名
						$all_image_name[1][1]=$this_path1;//大圖檔案位置
						$all_image_name[1][2]=$this_path2;//中圖檔案位置
						$all_image_name[1][3]=$this_path3;//小圖檔案位置
						//$all_image_name[1][4]=$_REQUEST['image_title'][$j];//檔案title(說明)
						//$all_image_name[1][5]=$_REQUEST['image_property'][$j];//檔案屬性(說明)
						
						if(file_exists($videoLink)){
							unlink($videoLink);
						}
				
			}
			else//如果不是圖片，提出警告
			{
				$no_image=1;
				//echo "不是圖片";
			}	
		}
		else//沒上傳檔案
		{
			//echo "沒上傳檔案";
						
		}
		 
	//}
	
	if($no_image==1)
	{
		$all_image_name[0][0]=1;
	}else
	{
		$all_image_name[0][0]=0;
	}
	
	//print_r($all_image_name);//列出陣列
	return $all_image_name ;	
}

/*function check_path($image_path)
	{
				
		if(! is_dir("../".$image_path))//如果沒有資料夾
			{
				mkdir("../".$image_path);//產生資料夾
			}
			else
			{
				//dont do thing	
			}
	}*/

ini_set("memory_limit","100M");

function reportImagesResize($src,$dest,$destW,$destH) { 
		if (file_exists($src)  && isset($dest)) { 
			//取得檔案資訊
			$srcSize   = getimagesize($src); 
			$srcExtension = $srcSize[2];
			$srcRatio  = $srcSize[0] / $srcSize[1]; //依width為主
			//依長寬比判斷長寬像素
			
				$destH_2 = $destW / $srcRatio;
				$destRatio = $srcSize[0] / $destW;
			////echo "destW = ".$destW."<br/>";
			////echo "destH = ".$destH."<br/>";
			////echo "destH_2 = ".$destH_2."<br/>";	
			if($destH_2<$destH){//依hight為主
				$srcRatio  = $srcSize[1] / $srcSize[0];
				$destW_2 = $destH / $srcRatio;
				$destRatio = $srcSize[1] / $destH;
				//$destH = $destH_2;
				////echo "大於<br/>";
				//$disX = ($destW_2 - $destW)/2;
				//$disY = ($destH - $destH)/2;
			}else{
				//$destH = $destH_2;
				////echo "小於<br/>";
				//$disX = ($destW - $destW)/2;
				//$disY = ($destH_2 - $destH)/2;
			}
			//$srcX = $destW - $disX;
			//$srcY = $destH - $disY;
			//$srcX = ($destW*$srcRatio_B)/2;
			//$srcY = ($destH*$srcRatio_B)/2;
			
			$srcW = $destW*$destRatio;
			$srcH = $destH*$destRatio;
			$srcX = ($srcSize[0] - $srcW)/2;
			$srcY = ($srcSize[1] - $srcH)/2;
		} 
		//echo "<br/>srcRatio = $srcRatio<br/>";
		//echo "destRatio = $destRatio<br>";
		//echo "destW = ".$destW."<br/>";
		//echo "destH = ".$destH."<br/>";
		//echo "srcW = ".$srcW."<br/>";
		//echo "srcH = ".$srcH."<br/>";
		//echo "srcX = ".$srcX."<br/>";
		//echo "srcY = ".$srcY."<br/><br/>";
		//建立影像 
		$destImage = imagecreatetruecolor($destW,$destH);
		////echo "destImage = ".$destImage."<br/>";
		//根據檔案格式讀取圖檔 
		switch ($srcExtension) { 
			case 1: $srcImage = imagecreatefromgif($src); break; 
			case 2: $srcImage = imagecreatefromjpeg($src); break; 
			case 3: $srcImage = imagecreatefrompng($src); break; 
		}
		
		//有處理透明背景
		if ( ($srcExtension == 1) || ($srcExtension == 3) ) {
     		$transparency = imagecolortransparent($srcImage);

     		// If we have a specific transparent color
			if ($transparency >= 0) {
				// Get the original image's transparent color's RGB values
       			$transparent_color  = imagecolorsforindex($srcImage, $trnprt_indx);
				// Allocate the same color in the new image resource
     			$transparency       = imagecolorallocate($destImage, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
        		// Completely fill the background of the new image with allocated color.
				imagefill($destImage, 0, 0, $transparency);
				// Set the background color for new image to transparent
        		imagecolortransparent($destImage, $transparency);
      		}
			// Always make a transparent background color for PNGs that don't have one allocated already
      		elseif ($srcExtension == 3) {
			
				// Turn off transparency blending (temporarily)
       			imagealphablending($destImage, false);   
        		// Create a new transparent color for image
        		$color = imagecolorallocatealpha($destImage, 0, 0, 0, 127);
				// Completely fill the background of the new image with allocated color.
        		imagefill($destImage, 0, 0, $color);
				// Restore transparency blending
        		imagesavealpha($destImage, true);
      		}
   		}

		//取樣縮圖 
/*bool imagecopyresampled ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
$dst_image：新建的圖片
$src_image：需要載入的圖片
$dst_x：設定需要載入的圖片在新圖中的x坐標
$dst_y： 設定需要載入的圖片在新圖中的y坐標
$src_x：設定載入圖片要載入的 區域x坐標
$src_y ：設定載入圖片要載入的 區域y坐標
$dst_w：設定載入 的原圖 的寬度（ 在此設置縮放 ）
$dst_h ：設定載入的原圖的高度（在此設置縮放）
$src_w：原圖要載入的寬度
$src_h： 原圖要載入的高度*/
		//imagecopyresampled( 輸出目標檔案, 來源檔案, 目標檔案開始點的x座標, 目標檔案開始點的y座標, 來源檔案開始點的x座標, 來源檔案開始點的y座標, 目標檔案的長度, 目標檔案的高度, 來源檔案的長度, 來源檔案的高度)
		imagecopyresampled($destImage, $srcImage, 0, 0, $srcX, $srcY, $destW, $destH, $srcW, $srcH); 
		//imagefilledrectangle($destImage, 0, 0, $destW, $destH, $white_color);

		//輸出圖檔 
		switch ($srcExtension) { 
			case 1: imagegif($destImage,$dest); break; 
			case 2: imagejpeg($destImage,$dest,100); break;
			case 3: imagepng($destImage,$dest); break;

		//釋放資源
		imagedestroy($destImage);
		} 		
	}


function reportImagesResize_2($src,$dest,$destW,$destH) { 
		if (file_exists($src)  && isset($dest)) { 
			//取得檔案資訊
			$srcSize   = getimagesize($src); 
			$srcExtension = $srcSize[2];
			$srcRatio  = $srcSize[0] / $srcSize[1]; 
			//依長寬比判斷長寬像素
			
				$destH = $destW / $srcRatio;
			
			
		} 
		echo "destW = ".$destW."<br>";
		echo "destH = ".$destH."<br>";
		//建立影像 
		$destImage = imagecreatetruecolor($destW,$destH); 	
		echo "destImage = ".$destImage."<br>";
		//根據檔案格式讀取圖檔 
		switch ($srcExtension) { 
			case 1: $srcImage = imagecreatefromgif($src); break; 
			case 2: $srcImage = imagecreatefromjpeg($src); break; 
			case 3: $srcImage = imagecreatefrompng($src); break; 
		}

		//取樣縮圖 
		imagecopyresampled($destImage, $srcImage, 0, 0, 0, 0,$destW,$destH,
		imagesx($srcImage), imagesy($srcImage)); 

		//輸出圖檔 
		switch ($srcExtension) { 
			case 1: imagegif($destImage,$dest); break; 
			case 2: imagejpeg($destImage,$dest,100); break;
			case 3: imagepng($destImage,$dest); break;

		//釋放資源
		imagedestroy($destImage);
		} 		
	}


//縮小圖專用,依設定尺寸
function reportImagesResize_4($src,$dest,$destW,$destH) { 
		if (file_exists($src)  && isset($dest)) { 
			//取得檔案資訊
			$srcSize   = getimagesize($src); 
			$srcExtension = $srcSize[2];
			$srcRatio  = $srcSize[0] / $srcSize[1]; //依width為主
			//依長寬比判斷長寬像素
			
				$destH_2 = $destW / $srcRatio;
				$destRatio = $srcSize[0] / $destW;
			////echo "destW = ".$destW."<br/>";
			////echo "destH = ".$destH."<br/>";
			////echo "destH_2 = ".$destH_2."<br/>";	
			if($destH_2<$destH){//依hight為主
				$srcRatio  = $srcSize[1] / $srcSize[0];
				$destW_2 = $destH / $srcRatio;
				$destRatio = $srcSize[1] / $destH;
				//$destH = $destH_2;
				////echo "大於<br/>";
				//$disX = ($destW_2 - $destW)/2;
				//$disY = ($destH - $destH)/2;
			}else{
				//$destH = $destH_2;
				////echo "小於<br/>";
				//$disX = ($destW - $destW)/2;
				//$disY = ($destH_2 - $destH)/2;
			}
			//$srcX = $destW - $disX;
			//$srcY = $destH - $disY;
			//$srcX = ($destW*$srcRatio_B)/2;
			//$srcY = ($destH*$srcRatio_B)/2;
			
			$srcW = $destW*$destRatio;
			$srcH = $destH*$destRatio;
			$srcX = ($srcSize[0] - $srcW)/2;
			$srcY = ($srcSize[1] - $srcH)/2;
		} 
		//echo "<br/>srcRatio = $srcRatio<br/>";
		//echo "destRatio = $destRatio<br>";
		//echo "destW = ".$destW."<br/>";
		//echo "destH = ".$destH."<br/>";
		//echo "srcW = ".$srcW."<br/>";
		//echo "srcH = ".$srcH."<br/>";
		//echo "srcX = ".$srcX."<br/>";
		//echo "srcY = ".$srcY."<br/><br/>";
		//建立影像 
		$destImage = imagecreatetruecolor($destW,$destH);
		////echo "destImage = ".$destImage."<br/>";
		//根據檔案格式讀取圖檔 
		switch ($srcExtension) { 
			case 1: $srcImage = imagecreatefromgif($src); break; 
			case 2: $srcImage = imagecreatefromjpeg($src); break; 
			case 3: $srcImage = imagecreatefrompng($src); break; 
		}
		
		//有處理透明背景
		if ( ($srcExtension == 1) || ($srcExtension == 3) ) {
     		$transparency = imagecolortransparent($srcImage);

     		// If we have a specific transparent color
			if ($transparency >= 0) {
				// Get the original image's transparent color's RGB values
       			$transparent_color  = imagecolorsforindex($srcImage, $trnprt_indx);
				// Allocate the same color in the new image resource
     			$transparency       = imagecolorallocate($destImage, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
        		// Completely fill the background of the new image with allocated color.
				imagefill($destImage, 0, 0, $transparency);
				// Set the background color for new image to transparent
        		imagecolortransparent($destImage, $transparency);
      		}
			// Always make a transparent background color for PNGs that don't have one allocated already
      		elseif ($srcExtension == 3) {
			
				// Turn off transparency blending (temporarily)
       			imagealphablending($destImage, false);   
        		// Create a new transparent color for image
        		$color = imagecolorallocatealpha($destImage, 0, 0, 0, 127);
				// Completely fill the background of the new image with allocated color.
        		imagefill($destImage, 0, 0, $color);
				// Restore transparency blending
        		imagesavealpha($destImage, true);
      		}
   		}

		//取樣縮圖 
/*bool imagecopyresampled ( resource $dst_image , resource $src_image , int $dst_x , int $dst_y , int $src_x , int $src_y , int $dst_w , int $dst_h , int $src_w , int $src_h )
$dst_image：新建的圖片
$src_image：需要載入的圖片
$dst_x：設定需要載入的圖片在新圖中的x坐標
$dst_y： 設定需要載入的圖片在新圖中的y坐標
$src_x：設定載入圖片要載入的 區域x坐標
$src_y ：設定載入圖片要載入的 區域y坐標
$dst_w：設定載入 的原圖 的寬度（ 在此設置縮放 ）
$dst_h ：設定載入的原圖的高度（在此設置縮放）
$src_w：原圖要載入的寬度
$src_h： 原圖要載入的高度*/
		//imagecopyresampled( 輸出目標檔案, 來源檔案, 目標檔案開始點的x座標, 目標檔案開始點的y座標, 來源檔案開始點的x座標, 來源檔案開始點的y座標, 目標檔案的長度, 目標檔案的高度, 來源檔案的長度, 來源檔案的高度)
		imagecopyresampled($destImage, $srcImage, 0, 0, $srcX, $srcY, $destW, $destH, $srcW, $srcH); 
		//imagefilledrectangle($destImage, 0, 0, $destW, $destH, $white_color);

		//輸出圖檔 
		switch ($srcExtension) { 
			case 1: imagegif($destImage,$dest); break; 
			case 2: imagejpeg($destImage,$dest,100); break;
			case 3: imagepng($destImage,$dest); break;

		//釋放資源
		imagedestroy($destImage);
		} 		
	}	
?>

