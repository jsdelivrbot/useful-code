<?php
 require_once('../Connections/connect2data.php');
 	
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
							if($orginal_width>1000){
							$image_width=1000;
							$image_height=$orginal_height*(1000/$orginal_width);
							}else{
							$image_width=$orginal_width;
							$image_height=$orginal_height;
							}
							
						}
						
						$this_path1=$image_path."/".$file_name."_".$photo_name.".".$image_type;
						//echo $this_path1."<br>";
								
						//if(($orginal_width/$orginal_height)>($image_width/$image_height))//如果大於比例，以分子為主(在此為不改變圖片比例)
						if(($orginal_width/$orginal_height)>($image_width/$image_height))//如果大於比例，以分子為主(在此為不改變圖片比例)
						{
							$exec_str="convert -resize 9999x".$image_height." ".$_FILES[image][tmp_name][$j]." ../".$this_path1;
						
						}else//如果小於比例，以分母為主
						{
							$exec_str="convert -resize ".$image_width."x9999 ".$_FILES[image][tmp_name][$j]." ../".$this_path1;
						}
						exec($exec_str);
						$exec_str="convert ../".$this_path1." -quality 80% -gravity center -crop ".$image_width."x".$image_height."+0+0 +repage ../".$this_path1;//切圖
						exec($exec_str);
						
						
						//縮小圖
						$this_path2=$image_path."/s_".$file_name."_".$photo_name.".".$image_type;
						//echo $this_path;
						//$exec_str="convert -resize 130x130 ".$_FILES[image][tmp_name][$j]." ../".$this_path2;
						$exec_str="convert -resize 190x150 ".$_FILES[image][tmp_name][$j]." ../".$this_path2;
						exec($exec_str);
						$exec_str="convert ../".$this_path2." -quality 80% -gravity center -crop 190x150+0+0 +repage ../".$this_path2;//切圖
						//$exec_str="convert ../".$this_path1." -quality 80% -gravity center -crop ".$image_width."x".$image_height."+0+0 +repage ../".$this_path1;//切圖
						exec($exec_str);
						/*-------從檔案暫存區複製到指定的資料夾，並縮圖end--------*/
						
						//echo $_FILES[image][name][$j].":name<br>";
						//echo $_REQUEST[image_title][$j].":title<br>";
						$db_file_name=$file_name."_".$photo_name.".".$image_type;//儲存到資料庫的檔案名稱
						
						$all_image_name[$j+1][0]=$db_file_name;//儲存檔案名
						$all_image_name[$j+1][1]=$this_path1;//大圖檔案位置
						$all_image_name[$j+1][2]=$this_path2;//小圖檔案位置
						$all_image_name[$j+1][3]=$_REQUEST[image_title][$j];//檔案title(說明)
				
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


	
?>

