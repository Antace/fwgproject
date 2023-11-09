<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}

	$label_ida = mysqli_real_escape_string($con,$_GET['ID']);
	$status_send = mysqli_real_escape_string($con,$_POST["status_send"]);
	

	$sql = "UPDATE tb_labeldetail SET 
    status_send='1'
	WHERE label_ida=$label_ida";


	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());
	mysqli_close($con);
	
	if($result){
	echo '<script>';
    echo "window.location='labeldetail.php?do=finish';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='labeldetail.php?act=add&do=f';";
    echo '</script>';
}

?>



