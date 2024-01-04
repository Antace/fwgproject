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
	$po_date = mysqli_real_escape_string($con,$_POST["po_date"]);
	$customer_name = mysqli_real_escape_string($con,$_POST["customer_name"]);
	$department_name = mysqli_real_escape_string($con,$_POST["department_name"]);
	$work_by = mysqli_real_escape_string($con,$_POST["work_by"]);
	$po_price = mysqli_real_escape_string($con,$_POST["po_price"]);
	$po_place = mysqli_real_escape_string($con,$_POST["po_place"]);
	$po_file2 = mysqli_real_escape_string($con,$_POST["po_file2"]);
	
	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$prodcut_img = (isset($_POST['po_file']) ? $_POST['po_file'] : '');
	$upload=$_FILES['po_file']['name'];
	$type = strrchr($_FILES['po_file']['name'],".");
	
	
	if($type=='.pdf'){
		if($upload !='') { 
		$path="../po_file/";
		$type = strrchr($_FILES['po_file']['name'],".");
		$fileNewName =$numrand.$date1.$type;
		$path_copy=$path.$fileNewName;
		$path_link="../po_file/".$fileNewName;
		move_uploaded_file($_FILES['po_file']['tmp_name'],$path_copy); 
		}
	}elseif(isset($_POST["submit"]) && !$_FILES['po_file']['error']) {
        $file = $_FILES['po_file']['tmp_name']; 
        $sourceProperties = getimagesize($file);
		$type = strrchr($_FILES['po_file']['name'],".");
        $fileNewName = time().$type;
        $folderPath = "../po_file/";
        $ext = pathinfo($_FILES['po_file']['name'], PATHINFO_EXTENSION);
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
        //  move_uploaded_file($file, $folderPath. $fileNewName);
    } else {
        $fileNewName=$po_file2;
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
	po_date='$po_date',
	customer_name='$customer_name',
	department_name='$department_name',
	work_by='$work_by',
	po_place='$po_place',
	po_price='$po_price',
	po_file='$fileNewName'
	WHERE po_id=$po_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
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