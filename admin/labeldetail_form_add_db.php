<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	
	$label_place = mysqli_real_escape_string($con,$_POST["label_place"]);
	$label_numberid = mysqli_real_escape_string($con,$_POST["label_numberid"]);
	$department_name = mysqli_real_escape_string($con,$_POST["department_name"]);
	$label_orderstatus = mysqli_real_escape_string($con,$_POST["label_orderstatus"]);
	$status_send = mysqli_real_escape_string($con,$_POST["status_send"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);
	

    
	$sql = "INSERT INTO tb_labeldetail
	(
        label_place,
        label_numberid,
	    department_name,
	    label_orderstatus,
	    status_send,
		username
	)
	VALUES
	(
	'$label_place',
	'$label_numberid',
	'$department_name',
	'$label_orderstatus',
	'$status_send',
	'$username'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));

	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='labeldetail.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='labeldetail.php?act=add&do=f';";
    echo '</script>';
}
?>