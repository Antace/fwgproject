<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit();
	$contractor_name = mysqli_real_escape_string($con,$_POST["contractor_name"]);
	$contractor_nickname = mysqli_real_escape_string($con,$_POST["contractor_nickname"]);
	$contractor_nid = mysqli_real_escape_string($con,$_POST["contractor_nid"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	
	
	

	$check = "
	SELECT contractor_name
	FROM tb_contractor
	WHERE contractor_name = '$contractor_name'
	";
    $result1 = mysqli_query($con, $check) or die(mysqli_error());
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
	      	  echo '<script>';
		      echo "window.location='contractor.php?act=add&do=d';";
		      echo '</script>';
    }else{

	$sql = "INSERT INTO tb_contractor
	(
	contractor_name,
	contractor_nickname,
	contractor_nid,
	username
	)
	VALUES
	(
	'$contractor_name',
	'$contractor_nickname',
	'$contractor_nid',
	'$username'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

	}
	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='contractor.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='contractor.php?act=add&do=f';";
    echo '</script>';
}
?>
