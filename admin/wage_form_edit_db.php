<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$wage_id = mysqli_real_escape_string($con,$_POST['wage_id']);
	$wage_name = mysqli_real_escape_string($con,$_POST["wage_name"]);
    $wage_price = mysqli_real_escape_string($con,$_POST['wage_price']);
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$sql = "UPDATE  tb_wage SET 
	
	wage_name='$wage_name',
    wage_price = '$wage_price',
	username='$username'
	WHERE wage_id=$wage_id
	";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='wage.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='wage.php?act=add&do=f';";
    echo '</script>';
}
?>