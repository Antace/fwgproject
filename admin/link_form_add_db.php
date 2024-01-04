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
	$link_name = mysqli_real_escape_string($con,$_POST["link_name"]);
	$link_user = mysqli_real_escape_string($con,$_POST["link_user"]);
	$link_pass = mysqli_real_escape_string($con,$_POST["link_pass"]);
	$link_detail = mysqli_real_escape_string($con,$_POST["link_detail"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);

	
	
	

	$check = "
	SELECT link_name
	FROM tb_link
	WHERE link_name = '$link_name'
	";
    $result1 = mysqli_query($con, $check) or die(mysqli_error($con));
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
	      	  echo '<script>';
		      echo "window.location='link.php?act=add&do=d';";
		      echo '</script>';
    }else{

	$sql = "INSERT INTO tb_link
	(
	link_name,
	link_user,
	link_pass,
	link_detail,
	username
	)
	VALUES
	(
	'$link_name',
	'$link_user',
	'$link_pass',
	'$link_detail',
	'$username'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));

	}
	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='link.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='link.php?act=add&do=f';";
    echo '</script>';
}
?>
