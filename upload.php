<!-- referance -->
http://jerry17768java.blogspot.tw/2014/08/jquery.html


<!-- upload.php -->
<?php
$output_dir = "uploads/";
if(isset($_FILES["myfile"]))
{
	$ret = array();

	//判斷是單一或多個檔案上傳
	if(!is_array($_FILES["myfile"]["name"])) //單一檔案
	{
		$fileName = $_FILES["myfile"]["name"];
		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$fileName);
		$ret[]= $fileName;
	}
	else  //多個檔案
	{
		$fileCount = count($_FILES["myfile"]["name"]);
		for($i=0; $i < $fileCount; $i++)
		{
			$fileName = $_FILES["myfile"]["name"][$i];
			move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
			$ret[]= $fileName;
		}

	}
	echo json_encode($ret);
}
?>



<script src="js/upload.js"></script>

<span id="fileuploader">選擇檔案</span>

<script>
	$("#fileuploader").uploadFile({
		url:"upload.php",
		fileName:"myfile"
	});
</script>


<!-- 需自訂css -->
<style>
	.ajax-upload-dragdrop{
		width: initial;
		display: inline-block;
		padding: 7px 18px;
		border-radius: 11px;
		background-color: #717071;
		color: #EEEFEF;
		position: relative;
		top: -5px;
		cursor: pointer;
		&:hover{
			color: #EEEFEF - 100;
			background-color: #717071 + 100;
		}
	}
	.ajax-file-upload-statusbar{
		margin-top: 9px;
		div{
			display: inline-block;
			.mr(30px);
		}
	}
</style>