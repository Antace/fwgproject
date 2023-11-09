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
    
	$productdept_name = mysqli_real_escape_string($con,$_POST["productdept_name"]);
	$productdept_price = mysqli_real_escape_string($con,$_POST["productdept_price"]);
	
	
	$username = mysqli_real_escape_string($con,$_POST["username"]);
    $check = "
	SELECT productdept_name
	FROM tb_productdept
	WHERE productdept_name = '$productdept_name'
	";
	$result1 = mysqli_query($con, $check) or die(mysqli_error($con));
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
	      	  echo '<script>';
		      echo "window.location='productdept.php?act=add&do=d';";
		      echo '</script>';
    }else{

	$sql = "INSERT INTO tb_productdept
	(
        productdept_name,
        productdept_price,
	    username
	)
	VALUES
	(
	'$productdept_name',
	'$productdept_price',
	'$username'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
}
	mysqli_close($con);

	if($result){
	if($_GET['act']=="productadd"){
	echo '<script>';
    echo "window.location='product.php?act=add1';";
    echo '</script>';
	}elseif($_GET['act']=="productedit"){
	echo '<script>';
    echo "window.location='product.php?act=edit';";
    echo '</script>';
	}
	}else{
	echo '<script>';
    echo "window.location='productdept.php?act=add&do=f';";
    echo '</script>';
}
?>