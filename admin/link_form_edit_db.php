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

	$link_id = mysqli_real_escape_string($con,$_POST["link_id"]);
	$link_name = mysqli_real_escape_string($con,$_POST["link_name"]);
	$link_user = mysqli_real_escape_string($con,$_POST["link_user"]);
	$link_pass = mysqli_real_escape_string($con,$_POST["link_pass"]);
	$link_detail = mysqli_real_escape_string($con,$_POST["link_detail"]);	
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	$sql = "UPDATE tb_link SET 
	link_name='$link_name',
	link_user='$link_user',
	link_pass='$link_pass',
	link_detail='$link_detail',
	username='$username'
	WHERE link_id=$link_id
	 ";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='link.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='link.php?act=add&do=f';";
    echo '</script>';
}
?>