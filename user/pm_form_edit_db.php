<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
 //echo "<pre>";
 //print_r($_POST);
 //echo "</pre>";
 //exit();
 
    //$strplsDate = $row['po_insurance'];
  
  //print_r($strplsDate);
  //exit():
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$po_id = mysqli_real_escape_string($con,$_POST["po_id"]);
	$po_name = mysqli_real_escape_string($con,$_POST["po_name"]);
	$pm_name = mysqli_real_escape_string($con,$_POST["pm_name"]);
	$pm_date = mysqli_real_escape_string($con,$_POST["pm_date"]);
	$po_datesend = mysqli_real_escape_string($con,$_POST["po_datesend"]);
	$po_insurance = mysqli_real_escape_string($con,$_POST["po_insurance"]);
	//$po_dateexpire = date ("Y-m-d", strtotime("+".$strplsDate. "year"));
	$po_dateexpire = mysqli_real_escape_string($con,$_POST["po_dateexpire"]);
	$po_dateexpire = date("Y-m-d", strtotime($po_datesend."+".$po_insurance. "year"));
	$pm_file2 = mysqli_real_escape_string($con,$_POST["pm_file2"]);

	//print_r ($po_datesend);
	//echo "<br>";
	//print_r ($po_insurance);
	//echo "<br>";
	//print_r ($po_dateexpire);
	//print_r ($_POST);
	//exit;
	$date1 = date("Ymd_His");
	$numrand = (mt_rand());
	$pm_file = (isset($_POST['pm_file2']) ? $_POST['pm_file2'] : '');
	$upload=$_FILES['pm_file']['name'];
	if($upload !='') { 
		//move_uploaded_file($_FILES['file']['tmp_name'],'/image/'.$upload);
		$path="../pm_file/";
		$type = strrchr($_FILES['pm_file']['name'],".");
		$newname =$numrand.$date1.$type;
		$path_copy=$path.$newname;
		$path_link="../pm_file/".$newname;
		move_uploaded_file($_FILES['pm_file']['tmp_name'],$path_copy);  
	}else{
		$newname=$pm_file2;
	}
	//print_r ($pm_file);
	//echo "<br>";
	//print_r ($_POST);
	//print_r ($newname);
	//exit;
	$sql = "UPDATE tb_po SET 
	po_name='$po_name',
	pm_name='$pm_name',
	pm_date='$pm_date',
	pm_file='$newname',
	po_datesend='$po_datesend',
	po_insurance='$po_insurance',
	po_dateexpire='$po_dateexpire'
	WHERE po_id=$po_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='po.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='po.php?act=add&do=f';";
    echo '</script>';
}
?>