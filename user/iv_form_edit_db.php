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
	$iv_name = mysqli_real_escape_string($con,$_POST["iv_name"]);
	$iv_date = mysqli_real_escape_string($con,$_POST["iv_date"]);
	$iv_file2 = mysqli_real_escape_string($con,$_POST["iv_file2"]);
	
    $date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$prodcut_img = (isset($_POST['iv_file']) ? $_POST['iv_file'] : '');
	$upload=$_FILES['iv_file']['name'];
	$type = strrchr($_FILES['iv_file']['name'],".");
	
	
	if($type=='.pdf'){
		if($upload !='') { 
		$path="../iv_file/";
		$type = strrchr($_FILES['iv_file']['name'],".");
		$fileNewName =$numrand.$date1.$type;
		$path_copy=$path.$fileNewName;
		$path_link="../iv_file/".$fileNewName;
		move_uploaded_file($_FILES['iv_file']['tmp_name'],$path_copy); 
		}
	}elseif(isset($_POST["submit"]) && !$_FILES['iv_file']['error']) {
        $file = $_FILES['iv_file']['tmp_name']; 
        $sourceProperties = getimagesize($file);
		$type = strrchr($_FILES['iv_file']['name'],".");
        $fileNewName = time().$type;
        $folderPath = "../iv_file/";
        $ext = pathinfo($_FILES['iv_file']['name'], PATHINFO_EXTENSION);
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
        $fileNewName=$iv_file2;
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
	iv_name='$iv_name',
	iv_date='$iv_date',
	iv_file='$fileNewName'
	WHERE po_id=$po_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='po.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='po.php?act=add&do=f';";
    echo '</script>';
}
?>