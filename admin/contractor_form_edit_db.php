<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
 //echo "<pre>";
 //print_r($_POST);
 //echo "</pre>";
 //exit();
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}

	$contractor_id = mysqli_real_escape_string($con,$_POST["contractor_id"]);
	$contractor_name = mysqli_real_escape_string($con,$_POST["contractor_name"]);
	$contractor_nickname = mysqli_real_escape_string($con,$_POST["contractor_nickname"]);
	$contractor_nid = mysqli_real_escape_string($con,$_POST["contractor_nid"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$sql = "UPDATE tb_contractor SET 
	contractor_name='$contractor_name',
	contractor_nickname='$contractor_nickname',
	contractor_nid='$contractor_nid',
	username='$username'
	WHERE contractor_id=$contractor_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='contractor.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='contractor.php?act=add&do=f';";
    echo '</script>';
}
?>