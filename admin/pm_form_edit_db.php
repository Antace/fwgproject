<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
 //echo "<pre>";
 //print_r($_POST);
 //echo "</pre>";
 //exit();
 
    //$strplsDate = $row['po_insurance'];
  
  //print_r($strplsDate);
  //exit():
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$po_id = mysqli_real_escape_string($con,$_POST["po_id"]);
	$po_name = mysqli_real_escape_string($con,$_POST["po_name"]);
	$pm_name = mysqli_real_escape_string($con,$_POST["pm_name"]);
	$pm_date = mysqli_real_escape_string($con,$_POST["pm_date"]);
	$po_datesend = mysqli_real_escape_string($con,$_POST["po_datesend"]);
	$po_insurance = mysqli_real_escape_string($con,$_POST["po_insurance"]);
	//$po_dateexpire = date ("Y-m-d", strtotime("+".$strplsDate. "year"));
	$po_dateexpire = mysqli_real_escape_string($con,$_POST["po_dateexpire"]);
	$po_dateexpire = date("Y-m-d", strtotime($po_datesend."+".$po_insurance. "year"));
	$pm_file2 = mysqli_real_escape_string($con,$_POST["pm_file2"]);

	//print_r ($po_datesend);
	//echo "<br>";
	//print_r ($po_insurance);
	//echo "<br>";
	//print_r ($po_dateexpire);
	//print_r ($_POST);
	//exit;
	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$prodcut_img = (isset($_POST['pm_file']) ? $_POST['pm_file'] : '');
	$upload=$_FILES['pm_file']['name'];
	$type = strrchr($_FILES['pm_file']['name'],".");
	
	
	if($type=='.pdf'){
		if($upload !='') { 
		$path="../pm_file/";
		$type = strrchr($_FILES['pm_file']['name'],".");
		$fileNewName =$numrand.$date1.$type;
		$path_copy=$path.$fileNewName;
		$path_link="../pm_file/".$fileNewName;
		move_uploaded_file($_FILES['pm_file']['tmp_name'],$path_copy); 
		}
	}elseif(isset($_POST["submit"]) && !$_FILES['pm_file']['error']) {
        $file = $_FILES['pm_file']['tmp_name']; 
        $sourceProperties = getimagesize($file);
		$type = strrchr($_FILES['pm_file']['name'],".");
        $fileNewName = time().$type;
        $folderPath = "../pm_file/";
        $ext = pathinfo($_FILES['pm_file']['name'], PATHINFO_EXTENSION);
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
        $fileNewName=$pm_file2;
    }
	function imageResize($imageResourceId,$width,$height) {
        $targetWidth = $width < 1280 ? $width : 1280 ;
        $targetHeight = ($height/$width)* $targetWidth;
        $targetLayer = imagecreatetruecolor($targetWidth,$targetHeight);
        imagecopyresampled($targetLayer, $imageResourceId, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);
        return $targetLayer;
    }
	//print_r ($pm_file);
	//echo "<br>";
	//print_r ($_POST);
	//print_r ($newname);
	//exit;
	$sql = "UPDATE tb_po SET 
	po_name='$po_name',
	pm_name='$pm_name',
	pm_date='$pm_date',
	pm_file='$fileNewName',
	po_datesend='$po_datesend',
	po_insurance='$po_insurance',
	po_dateexpire='$po_dateexpire'
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