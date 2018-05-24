<?php
include '../Connections/ini_set.php';

$uploadFileSize = "每次上傳之檔案大小總計請勿超過".ini_get("upload_max_filesize")."。";
$maxFileSize = "<br />$uploadFileSize";

$imagesSize = array(
	"banners"	=>	array(
		'IW'	=> 1920,
		'IH'	=> 800,
		'note'	=> "圖片請上傳寬 1920pixel、高 800pixel之圖檔。 $maxFileSize"
		),
	"farmer"	=>	array(
		'IW'	=> 700,
		'IH'	=> 800,
		'note'	=> "圖片請上傳寬不大於716 pixel 72dpi之圖檔。 $maxFileSize"
		),
	"news"	=>	array(
		'IW'	=> 800,
		'IH'	=> 530,
		'note'	=> "圖片請上傳寬 800pixel、高 530pixel之圖檔。 $maxFileSize"
		),
	"newsCover"	=>	array(
		'IW'	=> 300,
		'IH'	=> 195,
		'note'	=> "圖片請上傳寬 300pixel、高 195pixel之圖檔。 $maxFileSize"
		),
	"store"	=>	array(
		'IW'	=> 800,
		'IH'	=> 530,
		'note'	=> "圖片請上傳寬 800pixel、高 530pixel之圖檔。 $maxFileSize"
		),
	"storeCover"	=>	array(
		'IW'	=> 300,
		'IH'	=> 195,
		'note'	=> "圖片請上傳寬 300pixel、高 195pixel之圖檔。 $maxFileSize"
		),
	"media"	=>	array(
		'IW'	=> 800,
		'IH'	=> 530,
		'note'	=> "圖片請上傳寬 800pixel、高 530pixel之圖檔。 $maxFileSize"
		),
	"mediaCover"	=>	array(
		'IW'	=> 300,
		'IH'	=> 195,
		'note'	=> "圖片請上傳寬 300pixel、高 195pixel之圖檔。 $maxFileSize"
		),
	"other"		=>	array(
		'IW'	=> 700,
		'IH'	=> 800,
		'note'	=> "圖片請上傳寬不大於700 pixel 72dpi之圖檔。 $maxFileSize"
		)
	);
?>