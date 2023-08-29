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
	$productp_name = mysqli_real_escape_string($con,$_POST["productp_name"]);
	$productp_thick = mysqli_real_escape_string($con,$_POST["productp_thick"]);
	$productp_height = mysqli_real_escape_string($con,$_POST["productp_height"]);
	$productp_long = mysqli_real_escape_string($con,$_POST["productp_long"]);
	$department_name = mysqli_real_escape_string($con,$_POST["department_name"]);
	$productp_uom = mysqli_real_escape_string($con,$_POST["productp_uom"]);
	$productp_unit = mysqli_real_escape_string($con,$_POST["productp_unit"]);
	$productp_weight = mysqli_real_escape_string($con,$_POST["productp_weight"]);
	
	$username = mysqli_real_escape_string($con,$_POST["username"]);
    // $check = "
	// SELECT productp_name
	// FROM tb_productp
	// WHERE productp_name = '$productp_name'
	// ";
	// $result1 = mysqli_query($con, $check) or die(mysqli_error());
    // $num=mysqli_num_rows($result1);

    if($num > 0)
    {
	      	  echo '<script>';
		      echo "window.location='productp.php?act=add&do=d';";
		      echo '</script>';
    }else{

	$sql = "INSERT INTO tb_productproject
	(
        productp_name,
		productp_thick,
		productp_height,
		productp_long,
        department_name,
        productp_uom,
        productp_unit,
		productp_weight,
	    username
	)
	VALUES
	(
	'$productp_name',
	'$productp_thick',
	'$productp_height',
	'$productp_long',
	'$department_name',
	'$productp_uom',
	'$productp_unit',
	'$productp_weight',
	'$username'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
}
	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='productp.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='productp.php?act=add&do=f';";
    echo '</script>';
}
?>