<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
	$username = mysqli_real_escape_string($con,$_POST["username"]);
	$password = mysqli_real_escape_string($con,$_POST["password"]);
	$employee_name = mysqli_real_escape_string($con,$_POST["employee_name"]);
	$employee_tel = mysqli_real_escape_string($con,$_POST["employee_tel"]);
	$employee_mail = mysqli_real_escape_string($con,$_POST["employee_mail"]);
	$employee_level = mysqli_real_escape_string($con,$_POST["employee_level"]);
	$username1 = mysqli_real_escape_string($con,$_POST["username1"]);
	
	

	$check = "
	SELECT username
	FROM tb_employee
	WHERE username = '$username'
	";
    $result1 = mysqli_query($con, $check) or die(mysqli_error());
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
	      	  echo '<script>';
		      echo "window.location='member.php?act=add&do=d';";
		      echo '</script>';
    }else{

	$sql = "INSERT INTO tb_employee
	(
	username,
	password,
	employee_name,
	employee_tel,
	employee_mail,
	employee_level,
	username1
	)
	VALUES
	(
	'$username',
	'$password',
	'$employee_name',
	'$employee_tel',
	'$employee_mail',
	'$employee_level',
	'$username1'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

	}
	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='member.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='member.php?act=add&do=f';";
    echo '</script>';
}
?>
