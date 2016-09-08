<?php
 require_once('../Connections/connect2data.php');
 require_once('jquery/generatorPassword.php');		
function image_process($file_name, $deal_type, $image_width, $image_height){
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
			
			$new_pic_num=$_POST['file_id'];
				
			//echo $new_pic_num;
			
			
		}
		//******如果是更新記錄的上傳圖片end*******/
			
	for($j=0;$j<count($_FILES[image][name]);$j++)
	{
		$tmp_name=$_FILES[image][name][$j];
		
		if($tmp_name!='')//如果有上傳檔案
		{
		
			//******產生相對應的資料夾begin*******//
				$image_path="upload_image";
				check_path($image_path);//如果沒有資料夾，產生資料夾
				
				
				$image_path.="/".$file_name;
				echo "image_path = ".$image_path."<br>";
				check_path($image_path);//如果沒有資料夾，產生資料夾
										
			//******產生相對應的資料夾end*******//

		
			//echo  $_FILES[image][name][$j]."<br>";
			$image_type=strtolower(end(explode(".", $_FILES[image][name][$j])));//將檔案已"."分開，放到陣列呼叫array最後一個資料,為檔案副檔名
			//echo $image_type."<br>";//
			
			
			
			//確定檔案是圖片檔案
			if($image_type=="jpg" || $image_type=="gif" || $image_type=="bmp" || $image_type=="png" || $image_type=="tif")
			{
						
			            $photo_name=$new_pic_num+$j;//將新id轉成檔案名，已上傳的數量來增加
						//echo $photo_name."<br>";
						
						/*-------從檔案暫存區複製到指定的資料夾，並縮圖begin--------*/
						$_FILES[image][name][$j]=str_replace(" ","",$_FILES[image][name][$j]);//將檔案名內有空白的除掉
						
						$size=getimagesize($_FILES[image][tmp_name][$j]);
						//echo $size[0];//寬
						//echo $size[1];//長
						$orginal_width=$size[0];//寬
						$orginal_height=$size[1];//長
						
						if($image_width==0)//如果是0使用圖片原來的尺寸:注意、注意
						{
							$image_width=$orginal_width;
							$image_height=$orginal_height;
						}
						
						$generator = generatorPassword(8);
						
						$image_path_new = "../".$image_path;
						$this_path1=$image_path."/".$file_name."_".$generator."_".$photo_name.".".$image_type;
						$this_image_path1 = "../".$this_path1;
						//echo $this_path1."<br>";
								
						//if(($orginal_width/$orginal_height)>($image_width/$image_height))//如果大於比例，以分子為主(在此為不改變圖片比例)
						/*if(($orginal_width/$orginal_height)>($image_width/$image_height))//如果大於比例，以分子為主(在此為不改變圖片比例)
						{
							$exec_str="convert -resize 9999x".$image_height." ".$_FILES[image][tmp_name][$j]." ../".$this_path1;
							imagesResize($this_path1,$image_path,$destW,$destH);
						
						}else//如果小於比例，以分母為主
						{
							$exec_str="convert -resize ".$image_width."x9999 ".$_FILES[image][tmp_name][$j]." ../".$this_path1;
							imagesResize($src,$src,$destW,$destH);
						}*/
						//exec($exec_str);
						//複製暫存檔
						copy($_FILES['image']['tmp_name'][$j] , $this_image_path1 );
						if($orginal_width>$image_width){
							imagesResize($this_image_path1,$this_image_path1,$image_width,$image_height);
							/*echo "orginal_width = ".$orginal_width;"<br>";
							echo "orginal_height = ".$orginal_height;"<br>";
							echo "image_width = ".$image_width;"<br>";
							echo "image_height = ".$image_height;"<br>";*/
						}else{
							imagesResize($this_image_path1,$this_image_path1,$orginal_width,$orginal_height);
						}
						/*$exec_str="convert ../".$this_path1." -quality 100% -gravity center -crop ".$image_width."x".$image_height."+0+0 +repage ../".$this_path1;//切圖
						exec($exec_str);*/
						
						
						//縮小圖
						$this_path2=$image_path."/s_".$file_name."_".$generator."_".$photo_name.".".$image_type;
						$this_image_path2 = "../".$this_path2;
						copy($_FILES['image']['tmp_name'][$j] , $this_image_path2 );
						//echo $this_path;
						//$exec_str="convert -resize 130x130 ".$_FILES[image][tmp_name][$j]." ../".$this_path2;
						$destW = 120;
						$destH = 120;
						imagesResize_2($this_image_path2,$this_image_path2,$destW,$destH);
						
						/*$exec_str="convert -resize 130x88 ".$_FILES[image][tmp_name][$j]." ../".$this_path2;
						exec($exec_str);
						$exec_str="convert ../".$this_path2." -quality 80% -gravity center -crop 130x88+0+0 +repage ../".$this_path2;//切圖
						//$exec_str="convert ../".$this_path1." -quality 80% -gravity center -crop ".$image_width."x".$image_height."+0+0 +repage ../".$this_path1;//切圖
						exec($exec_str);*/
						/*-------從檔案暫存區複製到指定的資料夾，並縮圖end--------*/
						
						//echo $_FILES[image][name][$j].":name<br>";
						//echo $_REQUEST[image_title][$j].":title<br>";
						$db_file_name=$file_name."_".$generator."_".$photo_name.".".$image_type;//儲存到資料庫的檔案名稱
						
						$all_image_name[$j+1][0]=$db_file_name;//儲存檔案名
						$all_image_name[$j+1][1]=$this_path1;//大圖檔案位置
						$all_image_name[$j+1][2]=$this_path2;//小圖檔案位置
						$all_image_name[$j+1][3]=$_REQUEST[image_title][$j];//檔案title(說明)
						$all_image_name[$j+1][4]=$_REQUEST[image_property][$j];//檔案屬性(說明)
				
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
		 
	}
	
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

function check_path($image_path)
	{
				
		if(! is_dir("../".$image_path))//如果沒有資料夾
			{
				mkdir("../".$image_path);//產生資料夾
			}
			else
			{
				//dont do thing	
			}
	}

ini_set("memory_limit","100M");
	function imagesResize($src,$dest,$destW,$destH) { 
		if (file_exists($src)  && isset($dest)) { 
			//取得檔案資訊
			$srcSize   = getimagesize($src); 
			$srcExtension = $srcSize[2];
			$srcRatio  = $srcSize[0] / $srcSize[1]; 
			//依長寬比判斷長寬像素
			
				$destH = $destW / $srcRatio;
			
			
		} 
		echo "destW = ".$destW;"<br>";
		echo "destH = ".$destH;"<br>";
		//建立影像 
		$destImage = imagecreatetruecolor($destW,$destH); 	
		echo "destImage = ".$destImage;"<br>";
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
//取正方形	
function imagesResize_2($src,$dest,$destW,$destH) { 
		if (file_exists($src)  && isset($dest)) { 
			
			$imgSetW = $destW;
			$imgSetH = $destH;
			
			//取得檔案資訊
			$srcSize   = getimagesize($src); 
			$srcExtension = $srcSize[2];
			$srcRatio  = $srcSize[0] / $srcSize[1]; 
			//依長寬比判斷長寬像素
			
			$destH_2 = $destW / $srcRatio;
			//echo "destW = ".$destW."<br/>";
			//echo "destH = ".$destH."<br/>";
			//echo "destH_2 = ".$destH_2."<br/>";	
			if($destH_2<$destH){
				$srcRatio  = $srcSize[1] / $srcSize[0];
				$destW = $destH / $srcRatio;
				//$destH = $destH_2;
				//echo "大於<br/>";
			}else{
				$destH = $destH_2;
				//echo "小於<br/>";
			}
			$srcX = ($destW - $imgSetW)/2;
			$srcY = ($destH - $imgSetH)/2;
			
		}
		//echo "小destW = ".$destW."<br/>";
		//echo "小destH = ".$destH."<br/>";
		//echo "小srcX = ".$srcX."<br/>";
		//echo "小srcY = ".$srcY."<br/>";
		//建立影像 
		$destImage = imagecreatetruecolor($imgSetW,$imgSetH); 
		//$destImage = imagecreatetruecolor($destW,$destH); 	
		//echo "小destImage = ".$destImage."<br/>";
		//根據檔案格式讀取圖檔 
		switch ($srcExtension) { 
			case 1: $srcImage = imagecreatefromgif($src); break; 
			case 2: $srcImage = imagecreatefromjpeg($src); break; 
			case 3: $srcImage = imagecreatefrompng($src); break; 
		}
		
		//$tgXS = $imgSetW*(imagesx($srcImage)/$destW);
		//$tgYS = $imgSetH*(imagesy($srcImage)/$destH);
		//$tgX = ((imagesx($srcImage)-$tgXS)/2)+$tgXS;
		//$tgY = ((imagesy($srcImage)-$tgXS)/2)+$tgYS;
		if(imagesx($srcImage)<imagesy($srcImage)){
			$tgY = ((imagesy($srcImage)-imagesx($srcImage))/2);
			$tgX = 0;
			$tgS = imagesx($srcImage);
		}else if(imagesx($srcImage)>imagesy($srcImage)){
			$tgX = ((imagesx($srcImage)-imagesy($srcImage))/2);
			$tgY = 0;
			$tgS = imagesy($srcImage);
		}else{
			$tgX = 0;
			$tgY = 0;
			$tgS = imagesx($srcImage);
		}
		
		
		//取樣縮圖 
		imagecopyresampled($destImage, $srcImage, 0, 0, $tgX, $tgY,$imgSetW,$imgSetH,
		$tgS, $tgS); 
		//echo "imagesx = ".imagesx($srcImage)."<br/>";
		//echo "imagesy = ".imagesy($srcImage)."<br/>";
		//echo "tgS = ".$tgS."<br/>";
		//echo "tgX = ".$tgX."<br/>";
		//echo "tgY = ".$tgY."<br/>";
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

