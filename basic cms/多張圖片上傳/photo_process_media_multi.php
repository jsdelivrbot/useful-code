<?php
 require_once('../Connections/connect2data.php');
 require_once('../Connections/ini_set.php');
//一般用
function image_process($FILES_A, $file_title, $file_name, $deal_type, $image_width, $image_height){
	//echo "上傳物件數量 = ".count($FILES_A['name']);//上傳物件數量
	////echo count($_REQUEST[image_title]);//上傳物件的說明之數量
	//echo "imageH = ".$image_height."<br/>";
		$all_image_name = array();//建立回傳的資料陣列
		$no_image=0;
	
		//******如果是插入記錄的上傳圖片begin*******/
		if($deal_type=="add")
		{
			$sql_max_pic= "Select MAX(file_id) From file_set";//找到圖片id的最大值，來當作下一個圖片的名稱
			////echo $sql_max_pic;
			$result_max_pic=mysql_query($sql_max_pic);
			
			if($row_max_pic = mysql_fetch_array($result_max_pic))
			{	
			
				$new_pic_num=$row_max_pic[0]+1;
		
				////echo $row_max_pic[0];
			}
			else
			{
				$new_pic_num=1;
				
			}
			////echo $new_pic_num;
			
			
		}
		//******如果是插入記錄的上傳圖片end*******/
		
		//******如果是更新記錄的上傳圖片begin*******/
		if($deal_type=="edit")
		{
			
			$new_pic_num=$_POST['file_id'];
				
			////echo $new_pic_num;
			
			
		}
		//******如果是更新記錄的上傳圖片end*******/
			//echo "count = ".count($FILES_A['name']);
	for($j=0;$j<count($FILES_A['name']);$j++)
	{
		$tmp_name=$FILES_A['name'][$j];
		
		if($tmp_name!='')//如果有上傳檔案
		{
		
			//******產生相對應的資料夾begin*******//
				$image_path="upload_image";
				check_path($image_path);//如果沒有資料夾，產生資料夾
				
				
				$image_path.="/".$file_name;
				//echo "image_path = ".$image_path."<br>";
				check_path($image_path);//如果沒有資料夾，產生資料夾
										
			//******產生相對應的資料夾end*******//

		
			////echo  $FILES_A['name'][$j]."<br>";
			$image_type=strtolower(end(explode(".", $FILES_A['name'][$j])));//將檔案已"."分開，放到陣列呼叫array最後一個資料,為檔案副檔名
			////echo $image_type."<br>";//
			
			
			
			//確定檔案是圖片檔案
			if($image_type=="jpg" || $image_type=="gif" || $image_type=="bmp" || $image_type=="png" || $image_type=="tif")
			{
						
			            //$photo_name=$new_pic_num+$j;//將新id轉成檔案名，已上傳的數量來增加
			            $photo_name = md5($file_name.$j.time());
						////echo $photo_name."<br>";
						
						/*-------從檔案暫存區複製到指定的資料夾，並縮圖begin--------*/
						$FILES_A['name'][$j]=str_replace(" ","",$FILES_A['name'][$j]);//將檔案名內有空白的除掉
						
						$size=getimagesize($FILES_A['tmp_name'][$j]);
						echo "寬 = ".$size[0]."<br>";//寬
						echo "長 = ".$size[1];//長
						$orginal_width=$size[0];//寬
						$orginal_height=$size[1];//長
						
						if($image_width==0)//如果是0使用圖片原來的尺寸:注意、注意
						{
							$image_width=$orginal_width;
							$image_height=$orginal_height;
						}
						/*if($orginal_width<$image_width){
							$image_width=$orginal_width;
							$image_height=$orginal_height;
						}*/
						
						$image_path_new = "../".$image_path;
						$this_path1=$image_path."/".$file_name."_".$photo_name.".".$image_type;
						$this_image_path1 = "../".$this_path1;
						////echo $this_path1."<br>";
								
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
						copy($FILES_A['tmp_name'][$j] , $this_image_path1 );
						/*if($orginal_width>$image_width){
							imagesResize($this_image_path1,$this_image_path1,$image_width,$image_height);
							//echo "orginal_width = ".$orginal_width;"<br>";
							//echo "orginal_height = ".$orginal_height;"<br>";
							//echo "image_width = ".$image_width;"<br>";
							//echo "image_height = ".$image_height;"<br>";
						}else if($orginal_height>$image_height){
							imagesResize($this_image_path1,$this_image_path1,$image_width,$image_height);
							//echo "orginal_width = ".$orginal_width;"<br>";
							//echo "orginal_height = ".$orginal_height;"<br>";
							//echo "image_width = ".$image_width;"<br>";
							//echo "image_height = ".$image_height;"<br>";
						}else{
							//imagesResize_3($this_image_path1,$this_image_path1,$orginal_width,$orginal_height);
							imagesResize($this_image_path1,$this_image_path1,$image_width,$image_height);
						}*/
						
						//imagesResize_4($this_image_path1,$this_image_path1,$image_width,$image_height);
						//取得檔案資訊
						$srcSize   = getimagesize($this_image_path1); 
						
						if($srcSize[0]>$image_width || $srcSize[1]>$image_height){
							imagesResize_8($this_image_path1,$this_image_path1,$image_width,$image_height);
						}
						/*$exec_str="convert ../".$this_path1." -quality 100% -gravity center -crop ".$image_width."x".$image_height."+0+0 +repage ../".$this_path1;//切圖
						exec($exec_str);*/
						//echo 'finish 1<br>';
						//取得檔案資訊
						/*
						* 這裡$srcSize為一個數組類型
						* $srcSize[0] 為圖像的寬度
						* $srcSize[1] 為圖像的高度
						* $srcSize[2] 為圖像的格式，包括jpg、gif和png等
						* $srcSize[3] 為圖像的寬度和高度，內容為 width="xxx" height="yyy"
						*/
			
						//判斷橫式或直式圖
						$format = 0;
						if( $srcSize[0] >= $srcSize[1] ){			//横式圖或正方形圖
							$format = 1;
						}elseif( $srcSize[0] < $srcSize[1] ){		//直式圖
							$format = 0;
						}
						
						
						//縮中圖detail用
						/*$this_path2=$image_path."/".$file_name."_".$photo_name."_m596.".$image_type;
						$this_image_path2 = "../".$this_path2;
						copy($FILES_A['tmp_name'][$j] , $this_image_path2 );
						$destW = 596;
						$destH = 390;
						imagesResize_5($this_image_path2,$this_image_path2,$destW,$destH);*/
						
						
						//縮中圖index用
						/*$this_path2=$image_path."/".$file_name."_".$photo_name."_m272.".$image_type;
						$this_image_path2 = "../".$this_path2;
						copy($FILES_A['tmp_name'][$j] , $this_image_path2 );
						$destW = 272;
						$destH = 130;
						imagesResize_5($this_image_path2,$this_image_path2,$destW,$destH);*/
						
						//縮小圖後台list用
						$this_path2=$image_path."/".$file_name."_".$photo_name."_s100.".$image_type;
						$this_image_path2 = "../".$this_path2;
						copy($FILES_A['tmp_name'][$j] , $this_image_path2 );
						//$destW = 84;
						//$destH = 66;
						$destW = 210;
						$destH = 130;
						//imagesResize_2($this_image_path3,$this_image_path3,$destW,$destH);
						imagesResize_4($this_image_path2,$this_image_path2,$destW,$destH);

						//list-小圖
						$destW = 370;
						$destH = 245;
						$this_path3=$image_path."/".$file_name."_".$photo_name."_".intval($destW).'.'.$image_type;
						$this_image_path3 = "../".$this_path3;
						copy($FILES_A['tmp_name'][$j] , $this_image_path3 );
						
						//imagesResize_2($this_image_path3,$this_image_path3,$destW,$destH);
						imagesResize_4($this_image_path3,$this_image_path3,$destW,$destH);
						
						
						/*-------從檔案暫存區複製到指定的資料夾，並縮圖end--------*/
						
						////echo $FILES_A['name'][$j].":name<br>";
						////echo $_REQUEST[image_title][$j].":title<br>";
						$db_file_name=$file_name."_".$photo_name.".".$image_type;//儲存到資料庫的檔案名稱
						
						$all_image_name[$j+1][0]=$db_file_name;//儲存檔案名
						$all_image_name[$j+1][1]=$this_path1;//大圖檔案位置						
						$all_image_name[$j+1][2]=$this_path2;//小圖檔案位置後台list用//中圖檔案位置index用
						$all_image_name[$j+1][3]=$this_path3;//list-小圖
						
						//$all_image_name[$j+1][4]=$this_path4;//小圖檔案位置list用
						$all_image_name[$j+1][5]=$format;//判斷橫式或直式圖
						//echo 'j = '.$j.'<br>';
						//echo 'file_title = '.$file_title[$j].'<br>';
						$all_image_name[$j+1][4]=$file_title[$j];//檔案title(說明)
						/*if($deal_type=="add"){
							$all_image_name[$j+1][4]=$file_title[$j];//檔案title(說明)
						}*/
						
						//$all_image_name[$j+1][4]=$_REQUEST['image_property'][$j];//檔案屬性(說明)
				
			}
			else//如果不是圖片，提出警告
			{
				$no_image=1;
				////echo "不是圖片";
			}	
		}
		else//沒上傳檔案
		{
			////echo "沒上傳檔案";
						
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

//photo用
function photo_process($FILES_A, $file_title, $file_content, $file_name, $deal_type, $image_width, $image_height, $d_id, $database_connect2data, $connect2data){
	
	//echo "上傳物件數量 = ".count($FILES_A['name']);//上傳物件數量
	////echo count($_REQUEST[image_title]);//上傳物件的說明之數量
	//echo "imageH = ".$image_height."<br/>";
		$all_image_name = array();//建立回傳的資料陣列
		$no_image=0;
	
		//******如果是插入記錄的上傳圖片begin*******/
		if($deal_type=="add")
		{

			mysql_select_db($database_connect2data, $connect2data);
			
			$sql_max_pic= "Select MAX(file_id) From file_set";//找到圖片id的最大值，來當作下一個圖片的名稱
			////echo $sql_max_pic;
			$result_max_pic=mysql_query($sql_max_pic);
			
			if($row_max_pic = mysql_fetch_array($result_max_pic))
			{	
			
				$new_pic_num=$row_max_pic[0]+1;
		
				////echo $row_max_pic[0];
			}
			else
			{
				$new_pic_num=1;
				
			}
			////echo $new_pic_num;
			
			
		}
		//******如果是插入記錄的上傳圖片end*******/
		
		//******如果是更新記錄的上傳圖片begin*******/
		if($deal_type=="edit")
		{
			
			$new_pic_num=$_POST['file_id'];
				
			////echo $new_pic_num;
			
			
		}
		//******如果是更新記錄的上傳圖片end*******/
			
	/*for($j=0;$j<count($FILES_A['name']);$j++)
	{*/
		$tmp_name=$FILES_A['name'];

		//echo "tmpName ".$FILES_A['name'];
		
		if($tmp_name!='')//如果有上傳檔案
		{
		
			//******產生相對應的資料夾begin*******//
				$image_path="upload_image";
				check_path($image_path);//如果沒有資料夾，產生資料夾
				
				
				$image_path.="/".$file_name;
				//echo "image_path = ".$image_path."<br>";
				check_path($image_path);//如果沒有資料夾，產生資料夾
										
			//******產生相對應的資料夾end*******//

		
			////echo  $FILES_A['name']."<br>";
			$image_type=strtolower(end(explode(".", $FILES_A['name'])));//將檔案已"."分開，放到陣列呼叫array最後一個資料,為檔案副檔名
			//echo $image_type."<br>";//
			
			
			
			//確定檔案是圖片檔案
			if($image_type=="jpg" || $image_type=="gif" || $image_type=="bmp" || $image_type=="png" || $image_type=="tif")
			{
						
			            //$photo_name=$new_pic_num+$j;//將新id轉成檔案名，已上傳的數量來增加
			            $photo_name = md5($file_name.$new_pic_num.$tmp_name.time());
						////echo $photo_name."<br>";
						
						/*-------從檔案暫存區複製到指定的資料夾，並縮圖begin--------*/
						$FILES_A['name']=str_replace(" ","",$FILES_A['name']);//將檔案名內有空白的除掉
						
						$size=getimagesize($FILES_A['tmp_name']);
						////echo $size[0];//寬
						////echo $size[1];//長
						$orginal_width=$size[0];//寬
						$orginal_height=$size[1];//長
						
						if($image_width==0)//如果是0使用圖片原來的尺寸:注意、注意
						{
							$image_width=$orginal_width;
							$image_height=$orginal_height;
						}
						/*if($orginal_width<$image_width){
							$image_width=$orginal_width;
							$image_height=$orginal_height;
						}*/
						
						$image_path_new = "../".$image_path;
						$this_path1=$image_path."/".$file_name."_".$photo_name.".".$image_type;
						$this_image_path1 = "../".$this_path1;
						////echo $this_path1."<br>";
								
						//if(($orginal_width/$orginal_height)>($image_width/$image_height))//如果大於比例，以分子為主(在此為不改變圖片比例)
						/*if(($orginal_width/$orginal_height)>($image_width/$image_height))//如果大於比例，以分子為主(在此為不改變圖片比例)
						{
							$exec_str="convert -resize 9999x".$image_height." ".$_FILES[image][tmp_name]." ../".$this_path1;
							imagesResize($this_path1,$image_path,$destW,$destH);
						
						}else//如果小於比例，以分母為主
						{
							$exec_str="convert -resize ".$image_width."x9999 ".$_FILES[image][tmp_name]." ../".$this_path1;
							imagesResize($src,$src,$destW,$destH);
						}*/
						//exec($exec_str);
						//複製暫存檔
						copy($FILES_A['tmp_name'] , $this_image_path1 );
						/*if($orginal_width>$image_width){
							imagesResize($this_image_path1,$this_image_path1,$image_width,$image_height);
							//echo "orginal_width = ".$orginal_width;"<br>";
							//echo "orginal_height = ".$orginal_height;"<br>";
							//echo "image_width = ".$image_width;"<br>";
							//echo "image_height = ".$image_height;"<br>";
						}else if($orginal_height>$image_height){
							imagesResize($this_image_path1,$this_image_path1,$image_width,$image_height);
							//echo "orginal_width = ".$orginal_width;"<br>";
							//echo "orginal_height = ".$orginal_height;"<br>";
							//echo "image_width = ".$image_width;"<br>";
							//echo "image_height = ".$image_height;"<br>";
						}else{
							//imagesResize_3($this_image_path1,$this_image_path1,$orginal_width,$orginal_height);
							imagesResize($this_image_path1,$this_image_path1,$image_width,$image_height);
						}*/
						
						//imagesResize_4($this_image_path1,$this_image_path1,$image_width,$image_height);
						//取得檔案資訊
						$srcSize   = getimagesize($this_image_path1); 
						
						if($srcSize[0]>$image_width || $srcSize[1]>$image_height){
							imagesResize_8($this_image_path1,$this_image_path1,$image_width,$image_height);
						}
						/*$exec_str="convert ../".$this_path1." -quality 100% -gravity center -crop ".$image_width."x".$image_height."+0+0 +repage ../".$this_path1;//切圖
						exec($exec_str);*/
						//echo 'finish 1<br>';
						//取得檔案資訊
						/*
						* 這裡$srcSize為一個數組類型
						* $srcSize[0] 為圖像的寬度
						* $srcSize[1] 為圖像的高度
						* $srcSize[2] 為圖像的格式，包括jpg、gif和png等
						* $srcSize[3] 為圖像的寬度和高度，內容為 width="xxx" height="yyy"
						*/
			
						//判斷橫式或直式圖
						$format = 0;
						if( $srcSize[0] >= $srcSize[1] ){			//横式圖或正方形圖
							$format = 1;
						}elseif( $srcSize[0] < $srcSize[1] ){		//直式圖
							$format = 0;
						}
						
						
						//縮中圖detail用
						/*$this_path2=$image_path."/".$file_name."_".$photo_name."_m596.".$image_type;
						$this_image_path2 = "../".$this_path2;
						copy($FILES_A['tmp_name'] , $this_image_path2 );
						$destW = 596;
						$destH = 390;
						imagesResize_5($this_image_path2,$this_image_path2,$destW,$destH);*/
						
						
						//縮中圖index用
						/*$this_path2=$image_path."/".$file_name."_".$photo_name."_m272.".$image_type;
						$this_image_path2 = "../".$this_path2;
						copy($FILES_A['tmp_name'] , $this_image_path2 );
						$destW = 272;
						$destH = 130;
						imagesResize_5($this_image_path2,$this_image_path2,$destW,$destH);*/
						
						//縮小圖後台list用
						$this_path2=$image_path."/".$file_name."_".$photo_name."_s100.".$image_type;
						$this_image_path2 = "../".$this_path2;
						copy($FILES_A['tmp_name'] , $this_image_path2 );
						//$destW = 84;
						//$destH = 66;
						$destW = 210;
						$destH = 130;
						//imagesResize_2($this_image_path3,$this_image_path3,$destW,$destH);
						imagesResize_4($this_image_path2,$this_image_path2,$destW,$destH);

						//list-小圖
						$destW = 370;
						$destH = 245;
						$this_path3=$image_path."/".$file_name."_".$photo_name."_".intval($destW).'.'.$image_type;
						$this_image_path3 = "../".$this_path3;
						copy($FILES_A['tmp_name'] , $this_image_path3 );
						
						//imagesResize_2($this_image_path3,$this_image_path3,$destW,$destH);
						imagesResize_4($this_image_path3,$this_image_path3,$destW,$destH);

						//細節list-小圖
						$destW = 340;
						$destH = 225;
						$this_path4=$image_path."/".$file_name."_".$photo_name."_".intval($destW).'.'.$image_type;
						$this_image_path4 = "../".$this_path4;
						copy($FILES_A['tmp_name'] , $this_image_path4 );
						
						//imagesResize_2($this_image_path4,$this_image_path4,$destW,$destH);
						imagesResize_4($this_image_path4,$this_image_path4,$destW,$destH);
						
						
						/*-------從檔案暫存區複製到指定的資料夾，並縮圖end--------*/
						
						////echo $FILES_A['name'].":name<br>";
						////echo $_REQUEST[image_title].":title<br>";
						$db_file_name=$file_name."_".$photo_name.".".$image_type;//儲存到資料庫的檔案名稱
						
						$all_image_name[0]=$db_file_name;//儲存檔案名
						$all_image_name[1]=$this_path1;//大圖檔案位置						
						$all_image_name[2]=$this_path2;//小圖檔案位置後台list用//中圖檔案位置index用
						$all_image_name[3]=$this_path3;//list-小圖
						$all_image_name[6]=$this_path4;//細節list-小圖
						
						//$all_image_name[4]=$this_path4;//小圖檔案位置list用
						$all_image_name[5]=$format;//判斷橫式或直式圖
						//echo 'j = '.$j.'<br>';
						//echo 'file_title = '.$file_title.'<br>';$file_content
						//$all_image_name[4]=$file_title;//檔案title(說明)
						//$all_image_name[9]=$file_content;//檔案說明
						/*if($deal_type=="add"){
							$all_image_name[$j+1][4]=$file_title;//檔案title(說明)
						}*/
						
						//$all_image_name[$j+1][4]=$_REQUEST['image_property'];//檔案屬性(說明)

						//require_once('../Connections/connect2data.php');

						$insertSQL = sprintf("INSERT INTO file_set (file_name, file_link1, file_link2, file_link3, file_link4, file_type, file_d_id, file_show_type) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
	                       GetSQLValueString($all_image_name[0], "text"),
	                       GetSQLValueString($all_image_name[1], "text"),
	                       GetSQLValueString($all_image_name[2], "text"),
	                       GetSQLValueString($all_image_name[3], "text"),
	                       GetSQLValueString($all_image_name[6], "text"),
	                       GetSQLValueString("photoImage", "text"),
	                       GetSQLValueString($d_id, "int"),
	                       GetSQLValueString($all_image_name[5], "int"));

				          mysql_select_db($database_connect2data, $connect2data);
				          $Result1 = mysql_query($insertSQL, $connect2data) or die(mysql_error());
				        $_SESSION["change_image"]=1;
				
			}
			else//如果不是圖片，提出警告
			{
				$no_image=1;
				////echo "不是圖片";
			}	
		}
		else//沒上傳檔案
		{
			////echo "沒上傳檔案";
						
		}
		 
	/*}*/
	
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

//youtube用	
function reportImageProcess($file_name, $deal_type, $image_width, $image_height, $youtubeId){
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
		/*$tmp_name = "videos.jpg";
		$videoLink = "../upload_image/$tmp_name";*/
		
		//original image 
		//$img = "http://www.site.com/blah.gif"; 

		//directory to copy to (must be CHMOD to 777) 
		//$copydir = "/home/user/public_html/directory/"; 

		//$data = file_get_contents($thumbnailLink); 
		//$file = fopen($videoLink, "w+"); 
		//fputs($file, $data);  
		//fclose($file);
		
		/*if(function_exists('curl_init')){
			echo "have curl_init fun<br>";
		}else{
			echo "non curl_init fun<br>";
		}
		getimagesize($thumbnailLink);*/

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


	$tmp_name = "youtubeThumbnails.jpg";
	$videoLink = "../upload_image/$tmp_name";
	/*sddefault.jpg
	maxresdefault.jpg
	$thumbnailLink = "http://img.youtube.com/vi/".$youtubeId."/0.jpg";*/

	//連接youtube api，並取得該ID的資訊
	$data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?key=AIzaSyBXnABa4hiaHFK5m_Vm3Amb-Gen0syJ4Yw&part=snippet&id=$youtubeId");

	//將回傳資訊轉為array
	$json = json_decode($data, true);

	//var_dump($json->items[0]->snippet->thumbnails);
	//$data = $json->items[0]->snippet->thumbnails;
	//只取thumbnails資訊
	$data = $json['items'][0]['snippet']['thumbnails'];


	//如果有大圖就取大圖，圖片由大到小
	if(array_key_exists("maxres",$data)){

		$thumbnailLink = $data["maxres"]["url"];

	}elseif(array_key_exists("standard",$data)){

		$thumbnailLink = $data["standard"]["url"];

	}elseif(array_key_exists("high",$data)){

		$thumbnailLink = $data["high"]["url"];
		
	}elseif(array_key_exists("medium",$data)){

		$thumbnailLink = $data["medium"]["url"];
		
	}elseif(array_key_exists("default",$data)){

		$thumbnailLink = $data["default"]["url"];
		
	}

	//echo '<br>'.$thumbnailLink.'<br>';
	//目前只發現得用http，不能用https，會抓不到圖
	$thumbnailLink = str_replace("https://","http://",$thumbnailLink);
	//echo '<br>'.$thumbnailLink.'<br>';
	//Initialize the Curl session 
	$ch = curl_init();
	//Set curl to return the data instead of printing it to the browser. 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	//Set the URL 
	curl_setopt($ch, CURLOPT_URL, $thumbnailLink); 
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
	CURLOPT_URL => $thumbnailLink, 
	CURLOPT_HEADER => false 
	); 
	curl_setopt_array($ch, $options); */

	//curl_setopt($ch, CURLOPT_FILE, $fp);
	//curl_setopt($ch, CURLOPT_HEADER, false);
	//
	//curl_exec($ch); 
	//curl_close($ch); 
	//fclose($fp); 
		
		
		//copy($thumbnailLink, $videoLink);
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

						$photo_name = "thumbnail".md5($file_name.time());
						
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
						
						
						//縮小圖(後台)
						$this_path2=$image_path."/".$file_name."_".$photo_name."_s100.".$image_type;
						$this_image_path2 = "../".$this_path2;
						//copy($_FILES['image']['tmp_name'][$j] , $this_image_path2 );
						copy($videoLink , $this_image_path2 );
						//echo $this_path;
						//$exec_str="convert -resize 130x130 ".$_FILES[image][tmp_name][$j]." ../".$this_path2;
						
						$destW = 210;
						$destH = 130;
						reportImagesResize_4($this_image_path2,$this_image_path2,$destW,$destH);
						
						
						//縮小圖370*245(列-小圖)
						$destW = 370;
						$destH = 245;
						$this_path3=$image_path."/".$file_name."_".$photo_name."_$destW.".$image_type;
						$this_image_path3 = "../".$this_path3;
						//copy($_FILES['image']['tmp_name'][$j] , $this_image_path2 );
						copy($videoLink , $this_image_path3 );
						//echo $this_path;
						//$exec_str="convert -resize 130x130 ".$_FILES[image][tmp_name][$j]." ../".$this_path2;						
						reportImagesResize_4($this_image_path3,$this_image_path3,$destW,$destH);


						
						/*-------從檔案暫存區複製到指定的資料夾，並縮圖end--------*/
						
						//echo $_FILES[image][name][$j].":name<br>";
						//echo $_REQUEST[image_title][$j].":title<br>";
						$db_file_name=$file_name."_".$photo_name.".".$image_type;//儲存到資料庫的檔案名稱
						
						$all_image_name[1][0]=$db_file_name;//儲存檔案名
						$all_image_name[1][1]=$this_path1;//大圖檔案位置
						$all_image_name[1][2]=$this_path2;//縮小圖(後台)
						$all_image_name[1][3]=$this_path3;//縮小圖284*188(列-小圖)
						//$all_image_name[1][4]=$this_path4;//410*273(大圖-藝)
						//$all_image_name[1][5]=$this_path5;//132*88(大圖-藝)
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

//ini_set("memory_limit","100M");
//依設定尺寸裁切(判斷橫式或直式圖)-
//橫式:W是否大於設定W，如果有則依設定W按比例縮小，縮小後比對H是否大於設定H，如果有則依設定H按比例縮小
//直式:H是否大於設定H，如果有則依設定H按比例縮小，縮小後比對W是否大於設定W，如果有則依設定W按比例縮小
function imagesResize($src,$dest,$destW,$destH) { 
	if (file_exists($src)  && isset($dest)) { 
		//取得檔案資訊
		$srcSize   = getimagesize($src); 
		/*
		* 這裡$srcSize為一個數組類型
		* $srcSize[0] 為圖像的寬度
		* $srcSize[1] 為圖像的高度
		* $srcSize[2] 為圖像的格式，包括jpg、gif和png等 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(orden de bytes intel), 8 = TIFF(orden de bytes motorola), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM. 
		* $srcSize[3] 為圖像的寬度和高度，內容為 width="xxx" height="yyy"
		*/
		
		//判斷橫式或直式圖
		$format = 0;
		if( $srcSize[0] >= $srcSize[1] ){			//横式圖或正方形圖
			$format = 1;
		}elseif( $srcSize[0] < $srcSize[1] ){		//直式圖
			$format = 0;
		}
		
		if($format){
			
			//依width為主 W /H
			$srcRatio  = $srcSize[0] / $srcSize[1];
		
			//echo "横式圖或正方形圖<br>";
			if( ($srcSize[0]>$destW) && ($srcSize[1]>$destH) ){
				
				//echo "W > , H > | ";
				
				//依長寬比判斷長寬像素			
				$destH_2 = $destW / $srcRatio;
				$destRatio = $srcSize[0] / $destW;
				////echo "destW = ".$destW."<br/>";
				////echo "destH = ".$destH."<br/>";
				//echo "destH_2 = ".$destH_2."<br/>";	
				if($destH_2>$destH){
					//依hight為主 H/W
					$srcRatio  = $srcSize[1] / $srcSize[0];
					$destW_2 = $destH / $srcRatio;
					$destRatio = $srcSize[1] / $destH;
					$destW = $destW_2;
					//$destH = $destH_2;
					//echo "大於<br/>";
					//$disX = ($destW_2 - $destW)/2;
					//$disY = ($destH - $destH)/2;
				}else{
					$destH = $destH_2;
					//echo "小於<br/>";
					//$disX = ($destW - $destW)/2;
					//$disY = ($destH_2 - $destH)/2;
				}
				
				$srcW = $destW*$destRatio;
				$srcH = $destH*$destRatio;
				$srcX = abs(($srcSize[0] - $srcW))/2;
				$srcY = abs(($srcSize[1] - $srcH))/2;
				
			}elseif( ($srcSize[0]>$destW) && ($srcSize[1]<=$destH) ){
				
				//echo "W > , H <= | ";
				//依長寬比判斷長寬像素			
				$destH = $destW / $srcRatio;
				$destRatio = $srcSize[0] / $destW;
				
				$srcW = $destW*$destRatio;
				$srcH = $destH*$destRatio;
				$srcX = abs(($srcSize[0] - $srcW))/2;
				$srcY = abs(($srcSize[1] - $srcH))/2;
				
			}elseif( ($srcSize[0]<=$destW) && ($srcSize[1]>$destH) ){
				
				//echo "W <= , H > | ";
				$srcRatio  = $srcSize[1] / $srcSize[0];
				$destW_2 = $destH / $srcRatio;
				$destRatio = $srcSize[1] / $destH;
				$destW = $destW_2;
				
				$srcW = $destW*$destRatio;
				$srcH = $destH*$destRatio;
				$srcX = abs(($srcSize[0] - $srcW))/2;
				$srcY = abs(($srcSize[1] - $srcH))/2;
				
			}elseif( ($srcSize[0]<=$destW) && ($srcSize[1]<=$destH) ){
				
				//echo "W <= , H <= | ";
				//$srcRatio = $destRatio = $srcSize[1] / $srcSize[0];
				$destW = $srcSize[0];
				$destH = $srcSize[1];
				
				$srcW = $destW;
				$srcH = $destH;
				$srcX = 0;
				$srcY = 0;
				
			}
		
		}else{
			
			//echo "直式圖<br>";
			//依hight為主 H/W
			$srcRatio  = $srcSize[1] / $srcSize[0];
			$destW = $destH;
			
			if( ($srcSize[1]>$destH) && ($srcSize[0]>$destW) ){
				
				$destW_2 = $destH / $srcRatio;
				$destRatio = $srcSize[1] / $destH;	
				$destW = $destW_2;
				
				$srcW = $destW*$destRatio;
				$srcH = $destH*$destRatio;
				$srcX = abs(($srcSize[0] - $srcW))/2;
				$srcY = abs(($srcSize[1] - $srcH))/2;		
				
			}elseif( ($srcSize[1]>$destH) && ($srcSize[0]<=$destW) ){
				
				$destW_2 = $destH / $srcRatio;
				$destRatio = $srcSize[1] / $destH;	
				$destW = $destW_2;
				
				$srcW = $destW*$destRatio;
				$srcH = $destH*$destRatio;
				$srcX = abs(($srcSize[0] - $srcW))/2;
				$srcY = abs(($srcSize[1] - $srcH))/2;	
				
			}if( ($srcSize[1]<=$destH) && ($srcSize[0]<=$destW) ){
				
				//$srcRatio = $destRatio = $srcSize[1] / $srcSize[0];
				$destW = $srcSize[0];
				$destH = $srcSize[1];
				
				$srcW = $destW;
				$srcH = $destH;
				$srcX = 0;
				$srcY = 0;
				
			}
			
		}

		$srcExtension = $srcSize[2];	//格式
		
		/*$srcRatio  = $srcSize[0] / $srcSize[1]; //依width為主 W /H
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
			
			////echo "大於<br/>";
			//$disX = ($destW_2 - $destW)/2;
			//$disY = ($destH - $destH)/2;
		}else{
			//$destH = $destH_2;
			////echo "小於<br/>";
			//$disX = ($destW - $destW)/2;
			//$disY = ($destH_2 - $destH)/2;
		}*/					
			
		//$srcX = $destW - $disX;
		//$srcY = $destH - $disY;
		//$srcX = ($destW*$srcRatio_B)/2;
		//$srcY = ($destH*$srcRatio_B)/2;
		
		/*$srcW = $destW*$destRatio;
		$srcH = $destH*$destRatio;
		$srcX = abs(($srcSize[0] - $srcW))/2;
		$srcY = abs(($srcSize[1] - $srcH))/2;*/
	} 
	//echo "<br/>srcRatio = $srcRatio<br/>";
	//echo "destRatio = $destRatio<br>";
	//echo "destW = ".$destW."<br/>";
	//echo "destH = ".$destH."<br/>";
	/*echo "srcW = ".$srcW."<br/>";
	echo "srcH = ".$srcH."<br/>";
	echo "srcX = ".$srcX."<br/>";
	echo "srcY = ".$srcY."<br/><br/>";*/
	//建立影像 
	$destImage = imagecreatetruecolor($destW,$destH);
	////echo "destImage = ".$destImage."<br/>";
	//根據檔案格式讀取圖檔 
	switch ($srcExtension) { 
		case 1: $srcImage = imagecreatefromgif($src); break; 
		case 2: $srcImage = imagecreatefromjpeg($src); break; 
		case 3: $srcImage = imagecreatefrompng($src); break;
	}
	//echo "srcExtension = ".$srcExtension."<br/>";
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

//縮小圖專用,依設定尺寸
function imagesResize_4($src,$dest,$destW,$destH) { 
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

//依寬按比例縮小，如高超過則會裁切高
function imagesResize_8($src,$dest,$destW,$destH) { 
	if (file_exists($src)  && isset($dest)) { 
		//取得檔案資訊
		$srcSize   = getimagesize($src); 
		/*
		* 這裡$srcSize為一個數組類型
		* $srcSize[0] 為圖像的寬度
		* $srcSize[1] 為圖像的高度
		* $srcSize[2] 為圖像的格式，包括jpg、gif和png等 1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(orden de bytes intel), 8 = TIFF(orden de bytes motorola), 9 = JPC, 10 = JP2, 11 = JPX, 12 = JB2, 13 = SWC, 14 = IFF, 15 = WBMP, 16 = XBM. 
		* $srcSize[3] 為圖像的寬度和高度，內容為 width="xxx" height="yyy"
		*/
		
		//判斷橫式或直式圖
		$format = 1;
		if( $srcSize[0] >= $srcSize[1] ){			//横式圖或正方形圖
			$format = 1;
		}elseif( $srcSize[0] < $srcSize[1] ){		//直式圖
			$format = 0;
		}

		if($format==1){	//橫或正方

			if($srcSize[0] > $destW){	//原圖W是否大於目標W
				//按比例縮小

				//原圖WH比例
				$srcRatio  = $srcSize[0] / $srcSize[1];

				//目標W按原圖WH比，算出縮小後的H
				$destH_2 = $destW / $srcRatio;

				//原圖W與目標W的比例
				$destRatio = $srcSize[0] / $destW;

				//改變目標H，因橫或正方圖縮小後，H不會超出目標H
				$destH = $destH_2;
				
				//原圖WH，其實這裡不用計算
				$srcW = $destW*$destRatio;				//$srcSize[0]
				$srcH = $destH*$destRatio;				//$srcSize[1]

				//原圖開始點的XY座標，其實這裡為0
				$srcX = abs(($srcSize[0] - $srcW))/2;
				$srcY = abs(($srcSize[1] - $srcH))/2;

				//imagecopyresampled( 輸出目標檔案, 來源檔案, 目標檔案開始點的x座標, 目標檔案開始點的y座標, 來源檔案開始點的x座標, 來源檔案開始點的y座標, 目標檔案的長度, 目標檔案的高度, 來源檔案的長度, 來源檔案的高度)
				//imagecopyresampled($destImage, $srcImage, 0, 0, $srcX, $srcY, $destW, $destH, $srcW, $srcH); 

			}else{
				//不改變圖片

				$destW = $srcSize[0];
				$destH = $srcSize[1];
				
				$srcW = $destW;
				$srcH = $destH;
				$srcX = 0;
				$srcY = 0;
			}

		}else{	//直式

			if($srcSize[0] > $destW){	//原圖W是否大於目標W
				//W大於目標W，所以按比例縮小後，需再比對H是否有大於目標H

				//原圖WH比例
				$srcRatio  = $srcSize[0] / $srcSize[1];

				//目標W按原圖WH比，算出縮小後的H
				$destH_2 = $destW / $srcRatio;

				//原圖W與目標W的比例
				$destRatio = $srcSize[0] / $destW;

				if($destH_2 > $destH){	//縮小後的H大於目標H，則需切H
					//原圖WH，其實這裡不用計算
					$srcW = $destW*$destRatio;				//$srcSize[0]
					$srcH = $destH*$destRatio;				//$srcSize[1]

					//原圖開始點的XY座標，其實這裡為0
					$srcX = abs(($srcSize[0] - $srcW))/2;
					$srcY = abs(($srcSize[1] - $srcH ))/2;
				}else{	//縮小後的H小於等於目標H，則不再改變

					//縮小後的H小於等於目標H，則把目標H改為按比例縮小的H
					$destH = $destH_2;

					//原圖WH，其實這裡不用計算
					$srcW = $destW*$destRatio;				//$srcSize[0]
					$srcH = $destH*$destRatio;				//$srcSize[1]

					//原圖開始點的XY座標，其實這裡為0
					$srcX = 0;
					$srcY = 0;
				}

				//imagecopyresampled( 輸出目標檔案, 來源檔案, 目標檔案開始點的x座標, 目標檔案開始點的y座標, 來源檔案開始點的x座標, 來源檔案開始點的y座標, 目標檔案的長度, 目標檔案的高度, 來源檔案的長度, 來源檔案的高度)
				//imagecopyresampled($destImage, $srcImage, 0, 0, $srcX, $srcY, $destW, $destH, $srcW, $srcH); 

			}else{	//原圖W小於目標W

				if($srcSize[1] > $destH){	//原圖H大於目標H
					//原圖WH比例
					$srcRatio  = $srcSize[0] / $srcSize[1];

					//目標W按原圖WH比，算出縮小後的H
					$destH_2 = $destW / $srcRatio;

					//原圖W與目標W的比例
					$destRatio = $srcSize[0] / $destW;

					//原圖WH，其實這裡不用計算
					$srcW = $destW*$destRatio;				//$srcSize[0]
					$srcH = $destH*$destRatio;				//$srcSize[1]

					//原圖開始點的XY座標，其實這裡為0
					$srcX = abs(($srcSize[0] - $srcW))/2;
					$srcY = abs(($srcSize[1] - $srcH ))/2;

				}else{	//原圖H小於等於目標H
					//不改變圖片

					$destW = $srcSize[0];
					$destH = $srcSize[1];
					
					$srcW = $destW;
					$srcH = $destH;
					$srcX = 0;
					$srcY = 0;
				}
			}
		}

		$srcExtension = $srcSize[2];	//格式


		//echo "<br/>srcRatio = $srcRatio<br/>";
		//echo "destRatio = $destRatio<br>";
		//echo "destW = ".$destW."<br/>";
		//echo "destH = ".$destH."<br/>";
		/*echo "srcW = ".$srcW."<br/>";
		echo "srcH = ".$srcH."<br/>";
		echo "srcX = ".$srcX."<br/>";
		echo "srcY = ".$srcY."<br/><br/>";*/
		//建立影像 
		$destImage = imagecreatetruecolor($destW,$destH);
		////echo "destImage = ".$destImage."<br/>";
		//根據檔案格式讀取圖檔 
		switch ($srcExtension) { 
			case 1: $srcImage = imagecreatefromgif($src); break; 
			case 2: $srcImage = imagecreatefromjpeg($src); break; 
			case 3: $srcImage = imagecreatefrompng($src); break;
		}
		//echo "srcExtension = ".$srcExtension."<br/>";
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
		} 	

		//釋放資源
		imagedestroy($destImage);	
		
	} 
		
}

//--------------------------------youtube用-------------------------------
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
//--------------------------------youtube用-------------------------------
?>

