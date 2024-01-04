<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$ID  = mysqli_real_escape_string($con,$_GET["ID"]);
	$sql = "DELETE FROM tb_location WHERE location_id=$ID";
    // echo $sql;
    // exit;
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));	
	mysqli_close($con);
	
	if($result){
	echo "<script type='text/javascript'>";
	echo "window.location = 'location.php'; ";
	echo "</script>";
	}else{
	echo "<script type='text/javascript'>";
	echo "window.location = 'location.php'; ";
	echo "</script>";
}
?>