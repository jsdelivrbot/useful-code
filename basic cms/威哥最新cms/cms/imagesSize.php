<?php 
$maxFileSize = "<br />上傳之檔案大小總計請勿超過".ini_get("upload_max_filesize")."。";


$imagesSize = array(
					"banners"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 720,
									'note'	=> "圖片請上傳寬 1920pixel、高 720pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"bannersMobile"	=>	array(
									'IW'	=> 824,
									'IH'	=> 972,
									'note'	=> "圖片請上傳寬 824pixel、高 972pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"articleTBanner"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 503,
									'note'	=> "圖片請上傳寬 1920pixel、高 503pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"articleTContentBanner"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 720,
									'note'	=> "圖片請上傳寬 1920pixel、高 720pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"author"	=>	array(
									'IW'	=> 264,
									'IH'	=> 264,
									'note'	=> "圖片請上傳寬 264pixel、高 264pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"authorBanner"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 503,
									'note'	=> "圖片請上傳寬 1920pixel、高 503pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"articleListCover"	=>	array(
									'IW'	=> 1024,
									'IH'	=> 683,
									'note'	=> "圖片請上傳寬 1024pixel、高 683pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"articleCover"	=>	array(
									'IW'	=> 962,
									'IH'	=> 644,
									'note'	=> "圖片請上傳寬 962pixel、高 644pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"articleCoverMobile"	=>	array(
									'IW'	=> 1025,
									'IH'	=> 1334,
									'note'	=> "圖片請上傳寬 1025pixel、高 1334pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"aboutBanner"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 503,
									'note'	=> "圖片請上傳寬 1920pixel、高 503pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"clauseBanner"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 503,
									'note'	=> "圖片請上傳寬 1920pixel、高 503pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),

					"weneeduTopBanner"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 503,
									'note'	=> "圖片請上傳寬 1920pixel、高 503pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					
					"weneeduBottomBanner"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 380,
									'note'	=> "圖片請上傳寬 1920pixel、高 380pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"weneedu"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 629,
									'note'	=> "圖片請上傳寬 1920pixel、高 629pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"weneeduMobile"	=>	array(
									'IW'	=> 1025,
									'IH'	=> 1249,
									'note'	=> "圖片請上傳寬 1025pixel、高 1249pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"partner"	=>	array(
									'IW'	=> 300,
									'IH'	=> 250,
									'note'	=> "圖片請上傳寬小於 300pixel、高小於 250pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"indexVideo"	=>	array(
									'IW'	=> 1280,
									'IH'	=> 486,
									'note'	=> "圖片請上傳寬 1280pixel、高 486pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"indexVideoMobile"	=>	array(
									'IW'	=> 1025,
									'IH'	=> 653,
									'note'	=> "圖片請上傳寬 1025pixel、高 653pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),

					"eventsBanner"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 503,
									'note'	=> "圖片請上傳寬 1920pixel、高 503pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),

					"events"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 500,
									'note'	=> "圖片請上傳寬 1920pixel、高 500pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"eventsPoster"	=>	array(
									'IW'	=> 1025,
									'IH'	=> 1683,
									'note'	=> "圖片請上傳寬 1025pixel、高 1683pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"eventsPosterMobile"	=>	array(
									'IW'	=> 1920,
									'IH'	=> 723,
									'note'	=> "圖片請上傳寬 1920pixel、高 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),

					"main"	=>	array(
									'IW'	=> 1142,
									'IH'	=> 575,
									'note'	=> "圖片請上傳寬 1142pixel、高 575pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"mainMobile"	=>	array(
									'IW'	=> 828,
									'IH'	=> 496,
									'note'	=> "圖片請上傳寬 828pixel、高 496pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"origin"		=>	array(
									'IW'	=> 723,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"spirit"		=>	array(
									'IW'	=> 723,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"nomination"	=>	array(
									'IW'	=> 723,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"award"	=>	array(
									'IW'	=> 723,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"design"	=>	array(
									'IW'	=> 723,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"medal"	=>	array(
									'IW'	=> 723,
									'IH'	=> 1100,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"diploma"	=>	array(
									'IW'	=> 723,
									'IH'	=> 1100,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"gallery"	=>	array(
									'IW'	=> 561,
									'IH'	=> 312,
									'note'	=> "圖片請上傳寬 561pixel、高 312pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"owner"	=>	array(
									'IW'	=> 723,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"week"	=>	array(
									'IW'	=> 723,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"event"		=>	array(
									'IW'	=> 723,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),	
					"publications"	=>	array(
									'IW'	=> 310,
									'IH'	=> 260,
									'note'	=> "圖片請上傳寬 310pixel、高 260pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),	
					"founder"		=>	array(
									'IW'	=> 723,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"media"		=>	array(
									'IW'	=> 723,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 723pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"mediaVideo"		=>	array(
									'IW'	=> 370,
									'IH'	=> 245,
									'note'	=> "圖片請上傳寬 370pixel、高 245pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"mediaPhoto"		=>	array(
									'IW'	=> 712,
									'IH'	=> 472,
									'note'	=> "圖片請上傳寬 712pixel、高 472pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),	

					"releases"		=>	array(
									'IW'	=> 382,
									'IH'	=> 999,
									'note'	=> "圖片請上傳寬 382pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"video"		=>	array(
									'IW'	=> 680,
									'IH'	=> 402,
									'note'	=> "圖片請上傳寬 680pixel、高 402pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"blabla"		=>	array(
									'IW'	=> 420,
									'IH'	=> 278,
									'note'	=> "圖片請上傳寬 420pixel、高 278pixel、解析度 72dpi 之圖檔。 $maxFileSize"
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
					"other"		=>	array(
									'IW'	=> 700,
									'IH'	=> 800,
									'note'	=> "圖片請上傳寬不大於700 pixel 72dpi之圖檔。 $maxFileSize"
									),
					"epaperShort1"	=>	array(
									'IW'	=> 373,
									'IH'	=> 282,
									'note'	=> "圖片請上傳寬 373pixel、高 282pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"epaperShort2"	=>	array(
									'IW'	=> 369,
									'IH'	=> 279,
									'note'	=> "圖片請上傳寬 369pixel、高 279pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									),
					"epaperLong1"	=>	array(
									'IW'	=> 794,
									'IH'	=> 285,
									'note'	=> "圖片請上傳寬 794pixel、高 285pixel、解析度 72dpi 之圖檔。 $maxFileSize"
									)

					);					
?>