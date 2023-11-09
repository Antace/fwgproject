<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}

	$po_id = mysqli_real_escape_string($con,$_POST["po_id"]);
	$po_name = mysqli_real_escape_string($con,$_POST["po_name"]);
	$cb_name = mysqli_real_escape_string($con,$_POST["cb_name"]);
	$cb_date = mysqli_real_escape_string($con,$_POST["cb_date"]);
	$insurance_price = mysqli_real_escape_string($con,$_POST["insurance_price"]);
	$cb_file2 = mysqli_real_escape_string($con,$_POST["cb_file2"]);
	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$prodcut_img = (isset($_POST['cb_file']) ? $_POST['cb_file'] : '');
	$upload=$_FILES['cb_file']['name'];
	$type = strrchr($_FILES['cb_file']['name'],".");
	
	
	if($type=='.pdf'){
		if($upload !='') { 
		$path="../cb_file/";
		$type = strrchr($_FILES['cb_file']['name'],".");
		$fileNewName =$numrand.$date1.$type;
		$path_copy=$path.$fileNewName;
		$path_link="../cb_file/".$fileNewName;
		move_uploaded_file($_FILES['cb_file']['tmp_name'],$path_copy); 
		}
	}elseif(isset($_POST["submit"]) && !$_FILES['cb_file']['error']) {
	$file = $_FILES['cb_file']['tmp_name']; 
	$sourceProperties = getimagesize($file);
	$type = strrchr($_FILES['cb_file']['name'],".");
	$fileNewName = time().$type;
	$folderPath = "../cb_file/";
	$ext = pathinfo($_FILES['cb_file']['name'], PATHINFO_EXTENSION);
	$imageType = $sourceProperties[2];

	switch ($imageType) {

		case IMAGETYPE_PNG:
			$imageResourceId = imagecreatefrompng($file); 
			$targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
			imagepng($targetLayer,$folderPath. $fileNewName);
			break;

		case IMAGETYPE_GIF:
			$imageResourceId = imagecreatefromgif($file); 
			$targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
			imagegif($targetLayer,$folderPath. $fileNewName);
			break;

		case IMAGETYPE_JPEG:
			$imageResourceId = imagecreatefromjpeg($file); 
			$targetLayer = imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
			imagejpeg($targetLayer,$folderPath. $fileNewName);
			break;

		default:
			echo "Invalid Image type.";
			exit;
			break;
	}
	// move_uploaded_file($file, $folderPath. $fileNewName. "_origin.". $ext);
} else {
	$fileNewName=$cb_file2;
}
function imageResize($imageResourceId,$width,$height) {
	$targetWidth = $width < 1280 ? $width : 1280 ;
	$targetHeight = ($height/$width)* $targetWidth;
	$targetLayer = imagecreatetruecolor($targetWidth,$targetHeight);
	imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
	return $targetLayer;
}

	$sql = "UPDATE tb_po SET 
	po_name='$po_name',
	cb_name='$cb_name',
	cb_date='$cb_date',
	insurance_price='$insurance_price',
	cb_file='$fileNewName'
	WHERE po_id=$po_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='pod.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='pod.php?act=add&do=f';";
    echo '</script>';
}
?>