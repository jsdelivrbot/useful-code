<?php require_once '../Connections/connect2data.php';?>
<?php require_once 'photo_process.php';?>
<?php require_once 'imagesSize.php';?>

<?php

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

    if (isset($_POST["dataId"]) && $_POST["dataId"] != "") {
    	echo '123123';
        // $image_result = photo_process($_FILES['file'], "", "", "mediaPhoto", "add", $IWidth, $IHeight, $_POST["dataId"], $con);


    }
}
?>