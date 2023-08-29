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
	$iv_file = (isset($_POST['iv_file']) ? $_POST['iv_file'] : '');
	$upload=$_FILES['iv_file']['name'];
	if($upload !='') { 

		$path="../iv_file/";
		$type = strrchr($_FILES['iv_file']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../iv_file/".$newname;
		move_uploaded_file($_FILES['iv_file']['tmp_name'],$path_copy);  
	}else{
		$newname=$iv_file2;
	}

	$sql = "UPDATE tb_po SET 
	po_name='$po_name',
	iv_name='$iv_name',
	iv_date='$iv_date',
	iv_file='$newname'
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