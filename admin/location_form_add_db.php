
<?php
session_start();
echo '<meta charset="utf-8">';
include('../condb.php');
if($_SESSION['employee_id']==''){
	Header("Location: index.php");
}
	$location_name = mysqli_real_escape_string($con,$_POST["location_name"]);
    $username = mysqli_real_escape_string($con,$_POST['username']);
	$check = "
	SELECT  location_name  
	FROM tb_location  
	WHERE 
	location_name = '$location_name'
	";
    // print_r($_POST);
	// exit;
    $result1 = mysqli_query($con, $check) or die(mysqli_error($con));
    $num=mysqli_num_rows($result1);

    if($num > 0)
    {
     echo '<script>';
	 echo "window.location='location.php?act=add&do=d';";
	 echo '</script>';
    }else{
	
	$sql = "INSERT INTO tb_location
	(location_name,username)
	VALUES
	('$location_name','$username')";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));
    // echo $sql;
    // exit;
}
	mysqli_close($con);
	if($result){
	echo '<script>';
    echo "window.location='location.php?do=success';";
    echo '</script>';
	}else{
	echo '<script>';
    echo "window.location='location.php?act=add&do=f';";
    echo '</script>';
}
?>