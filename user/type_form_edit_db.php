<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$category_id = mysqli_real_escape_string($con,$_POST['category_id']);
	$category_name = mysqli_real_escape_string($con,$_POST["category_name"]);
	

	$sql = "UPDATE  tb_category SET 
	category_name='$category_name'
	WHERE category_id=$category_id
	";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='type.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='type.php?act=add&do=f';";
    echo '</script>';
}
?>