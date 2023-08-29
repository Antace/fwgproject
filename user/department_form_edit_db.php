<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$department_id = mysqli_real_escape_string($con,$_POST['department_id']);
	$dept_name = mysqli_real_escape_string($con,$_POST['dept_name']);
	$department_name = mysqli_real_escape_string($con,$_POST["department_name"]);


	$sql = "UPDATE  tb_department SET 
	dept_name = '$dept_name',
	department_name='$department_name'
	WHERE department_id=$department_id
	";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='department.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='department.php?act=add&do=f';";
    echo '</script>';
}
?>