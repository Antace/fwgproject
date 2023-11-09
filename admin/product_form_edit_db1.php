<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
//  echo "<pre>";
//  print_r($_POST);
//  echo "</pre>";
//  exit();
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}

	$product_id = mysqli_real_escape_string($con,$_POST["product_id"]);
    $product_idn = mysqli_real_escape_string($con,$_POST["product_idn"]);
	$product_name = mysqli_real_escape_string($con,$_POST["product_name"]);
	$product_detail = mysqli_real_escape_string($con,$_POST["product_detail"]);
    $num2 = mysqli_real_escape_string($con,$_POST["num2"]);
	$num1 = mysqli_real_escape_string($con,$_POST["num1"]);
	$product_price = mysqli_real_escape_string($con,$_POST["product_price"]);
	$calculate_uom = mysqli_real_escape_string($con,$_POST["calculate_uom"]);
	$production_price = mysqli_real_escape_string($con,$_POST["production_price"]);
	$product_uom = mysqli_real_escape_string($con,$_POST["product_uom"]);	
    $product_unit = mysqli_real_escape_string($con,$_POST["product_unit"]);	
	$product_weight = mysqli_real_escape_string($con,$_POST["product_weight"]);	
	$username = mysqli_real_escape_string($con,$_POST["username"]);

    if($num2==''){
	$sql = "UPDATE tb_product SET 
	product_idn='$product_idn',
	product_name='$product_name',
	product_detail='$product_detail',
	product_price='$product_price',
	calculate_uom='$calculate_uom',
	production_price='$production_price',
    product_uom='$product_uom',
    product_unit='$product_unit',
	product_weight='$product_weight',
	username='$username'
	WHERE product_id=$product_id
	 ";
    }elseif(!empty($num2)){
    $product_name1 = $product_name.$num2.' ม.';
    $sql = "UPDATE tb_product SET 
	product_idn='$product_idn',
	product_name='$product_name1',
	product_detail='$product_detail',
	product_price='$product_price',
	calculate_uom='$calculate_uom',
	production_price='$production_price',
    product_uom='$product_uom',
    product_unit='$product_unit',
	product_weight='$product_weight',
	username='$username'
	WHERE product_id=$product_id
	 ";
    }
    // echo $sql;
    // exit;
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
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