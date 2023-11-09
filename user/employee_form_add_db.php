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
	$emp_id = mysqli_real_escape_string($con,$_POST["emp_id"]);
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
	
	

	$check = "
	SELECT emp_id
	FROM tb_employees
	WHERE emp_id = '$emp_id'
	";
    $result1 = mysqli_query($con, $check) or die(mysqli_error($con));
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
	      	  echo '<script>';
		      echo "window.location='employee.php?act=add&do=d';";
		      echo '</script>';
    }else{

	$sql = "INSERT INTO tb_employees
	(
	emp_id,
	employee_name,
	Accountnumber,
	name_dept,
	name_position,
    Salary,
    Allowance,
    Position,
    House,
    Phone,
	Diligent,
    Oil,
	Bonus,
    Income,
	Overtime,
	username
	)
	VALUES
	(
	'$emp_id',
	'$employee_name',
	'$Accountnumber',
	'$name_dept',
	'$name_position',
    '$Salary',
    '$Allowance',
    '$Position',
    '$House',
    '$Phone',
	'$Diligent',
    '$Oil',
	'$Bonus',
    '$Income',
	'$Overtime',
	'$username'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));

	}
	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='employee.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='employee.php?act=add&do=f';";
    echo '</script>';
}
?>
