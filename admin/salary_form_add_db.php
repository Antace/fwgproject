<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
 //echo "<pre>";
 //print_r($_POST);
 //echo "</pre>";
 //exit();
    
    $salary_date = mysqli_real_escape_string($con,$_POST["salary_date"]);
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
    $SocialSecurity = mysqli_real_escape_string($con,$_POST["SocialSecurity"]);
    $Tax = mysqli_real_escape_string($con,$_POST["Tax"]);
    $Late = mysqli_real_escape_string($con,$_POST["Late"]);
    $Absentt = mysqli_real_escape_string($con,$_POST["Absentt"]);
    $SBH = mysqli_real_escape_string($con,$_POST["SBH"]);
    $Reveal = mysqli_real_escape_string($con,$_POST["Reveal"]);
    $ReserveFund = mysqli_real_escape_string($con,$_POST["ReserveFund"]);
    $Other = mysqli_real_escape_string($con,$_POST["Other"]);
    $insuranceAL = mysqli_real_escape_string($con,$_POST["insuranceAL"]);
      $Overtime = mysqli_real_escape_string($con,$_POST["Overtime"]);
    $SLF = mysqli_real_escape_string($con,$_POST["SLF"]);
    
    $sum1 = $Salary + $Allowance + $Position + $House + $Phone + $Diligent + $Oil + $Bonus + $Income + $Overtime ;
    $sum2 = $SocialSecurity + $Tax + $Late + $Absentt + $SBH + $Reveal + $ReserveFund + $Other + $insuranceAL + $SLF;
    $total = $sum1-$sum2;

    
//  echo "<pre>";
//  print_r($sum1);
//  echo "<br>";
//  print_r($sum2);
//  echo "<br>";
//  print_r($total);
//  echo "</pre>";
//  exit();
	

	$sql = "INSERT INTO tb_salary
	(
    salary_date,
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
    SocialSecurity,
    Tax,
    Late,
    Absentt,
    SBH,
    Reveal,
    ReserveFund,
    Other,
    insuranceAL,
    SLF,
    sum1,
    sum2,
    total

	)
	VALUES
	(
    '$salary_date',
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
    '$SocialSecurity',
    '$Tax',
    '$Late', 
    '$Absentt', 
    '$SBH', 
    '$Reveal', 
    '$ReserveFund', 
    '$Other',
    '$insuranceAL', 
    '$SLF',
    '$sum1',
    '$sum2',
    '$total'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));

	
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
