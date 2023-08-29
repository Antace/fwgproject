<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
// echo "<pre>";
 //print_r($_POST);
 //echo "</pre>";
 //exit();
	$employee_id = mysqli_real_escape_string($con,$_POST["employee_id"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);
	$password = mysqli_real_escape_string($con,$_POST["password"]);
	$employee_name = mysqli_real_escape_string($con,$_POST["employee_name"]);
	$employee_tel = mysqli_real_escape_string($con,$_POST["employee_tel"]);
	$employee_mail = mysqli_real_escape_string($con,$_POST["employee_mail"]);
	$employee_level = mysqli_real_escape_string($con,$_POST["employee_level"]);
	$username1 = mysqli_real_escape_string($con,$_POST["username1"]);


	$sql = "UPDATE tb_employee SET 
	username='$username',
	employee_name='$employee_name',
	employee_tel='$employee_tel',
	employee_mail='$employee_mail',
	employee_level='$employee_level',
	username1='$username1'
	WHERE employee_id=$employee_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='member.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='member.php?act=add&do=f';";
    echo '</script>';
}
?>