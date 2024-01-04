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

	$rexpenses_id = mysqli_real_escape_string($con,$_POST["rexpenses_id"]);
    $rexpenses_date = mysqli_real_escape_string($con,$_POST["rexpenses_date"]);
	$contractor_nickname = mysqli_real_escape_string($con,$_POST["contractor_nickname"]);
	$expenses_name = mysqli_real_escape_string($con,$_POST["expenses_name"]);
	$rexpenses_uom = mysqli_real_escape_string($con,$_POST["rexpenses_uom"]);
	
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$sql = "UPDATE tb_rexpenses SET 
    rexpenses_date='$rexpenses_date',
	contractor_nickname='$contractor_nickname',
	expenses_name='$expenses_name',
	rexpenses_uom='$rexpenses_uom',
	username='$username'
	WHERE rexpenses_id=$rexpenses_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='rexpenses.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='rexpenses.php?act=add&do=f';";
    echo '</script>';
}
?>