<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
	$customer_name = mysqli_real_escape_string($con,$_POST["customer_name"]);
	$customer_address = mysqli_real_escape_string($con,$_POST["customer_address"]);
	$customer_branch = mysqli_real_escape_string($con,$_POST["customer_branch"]);
	$customer_tax = mysqli_real_escape_string($con,$_POST["customer_tax"]);
	$customer_type = mysqli_real_escape_string($con,$_POST["customer_type"]);
	$customer_credit = mysqli_real_escape_string($con,$_POST["customer_credit"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	
	
	

	$check = "
	SELECT customer_name
	FROM tb_customer
	WHERE customer_name = '$customer_name'
	";
    $result1 = mysqli_query($con, $check) or die(mysqli_error());
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
	      	  echo '<script>';
		      echo "window.location='customer.php?act=add&do=d';";
		      echo '</script>';
    }else{

	$sql = "INSERT INTO tb_customer
	(
	customer_name,
	customer_address,
	customer_branch,
	customer_tax,
	customer_type,
	customer_credit,
	username
	)
	VALUES
	(
	'$customer_name',
	'$customer_address',
	'$customer_branch',
	'$customer_tax',
	'$customer_type',
	'$customer_credit',
	'$username'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

	}
	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='customer.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='customer.php?act=add&do=f';";
    echo '</script>';
}
?>
