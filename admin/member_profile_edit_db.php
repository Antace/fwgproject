<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if($_SESSION['employee']==''){
	Header("Location: index.php");
}

	$employee_id = mysqli_real_escape_string($con,$_POST["employee_id"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);
	$password = mysqli_real_escape_string($con,$_POST["password"]);
	$employee_name = mysqli_real_escape_string($con,$_POST["employee_name"]);
	$employee_tel = mysqli_real_escape_string($con,$_POST["employee_tel"]);
	$employee_mail = mysqli_real_escape_string($con,$_POST["employee_mail"]);


	$sql = "UPDATE tb_employee SET 
	username='$username',
	employee_name='$employee_name',
	employee_tel='$employee_tel',
	employee_mail='$employee_mail'
	WHERE employee_id=$employee_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='member_profile.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='member_profile.php?act=add&do=f';";
    echo '</script>';
}
?>