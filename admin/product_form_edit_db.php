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

	$product_id = mysqli_real_escape_string($con,$_POST["product_id"]);
    $product_idn = mysqli_real_escape_string($con,$_POST["product_idn"]);
	$product_name = mysqli_real_escape_string($con,$_POST["product_name"]);
	$product_detail = mysqli_real_escape_string($con,$_POST["product_detail"]);
	$product_price = mysqli_real_escape_string($con,$_POST["product_price"]);
	$product_uom = mysqli_real_escape_string($con,$_POST["product_uom"]);	
    $product_unit = mysqli_real_escape_string($con,$_POST["product_unit"]);	
	$product_weight = mysqli_real_escape_string($con,$_POST["product_weight"]);	
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$sql = "UPDATE tb_product SET 
	product_idn='$product_idn',
	product_name='$product_name',
	product_detail='$product_detail',
	product_price='$product_price',
    product_uom='$product_uom',
    product_unit='$product_unit',
	product_weight='$product_weight',
	username='$username'
	WHERE product_id=$product_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='product.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='product.php?act=add&do=f';";
    echo '</script>';
}
?>