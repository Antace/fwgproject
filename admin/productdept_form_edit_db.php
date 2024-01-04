<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
 //echo "<pre>";
 //print_r($_POST);
 //echo "</pre>";
 //exit();
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}

	$productdept_id = mysqli_real_escape_string($con,$_POST["productdept_id"]);
	$productdept_name = mysqli_real_escape_string($con,$_POST["productdept_name"]);
	$productdept_price = mysqli_real_escape_string($con,$_POST["productdept_price"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$sql = "UPDATE tb_productdept SET 

	productdept_name='$productdept_name',
	productdept_price='$productdept_price',
	username='$username'
	WHERE productdept_id=$productdept_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='productdept.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='productdept.php?act=add&do=f';";
    echo '</script>';
}
?>