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
    $salary_id = mysqli_real_escape_string($con,$_POST["salary_id"]);
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
    // $sum1 = mysqli_real_escape_string($con,$_POST["sum1"]);
    // $sum2 = mysqli_real_escape_string($con,$_POST["sum2"]);
    // $total = mysqli_real_escape_string($con,$_POST["total"]);
    
    
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
	

	$sql = "UPDATE tb_salary SET
	
    salary_date='$salary_date',
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
    SocialSecurity='$SocialSecurity',
    Tax='$Tax',
    Late='$Late',
    Absentt='$Absentt',
    SBH='$SBH',
    Reveal='$Reveal',
    ReserveFund='$ReserveFund',
    Other='$Other',
    insuranceAL='$insuranceAL', 
    SLF='$SLF',
    sum1='$sum1',
    sum2='$sum2',
    total='$total'
    WHERE salary_id=$salary_id
	";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));

	
	mysqli_close($con);

	if($result){
        echo '<script>';
        echo "window.location='salary.php?do=finish';";
        echo '</script>';
        }else{
        echo '<script>';
        echo "window.location='salary.php?act=add&do=f';";
        echo '</script>';
    }
    ?>
