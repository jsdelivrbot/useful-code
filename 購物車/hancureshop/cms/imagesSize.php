<?php 
$maxFileSize = "<br />上傳之檔案大小總計請勿超過".ini_get("upload_max_filesize")."。";


$imagesSize = array(
					"banners"	=>	array(
									'IW'	=> 1921,
									'IH'	=> 983,
									'note'	=> "圖片請上傳寬 1921pixel、高 983pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),					
					"about"		=>	array(
									'IW'	=> 750,
									'IH'	=> 532,
									'note'	=> "圖片請上傳寬 750pixel、高 532pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),						
					"news"		=>	array(
									'IW'	=> 805,
									'IH'	=> 480,
									'note'	=> "圖片請上傳寬 805pixel、高 480pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),	
									
					"products"	=>	array(
									'IW'	=> 465,
									'IH'	=> 335,
									'note'	=> "圖片請上傳寬 465pixel、高 335pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),

					"contact"		=>	array(
									'IW'	=> 406,
									'IH'	=> 52,
									'note'	=> "圖片請上傳寬 406pixel、高 52pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),				
					"shopProcess"		=>	array(
									'IW'	=> 700,
									'IH'	=> 800,
									'note'	=> "圖片請上傳寬不大於700 pixel 72dpi之圖檔。 $maxFileSize"
									),
					"activity"		=>	array(
									'IW'	=> 700,
									'IH'	=> 800,
									'note'	=> "圖片請上傳寬不大於700 pixel 72dpi之圖檔。 $maxFileSize"
									),
					"location"		=>	array(
									'IW'	=> 700,
									'IH'	=> 800,
									'note'	=> "圖片請上傳寬不大於700 pixel 72dpi之圖檔。 $maxFileSize"
									),
					"report"		=>	array(
									'IW'	=> 700,
									'IH'	=> 800,
									'note'	=> "圖片請上傳寬不大於700 pixel 72dpi之圖檔。 $maxFileSize"
									),
									
					"farmer"	=>	array(
									'IW'	=> 700,
									'IH'	=> 800,
									'note'	=> "圖片請上傳寬不大於716 pixel 72dpi之圖檔。 $maxFileSize"
									),
					"other"		=>	array(
									'IW'	=> 700,
									'IH'	=> 800,
									'note'	=> "圖片請上傳寬不大於700 pixel 72dpi之圖檔。 $maxFileSize"
									)
					);					
?>