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

	$customer_id = mysqli_real_escape_string($con,$_POST["customer_id"]);
	$customer_name = mysqli_real_escape_string($con,$_POST["customer_name"]);
	$customer_address = mysqli_real_escape_string($con,$_POST["customer_address"]);
	$customer_branch = mysqli_real_escape_string($con,$_POST["customer_branch"]);
	$customer_tax = mysqli_real_escape_string($con,$_POST["customer_tax"]);
	$customer_type = mysqli_real_escape_string($con,$_POST["customer_type"]);	
	$customer_credit = mysqli_real_escape_string($con,$_POST["customer_credit"]);	
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$sql = "UPDATE tb_customer SET 
	customer_name='$customer_name',
	customer_address='$customer_address',
	customer_branch='$customer_branch',
	customer_tax='$customer_tax',
	customer_type='$customer_type',
	customer_credit='$customer_credit',
	username='$username'
	WHERE customer_id=$customer_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='customer.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='customer.php?act=add&do=f';";
    echo '</script>';
}
?>