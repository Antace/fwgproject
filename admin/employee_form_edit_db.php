<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}

	$employee_id = mysqli_real_escape_string($con,$_POST["employee_id"]);
	$emp_id = mysqli_real_escape_string($con,$_POST['emp_id']);
	$employee_name = mysqli_real_escape_string($con,$_POST["employee_name"]);
	$Accountnumber = mysqli_real_escape_string($con,$_POST["Accountnumber"]);
	$name_dept = mysqli_real_escape_string($con,$_POST["name_dept"]);
	$name_position = mysqli_real_escape_string($con,$_POST["name_position"]);
    $Salary = mysqli_real_escape_string($con,$_POST["Salary"]);
    $Allowance = mysqli_real_escape_string($con,$_POST["Allowance"]);
    $Position = mysqli_real_escape_string($con,$_POST["Position"]);
    $House = mysqli_real_escape_string($con,$_POST["House"]);
    $Phone = mysqli_real_escape_string($con,$_POST["Phone"]);
	$Diligent = mysqli_real_escape_string($con,$_POST["Diligent"]);
    $Oil = mysqli_real_escape_string($con,$_POST["Oil"]);
	$Bonus = mysqli_real_escape_string($con,$_POST["Bonus"]);
    $Income = mysqli_real_escape_string($con,$_POST["Income"]);
	$Overtime = mysqli_real_escape_string($con,$_POST["Overtime"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);



	$sql = "UPDATE tb_employees SET 
	emp_id='$emp_id',
	employee_name='$employee_name',
	Accountnumber='$Accountnumber',
	name_dept='$name_dept',
	name_position='$name_position',
    Salary='$Salary',
    Allowance='$Allowance',
    Position='$Position',
    House='$House',
    Phone='$Phone',
	Diligent='$Diligent',
    Oil='$Oil',
	Bonus='$Bonus',
    Income='$Income',
	Overtime='$Overtime',
	username='$username'
	WHERE employee_id=$employee_id
	 ";


	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='employee.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='employee.php?act=add&do=f';";
    echo '</script>';
}
?>