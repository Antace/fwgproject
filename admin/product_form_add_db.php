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
    $product_idn = mysqli_real_escape_string($con,$_POST["product_idn"]);
	$product_name = mysqli_real_escape_string($con,$_POST["product_name"]);
	$product_detail = mysqli_real_escape_string($con,$_POST["product_detail"]);
	
	$product_price = mysqli_real_escape_string($con,$_POST["product_price"]);
	$calculate_uom = mysqli_real_escape_string($con,$_POST["calculate_uom"]);
	$production_price = mysqli_real_escape_string($con,$_POST["production_price"]);
	$product_uom = mysqli_real_escape_string($con,$_POST["product_uom"]);
	$product_unit = mysqli_real_escape_string($con,$_POST["product_unit"]);
	$product_weight = mysqli_real_escape_string($con,$_POST["product_weight"]);
	
	$username = mysqli_real_escape_string($con,$_POST["username"]);
    $check = "
	SELECT product_name
	FROM tb_product
	WHERE product_name = '$product_name'
	";
	$result1 = mysqli_query($con, $check) or die(mysqli_error());
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
	      	  echo '<script>';
		      echo "window.location='product.php?act=add&do=d';";
		      echo '</script>';
    }else{

	$sql = "INSERT INTO tb_product
	(
        product_idn,
        product_name,
        product_detail,
        product_price,
		calculate_uom,
		production_price,
        product_uom,
        product_unit,
		product_weight,
	    username
	)
	VALUES
	(
	'$product_idn',
	'$product_name',
	'$product_detail',
	'$product_price',
	'$calculate_uom',
	'$production_price',
	'$product_uom',
	'$product_unit',
	'$product_weight',
	'$username'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
}
	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='product.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='product.php?act=add&do=f';";
    echo '</script>';
}
?>