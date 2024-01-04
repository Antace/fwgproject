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
	$wage_name = mysqli_real_escape_string($con,$_POST["wage_name"]);
	$wage_price = mysqli_real_escape_string($con,$_POST["wage_price"]);
	$username = mysqli_real_escape_string($con,$_POST["username"]);
    $check = "
	SELECT wage_name
	FROM tb_wage
	WHERE wage_name = '$wage_name'
	";
	$result1 = mysqli_query($con, $check) or die(mysqli_error($con));
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
	      	  echo '<script>';
		      echo "window.location='wage.php?act=add&do=d';";
		      echo '</script>';
    }else{

	$sql = "INSERT INTO tb_wage
	(
        wage_name,
        wage_price,
	    username
	)
	VALUES
	(
	'$wage_name',
	'$wage_price',
	'$username'
	)";

	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
}
	mysqli_close($con);

	if($result){
	echo '<script>';
    echo "window.location='wage.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='wage.php?act=add&do=f';";
    echo '</script>';
}
?>