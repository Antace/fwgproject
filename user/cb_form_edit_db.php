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
	$cb_file2 = mysqli_real_escape_string($con,$_POST["cb_file2"]);
	
	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$cb_file = (isset($_POST['cb_file']) ? $_POST['cb_file'] : '');
	$upload=$_FILES['cb_file']['name'];
	if($upload !='') { 

		$path="../cb_file/";
		$type = strrchr($_FILES['cb_file']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../cb_file/".$newname;
		move_uploaded_file($_FILES['cb_file']['tmp_name'],$path_copy);  
	}else{
		$newname=$cb_file2;
	}

	$sql = "UPDATE tb_po SET 
	po_name='$po_name',
	cb_name='$cb_name',
	cb_date='$cb_date',
	cb_file='$newname'
	WHERE po_id=$po_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
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