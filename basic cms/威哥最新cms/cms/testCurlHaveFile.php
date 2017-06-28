<?php
$youtubeId = "jAlWCr5cIjE";
$thumbnailLink = "http://img.youtube.com/vi/".$youtubeId."/0.jpg";
//$thumbnailLink2 = "http://img.youtube.com/vi/".$youtubeId."/5.jpg";

/*if(file_exists($thumbnailLink)){
	echo "YES";
}else{
	echo "NO";
}*/
//echo $thumbnailLink2.'<br>';


//echo "<br>";

$data = file_get_contents("https://www.googleapis.com/youtube/v3/videos?key=AIzaSyBXnABa4hiaHFK5m_Vm3Amb-Gen0syJ4Yw&part=snippet&id=$youtubeId");
$json = json_decode($data, true);

//var_dump($json->items[0]->snippet->thumbnails);
//$data = $json->items[0]->snippet->thumbnails;

var_dump($json);

$data = $json['items'][0]['snippet']['thumbnails'];


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
//echo $thumbnailLink.'<br>';
//var_dump($json);
//$data = (array) $data;
//echo array_search("maxres",$data);
//var_dump($data).'<br>';
//echo count($data);

//echo (array_key_exists("maxres",$data))
/*echo "<br>".$data->maxres->url."<br>";
echo isset($data->maxres)."<br>";
echo isset($data->maxres2)."<br>";
echo count($data->maxres)."<br>";*/
/*foreach($data as $key=>$value){
  var_dump($value);
}*/

echo '<br>'.$thumbnailLink.'<br>';

$thumbnailLink = str_replace("https://","http://",$thumbnailLink);
echo '<br>'.$thumbnailLink.'<br>';

$tmp_name = "youtubeThumbnails2.jpg";
$videoLink = "../upload_image/$tmp_name";

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
?>