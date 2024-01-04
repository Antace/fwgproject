<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$location_id = mysqli_real_escape_string($con,$_POST['location_id']);
	$location_name = mysqli_real_escape_string($con,$_POST["location_name"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$sql = "UPDATE  tb_location SET 
	location_name='$location_name',
	username='$username'
	WHERE location_id=$location_id
	";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='location.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='location.php?act=add&do=f';";
    echo '</script>';
}
?>