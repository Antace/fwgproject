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
	$category_name = mysqli_real_escape_string($con,$_POST["category_name"]);
	$work_by = mysqli_real_escape_string($con,$_POST["work_by"]);
	$po_price = mysqli_real_escape_string($con,$_POST["po_price"]);
	$po_place = mysqli_real_escape_string($con,$_POST["po_place"]);
	$po_file2 = mysqli_real_escape_string($con,$_POST["po_file2"]);

	
	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$po_file = (isset($_POST['po_file']) ? $_POST['po_file'] : '');
	$upload=$_FILES['po_file']['name'];
	if($upload !='') { 

		$path="../po_file/";
		$type = strrchr($_FILES['po_file']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../po_file/".$newname;
		move_uploaded_file($_FILES['po_file']['tmp_name'],$path_copy);  
	}else{
		$newname=$po_file2;
	}

	$sql = "UPDATE tb_po SET 
	po_name='$po_name',
	po_date='$po_date',
	customer_name='$customer_name',
	department_name='$department_name',
	category_name='$category_name',
	work_by='$work_by',
	po_place='$po_place',
	po_price='$po_price',
	po_file='$newname'
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