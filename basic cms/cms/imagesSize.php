<?php
include '../Connections/ini_set.php';

$uploadFileSize = "每次上傳之檔案大小總計請勿超過" . ini_get("upload_max_filesize") . "。";
$maxFileSize = "<br />$uploadFileSize";

$imagesSize = [
    "news" => [
        'IW' => 800,
        'IH' => 530,
        'note' => "圖片請上傳寬 800pixel、高 530pixel之圖檔。 $maxFileSize",
    ],
    "newsCover" => [
        'IW' => 300,
        'IH' => 195,
        'note' => "圖片請上傳寬 300pixel、高 195pixel之圖檔。 $maxFileSize",
    ],
    "store" => [
        'IW' => 800,
        'IH' => 530,
        'note' => "圖片請上傳寬 800pixel、高 530pixel之圖檔。 $maxFileSize",
    ],
    "storeCover" => [
        'IW' => 300,
        'IH' => 195,
        'note' => "圖片請上傳寬 300pixel、高 195pixel之圖檔。 $maxFileSize",
    ],
];
?>