<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$expenses_id = mysqli_real_escape_string($con,$_POST['expenses_id']);
	$expenses_name = mysqli_real_escape_string($con,$_POST["expenses_name"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$sql = "UPDATE  tb_expenses SET 
	expenses_name='$expenses_name',
	username='$username'
	WHERE expenses_id=$expenses_id
	";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='expenses.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='expenses.php?act=add&do=f';";
    echo '</script>';
}
?>